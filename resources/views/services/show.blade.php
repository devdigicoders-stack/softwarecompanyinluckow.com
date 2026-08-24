<x-layout :title="$title ?? ($h1 . ' | Software Company in Lucknow')" :description="$meta_description ?? $excerpt"
    :keywords="$keywords ?? ''" :canonical="route('services.show', $slug)" :faqs="$faqs ?? []" :breadcrumbs="$breadcrumbs">
    <!-- Header Hero -->
    <section class="hero-portal text-center">
        <div class="container">
            <span class="badge bg-primary px-3 py-2 text-uppercase mb-3 fw-bold" style="letter-spacing: 0.5px;">
                <i class="bi {{ $icon ?? 'bi-code-slash' }} me-1"></i> Software & IT Guide
            </span>
            <h1 class="display-5 fw-bold text-white mb-3">{{ $h1 }}</h1>
            <p class="lead text-slate-300 mx-auto">
                {{ $excerpt }}
            </p>
        </div>
    </section>

    <!-- Main Service Content Section -->
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
                                Software and technology services in Lucknow have evolved from simple web development into comprehensive digital transformation ecosystem. Businesses across Uttar Pradesh rely on custom software development, high-performance mobile applications, enterprise ERP solutions, and scalable cloud integrations to drive growth and operational efficiency.
                            </p>
                            <p>
                                When choosing a technology service provider in Lucknow, it is critical to evaluate vendor capabilities across security standards, code quality, deployment architecture, and post-launch technical support.
                            </p>
                        </div>
                    @endif

                    <!-- Core Deliverables / Features -->
                    @if(!empty($features))
                        <div class="my-4">
                            <h3 class="fw-bold text-dark mb-3"><i class="bi bi-patch-check-fill text-primary me-2"></i> Key Service Deliverables & Capabilities</h3>
                            <div class="row g-3">
                                @foreach($features as $feature)
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded-3 border h-100">
                                            <h6 class="fw-bold text-dark mb-1"><i class="bi bi-check-circle-fill text-success me-1"></i> {{ is_array($feature) ? ($feature['title'] ?? 'Feature') : $feature }}</h6>
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
                            <h4 class="fw-bold text-dark mb-2"><i class="bi bi-geo-alt me-2 text-primary"></i> Target Business Segments in Lucknow</h4>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach($target_audience as $aud)
                                    <span class="badge bg-white text-dark border px-3 py-2 fs-6"><i class="bi bi-check2 text-success me-1"></i> {{ $aud }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Objective Service Evaluation Matrix -->
                    <div class="my-5">
                        <h3 class="fw-bold text-dark mb-3">How to Evaluate Technology Service Providers</h3>
                        <p class="text-secondary">
                            Before signing a software or web development contract, review source code ownership policies, SLA commitments, mobile responsiveness, and client case studies.
                        </p>
                        <x-comparison-table :category="$slug" />
                    </div>

                    <!-- Recommended Provider Section -->
                    <div class="my-5">
                        <h3 class="fw-bold text-dark mb-3">Recommended Technology Partner in Lucknow</h3>
                        <p class="text-secondary">
                            For custom web development, mobile apps, software solutions, and digital transformation in Lucknow, we recommend partnering with verified development teams.
                        </p>

                        <x-recommended-provider-card 
                            :category="$slug"
                            ctaText="Consult IT Experts"
                        />
                    </div>

                    <!-- FAQs -->
                    @if(!empty($faqs))
                        <div class="mt-5 pt-4 border-top">
                            <h3 class="fw-bold text-dark mb-4"><i class="bi bi-question-circle-fill text-primary me-2"></i> Frequently Asked Questions</h3>
                            <x-faq-accordion :faqs="$faqs" id="serviceFaqsAccordion" />
                        </div>
                    @endif
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4 sidebar-sticky-wrap">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Related Services Widget -->
                    <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>
                            Service Guides</h5>
                        <div class="list-group list-group-flush border-0">
                            <a href="{{ route('services.show', 'software-company-in-lucknow') }}"
                                class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i
                                    class="bi bi-chevron-right text-primary me-1"></i> Software Company Guide</a>
                            <a href="{{ route('services.show', 'software-development-company-in-lucknow') }}"
                                class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i
                                    class="bi bi-chevron-right text-primary me-1"></i> Software Development</a>
                            <a href="{{ route('services.show', 'web-development-company-in-lucknow') }}"
                                class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i
                                    class="bi bi-chevron-right text-primary me-1"></i> Web Development</a>
                            <a href="{{ route('services.show', 'mobile-app-development-company-in-lucknow') }}"
                                class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i
                                    class="bi bi-chevron-right text-primary me-1"></i> Mobile App Dev</a>
                            <a href="{{ route('services.show', 'custom-software-development-lucknow') }}"
                                class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i
                                    class="bi bi-chevron-right text-primary me-1"></i> Custom Software</a>
                            <a href="{{ route('services.show', 'ecommerce-development-company-in-lucknow') }}"
                                class="list-group-item list-group-item-action border-0 px-0 py-2 text-dark small"><i
                                    class="bi bi-chevron-right text-primary me-1"></i> E-commerce Dev</a>
                        </div>
                    </div>

                    <!-- Consultation Request Card -->
                    <div class="p-4 rounded-4 bg-dark text-white shadow-sm text-center">
                        <i class="bi bi-headset fs-1 text-primary mb-2 d-block"></i>
                        <h5 class="fw-bold text-white mb-2">Need Help Choosing Software?</h5>
                        <p class="small text-slate-300 mb-3">Speak directly with lead software architects in Lucknow.</p>
                        <div class="d-flex flex-column gap-2 mb-2">
                            <a href="tel:919198483820" class="btn btn-primary btn-sm fw-bold w-100 py-2">
                                <i class="bi bi-telephone-fill me-1"></i>9198483820
                            </a>
                          
                            <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20software%20services" target="_blank" rel="noopener" class="btn text-white btn-sm fw-bold w-100 py-2" style="background-color: #25D366; border-color: #25D366;">
                                <i class="bi bi-whatsapp me-1"></i>6394296293
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>