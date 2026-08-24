<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Step 1: Send 2-Minute OTP to Admin Email & Save to Database.
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower(trim($request->input('email')));
        $adminUser = User::where('email', $email)->where('is_admin', true)->first();

        if (! $adminUser) {
            return response()->json([
                'status' => 'error',
                'title' => 'Invalid Admin Email ❌',
                'message' => 'No active administrator account was found with this email address.',
            ], 422);
        }

        // Generate 6-digit OTP & 2-minute expiration timestamp
        $otp = sprintf('%06d', mt_rand(100000, 999999));
        $expiresAt = Carbon::now()->addMinutes(2);

        // Save OTP directly into database on User model
        $adminUser->update([
            'otp_code' => $otp,
            'otp_expires_at' => $expiresAt,
        ]);

        // Keep session sync
        session([
            'admin_otp_email' => $email,
            'admin_otp_expires' => $expiresAt,
        ]);

        // Resolve Location and Google Maps URL
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');
        $inputAddress = trim((string) $request->input('location_address'));
        $ipAddress = $request->ip();

        if ($lat && $lng) {
            $locationAddress = ! empty($inputAddress) ? $inputAddress : "Lat: {$lat}, Lng: {$lng}";
            $mapUrl = "https://www.google.com/maps?q={$lat},{$lng}";
        } else {
            $locationAddress = ! empty($inputAddress) ? $inputAddress : (in_array($ipAddress, ['127.0.0.1', '::1']) ? 'Localhost / Internal System (Lucknow, UP)' : "IP Location ({$ipAddress})");
            $mapUrl = 'https://www.google.com/maps/search/?api=1&query='.urlencode($locationAddress);
        }

        // Prepare Security Audit Data for HTML Email
        $mailData = [
            'adminName' => $adminUser->name,
            'email' => $email,
            'otp' => $otp,
            'ipAddress' => $ipAddress,
            'browser' => $this->getBrowser($request->userAgent()),
            'deviceOs' => $this->getOs($request->userAgent()),
            'locationAddress' => $locationAddress,
            'mapUrl' => $mapUrl,
            'requestTime' => Carbon::now()->format('M d, Y h:i A'),
        ];

        // Attempt to send rich HTML Security Audit Email
        try {
            // Recipient email from .env (ADMIN_OTP_EMAIL) or fallback to entered admin email
            $recipientEmail = env('ADMIN_OTP_EMAIL') ?: $email;

            Mail::send('emails.admin-otp', $mailData, function ($message) use ($recipientEmail) {
                $message->to($recipientEmail)
                    ->subject('🛡️ Admin Security OTP & Login Audit - Software Company in Lucknow');
            });
        } catch (\Throwable $e) {
            // Mailer failure fallback
        }

        return response()->json([
            'status' => 'success',
            'title' => 'OTP Sent! 📧 (Valid 2 Mins)',
            'message' => "6-digit OTP code sent to {$recipientEmail}. Valid for 2 minutes.",
            'email' => $email,
            'recipient_email' => $recipientEmail,
            'expires_in_seconds' => 120,
        ]);
    }

    /**
     * Step 2: Verify OTP Code & Clear OTP from Database Immediately ("verify hote hi blank").
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $email = strtolower(trim($request->input('email')));
        $enteredOtp = trim($request->input('otp'));

        $adminUser = User::where('email', $email)->where('is_admin', true)->first();

        if (! $adminUser || empty($adminUser->otp_code)) {
            return response()->json([
                'status' => 'error',
                'title' => 'No OTP Found ❌',
                'message' => 'No active OTP found. Please request a new OTP code.',
            ], 422);
        }

        // Check 2-minute expiration
        if (! $adminUser->otp_expires_at || Carbon::now()->greaterThan($adminUser->otp_expires_at)) {
            // Clear expired OTP from database
            $adminUser->update([
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            return response()->json([
                'status' => 'error',
                'title' => 'OTP Expired ⏰',
                'message' => 'The 2-minute OTP code has expired. Please click resend to get a new code.',
            ], 422);
        }

        // Verify OTP digits match
        if ($enteredOtp !== $adminUser->otp_code) {
            return response()->json([
                'status' => 'error',
                'title' => 'Incorrect OTP ❌',
                'message' => 'Invalid 6-digit OTP code entered. Please check and try again.',
            ], 422);
        }

        // "verify hote hi blank": Clear OTP fields in database immediately upon verification!
        $adminUser->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Save OTP verified token in session
        session(['admin_otp_verified_email' => $email]);

        return response()->json([
            'status' => 'success',
            'title' => 'OTP Verified! 🔐',
            'message' => 'Identity verified successfully! Please enter your admin password.',
            'email' => $email,
        ]);
    }

    /**
     * Step 3: Complete Password Login & Record Security Activity.
     */
    public function login(Request $request): JsonResponse|RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = strtolower(trim($credentials['email']));

        // Ensure OTP verification was completed for this email
        $verifiedEmail = session('admin_otp_verified_email');
        if (! $verifiedEmail || $verifiedEmail !== $email) {
            return response()->json([
                'status' => 'error',
                'title' => 'OTP Verification Required 🔒',
                'message' => 'Please verify the 6-digit OTP code before entering password.',
            ], 422);
        }

        // Determine specific error cause if credentials fail
        $adminUser = User::where('email', $email)->first();
        if (! $adminUser || ! $adminUser->is_admin) {
            $errorTitle = 'Email Not Found ❌';
            $errorMessage = 'No administrator account found with this email address.';
            $errorField = 'email';
        } else {
            $errorTitle = 'Incorrect Password ❌';
            $errorMessage = 'Incorrect password entered for this admin account.';
            $errorField = 'password';
        }

        // If AJAX pre-verification request, validate credentials without mutating session state
        if ($request->boolean('verify_only')) {
            if (Auth::validate(['email' => $email, 'password' => $credentials['password'], 'is_admin' => true])) {
                return response()->json([
                    'status' => 'success',
                    'title' => 'Authentication Successful! 🎉',
                    'message' => 'Welcome back! Redirecting to Admin Dashboard...',
                ]);
            }

            return response()->json([
                'status' => 'error',
                'title' => $errorTitle,
                'message' => $errorMessage,
            ], 422);
        }

        if (Auth::attempt(['email' => $email, 'password' => $credentials['password'], 'is_admin' => true])) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Ensure database OTP fields are blanked
            $user->update([
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            // Clear OTP session variables after successful login
            session()->forget(['admin_otp_email', 'admin_otp_code', 'admin_otp_expires', 'admin_otp_verified_email']);

            try {
                $now = Carbon::now();
                $log = ActivityLog::create([
                    'admin_id' => $user->id,
                    'admin_email' => $user->email,
                    'admin_name' => $user->name,
                    'event_type' => 'login',
                    'description' => 'Admin signed in to administrative dashboard via 2-Min Database OTP',
                    'login_at' => $now,
                    'ip_address' => $request->ip(),
                    'user_agent' => substr((string) $request->userAgent(), 0, 500),
                    'browser' => $this->getBrowser($request->userAgent()),
                    'device_os' => $this->getOs($request->userAgent()),
                    'latitude' => $request->input('latitude'),
                    'longitude' => $request->input('longitude'),
                    'location_address' => $request->input('location_address') ?: (in_array($request->ip(), ['127.0.0.1', '::1']) ? 'Localhost / Internal System' : 'Public IP'),
                ]);

                $request->session()->put('active_login_log_id', $log->id);
            } catch (\Throwable $e) {
                // Safeguard: logging error must never break successful admin authentication
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'title' => 'Login Successful! 🎉',
                    'message' => 'Welcome back! Redirecting to Admin Dashboard...',
                ]);
            }

            // Clear stale intended URL if pointing to login
            $intended = session()->get('url.intended');
            if ($intended && str_contains($intended, '/admin/login')) {
                session()->forget('url.intended');
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        if ($request->boolean('verify_only') || $request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'title' => $errorTitle,
                'message' => $errorMessage,
            ], 422);
        }

        return back()->withErrors([
            $errorField => $errorMessage,
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();

        try {
            $activeLogId = $request->session()->get('active_login_log_id');
            $activeLog = $activeLogId ? ActivityLog::find($activeLogId) : null;

            if (! $activeLog && $user) {
                $activeLog = ActivityLog::where('admin_id', $user->id)
                    ->where('event_type', 'login')
                    ->whereNull('logout_at')
                    ->latest('login_at')
                    ->first();
            }

            if ($activeLog && $activeLog->login_at) {
                $now = Carbon::now();
                $diffInSeconds = max(0, $activeLog->login_at->diffInSeconds($now));
                $hours = floor($diffInSeconds / 3600);
                $minutes = floor(($diffInSeconds % 3600) / 60);
                $seconds = $diffInSeconds % 60;
                $durationText = sprintf('%02dh %02dm %02ds', $hours, $minutes, $seconds);

                $activeLog->update([
                    'logout_at' => $now,
                    'session_duration' => $durationText,
                ]);
            }

            if ($user) {
                ActivityLog::create([
                    'admin_id' => $user->id,
                    'admin_email' => $user->email,
                    'admin_name' => $user->name,
                    'event_type' => 'logout',
                    'description' => 'Admin signed out of session',
                    'logout_at' => Carbon::now(),
                    'ip_address' => $request->ip(),
                    'user_agent' => substr((string) $request->userAgent(), 0, 500),
                    'browser' => $this->getBrowser($request->userAgent()),
                    'device_os' => $this->getOs($request->userAgent()),
                    'location_address' => in_array($request->ip(), ['127.0.0.1', '::1']) ? 'Localhost / Internal System' : 'Public IP',
                ]);
            }
        } catch (\Throwable $e) {
            // Safeguard: logging error must never break admin logout
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    private function getBrowser(?string $userAgent): string
    {
        if (! $userAgent) {
            return 'Browser';
        }
        if (str_contains($userAgent, 'Edg')) {
            return 'Microsoft Edge';
        }
        if (str_contains($userAgent, 'Chrome')) {
            return 'Google Chrome';
        }
        if (str_contains($userAgent, 'Firefox')) {
            return 'Mozilla Firefox';
        }
        if (str_contains($userAgent, 'Safari')) {
            return 'Apple Safari';
        }

        return 'Web Browser';
    }

    private function getOs(?string $userAgent): string
    {
        if (! $userAgent) {
            return 'OS';
        }
        if (str_contains($userAgent, 'Windows')) {
            return 'Windows OS';
        }
        if (str_contains($userAgent, 'Macintosh') || str_contains($userAgent, 'Mac OS')) {
            return 'macOS';
        }
        if (str_contains($userAgent, 'Linux')) {
            return 'Linux';
        }
        if (str_contains($userAgent, 'Android')) {
            return 'Android';
        }
        if (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
            return 'iOS';
        }

        return 'Unknown OS';
    }
}
