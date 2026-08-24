<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show account profile and security settings view.
     */
    public function edit(): View
    {
        $user = Auth::user();

        return view('admin.settings.index', compact('user'));
    }

    /**
     * Update administrator name and email address.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        $oldName = $user->name;
        $oldEmail = $user->email;
        $isEmailChanged = ($oldEmail !== $validated['email']);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        try {
            ActivityLog::create([
                'admin_id' => $user->id,
                'admin_email' => $user->email,
                'admin_name' => $user->name,
                'event_type' => 'system_action',
                'description' => "Updated admin profile details (Name: {$oldName} -> {$user->name}, Email: {$oldEmail} -> {$user->email})",
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 500),
            ]);
        } catch (\Throwable $e) {
            // Log failure should not break profile update
        }

        // Automatic logout if email address was changed
        if ($isEmailChanged) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with('info', 'Your email address was updated! Please log in with your new email address.');
        }

        return back()->with('success', 'Profile details updated successfully!');
    }

    /**
     * Change administrator password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ], [
            'current_password.current_password' => 'The provided current password does not match your account password.',
            'password.confirmed' => 'New password confirmation does not match.',
            'password.min' => 'The new password must be at least 8 characters long.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        try {
            ActivityLog::create([
                'admin_id' => $user->id,
                'admin_email' => $user->email,
                'admin_name' => $user->name,
                'event_type' => 'system_action',
                'description' => 'Changed account security password successfully',
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 500),
            ]);
        } catch (\Throwable $e) {
            // Log failure should not break password update
        }

        return back()->with('success', 'Password changed successfully!');
    }
}
