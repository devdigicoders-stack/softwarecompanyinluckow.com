<x-layout 
    title="Software Development Cost Guides in Lucknow | IT Pricing Factors & Estimates"
    description="Explore transparent software development cost guides in Lucknow. Understand pricing factors for custom software, web applications, mobile apps, ERP, and CRM systems."
    canonical="{{ route('cost-guides.index') }}"
    keywords="software development cost in lucknow, website development cost, mobile app cost, erp software pricing, crm cost lucknow"
    :faqs="$faqs ?? []"
>
    <!-- Cost Guides Hero Banner -->
    <section class="hero-portal text-center">
        <div class="container">
            <span class="badge bg-primary px-3 py-2 text-uppercase mb-3 fw-bold" style="letter-spacing: 0.5px;">
                <i class="bi bi-calculator me-1"></i> Software Pricing & Factor Guides
            </span>
            <h1 class="display-5 fw-bold text-white mb-3">Software Development Cost Guides in Lucknow</h1>
            <p class="lead text-slate-300 mx-auto">
                Comprehensive breakdown of software development rates, licensing costs, developer hourly pricing, and custom software budgets in Lucknow.
            </p>
        </div>
    </section>

    <!-- Main Content Container -->
    <div class="container my-5">
        
        <!-- Objective Cost Disclaimer Note -->
        <div class="alert alert-info border-info d-flex align-items-center gap-3 p-4 mb-5 rounded-4 shadow-sm" role="alert">
            <i class="bi bi-info-circle-fill text-info fs-1"></i>
            <div>
                <h5 class="fw-bold mb-1 text-dark">Objective Pricing Philosophy</h5>
                <p class="mb-0 text-secondary small">
                    Exact software development costs depend on project specifications, feature complexity, third-party integrations, and user roles. Our cost guides explain the core parameters that drive pricing so you can evaluate quotes effectively.
                </p>
            </div>
        </div>

        <!-- Cost Guides Grid -->
        <div class="row g-4 mb-5">
            @if(isset($costGuides) && $costGuides->count() > 0)
                @foreach($costGuides as $guide)
                    <div class="col-md-6 col-lg-4">
                        <x-cost-guide-card 
                            :title="$guide->title"
                            :slug="$guide->slug"
                            :excerpt="$guide->excerpt"
                            :category="$guide->category->name ?? 'Cost Guide'"
                            :readTime="$guide->reading_time_minutes . ' min read'"
                        />
                    </div>
                @endforeach
            @else
                @foreach($defaultGuides as $guide)
                    <div class="col-md-6 col-lg-4">
                        <x-cost-guide-card 
                            :title="$guide['title']"
                            :slug="$guide['slug']"
                            :excerpt="$guide['excerpt']"
                            :category="$guide['category']"
                            :readTime="$guide['reading_time'] . ' min read'"
                        />
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Evaluation Criteria & Recommended Provider Section -->
        <div class="my-5">
            <h3 class="fw-bold mb-3 text-dark"><i class="bi bi-shield-check text-primary me-2"></i> How to Select a Cost-Effective Software Partner</h3>
            <p class="text-secondary mb-4">
                When assessing software pricing in Lucknow, avoid selecting purely based on the lowest initial quote. Evaluate companies based on code quality, technical architecture, and long-term support guarantees.
            </p>

            <x-comparison-table category="cost-guides" />

            <x-recommended-provider-card 
                category="cost-guides"
                ctaText="Get Software Cost Estimate"
            />
        </div>

        @if(!empty($faqs))
            <div class="my-5">
                <x-faq-accordion :faqs="$faqs" />
            </div>
        @endif
    </div>
</x-layout>
