<x-layout 
    :title="$title"
    :description="$meta_description"
    :keywords="$keywords ?? ''"
    :canonical="route('cost-guides.show', Str::slug($title))"
    :breadcrumbs="$breadcrumbs"
    :faqs="$faqs"
>
    <!-- Article Header -->
    <div class="bg-white border-bottom py-5">
        <div class="container">
            <div>
                <span class="pub-badge"><i class="bi bi-calculator me-1"></i> {{ $category }}</span>
                <h1 class="display-6 fw-bold text-dark mt-2 mb-3">{{ $title }}</h1>
                <p class="lead text-secondary mb-4">{{ $excerpt }}</p>

                <div class="d-flex flex-wrap align-items-center justify-content-between pt-3 border-top gap-3 text-muted small">
                    <div class="d-flex align-items-center gap-3">
                        <span><i class="bi bi-person-circle text-primary me-1"></i> {{ $author }}</span>
                        <span><i class="bi bi-calendar3 me-1"></i> Updated: {{ $updated_at }}</span>
                        <span><i class="bi bi-clock me-1"></i> {{ $read_time }} min read</span>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Lucknow, UP</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Body & Sidebar -->
    <div class="container my-5">
        <div class="row g-4">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                    <!-- Table of Contents -->
                    <x-toc :items="$table_of_contents" />

                    <!-- Section 1: Intro -->
                    <section id="intro" class="mb-5">
                        <h2 class="h3 fw-bold text-dark mb-3">Understanding Software Costs in Lucknow</h2>
                        <p>
                            Determining the cost of software development in Lucknow requires looking beyond flat hourly rates. Modern software solutions—whether custom web applications, native/cross-platform mobile apps, or enterprise ERP/CRM systems—involve multiple development stages including UI/UX design, database engineering, backend business logic, security configuration, quality assurance, and server deployment.
                        </p>
                        <p>
                            Because business requirements vary significantly across industries, reputable software engineering firms evaluate costs using custom functional scope definitions rather than arbitrary pricing tiers.
                        </p>
                    </section>

                    <!-- Section 2: Key Price Drivers -->
                    <section id="factors" class="mb-5">
                        <h2 class="h3 fw-bold text-dark mb-3">Key Factors That Determine Software Pricing</h2>
                        <div class="row g-3 my-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border h-100">
                                    <h5 class="fw-bold text-dark"><i class="bi bi-gear-fill text-primary me-2"></i> Functional Complexity</h5>
                                    <p class="small text-muted mb-0">The number of custom user roles, workflow approvals, automated notifications, and reporting dashboards directly determines development hours.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border h-100">
                                    <h5 class="fw-bold text-dark"><i class="bi bi-plug-fill text-primary me-2"></i> API Integrations</h5>
                                    <p class="small text-muted mb-0">Connecting third-party services such as payment gateways, SMS/WhatsApp APIs, biometric devices, or accounting packages requires additional security protocols.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border h-100">
                                    <h5 class="fw-bold text-dark"><i class="bi bi-phone-fill text-primary me-2"></i> Target Platforms</h5>
                                    <p class="small text-muted mb-0">Building a web-only application is faster than developing multi-platform iOS, Android, and Web applications simultaneously.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border h-100">
                                    <h5 class="fw-bold text-dark"><i class="bi bi-shield-lock-fill text-primary me-2"></i> Security & Compliance</h5>
                                    <p class="small text-muted mb-0">Enterprise-grade encryption, role-based access control (RBAC), CSRF protection, and audit logging require meticulous architecture.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Section 3: Recommended Provider -->
                    <section id="recommended-provider" class="my-5">
                        <h2 class="h3 fw-bold text-dark mb-3">Recommended Software Development Company in Lucknow</h2>
                        <p>
                            For businesses looking to build reliable, high-performance custom software, web applications, or mobile apps without risk of cost overruns, we recommend consulting with premier software engineering experts in Lucknow.
                        </p>
                        
                        <x-recommended-provider-card 
                            category="cost-guides"
                            ctaText="Explore Software Cost Guide"
                        />
                    </section>

                    <!-- Section 4: FAQs -->
                    <section id="faqs" class="mt-5">
                        <h2 class="h3 fw-bold text-dark mb-4"><i class="bi bi-question-circle-fill text-primary me-2"></i> Frequently Asked Questions</h2>
                        <x-faq-accordion :faqs="$faqs" />
                    </section>

                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px; z-index: 10;">
                    
                    <!-- Quick Summary Box -->
                    <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle text-primary me-2"></i> Key Takeaways</h5>
                        <ul class="list-unstyled mb-0 small text-secondary">
                            <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Software costs are driven by scope, not arbitrary pricing tiers.</li>
                            <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Modern frameworks like Laravel accelerate delivery timelines.</li>
                            <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Always demand transparent milestone scope documentation.</li>
                            <li class="mb-0"><i class="bi bi-check2-circle text-success me-2"></i> Custom software eliminates recurring monthly user fees.</li>
                        </ul>
                    </div>

                    <!-- Consultation Box -->
                    <div class="p-4 rounded-4 bg-dark text-white shadow-sm text-center">
                        <i class="bi bi-chat-dots-fill fs-1 text-primary mb-2 d-block"></i>
                        <h5 class="fw-bold text-white mb-2">Need a Custom Project Quote?</h5>
                        <p class="small text-slate-300 mb-3">Consult directly with technical experts for accurate milestone estimation.</p>
                        <div class="d-flex flex-column gap-2 mb-2">
                            <a href="tel:919198483820" class="btn btn-primary btn-sm fw-bold w-100 py-2">
                                <i class="bi bi-telephone-fill me-1"></i> Call: +91 9198483820
                            </a>
                            <a href="tel:916394296293" class="btn btn-outline-light btn-sm fw-bold w-100 py-2">
                                <i class="bi bi-telephone-fill me-1"></i> Call: +91 6394296293
                            </a>
                            <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20get%20a%20cost%20estimate%20for%20my%20software%20project" target="_blank" rel="noopener" class="btn text-white btn-sm fw-bold w-100 py-2" style="background-color: #25D366; border-color: #25D366;">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp: +91 6394296293
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout>
