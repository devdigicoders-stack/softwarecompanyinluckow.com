<!-- Global Premium Enquiry Modal -->
<div class="modal fade" id="globalEnquiryModal" tabindex="-1" aria-labelledby="globalEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden" style="border-radius: 20px !important;">
            <!-- Modal Header with Dark Slate Gradient -->
            <div class="modal-header border-0 py-3.5 px-4 position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-2.5 rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.15); color: #10b981;">
                        <i class="bi bi-rocket-takeoff-fill fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-extrabold text-white mb-0" id="globalEnquiryModalLabel" style="font-size: 1.2rem; letter-spacing: -0.3px;">Get Free Technical Quote</h5>
                        <span class="d-block fw-medium mt-0.5" style="color: #94a3b8; font-size: 0.8rem;">Fast response within 2 hours • No obligation</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none position-absolute top-50 end-0 translate-middle-y me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4 p-sm-4.5 bg-white">
                <!-- Alert Container for Success/Error Messages -->
                <div id="modalEnquiryAlertContainer"></div>

                <form id="globalEnquiryForm" action="{{ route('enquiries.store') }}" method="POST" novalidate>
                    @csrf
                    <input type="hidden" name="source_page" id="enquirySourcePage" value="general_modal">

                    <!-- Name Field (Required) -->
                    <div class="mb-3.5">
                        <label for="enquiryName" class="form-label fw-bold text-slate-800 small mb-1.5" style="color: #334155; font-size: 0.88rem;">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-slate-50 text-slate-400" style="background: #f8fafc; border-color: #cbd5e1; border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="name" id="enquiryName" class="form-control border-start-0 py-2.5 px-3" style="background: #f8fafc; border-color: #cbd5e1; border-top-right-radius: 10px; border-bottom-right-radius: 10px; font-size: 0.95rem; color: #0f172a;" placeholder="Full Name" required>
                        </div>
                        <div class="invalid-feedback text-danger small mt-1" id="enquiryNameError" style="display: none; font-size: 0.8rem;"></div>
                    </div>

                    <!-- Mobile Field (Required, 10 Digits starting with 6-9) -->
                    <div class="mb-3.5">
                        <label for="enquiryMobile" class="form-label fw-bold text-slate-800 small mb-1.5" style="color: #334155; font-size: 0.88rem;">
                            Mobile Number <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 fw-bold" style="background: #f1f5f9; border-color: #cbd5e1; color: #475569; border-top-left-radius: 10px; border-bottom-left-radius: 10px; font-size: 0.9rem;">+91</span>
                            <input type="tel" name="mobile" id="enquiryMobile" class="form-control border-start-0 py-2.5 px-3" style="background: #f8fafc; border-color: #cbd5e1; border-top-right-radius: 10px; border-bottom-right-radius: 10px; font-size: 0.95rem; color: #0f172a;" placeholder="Mobile Number" maxlength="10" pattern="[6-9][0-9]{9}" required>
                        </div>
                        <div class="invalid-feedback text-danger small mt-1" id="enquiryMobileError" style="display: none; font-size: 0.82rem; font-weight: 500;"></div>
                        <span id="enquiryMobileHelp" class="d-block mt-1 fw-medium" style="color: #64748b; font-size: 0.76rem;"><i class="bi bi-info-circle me-1 text-primary"></i> Must be 10 digits starting with 6, 7, 8, or 9</span>
                    </div>

                    <!-- Email Field (Optional) -->
                    <div class="mb-3.5">
                        <div class="d-flex align-items-center justify-content-between mb-1.5">
                            <label for="enquiryEmail" class="form-label fw-bold text-slate-800 small mb-0" style="color: #334155; font-size: 0.88rem;">Email Address</label>
                            <span class="badge bg-slate-100 text-slate-500 font-semibold" style="background: #f1f5f9; color: #64748b; font-size: 0.72rem; padding: 2px 8px; border-radius: 6px;">Optional</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-slate-50 text-slate-400" style="background: #f8fafc; border-color: #cbd5e1; border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" name="email" id="enquiryEmail" class="form-control border-start-0 py-2.5 px-3" style="background: #f8fafc; border-color: #cbd5e1; border-top-right-radius: 10px; border-bottom-right-radius: 10px; font-size: 0.95rem; color: #0f172a;" placeholder="Email">
                        </div>
                        <div class="invalid-feedback text-danger small mt-1" id="enquiryEmailError" style="display: none; font-size: 0.8rem;"></div>
                    </div>

                    <!-- Requirement Field (Optional) -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-1.5">
                            <label for="enquiryRequirement" class="form-label fw-bold text-slate-800 small mb-0" style="color: #334155; font-size: 0.88rem;">Project Requirement / Details</label>
                            <span class="badge bg-slate-100 text-slate-500 font-semibold" style="background: #f1f5f9; color: #64748b; font-size: 0.72rem; padding: 2px 8px; border-radius: 6px;">Optional</span>
                        </div>
                        <textarea name="requirement" id="enquiryRequirement" rows="3" class="form-control p-3" style="background: #f8fafc; border-color: #cbd5e1; border-radius: 10px; font-size: 0.92rem; color: #0f172a;" placeholder="Briefly describe your project scope..."></textarea>
                    </div>

                    <!-- Submit Button with Spinner -->
                    <button type="submit" id="enquirySubmitBtn" class="btn text-white fw-bold w-100 py-3 rounded-3 shadow-sm fs-6 transition-all" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); border: none; border-radius: 12px !important; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35); font-size: 1rem;">
                        <span id="enquiryBtnText"><i class="bi bi-send-fill me-2"></i> Submit Enquiry</span>
                        <span id="enquiryBtnSpinner" class="d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting Enquiry...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Modal Footer Note -->
            <div class="modal-footer border-top py-2.5 px-4 justify-content-between align-items-center" style="background: #f8fafc; border-color: #f1f5f9 !important;">
                <span class="text-slate-500 fw-medium" style="font-size: 0.78rem; color: #64748b;">
                    <i class="bi bi-shield-lock-fill text-success me-1"></i> 100% Confidential &amp; Secure
                </span>
                <span class="text-slate-600 fw-semibold" style="font-size: 0.78rem;">
                    Helpline: <a href="tel:919198483820" class="text-decoration-none text-primary font-bold">+91 9198483820</a>
                </span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('globalEnquiryModal');
    const form = document.getElementById('globalEnquiryForm');
    const nameInput = document.getElementById('enquiryName');
    const mobileInput = document.getElementById('enquiryMobile');
    const emailInput = document.getElementById('enquiryEmail');
    const nameError = document.getElementById('enquiryNameError');
    const mobileError = document.getElementById('enquiryMobileError');
    const mobileHelp = document.getElementById('enquiryMobileHelp');
    const emailError = document.getElementById('enquiryEmailError');
    const alertContainer = document.getElementById('modalEnquiryAlertContainer');
    const submitBtn = document.getElementById('enquirySubmitBtn');
    const btnText = document.getElementById('enquiryBtnText');
    const btnSpinner = document.getElementById('enquiryBtnSpinner');
    const sourceInput = document.getElementById('enquirySourcePage');

    if (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (button && button.getAttribute('data-source')) {
                sourceInput.value = button.getAttribute('data-source');
            } else {
                sourceInput.value = window.location.pathname;
            }
            alertContainer.innerHTML = '';
            clearValidation();
        });
    }

    function clearValidation() {
        [nameInput, mobileInput, emailInput].forEach(input => {
            if (input) input.classList.remove('is-invalid');
        });
        if (nameError) { nameError.style.display = 'none'; nameError.textContent = ''; }
        if (mobileError) { mobileError.style.display = 'none'; mobileError.textContent = ''; }
        if (mobileHelp) { mobileHelp.style.display = 'block'; }
        if (emailError) { emailError.style.display = 'none'; emailError.textContent = ''; }
    }

    // Restrict mobile input to numeric only & clear inline errors on typing
    if (mobileInput) {
        mobileInput.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            this.classList.remove('is-invalid');
            if (mobileError) { mobileError.style.display = 'none'; mobileError.textContent = ''; }
            if (mobileHelp) { mobileHelp.style.display = 'block'; }
        });
    }

    if (nameInput) {
        nameInput.addEventListener('input', function () {
            this.classList.remove('is-invalid');
            if (nameError) { nameError.style.display = 'none'; nameError.textContent = ''; }
        });
    }

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            alertContainer.innerHTML = '';
            clearValidation();

            const name = nameInput.value.trim();
            const mobile = mobileInput.value.trim();
            const email = emailInput ? emailInput.value.trim() : '';

            let hasError = false;
            let firstErrorInput = null;

            // Name validation
            if (!name) {
                showInputError(nameInput, nameError, 'Please enter your full name.');
                if (!firstErrorInput) firstErrorInput = nameInput;
                hasError = true;
            }

            // Mobile validation with EXACT error messages (only under input field)
            if (!mobile) {
                showInputError(mobileInput, mobileError, 'Please enter your 10-digit mobile number.');
                if (!firstErrorInput) firstErrorInput = mobileInput;
                hasError = true;
            } else if (mobile.length !== 10) {
                const exactMsg = `Mobile number must be exactly 10 digits. (You entered ${mobile.length} digits)`;
                showInputError(mobileInput, mobileError, exactMsg);
                if (!firstErrorInput) firstErrorInput = mobileInput;
                hasError = true;
            } else if (!/^[6-9]/.test(mobile)) {
                const exactMsg = `Mobile number must start with 6, 7, 8, or 9. (Entered start digit: '${mobile.charAt(0)}')`;
                showInputError(mobileInput, mobileError, exactMsg);
                if (!firstErrorInput) firstErrorInput = mobileInput;
                hasError = true;
            }

            if (hasError) {
                if (firstErrorInput) firstErrorInput.focus();
                return;
            }

            // Disable button and show spinner
            submitBtn.disabled = true;
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');

            const formData = new FormData(form);

            // Get CSRF Token safely from meta or input
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfInput = form.querySelector('input[name="_token"]');
            const csrfToken = (csrfMeta ? csrfMeta.getAttribute('content') : null) || (csrfInput ? csrfInput.value : '');

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                return response.json().then(data => ({ status: response.status, body: data }));
            })
            .then(res => {
                resetSubmitButton();

                if (res.status === 200 && res.body.success) {
                    showAlert('success', res.body.message || 'Thank you! Your enquiry has been received successfully.');
                    form.reset();
                    clearValidation();
                } else if (res.body.errors) {
                    const errors = res.body.errors;
                    if (errors.name) {
                        showInputError(nameInput, nameError, errors.name[0]);
                    }
                    if (errors.mobile) {
                        showInputError(mobileInput, mobileError, errors.mobile[0]);
                    }
                    if (errors.email) {
                        showInputError(emailInput, emailError, errors.email[0]);
                    }
                } else {
                    showAlert('danger', res.body.message || 'Something went wrong. Please try again.');
                }
            })
            .catch(err => {
                console.error('Enquiry submission error:', err);
                resetSubmitButton();
                showAlert('danger', 'Network connection issue. Please check your connection and try again.');
            });
        });
    }

    function showInputError(input, errorDiv, message) {
        if (input) input.classList.add('is-invalid');
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }
        if (input === mobileInput && mobileHelp) {
            mobileHelp.style.display = 'none';
        }
    }

    function resetSubmitButton() {
        submitBtn.disabled = false;
        btnText.classList.remove('d-none');
        btnSpinner.classList.add('d-none');
    }

    function showAlert(type, message) {
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show rounded-3 p-3 mb-3.5 border-0 shadow-sm position-relative" role="alert" style="padding-right: 2.75rem !important;">
                <div class="d-flex align-items-start gap-2.5">
                    <i class="bi ${type === 'success' ? 'bi-check-circle-fill text-success' : 'bi-exclamation-triangle-fill text-danger'} fs-5 flex-shrink-0 mt-0.5"></i>
                    <div style="font-size: 0.9rem; line-height: 1.5; color: #1e293b; font-weight: 500;">${message}</div>
                </div>
                <button type="button" class="btn-close shadow-none position-absolute" data-bs-dismiss="alert" aria-label="Close" style="top: 14px; right: 14px; padding: 0.25rem; font-size: 0.8rem;"></button>
            </div>
        `;
    }

    // Global click handler to populate source & ensure modal opens on any CTA click
    document.addEventListener('click', function (e) {
        const trigger = e.target.closest('[data-bs-target="#globalEnquiryModal"], .btn-explore-modal, [data-open-modal]');
        if (trigger) {
            const modalEl = document.getElementById('globalEnquiryModal');
            if (modalEl) {
                const source = trigger.getAttribute('data-source') || 'cta_button';
                const sourceInput = document.getElementById('enquirySourcePage');
                if (sourceInput) sourceInput.value = source;
                
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    bsModal.show();
                }
            }
        }
    });
});
</script>
@endpush
