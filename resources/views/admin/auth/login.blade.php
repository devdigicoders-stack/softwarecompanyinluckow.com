<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Authentication | Software Company in Lucknow</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Admin Glass System CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-glass.css') }}">
    <!-- Google Maps JS API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEss4wpsQ0o9WPBjDgHsSByUzFuo2oSNE&loading=async"
        async defer></script>
    <style>
        #btnResendOtp {
            border-radius: 12px !important;
            border: 1.5px solid #059669 !important;
            color: #059669 !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease-in-out !important;
        }
        #btnResendOtp:hover, #btnResendOtp:focus, #btnResendOtp:active {
            background-color: #059669 !important;
            color: #ffffff !important;
            border-color: #059669 !important;
        }
    </style>
</head>

<body class="admin-login-body">

    <!-- Global Floating Top-Right Glass Toast Container -->
    <div id="toastContainer"></div>

    <div class="login-glass-card" style="max-width: 440px; border-radius: 24px; padding: 32px 28px;">
        <!-- Header & Step Indicator -->
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-emerald-100 text-emerald rounded-circle mb-3 shadow-xs"
                style="width: 58px; height: 58px; background: rgba(5, 150, 105, 0.12); color: #059669;">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <h4 class="fw-bold text-slate-900 mb-1" style="color: #0f172a; font-size: 1.35rem;">Software Company in
                Lucknow</h4>
            <p class="text-secondary small mb-3" style="font-size: 0.85rem;">Two-Factor Database OTP Authentication</p>

            <!-- 3-Step Progress Indicators -->
            <div class="d-flex align-items-center justify-content-center gap-2 mb-2" id="authStepProgress">
                <span class="badge px-3 py-2 rounded-pill step-pill active" id="stepPill1"
                    style="background: #059669; color: #ffffff; font-size: 0.78rem; font-weight: 600;">1. Email</span>
                <i class="bi bi-chevron-right text-muted small" style="font-size: 0.7rem;"></i>
                <span class="badge px-3 py-2 rounded-pill step-pill text-muted" id="stepPill2"
                    style="background: #f1f5f9; color: #64748b; font-size: 0.78rem; font-weight: 600;">2. OTP</span>
                <i class="bi bi-chevron-right text-muted small" style="font-size: 0.7rem;"></i>
                <span class="badge px-3 py-2 rounded-pill step-pill text-muted" id="stepPill3"
                    style="background: #f1f5f9; color: #64748b; font-size: 0.78rem; font-weight: 600;">3.
                    Password</span>
            </div>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST" id="adminLoginForm">
            @csrf
            <input type="hidden" name="latitude" id="loginLatitude" value="">
            <input type="hidden" name="longitude" id="loginLongitude" value="">
            <input type="hidden" name="location_address" id="loginLocationAddress" value="">

            <!-- ================= STEP 1: EMAIL ADDRESS ================= -->
            <div id="stepSection1">
                <div class="mb-4">
                    <label for="emailInput" class="glass-label mb-2 fw-semibold"
                        style="font-size: 0.85rem; color: #334155;">Step 1: Admin Email Address <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-secondary px-3"><i
                                class="bi bi-envelope fs-6"></i></span>
                        <input type="email" name="email" id="emailInput"
                            class="form-control glass-input border-start-0 @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="admin@example.com" required autofocus style="height: 48px;">
                    </div>
                </div>

                <button type="button" id="btnSendOtp"
                    class="btn btn-emerald w-100 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2"
                    style="background: #059669; color: #ffffff; border-radius: 12px; font-size: 0.95rem;">
                    <span id="btnSendOtpSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <i class="bi bi-send-fill" id="btnSendOtpIcon"></i>
                    <span id="btnSendOtpText">Send OTP</span>
                </button>
            </div>

            <!-- ================= STEP 2: VERIFY OTP ================= -->
            <div id="stepSection2" class="d-none">
                <!-- 6-Digit OTP Code Input Field -->
                <div class="mb-3">
                    <label for="otpInput" class="glass-label text-center d-block mb-2 fw-semibold"
                        style="font-size: 0.85rem; color: #334155;">Step 2: Enter 6-Digit OTP Code <span
                            class="text-danger">*</span></label>
                    <input type="text" id="otpInput"
                        class="form-control text-center font-monospace fs-3 fw-bold tracking-widest shadow-2xs"
                        maxlength="6" placeholder="• • • • • •" autocomplete="one-time-code"
                        style="letter-spacing: 0.45em; height: 54px; border-radius: 12px; border: 1.5px solid #cbd5e1;">
                </div>

                <!-- Timer / Resend Button Container Directly Below OTP Field -->
                <div class="text-center mb-3" id="otpTimerContainer">
                    <!-- Active 2-Minute Timer Badge -->
                    <div id="otpTimerBadge"
                        class="d-inline-flex align-items-center justify-content-center badge rounded-pill py-2 px-3.5 fw-bold shadow-2xs"
                        style="font-size: 0.82rem; background: #fffbe0; color: #92400e; border: 1px solid #fde68a;">
                        <i class="bi bi-clock-history me-1.5 text-amber-600"></i> OTP expires in: <span
                            id="timerCountdownText" class="ms-1 font-monospace fs-6">02:00</span>
                    </div>

                    <!-- Resend OTP Button (Replaces Timer Badge in exact same spot when expired) -->
                    <button type="button" id="btnResendOtp"
                        class="btn w-100 py-2.5 fw-bold d-none shadow-2xs"
                        onclick="resendOtpCode()">
                        <i class="bi bi-arrow-clockwise me-1.5 fs-5"></i> Resend OTP
                    </button>
                </div>

                <!-- Main Verify OTP & Proceed Button -->
                <button type="button" id="btnVerifyOtp"
                    class="btn btn-emerald w-100 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3"
                    style="background: #059669; color: #ffffff; border-radius: 12px; font-size: 0.95rem;">
                    <span id="btnVerifySpinner" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <i class="bi bi-shield-check fs-5" id="btnVerifyIcon"></i>
                    <span id="btnVerifyText">Verify OTP & Proceed</span>
                </button>

                <!-- Centered Change Email Link -->
                <div class="text-center pt-1">
                    <button type="button" class="btn btn-link text-decoration-none text-secondary small p-0"
                        onclick="goToAuthStep(1)">
                        <i class="bi bi-pencil-square me-1"></i> Change Email
                    </button>
                </div>
            </div>

            <!-- ================= STEP 3: ENTER PASSWORD & SIGN IN ================= -->
            <div id="stepSection3" class="d-none">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                    <span class="badge bg-success text-white px-3 py-1.5 rounded-pill shadow-2xs"
                        style="font-size: 0.75rem; background: #059669 !important;">
                        <i class="bi bi-check-circle-fill me-1"></i> Email Verified
                    </span>
                    <span class="badge bg-success text-white px-3 py-1.5 rounded-pill shadow-2xs"
                        style="font-size: 0.75rem; background: #059669 !important;">
                        <i class="bi bi-shield-check me-1"></i> OTP Verified
                    </span>
                </div>

                <div class="mb-4">
                    <label for="passwordInput" class="glass-label mb-2 fw-semibold"
                        style="font-size: 0.85rem; color: #334155;">Step 3: Admin Password <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-secondary px-3"><i
                                class="bi bi-key fs-6"></i></span>
                        <input type="password" name="password" id="passwordInput"
                            class="form-control glass-input border-start-0 border-end-0 @error('password') is-invalid @enderror"
                            placeholder="Enter admin password" required style="height: 48px;">
                        <button class="btn btn-outline-secondary bg-white border-start-0 text-secondary px-3"
                            type="button" id="togglePasswordBtn" title="Toggle Password Visibility">
                            <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                    class="btn btn-emerald w-100 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2"
                    style="background: #059669; color: #ffffff; border-radius: 12px; font-size: 0.95rem;">
                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <i class="bi bi-box-arrow-in-right fs-5" id="btnSubmitIcon"></i>
                    <span id="btnText">Sign In to Admin Panel</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let locationPermissionGranted = false;
        let currentStep = 1;
        let countdownInterval = null;
        let secondsRemaining = 120;

        // Global Glass Toast Notification Function
        function showGlassToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `glass-toast glass-toast-${type}`;

            let icon = 'bi-check-circle-fill';
            if (type === 'error') icon = 'bi-exclamation-octagon-fill';
            if (type === 'warning') icon = 'bi-exclamation-triangle-fill';
            if (type === 'info') icon = 'bi-info-circle-fill';

            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="bi ${icon}"></i>
                </div>
                <div class="flex-grow-1 me-2">
                    <div class="fw-bold text-slate-900 small lh-sm" style="color: #0f172a;">${title}</div>
                    <div class="small text-secondary lh-sm mt-1" style="font-size: 0.84rem;">${message}</div>
                </div>
                <button type="button" class="btn-close ms-auto small" onclick="closeToast(this.parentElement)" style="font-size: 0.75rem;"></button>
                <div class="toast-progress"></div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                closeToast(toast);
            }, 5000);
        }

        function closeToast(toast) {
            if (!toast || toast.classList.contains('toast-hiding')) return;
            toast.classList.add('toast-hiding');
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.parentElement.removeChild(toast);
                }
            }, 300);
        }

        // Fetch Geolocation Coordinates & Reverse-Geocode Full Street Address
        async function fetchLocationWithReverseGeocoding() {
            if (!navigator.geolocation) {
                showGlassToast('error', 'Geolocation Unsupported 📍', 'Your browser does not support location services.');
                return false;
            }

            try {
                const position = await new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(resolve, reject, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    });
                });

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                document.getElementById('loginLatitude').value = lat;
                document.getElementById('loginLongitude').value = lng;

                let reverseAddress = '';

                // 1. Try Google Maps Geocoder API FIRST (Highest precision full street address in India!)
                if (window.google && window.google.maps && window.google.maps.Geocoder) {
                    try {
                        const geocoder = new google.maps.Geocoder();
                        const gRes = await new Promise((res) => {
                            geocoder.geocode({ location: { lat: lat, lng: lng } }, (results, status) => {
                                if (status === 'OK' && results && results[0]) {
                                    res(results[0].formatted_address);
                                } else {
                                    res(null);
                                }
                            });
                        });
                        if (gRes) {
                            reverseAddress = gRes;
                        }
                    } catch (gErr) {}
                }

                // 2. Try Nominatim OpenStreetMap with zoom=18 if needed
                if (!reverseAddress) {
                    try {
                        const nomRes = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&zoom=18&addressdetails=1`, {
                            headers: { 'Accept-Language': 'en' }
                        });
                        if (nomRes.ok) {
                            const nomData = await nomRes.json();
                            if (nomData && nomData.display_name) {
                                reverseAddress = nomData.display_name;
                            }
                        }
                    } catch (e) {}
                }

                // 3. Try BigDataCloud API as fallback
                if (!reverseAddress) {
                    try {
                        const bdcRes = await fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lng}&localityLanguage=en`);
                        if (bdcRes.ok) {
                            const bdcData = await bdcRes.json();
                            if (bdcData) {
                                const parts = [];
                                if (bdcData.locality) parts.push(bdcData.locality);
                                if (bdcData.city) parts.push(bdcData.city);
                                if (bdcData.principalSubdivision) parts.push(bdcData.principalSubdivision);
                                if (bdcData.postcode) parts.push(bdcData.postcode);
                                if (bdcData.countryName) parts.push(bdcData.countryName);
                                if (parts.length > 0) {
                                    reverseAddress = parts.join(', ');
                                }
                            }
                        }
                    } catch (e) {}
                }

                // 4. Fallback to coordinates
                if (!reverseAddress) {
                    reverseAddress = `Coordinates: ${lat.toFixed(5)}, ${lng.toFixed(5)}`;
                }

                document.getElementById('loginLocationAddress').value = reverseAddress;
                return true;

            } catch (error) {
                showGlassToast('error', 'Location Access Required 📍', 'Location permission is strictly required to send OTP and proceed with login.');
                return false;
            }
        }

        // Live 2-Minute Countdown Timer with Resend Button Swap
        function startOtpCountdown(seconds = 120) {
            clearInterval(countdownInterval);
            secondsRemaining = seconds;

            const timerBadge = document.getElementById('otpTimerBadge');
            const btnResendOtp = document.getElementById('btnResendOtp');
            const btnVerifyOtp = document.getElementById('btnVerifyOtp');

            if (btnVerifyOtp) btnVerifyOtp.disabled = false;

            // Show active timer badge, hide resend button initially
            if (timerBadge) timerBadge.classList.remove('d-none');
            if (btnResendOtp) btnResendOtp.classList.add('d-none');

            updateTimerDisplay();

            countdownInterval = setInterval(() => {
                secondsRemaining--;
                updateTimerDisplay();

                if (secondsRemaining <= 0) {
                    clearInterval(countdownInterval);

                    // When expired: hide timer badge & display Resend OTP button in exact same spot!
                    if (timerBadge) timerBadge.classList.add('d-none');
                    if (btnResendOtp) btnResendOtp.classList.remove('d-none');
                    if (btnVerifyOtp) btnVerifyOtp.disabled = true;

                    showGlassToast('error', 'OTP Expired ⏰', 'The 2-minute OTP code has expired. Please click Resend OTP.');
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            const timerBadge = document.getElementById('otpTimerBadge');
            const timerText = document.getElementById('timerCountdownText');
            if (!timerBadge) return;

            const mins = Math.floor(secondsRemaining / 60);
            const secs = secondsRemaining % 60;
            const formatted = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;

            if (timerText) timerText.textContent = formatted;

            if (secondsRemaining > 30) {
                timerBadge.style.backgroundColor = '#fffbe0';
                timerBadge.style.color = '#92400e';
                timerBadge.style.borderColor = '#fde68a';
            } else if (secondsRemaining > 0) {
                timerBadge.style.backgroundColor = '#fef2f2';
                timerBadge.style.color = '#b91c1c';
                timerBadge.style.borderColor = '#fca5a5';
            }
        }

        // Switch Between Auth Steps
        function goToAuthStep(step) {
            currentStep = step;
            const sec1 = document.getElementById('stepSection1');
            const sec2 = document.getElementById('stepSection2');
            const sec3 = document.getElementById('stepSection3');

            const pill1 = document.getElementById('stepPill1');
            const pill2 = document.getElementById('stepPill2');
            const pill3 = document.getElementById('stepPill3');

            sec1.classList.add('d-none');
            sec2.classList.add('d-none');
            sec3.classList.add('d-none');

            // Reset pill styles
            [pill1, pill2, pill3].forEach((p, idx) => {
                if (idx + 1 === step) {
                    p.style.background = '#059669';
                    p.style.color = '#ffffff';
                    p.classList.add('active');
                } else if (idx + 1 < step) {
                    p.style.background = '#10b981';
                    p.style.color = '#ffffff';
                    p.classList.remove('active');
                } else {
                    p.style.background = '#f1f5f9';
                    p.style.color = '#64748b';
                    p.classList.remove('active');
                }
            });

            if (step === 1) {
                sec1.classList.remove('d-none');
                clearInterval(countdownInterval);
                document.getElementById('emailInput').focus();
            } else if (step === 2) {
                sec2.classList.remove('d-none');
                document.getElementById('otpInput').focus();
                startOtpCountdown(120);
            } else if (step === 3) {
                sec3.classList.remove('d-none');
                clearInterval(countdownInterval);
                document.getElementById('passwordInput').focus();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const emailInput = document.getElementById('emailInput');
            const otpInput = document.getElementById('otpInput');
            const passwordInput = document.getElementById('passwordInput');
            const loginForm = document.getElementById('adminLoginForm');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');

            // Toggle Password Visibility
            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function () {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        togglePasswordIcon.classList.remove('bi-eye-slash');
                        togglePasswordIcon.classList.add('bi-eye');
                    } else {
                        passwordInput.type = 'password';
                        togglePasswordIcon.classList.remove('bi-eye');
                        togglePasswordIcon.classList.add('bi-eye-slash');
                    }
                });
            }

            // Step 1: Send OTP AJAX Trigger with Geolocation & Reverse Geocoding
            const btnSendOtp = document.getElementById('btnSendOtp');
            btnSendOtp.addEventListener('click', async function () {
                const email = emailInput.value.trim();
                if (!email) {
                    showGlassToast('error', 'Email Required 📧', 'Please enter your administrator email address.');
                    emailInput.focus();
                    return;
                }

                const spinner = document.getElementById('btnSendOtpSpinner');
                const icon = document.getElementById('btnSendOtpIcon');
                const text = document.getElementById('btnSendOtpText');

                btnSendOtp.disabled = true;
                spinner.classList.remove('d-none');
                icon.classList.add('d-none');
                text.textContent = 'Requesting location...';

                // 1. MUST GET LOCATION PERMISSION & REVERSE GEOCODE FULL STREET ADDRESS FIRST!
                const hasLocation = await fetchLocationWithReverseGeocoding();
                if (!hasLocation) {
                    btnSendOtp.disabled = false;
                    spinner.classList.add('d-none');
                    icon.classList.remove('d-none');
                    text.textContent = 'Send OTP';
                    return; // STOP EXECUTION IF LOCATION PERMISSION DENIED OR FAILED!
                }

                text.textContent = 'Sending OTP...';

                const lat = document.getElementById('loginLatitude').value;
                const lng = document.getElementById('loginLongitude').value;
                const locationAddress = document.getElementById('loginLocationAddress').value;

                try {
                    const res = await fetch("{{ route('admin.login.send-otp') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            email: email,
                            latitude: lat,
                            longitude: lng,
                            location_address: locationAddress
                        })
                    });

                    const data = await res.json();

                    if (!res.ok || data.status === 'error') {
                        showGlassToast('error', data.title || 'OTP Failed', data.message || 'Failed to send OTP code.');
                        btnSendOtp.disabled = false;
                        spinner.classList.add('d-none');
                        icon.classList.remove('d-none');
                        text.textContent = 'Send OTP';
                        return;
                    }

                    // Display Toast message with actual recipient email
                    const recipientDisplay = data.recipient_email || data.email || email;
                    showGlassToast('success', data.title || 'OTP Sent 📧', data.message || `OTP sent to ${recipientDisplay}!`);

                    btnSendOtp.disabled = false;
                    spinner.classList.add('d-none');
                    icon.classList.remove('d-none');
                    text.textContent = 'Send OTP';

                    document.getElementById('otpInput').value = '';
                    goToAuthStep(2);

                } catch (err) {
                    showGlassToast('error', 'Network Error 🌐', 'Unable to send OTP request. Please check connection.');
                    btnSendOtp.disabled = false;
                    spinner.classList.add('d-none');
                    icon.classList.remove('d-none');
                    text.textContent = 'Send OTP';
                }
            });

            // Step 2: Verify OTP AJAX Trigger
            const btnVerifyOtp = document.getElementById('btnVerifyOtp');
            btnVerifyOtp.addEventListener('click', async function () {
                const email = emailInput.value.trim();
                const otp = otpInput.value.trim();

                if (!otp || otp.length !== 6) {
                    showGlassToast('error', 'Invalid OTP 🔑', 'Please enter a valid 6-digit OTP code.');
                    otpInput.focus();
                    return;
                }

                const spinner = document.getElementById('btnVerifySpinner');
                const icon = document.getElementById('btnVerifyIcon');
                const text = document.getElementById('btnVerifyText');

                btnVerifyOtp.disabled = true;
                spinner.classList.remove('d-none');
                icon.classList.add('d-none');
                text.textContent = 'Verifying OTP...';

                try {
                    const res = await fetch("{{ route('admin.login.verify-otp') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ email: email, otp: otp })
                    });

                    const data = await res.json();

                    if (!res.ok || data.status === 'error') {
                        showGlassToast('error', data.title || 'OTP Failed', data.message || 'Invalid OTP code.');
                        btnVerifyOtp.disabled = false;
                        spinner.classList.add('d-none');
                        icon.classList.remove('d-none');
                        text.textContent = 'Verify OTP & Proceed';
                        return;
                    }

                    showGlassToast('success', data.title || 'OTP Verified 🔐', data.message || 'OTP verified! Enter password.');

                    btnVerifyOtp.disabled = false;
                    spinner.classList.add('d-none');
                    icon.classList.remove('d-none');
                    text.textContent = 'Verify OTP & Proceed';

                    goToAuthStep(3);

                } catch (err) {
                    showGlassToast('error', 'Network Error 🌐', 'Unable to verify OTP code.');
                    btnVerifyOtp.disabled = false;
                    spinner.classList.add('d-none');
                    icon.classList.remove('d-none');
                    text.textContent = 'Verify OTP & Proceed';
                }
            });

            // Resend OTP Helper
            window.resendOtpCode = function () {
                document.getElementById('btnSendOtp').click();
            };

            // Step 3: Password Authentication Submit (Location captured in Step 1)
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');

            if (loginForm) {
                loginForm.addEventListener('submit', async function (e) {
                    if (locationPermissionGranted) {
                        return true;
                    }

                    e.preventDefault();

                    const password = passwordInput.value;

                    if (!password) {
                        showGlassToast('error', 'Password Required 🔑', 'Please enter your admin account password.');
                        passwordInput.focus();
                        return;
                    }

                    submitBtn.disabled = true;
                    btnText.innerHTML = 'Verifying password...';
                    btnSpinner.classList.remove('d-none');

                    const verifyData = new FormData(loginForm);
                    verifyData.append('verify_only', '1');

                    try {
                        const verifyRes = await fetch("{{ route('admin.login.submit') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: verifyData
                        });

                        const verifyResult = await verifyRes.json();

                        if (!verifyRes.ok || verifyResult.status === 'error') {
                            showGlassToast('error', verifyResult.title || 'Invalid Password ❌', verifyResult.message || 'Authentication failed.');
                            resetSubmitBtn();
                            return;
                        }

                        showGlassToast('success', verifyResult.title || 'Login Successful! 🎉', verifyResult.message || 'Welcome back! Redirecting...');

                        locationPermissionGranted = true;
                        sessionStorage.setItem('tab_session_active', 'true');

                        btnText.innerHTML = 'Redirecting...';

                        setTimeout(function () {
                            loginForm.submit();
                        }, 600);

                    } catch (verifyErr) {
                        resetSubmitBtn();
                    }
                });
            }

            function resetSubmitBtn() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    btnText.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i> Sign In to Admin Panel';
                    btnSpinner.classList.add('d-none');
                }
            }

            // Session notification triggers
            @if(session('info'))
                showGlassToast('info', 'Notice 📧', "{{ session('info') }}");
            @endif

            @if(session('success'))
                showGlassToast('success', 'Success 🎉', "{{ session('success') }}");
            @endif

            @if(session('error'))
                showGlassToast('error', 'Login Error ❌', "{{ session('error') }}");
            @endif
        });
    </script>
</body>

</html>