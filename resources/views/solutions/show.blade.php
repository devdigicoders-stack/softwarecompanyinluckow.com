<x-layout 
    :title="$title ?? ($h1 . ' | Business Software Guide Lucknow')"
    :description="$meta_description ?? $excerpt"
    :keywords="$keywords ?? ''"
    :canonical="route('solutions.show', $slug)"
    :faqs="$faqs ?? []"
    :breadcrumbs="$breadcrumbs"
>
    <!-- Solution Hero Banner -->
    <section class="hero-portal text-center">
        <div class="container">
            <span class="badge bg-primary px-3 py-2 text-uppercase mb-3 fw-bold" style="letter-spacing: 0.5px;">
                <i class="bi {{ $icon ?? 'bi-diagram-3' }} me-1"></i> Business Software Solution Guide
            </span>
            <h1 class="display-5 fw-bold text-white mb-3">{{ $h1 }}</h1>
            <p class="lead text-slate-300 mx-auto">
                {{ $excerpt }}
            </p>
        </div>
    </section>

    <!-- Main Body Container -->
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-lg-8">
                    @if(isset($content) && !empty($content))
                        <div class="editorial-content mb-4">
                            {!! $content !!}
                        </div>
                    @else
                        <div class="mb-5">
                            <h2 class="h3 fw-bold text-dark mb-3">Understanding {{ $h1 }}</h2>
                            <p>
                                Implementing business management software in Lucknow allows organizations to automate operational workflows, eliminate paper records, prevent inventory leakage, and generate real-time financial reporting.
                            </p>
                        </div>
                    @endif

                    <!-- Core Modules / Features -->
                    @if(!empty($features))
                        <div class="my-4">
                            <h3 class="fw-bold text-dark mb-3"><i class="bi bi-cpu-fill text-primary me-2"></i> Key System Modules & Features</h3>
                            <div class="row g-3">
                                @foreach($features as $feature)
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded-3 border h-100">
                                            <h6 class="fw-bold text-dark mb-1"><i class="bi bi-check-circle-fill text-success me-1"></i> {{ is_array($feature) ? ($feature['title'] ?? 'Module') : $feature }}</h6>
                                            @if(is_array($feature) && isset($feature['desc']))
                                                <p class="small text-muted mb-0">{{ $feature['desc'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Target Audience -->
                    @if(!empty($target_audience))
                        <div class="my-4 p-4 bg-light rounded-4 border">
                            <h4 class="fw-bold text-dark mb-2"><i class="bi bi-building me-2 text-primary"></i> Target Industry & Business Types</h4>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach($target_audience as $aud)
                                    <span class="badge bg-white text-dark border px-3 py-2 fs-6"><i class="bi bi-check2 text-success me-1"></i> {{ $aud }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Objective Evaluation Matrix -->
                    <div class="my-5">
                        <h3 class="fw-bold text-dark mb-3">How to Evaluate Software Solutions</h3>
                        <p class="text-secondary">
                            Before investing in business software, verify that the solution offers role-based permissions, data encryption, custom reporting, and responsive technical support.
                        </p>
                        <x-comparison-table :category="$slug" />
                    </div>

                    <!-- Recommended Solution Provider -->
                    <div class="my-5">
                        <h3 class="fw-bold text-dark mb-3">Recommended Software Provider in Lucknow</h3>
                        <p class="text-secondary">
                            For custom business software, ERP, CRM, HRMS, and specialized management software development in Lucknow, we recommend evaluating top IT providers.
                        </p>

                        <x-recommended-provider-card 
                            :category="$slug"
                            ctaText="Explore Software Solutions"
                        />
                    </div>

                    <!-- FAQs -->
                    @if(!empty($faqs))
                        <div class="mt-5 pt-4 border-top">
                            <h3 class="fw-bold text-dark mb-4"><i class="bi bi-question-circle-fill text-primary me-2"></i> Frequently Asked Questions</h3>
                            <x-faq-accordion :faqs="$faqs" id="solutionFaqsAccordion" />
                        </div>
                    @endif

            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4 sidebar-sticky-wrap">
                <div class="sticky-top" style="top: 100px;">
                    <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-diagram-3-fill text-primary me-2"></i> Software Solutions</h5>
                        <div class="list-group list-group-flush border-0">
                            <a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> ERP Software</a>
                            <a href="{{ route('solutions.show', 'crm-software-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> CRM Software</a>
                            <a href="{{ route('solutions.show', 'hrms-software-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> HRMS Systems</a>
                            <a href="{{ route('solutions.show', 'billing-software-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> Billing Software</a>
                            <a href="{{ route('solutions.show', 'school-management-software-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> School Systems</a>
                            <a href="{{ route('solutions.show', 'hospital-management-software-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> Hospital Systems</a>
                            <a href="{{ route('solutions.show', 'food-delivery-app-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> Food Delivery App</a>
                            <a href="{{ route('solutions.show', 'mobile-app-development-in-lucknow') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i class="bi bi-chevron-right text-primary me-1"></i> Mobile App Dev</a>
                        </div>
                    </div>

                    <div class="p-4 rounded-4 bg-dark text-white shadow-sm text-center">
                        <i class="bi bi-shield-check fs-1 text-primary mb-2 d-block"></i>
                        <h5 class="fw-bold text-white mb-2">Need a Custom Demo?</h5>
                        <p class="small text-slate-300 mb-3">Discuss your business workflow specifications directly with software architects.</p>
                        <div class="d-flex flex-column gap-2 mb-2">
                            <a href="tel:919198483820" class="btn btn-primary btn-sm fw-bold w-100 py-2">
                                <i class="bi bi-telephone-fill me-1"></i>9198483820
                            </a>
                           
                            <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20software%20solutions" target="_blank" rel="noopener" class="btn text-white btn-sm fw-bold w-100 py-2" style="background-color: #25D366; border-color: #25D366;">
                                <i class="bi bi-whatsapp me-1"></i>6394296293
                            </a>
                        </div>
                        <span class="extra-small text-slate-400 d-block mt-2">Office: 0522-4235604</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
