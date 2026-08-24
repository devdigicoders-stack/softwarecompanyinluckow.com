<x-admin-layout pageTitle="Account & Password Settings">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Account Settings</h3>
            <p class="text-secondary small mb-0">Manage your administrative profile details and update security password.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-emerald-100 text-emerald-800 border border-emerald-300 px-3 py-2 rounded-3 shadow-xs d-inline-flex align-items-center gap-2" style="font-size: 0.88rem; background-color: #ecfdf5; color: #065f46; border-color: #a7f3d0 !important;">
                <i class="bi bi-shield-check-fill text-emerald-600 fs-6"></i>
                <span>Account Status: <strong>Active Administrator</strong></span>
            </span>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert" style="background: #fef2f2; color: #b91c1c; border-left: 4px solid #ef4444 !important;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                <div>
                    <strong>Please check the errors below:</strong>
                    <ul class="mb-0 mt-1 ps-3 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Profile Details Card -->
        <div class="col-12 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: #ffffff;">
                <div class="card-header bg-transparent border-bottom p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; font-size: 1.2rem; background: #e0f2fe; color: #0284c7;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h5 class="fw-bold text-slate-900 mb-0" style="color: #0f172a;">Profile Details</h5>
                            <small class="text-secondary">Update your admin account name and email</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.settings.update-profile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="admin_name" class="glass-label mb-1">Full Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-slate-50 border-end-0 text-slate-500"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" id="admin_name" class="form-control glass-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required placeholder="e.g. System Administrator">
                            </div>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="admin_email" class="glass-label mb-1">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-slate-50 border-end-0 text-slate-500"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" id="admin_email" class="form-control glass-input @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required placeholder="admin@example.com">
                            </div>
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="p-3 bg-slate-50 rounded-3 border mb-4" style="background: #f8fafc; border-color: #e2e8f0 !important;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-secondary small">Account Role</span>
                                <span class="badge bg-primary text-white px-2.5 py-1" style="font-size: 0.75rem; background: #0284c7 !important;">Super Admin</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-secondary small">Administrator ID</span>
                                <span class="fw-bold font-monospace text-slate-800" style="font-size: 0.82rem;">#ADM-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-emerald w-100 py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: #059669; color: #ffffff; border-radius: 10px;">
                            <i class="bi bi-check2-circle fs-5"></i> Save Profile Details
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: #ffffff;">
                <div class="card-header bg-transparent border-bottom p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-amber-subtle text-amber-600 fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; font-size: 1.2rem; background: #fef3c7; color: #d97706;">
                            <i class="bi bi-key-fill"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-slate-900 mb-0" style="color: #0f172a;">Change Password</h5>
                            <small class="text-secondary">Update your admin password with real-time strength validation</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.settings.update-password') }}" method="POST" id="passwordChangeForm">
                        @csrf
                        @method('PUT')

                        <!-- 1. Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="glass-label mb-1">
                                1. Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-slate-50 border-end-0 text-slate-500"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="current_password" id="current_password" class="form-control glass-input @error('current_password') is-invalid @enderror" required placeholder="Enter current password">
                                <button type="button" class="btn btn-outline-secondary toggle-pwd-btn" data-target="current_password" title="Show/Hide Password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('current_password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <!-- 2. New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="glass-label mb-1">
                                2. New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-slate-50 border-end-0 text-slate-500"><i class="bi bi-shield-lock-fill"></i></span>
                                <input type="password" name="password" id="new_password" class="form-control glass-input @error('password') is-invalid @enderror" required placeholder="Enter new strong password" onkeyup="checkPasswordStrength(this.value)">
                                <button type="button" class="btn btn-outline-secondary toggle-pwd-btn" data-target="new_password" title="Show/Hide Password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror

                            <!-- 4. Password Strength Progress Bar -->
                            <div class="mt-2" id="strengthContainer" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 0.78rem;">
                                    <span class="text-secondary fw-semibold">Password Strength:</span>
                                    <span id="strengthText" class="fw-bold text-danger">Too Weak</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 6px; background-color: #e2e8f0;">
                                    <div id="strengthProgressBar" class="progress-bar bg-danger" role="progressbar" style="width: 0%; transition: width 0.3s ease;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Confirm New Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="glass-label mb-1">
                                3. Confirm New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-slate-50 border-end-0 text-slate-500"><i class="bi bi-shield-check"></i></span>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control glass-input" required placeholder="Re-enter new password" onkeyup="checkPasswordMatch()">
                                <button type="button" class="btn btn-outline-secondary toggle-pwd-btn" data-target="password_confirmation" title="Show/Hide Password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div id="passwordMatchMsg" class="small mt-1" style="display: none; font-size: 0.8rem;"></div>
                        </div>

                        <!-- 4. Password Requirements Checklist -->
                        <div class="p-3 rounded-3 mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <h6 class="fw-bold text-slate-800 mb-2.5 d-flex align-items-center gap-2" style="font-size: 0.88rem; color: #1e293b;">
                                <i class="bi bi-list-check text-primary"></i> Password Requirements Checklist:
                            </h6>
                            <div class="row g-2.5" style="font-size: 0.82rem;">
                                <div class="col-12 col-sm-6">
                                    <span id="req-length" class="d-flex align-items-center gap-2 text-muted">
                                        <i class="bi bi-x-circle text-danger req-icon"></i> <span>At least 8 characters</span>
                                    </span>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <span id="req-uppercase" class="d-flex align-items-center gap-2 text-muted">
                                        <i class="bi bi-x-circle text-danger req-icon"></i> <span>Uppercase letter (A-Z)</span>
                                    </span>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <span id="req-lowercase" class="d-flex align-items-center gap-2 text-muted">
                                        <i class="bi bi-x-circle text-danger req-icon"></i> <span>Lowercase letter (a-z)</span>
                                    </span>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <span id="req-number" class="d-flex align-items-center gap-2 text-muted">
                                        <i class="bi bi-x-circle text-danger req-icon"></i> <span>Contains Number (0-9)</span>
                                    </span>
                                </div>
                                <div class="col-12">
                                    <span id="req-special" class="d-flex align-items-center gap-2 text-muted">
                                        <i class="bi bi-x-circle text-danger req-icon"></i> <span>Special character (!@#$%^&*)</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="updatePasswordSubmitBtn" class="btn btn-primary w-100 py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: #0284c7; border: none; border-radius: 10px;">
                            <i class="bi bi-key fs-5"></i> Update Security Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // 5. Show/Hide Password Eye Toggle Feature
        document.querySelectorAll('.toggle-pwd-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const pwdInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (pwdInput.type === 'password') {
                    pwdInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash-fill');
                    this.classList.add('btn-secondary');
                    this.classList.remove('btn-outline-secondary');
                } else {
                    pwdInput.type = 'password';
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye');
                    this.classList.remove('btn-secondary');
                    this.classList.add('btn-outline-secondary');
                }
            });
        });

        // 4. Password Strength & Live Requirements Checker
        function checkPasswordStrength(password) {
            const container = document.getElementById('strengthContainer');
            const bar = document.getElementById('strengthProgressBar');
            const text = document.getElementById('strengthText');

            if (!password || password.length === 0) {
                container.style.display = 'none';
                resetRequirements();
                return;
            }

            container.style.display = 'block';

            // Requirement criteria rules
            const hasLength = password.length >= 8;
            const hasUpper = /[A-Z]/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);

            // Update individual checklist UI
            updateReqItem('req-length', hasLength);
            updateReqItem('req-uppercase', hasUpper);
            updateReqItem('req-lowercase', hasLower);
            updateReqItem('req-number', hasNumber);
            updateReqItem('req-special', hasSpecial);

            // Calculate score (0-5)
            let score = 0;
            if (hasLength) score++;
            if (hasUpper) score++;
            if (hasLower) score++;
            if (hasNumber) score++;
            if (hasSpecial) score++;

            // Update Progress Bar UI
            let percentage = (score / 5) * 100;
            bar.style.width = percentage + '%';

            if (score <= 2) {
                bar.className = 'progress-bar bg-danger';
                text.textContent = 'Weak 🔴';
                text.className = 'fw-bold text-danger';
            } else if (score === 3) {
                bar.className = 'progress-bar bg-warning';
                text.textContent = 'Medium 🟠';
                text.className = 'fw-bold text-warning';
            } else if (score === 4) {
                bar.className = 'progress-bar bg-info';
                text.textContent = 'Strong 🔵';
                text.className = 'fw-bold text-info';
            } else {
                bar.className = 'progress-bar bg-success';
                text.textContent = 'Very Strong & Secure 🟢';
                text.className = 'fw-bold text-success';
            }

            checkPasswordMatch();
        }

        function updateReqItem(elementId, isMet) {
            const el = document.getElementById(elementId);
            const icon = el.querySelector('.req-icon');

            if (isMet) {
                el.classList.remove('text-muted');
                el.classList.add('text-success', 'fw-semibold');
                icon.className = 'bi bi-check-circle-fill text-success req-icon';
            } else {
                el.classList.remove('text-success', 'fw-semibold');
                el.classList.add('text-muted');
                icon.className = 'bi bi-x-circle text-danger req-icon';
            }
        }

        function resetRequirements() {
            ['req-length', 'req-uppercase', 'req-lowercase', 'req-number', 'req-special'].forEach(id => {
                updateReqItem(id, false);
            });
        }

        function checkPasswordMatch() {
            const newPwd = document.getElementById('new_password').value;
            const confirmPwd = document.getElementById('password_confirmation').value;
            const matchMsg = document.getElementById('passwordMatchMsg');

            if (!confirmPwd) {
                matchMsg.style.display = 'none';
                return;
            }

            matchMsg.style.display = 'block';
            if (newPwd === confirmPwd) {
                matchMsg.className = 'small mt-1 text-success fw-semibold';
                matchMsg.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Passwords match!';
            } else {
                matchMsg.className = 'small mt-1 text-danger fw-semibold';
                matchMsg.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Passwords do not match';
            }
        }
    </script>
    @endpush
</x-admin-layout>
