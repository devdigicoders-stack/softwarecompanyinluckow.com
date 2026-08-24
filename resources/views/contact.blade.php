<x-layout 
    title="Contact Us | Premier Software Company in Lucknow"
    description="Get in touch with top software engineers in Lucknow for custom web applications, mobile apps, ERP, CRM, and IT software consultation."
    canonical="{{ route('contact') }}"
    :faqs="$contactFaqs"
    :breadcrumbs="$breadcrumbs"
>
    <!-- Contact Hero Section -->
    <section class="hero-portal text-center py-5">
        <div class="container">
            <span class="badge bg-primary px-3 py-2 text-uppercase mb-3 fw-bold text-white" style="letter-spacing: 0.5px;">
                <i class="bi bi-headset me-1.5"></i> Direct Technical Engagement
            </span>
            <h1 class="display-4 fw-bold text-white mb-3">
                Contact Technical Team <br>
                <span class="text-primary">Software Development Company in Lucknow</span>
            </h1>
            <p class="lead text-slate-300 mx-auto" style="max-width: 850px; font-size: 1.15rem; line-height: 1.7;">
                Have a software project, web application, mobile app requirement, or enterprise ERP/CRM vision? 
                Connect directly with our senior solution architects and technical leads in Lucknow.
            </p>

            <!-- Key Engagement Indicators (Redesigned Glassmorphism Cards) -->
            <style>
                .engagement-glass-card {
                    background: rgba(15, 23, 42, 0.65);
                    backdrop-filter: blur(12px);
                    -webkit-backdrop-filter: blur(12px);
                    border: 1px solid rgba(255, 255, 255, 0.14);
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .engagement-glass-card:hover {
                    transform: translateY(-4px);
                    background: rgba(15, 23, 42, 0.85);
                    border-color: rgba(16, 185, 129, 0.55);
                    box-shadow: 0 12px 32px rgba(16, 185, 129, 0.2);
                }
            </style>
            <div class="row g-3 justify-content-center mt-4">
                <div class="col-6 col-lg-3">
                    <div class="p-3 rounded-4 h-100 d-flex align-items-center gap-3 engagement-glass-card text-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.18); border: 1px solid rgba(16, 185, 129, 0.4);">
                            <i class="bi bi-clock-history fs-5" style="color: #34d399;"></i>
                        </div>
                        <div style="min-width: 0;">
                            <div class="fw-bold text-white lh-sm mb-0.5" style="font-size: 1.02rem;">&lt; 2 Hours</div>
                            <span class="d-block text-truncate" style="font-size: 0.78rem; color: #cbd5e1; font-weight: 500;">Average Response Time</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="p-3 rounded-4 h-100 d-flex align-items-center gap-3 engagement-glass-card text-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.18); border: 1px solid rgba(16, 185, 129, 0.4);">
                            <i class="bi bi-building fs-5" style="color: #34d399;"></i>
                        </div>
                        <div style="min-width: 0;">
                            <div class="fw-bold text-white lh-sm mb-0.5" style="font-size: 1.02rem;">In-Person</div>
                            <span class="d-block text-truncate" style="font-size: 0.78rem; color: #cbd5e1; font-weight: 500;">Meetings across UP</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="p-3 rounded-4 h-100 d-flex align-items-center gap-3 engagement-glass-card text-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.18); border: 1px solid rgba(16, 185, 129, 0.4);">
                            <i class="bi bi-shield-check fs-5" style="color: #34d399;"></i>
                        </div>
                        <div style="min-width: 0;">
                            <div class="fw-bold text-white lh-sm mb-0.5" style="font-size: 1.02rem;">100% NDA</div>
                            <span class="d-block text-truncate" style="font-size: 0.78rem; color: #cbd5e1; font-weight: 500;">Data Privacy &amp; IP Security</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="p-3 rounded-4 h-100 d-flex align-items-center gap-3 engagement-glass-card text-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.18); border: 1px solid rgba(16, 185, 129, 0.4);">
                            <i class="bi bi-file-earmark-code fs-5" style="color: #34d399;"></i>
                        </div>
                        <div style="min-width: 0;">
                            <div class="fw-bold text-white lh-sm mb-0.5" style="font-size: 1.02rem;">Free Quote</div>
                            <span class="d-block text-truncate" style="font-size: 0.78rem; color: #cbd5e1; font-weight: 500;">Itemized Project Scope</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Contact Channels Grid -->
    <section class="py-4 bg-white border-bottom shadow-sm">
        <div class="container">
            <div class="row g-3">
                <!-- Channel 1: Phone -->
                <div class="col-md-6 col-lg-3">
                    <div class="p-3 bg-slate-50 rounded-4 border h-100 d-flex align-items-center gap-3 shadow-xs">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                            <i class="bi bi-telephone-fill fs-5" style="color: #059669;"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0;">
                            <span class="text-slate-400 d-block text-uppercase fw-bold mb-0.5" style="font-size: 0.7rem; letter-spacing: 0.5px;">Call Our Office</span>
                            <a href="tel:919198483820" class="fw-bold text-slate-900 text-decoration-none d-block hover-text-primary text-truncate" style="font-size: 0.9rem;">+91 9198483820</a>
                            <a href="tel:916394296293" class="fw-bold text-slate-900 text-decoration-none d-block hover-text-primary text-truncate" style="font-size: 0.9rem;">+91 6394296293</a>
                        </div>
                    </div>
                </div>

                <!-- Channel 2: WhatsApp -->
                <div class="col-md-6 col-lg-3">
                    <div class="p-3 bg-slate-50 rounded-4 border h-100 d-flex align-items-center gap-3 shadow-xs">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background-color: #25D366;">
                            <i class="bi bi-whatsapp fs-5 text-white"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0;">
                            <span class="text-slate-400 d-block text-uppercase fw-bold mb-0.5" style="font-size: 0.7rem; letter-spacing: 0.5px;">Instant WhatsApp</span>
                            <a href="https://wa.me/916394296293?text=Hello%20Software Company in Lucknow,%20I%20want%20to%20know%20more%20about%20your%20software%20services" target="_blank" rel="noopener" class="fw-bold text-slate-900 text-decoration-none d-block hover-text-primary text-truncate" style="font-size: 0.9rem;">
                                +91 6394296293 <i class="bi bi-arrow-right small text-emerald-600"></i>
                            </a>
                            <span class="small text-slate-600 d-block text-truncate" style="font-size: 0.78rem;">Chat with Technical Lead</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 3: Email -->
                <div class="col-md-6 col-lg-3">
                    <div class="p-3 bg-slate-50 rounded-4 border h-100 d-flex align-items-center gap-3 shadow-xs">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                            <i class="bi bi-envelope-fill fs-5" style="color: #059669;"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0;">
                            <span class="text-slate-400 d-block text-uppercase fw-bold mb-0.5" style="font-size: 0.7rem; letter-spacing: 0.5px;">Email Consultation</span>
                            <a href="mailto:info@softwarecompanyinlucknow.com" class="fw-bold text-primary text-decoration-none d-block text-break" style="font-size: 0.82rem; word-break: break-all; line-height: 1.35;" title="info@softwarecompanyinlucknow.com">info@softwarecompanyinlucknow.com</a>
                            <span class="small text-slate-500 d-block mt-0.5" style="font-size: 0.75rem;">Official Support & Sales Desk</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 4: Corporate Office -->
                <div class="col-md-6 col-lg-3">
                    <div class="p-3 bg-slate-50 rounded-4 border h-100 d-flex align-items-center gap-3 shadow-xs">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px; background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                            <i class="bi bi-geo-alt-fill fs-5" style="color: #059669;"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0;">
                            <span class="text-slate-400 d-block text-uppercase fw-bold mb-0.5" style="font-size: 0.7rem; letter-spacing: 0.5px;">Service Coverage</span>
                            <strong class="text-slate-900 d-block text-truncate" style="font-size: 0.88rem;">Lucknow, Kanpur, Gorakhpur</strong>
                            <span class="small text-slate-600 d-block text-truncate" style="font-size: 0.78rem;">Available across Uttar Pradesh</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Form & Corporate Information Section -->
    <section class="py-5 bg-slate-50">
        <div class="container">
            <div class="row g-4">
                <!-- Form Column -->
                <div class="col-lg-7">
                    <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge px-3 py-1.5 rounded-pill fw-bold" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                                <i class="bi bi-pencil-square me-1"></i> Consultation Form
                            </span>
                        </div>
                        <h2 class="h3 fw-bold text-slate-900 mb-2">Request a Free Software Consultation</h2>
                        <p class="text-slate-600 mb-4" style="line-height: 1.6;">
                            Provide your project goals or software requirements below. Our lead solution architect will analyze your scope and respond within 24 business hours with an estimated roadmap and quote.
                        </p>

                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm rounded-3 p-3.5 mb-4 d-flex align-items-center gap-3" role="alert" style="background-color: #ecfdf5; border-left: 5px solid #10b981 !important; color: #065f46;">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 42px; height: 42px; background-color: #10b981; color: white;">
                                    <i class="bi bi-check-circle-fill fs-5"></i>
                                </div>
                                <div>
                                    <strong class="d-block text-emerald-900 fw-bold mb-0.5" style="font-size: 1.05rem;">Request Submitted Successfully! 🎉</strong>
                                    <span style="font-size: 0.95rem;">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm rounded-3 p-3.5 mb-4 d-flex align-items-start gap-3" role="alert" style="background-color: #fef2f2; border-left: 5px solid #ef4444 !important; color: #991b1b;">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm mt-0.5" style="width: 40px; height: 40px; background-color: #ef4444; color: white;">
                                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                                </div>
                                <div>
                                    <strong class="d-block text-red-900 fw-bold mb-1" style="font-size: 1rem;">Please correct the following errors:</strong>
                                    <ul class="mb-0 ps-3 small" style="font-size: 0.9rem;">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" id="contactConsultationForm">
                            @csrf
                            <div class="row g-3">
                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold text-slate-800 small d-flex align-items-center gap-1.5 mb-1.5">
                                        <i class="bi bi-person-fill" style="color: #059669;"></i> <span>Full Name</span> <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Full Name" required style="border-color: #cbd5e1; font-size: 0.95rem;">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- Phone / Mobile Number -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-bold text-slate-800 small d-flex align-items-center gap-1.5 mb-1.5">
                                        <i class="bi bi-telephone-fill" style="color: #059669;"></i> <span>Phone / Mobile Number</span> <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" name="phone" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Mobile Number" maxlength="10" pattern="[6-9][0-9]{9}" title="Must be a 10 digit mobile number starting with 9, 8, 7, or 6" required style="border-color: #cbd5e1; font-size: 0.95rem;">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold text-slate-800 small d-flex align-items-center gap-1.5 mb-1.5">
                                        <i class="bi bi-envelope-fill" style="color: #059669;"></i> <span>Email Address</span> <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email Address" required style="border-color: #cbd5e1; font-size: 0.95rem;">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- Required Software Service / Subject -->
                                <div class="col-md-6">
                                    <label for="service" class="form-label fw-bold text-slate-800 small d-flex align-items-center gap-1.5 mb-1.5">
                                        <i class="bi bi-gear-fill" style="color: #059669;"></i> <span>Required Software Service</span> <span class="text-danger">*</span>
                                    </label>
                                    <select name="service" id="serviceSelect" class="form-select form-select-lg @error('service') is-invalid @enderror" required style="border-color: #cbd5e1; font-size: 0.95rem;">
                                        <option value="">Select Service...</option>
                                        <option value="Custom Web Application" {{ old('service') == 'Custom Web Application' ? 'selected' : '' }}>Custom Web Application</option>
                                        <option value="Mobile App Development (Android/iOS)" {{ old('service') == 'Mobile App Development (Android/iOS)' ? 'selected' : '' }}>Mobile App Development (Android/iOS)</option>
                                        <option value="Enterprise ERP Software" {{ old('service') == 'Enterprise ERP Software' ? 'selected' : '' }}>Enterprise ERP Software</option>
                                        <option value="CRM System & Lead Automation" {{ old('service') == 'CRM System & Lead Automation' ? 'selected' : '' }}>CRM System &amp; Lead Automation</option>
                                        <option value="HRMS & Payroll Software" {{ old('service') == 'HRMS & Payroll Software' ? 'selected' : '' }}>HRMS &amp; Payroll Software</option>
                                        <option value="School / Hospital Management Software" {{ old('service') == 'School / Hospital Management Software' ? 'selected' : '' }}>School / Hospital Management Software</option>
                                        <option value="Billing & Inventory Software" {{ old('service') == 'Billing & Inventory Software' ? 'selected' : '' }}>Billing &amp; Inventory Software</option>
                                        <option value="IT & Software Consulting" {{ old('service') == 'IT & Software Consulting' ? 'selected' : '' }}>IT &amp; Software Consulting</option>
                                        <option value="Other" {{ old('service') == 'Other' ? 'selected' : '' }}>Other / Custom Requirement...</option>
                                    </select>
                                    @error('service')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                    <!-- Custom Service Text Input (Shown when Other is selected) -->
                                    <div id="customServiceContainer" class="mt-2 {{ old('service') == 'Other' ? '' : 'd-none' }}">
                                        <input type="text" name="custom_service" id="custom_service" class="form-control @error('custom_service') is-invalid @enderror" value="{{ old('custom_service') }}" placeholder="Type your custom service or subject requirement..." style="border-color: #cbd5e1; font-size: 0.9rem;">
                                        @error('custom_service')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Project Message / Overview -->
                                <div class="col-12">
                                    <label for="message" class="form-label fw-bold text-slate-800 small d-flex align-items-center gap-1.5 mb-1.5">
                                        <i class="bi bi-card-text" style="color: #059669;"></i> <span>Project Overview &amp; Specifications</span> <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror" placeholder="Message" required style="border-color: #cbd5e1; font-size: 0.95rem;">{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                 <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" id="contactSubmitBtn" class="btn btn-primary btn-lg w-100 py-3 fw-bold rounded-3 shadow d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-send-fill"></i> <span>Submit Consultation Request</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info & Corporate Credentials Column -->
                <div class="col-lg-5">
                    <!-- Corporate Credentials Card -->
                    <div class="p-4 p-md-5 rounded-4 shadow-sm mb-4 dark-credentials-card">
                        <h4 class="fw-bold text-white mb-4 d-flex align-items-center gap-2">
                            <i class="bi bi-building-fill" style="color: #10b981;"></i> Corporate Identity &amp; Office
                        </h4>
                        
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="p-2.5 rounded-3 fs-4 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background-color: rgba(255, 255, 255, 0.1); color: #10b981;">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-white mb-1">Service Coverage</h6>
                                <p class="small text-slate-300 mb-0" style="line-height: 1.6;">
                                    Software Company in Lucknow <br>
                                    Available in Lucknow, Kanpur, Gorakhpur &amp; across Uttar Pradesh
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="p-2.5 rounded-3 fs-4 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background-color: rgba(255, 255, 255, 0.1); color: #10b981;">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-white mb-1">Office Hours</h6>
                                <p class="small text-slate-300 mb-0">
                                    Monday to Saturday: <strong class="text-white">9:30 AM – 7:00 PM (IST)</strong><br>
                                    <span class="text-slate-400">Sunday: Closed (Available for emergency SLA support)</span>
                                </p>
                            </div>
                        </div>

                        <div class="pt-3 border-top border-slate-800">
                            <h6 class="fw-bold text-white mb-2">Direct Contact &amp; Desk Escalation</h6>
                            <p class="small text-slate-400 mb-3">Reach out directly to primary engineering &amp; office desks:</p>
                            <div class="row g-2 small">
                                <div class="col-6">
                                    <a href="tel:916394296293" class="btn btn-outline-light btn-sm w-100 py-2 fw-bold text-white" style="font-size: 0.83rem;">
                                        <i class="bi bi-telephone-fill me-1" style="color: #10b981;"></i> +91 6394296293
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="tel:05224235604" class="btn btn-outline-light btn-sm w-100 py-2 fw-bold text-white" style="font-size: 0.83rem;">
                                        <i class="bi bi-telephone-fill me-1" style="color: #10b981;"></i> 0522-4235604
                                    </a>
                                </div>
                                <div class="col-6 mt-2">
                                    <a href="tel:919140967607" class="btn btn-outline-light btn-sm w-100 py-2 text-slate-300" style="font-size: 0.78rem;">
                                        <i class="bi bi-telephone me-1"></i> +91 9140967607
                                    </a>
                                </div>
                                <div class="col-6 mt-2">
                                    <a href="tel:919198483820" class="btn btn-outline-light btn-sm w-100 py-2 text-slate-300" style="font-size: 0.78rem;">
                                        <i class="bi bi-telephone me-1"></i> +91 9198483820
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4-Step Consultation Methodology -->
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 750px;">
                <span class="badge px-3 py-1.5 rounded-pill fw-bold mb-2" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">Structured Execution</span>
                <h2 class="h3 fw-bold text-slate-900 mb-3">How Our Consultation Process Works</h2>
                <p class="text-slate-600">
                    We eliminate ambiguity from software engineering by following a transparent 4-stage engagement framework.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="p-4 bg-slate-50 rounded-4 border h-100">
                        <div class="d-inline-block px-3 py-1 text-white fw-bold rounded-pill small mb-3" style="background-color: #059669;">Stage 01</div>
                        <h5 class="fw-bold text-slate-900 mb-2">Requirement Gathering</h5>
                        <p class="small text-slate-600 mb-0">
                            Our solution architect conducts a detailed discovery call or meeting to understand your business objectives, target workflow, and user roles.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="p-4 bg-slate-50 rounded-4 border h-100">
                        <div class="d-inline-block px-3 py-1 text-white fw-bold rounded-pill small mb-3" style="background-color: #059669;">Stage 02</div>
                        <h5 class="fw-bold text-slate-900 mb-2">Architecture Blueprint</h5>
                        <p class="small text-slate-600 mb-0">
                            We select the optimal tech stack (Laravel, Flutter, React, MySQL), design database schemas, and create high-level system wireframes.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="p-4 bg-slate-50 rounded-4 border h-100">
                        <div class="d-inline-block px-3 py-1 text-white fw-bold rounded-pill small mb-3" style="background-color: #059669;">Stage 03</div>
                        <h5 class="fw-bold text-slate-900 mb-2">Itemized Proposal &amp; SLA</h5>
                        <p class="small text-slate-600 mb-0">
                            You receive a clear project roadmap with milestone deliverables, transparent cost estimates, and post-delivery maintenance guarantees.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="p-4 bg-slate-50 rounded-4 border h-100">
                        <div class="d-inline-block px-3 py-1 text-white fw-bold rounded-pill small mb-3" style="background-color: #059669;">Stage 04</div>
                        <h5 class="fw-bold text-slate-900 mb-2">Agile Code Kickoff</h5>
                        <p class="small text-slate-600 mb-0">
                            Sprint-based coding begins with bi-weekly demo previews, continuous QA testing, and complete IP &amp; source code handover upon release.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Full-Width Interactive Office Google Map Section -->
    <!-- <section class="py-5 bg-slate-50 border-top">
        <div class="container">
            <div class="text-center mx-auto mb-4" style="max-width: 750px;">
                <span class="badge px-3 py-1.5 rounded-pill fw-bold mb-2" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">Service Availability</span>
                <h2 class="h3 fw-bold text-slate-900 mb-2 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-geo-alt-fill" style="color: #059669;"></i> <span>Software Company in Lucknow - Location Map</span>
                </h2>
                <p class="text-slate-600 mb-0">
                    Available in Lucknow, Kanpur, Gorakhpur. Connect with us for scheduled technical consultations &amp; project kickoffs.
                </p>
            </div>

          
            <div class="p-3 bg-white rounded-4 border shadow-sm">
                <div class="rounded-3 overflow-hidden border position-relative" style="height: 420px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.9187715490084!2d80.9495932!3d26.9046421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd90f852511b%3A0xea3004cdf494ecbb!2sSoftware Company in Lucknow%20Technologies%20Private%20Limited!5e1!3m2!1sen!2sin!4v1787291554998!5m2!1sen!2sin" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="strict-origin-when-cross-origin"
                        title="Software Company Location Map">
                    </iframe>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-3 px-2">
                    <div class="small text-slate-700 fw-semibold">
                        <i class="bi bi-geo-fill text-emerald-600 me-1" style="color: #059669;"></i> <strong>Service Coverage:</strong> Available in Lucknow, Kanpur, Gorakhpur
                    </div>
                    <div class="d-flex gap-2 w-100 w-sm-auto">
                        <a href="https://maps.app.goo.gl/KHEdjdWvDUGZbzLv7" target="_blank" rel="noopener" class="btn btn-outline-primary btn-sm fw-bold px-3 py-2 rounded-3">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Open in Google Maps
                        </a>
                        <a href="tel:05224235604" class="btn btn-primary btn-sm fw-bold px-3 py-2 rounded-3">
                            <i class="bi bi-telephone-fill me-1"></i> Call Desk (0522-4235604)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Frequently Asked Questions Section -->
    @if(!empty($contactFaqs))
        <section class="py-5 bg-white border-top">
            <div class="container">
                <div class="text-center mx-auto mb-5" style="max-width: 750px;">
                    <span class="badge px-3 py-1.5 rounded-pill fw-bold mb-2" style="background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">Clear Answers</span>
                    <h2 class="h3 fw-bold text-slate-900 mb-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-question-circle-fill" style="color: #059669;"></i> <span>Frequently Asked Questions</span>
                    </h2>
                    <p class="text-slate-600">
                        Common questions from clients before starting a custom software development project with Software Company in Lucknow.
                    </p>
                </div>

                <x-faq-accordion :faqs="$contactFaqs" id="contactFaqsAccordion" />
            </div>
        </section>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('serviceSelect');
            const customContainer = document.getElementById('customServiceContainer');
            const customInput = document.getElementById('custom_service');

            if (serviceSelect && customContainer) {
                serviceSelect.addEventListener('change', function() {
                    if (this.value === 'Other') {
                        customContainer.classList.remove('d-none');
                        if (customInput) customInput.focus();
                    } else {
                        customContainer.classList.add('d-none');
                        if (customInput) customInput.value = '';
                    }
                });
            }

            const contactForm = document.getElementById('contactConsultationForm');
            const contactSubmitBtn = document.getElementById('contactSubmitBtn');

            if (contactForm && contactSubmitBtn) {
                contactForm.addEventListener('submit', function() {
                    contactSubmitBtn.disabled = true;
                    contactSubmitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> <span>Submitting Request...</span>';
                });
            }
        });
    </script>
    @endpush
</x-layout>
