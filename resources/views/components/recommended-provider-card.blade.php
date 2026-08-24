@props([
    'category' => 'general',
    'ctaText' => 'Explore Software Solutions',
    'targetUrl' => null,
])

@php
    $finalUrl = $targetUrl ?? route('go.provider', ['category' => $category, 'cta' => 'recommended_card']);
@endphp

<div class="recommended-provider-promo-box p-4 p-md-5 rounded-4 border shadow-sm my-4 position-relative overflow-hidden">
    <div class="row align-items-center g-4">
        <!-- Left 8 Cols: Value Proposition -->
        <div class="col-lg-7">
            <h3 class="fw-extrabold text-slate-900 mb-3">Looking for a Trusted Software Development Partner?</h3>
            <p class="text-slate-600 mb-4" style="line-height: 1.65; font-size: 0.98rem;">
                Lucknow IT Solutions is a leading software development provider in Lucknow providing custom software, ERP, CRM, HRMS, and web & mobile app development solutions for businesses of all sizes.
            </p>
            <div class="d-flex flex-wrap align-items-center gap-3 mb-3" style="gap: 12px;">
                <button type="button" class="btn btn-primary fw-bold px-3.5 py-2.5 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#globalEnquiryModal" data-source="{{ $category }}">
                    {{ $ctaText }} <i class="bi bi-arrow-right ms-1"></i>
                </button>
                <a href="tel:919198483820" class="btn btn-outline-primary fw-bold px-3.5 py-2.5 rounded-3 shadow-sm">
                    <i class="bi bi-telephone-fill me-1.5"></i> Call: +91 9198483820
                </a>
                <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20software%20services" target="_blank" rel="noopener" class="btn text-white fw-bold px-3.5 py-2.5 rounded-3 shadow-sm" style="background-color: #25D366; border-color: #25D366;">
                    <i class="bi bi-whatsapp me-1.5"></i> WhatsApp: +91 6394296293
                </a>
            </div>
            <div class="small text-slate-500 fw-medium">
                <i class="bi bi-headset text-primary me-1"></i> Direct Helpline: <strong>+91 9198483820 / +91 6394296293</strong>
            </div>
        </div>

        <!-- Right 5 Cols: Brand Card & Feature Checklist -->
        <div class="col-lg-5">
            <div class="bg-white p-4 rounded-4 border shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                    <div class="recommended-logo-circle bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-slate-900 mb-0" style="font-size: 1.1rem;">Lucknow IT</h5>
                        <span class="text-muted extra-small uppercase tracking-wide fw-bold" style="font-size: 0.72rem;">SOLUTIONS</span>
                    </div>
                </div>

                <ul class="list-unstyled mb-0 d-flex flex-column gap-2 small fw-bold text-slate-700">
                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-lg text-primary fs-5"></i> Custom Software Development</li>
                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-lg text-primary fs-5"></i> ERP, CRM, HRMS Solutions</li>
                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-lg text-primary fs-5"></i> Web & Mobile App Development</li>
                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-lg text-primary fs-5"></i> Affordable Pricing</li>
                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-lg text-primary fs-5"></i> On-time Delivery</li>
                </ul>
            </div>
        </div>
    </div>
</div>
