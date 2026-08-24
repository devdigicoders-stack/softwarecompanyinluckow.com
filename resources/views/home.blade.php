<x-layout title="Software Company in Lucknow | IT & Software Information Portal"
    description="Find the best software solutions, development companies, cost guides & technology insights in Lucknow."
    canonical="{{ route('home') }}"
    keywords="software company in lucknow, best software company in lucknow, software development companies in lucknow, it companies in lucknow, erp software lucknow, crm software lucknow"
    :faqs="$homeFaqs">
    <!-- Section 1: Hero Section with Edge-to-Edge Lucknow Monument Backdrop -->
    <section class="hero-skyline-section position-relative overflow-hidden">
        <!-- Edge-to-Edge Right Side Image for Desktop -->
        <div class="hero-edge-image-wrap d-none d-lg-block">
            <img src="{{ asset('images/lucknow_monuments_skyline.jpg') }}"
                alt="Lucknow Monuments Skyline Rumi Darwaza & Bara Imambara" class="hero-edge-img">
            <div class="hero-edge-overlay"></div>
        </div>

        <div class="container position-relative" style="z-index: 3;">
            <div class="row align-items-center py-4 py-lg-5">
                <div class="col-lg-7 col-xl-6">
                    <h1 class="display-4 fw-extrabold text-slate-900 mb-3 tracking-tight">
                        Software Company <br>
                        in <span id="heroTypewriterText" class="text-primary">Lucknow</span><span class="typewriter-cursor text-primary">|</span>
                    </h1>
                    <p class="lead text-slate-600 mb-3" style="max-width: 540px; font-size: 1.12rem; line-height: 1.6;">
                        Find the best software solutions, development companies, cost guides & technology insights.
                    </p>

                    <!-- Main Hero Search Bar (Matching Mockup 100%) -->
                    <div class="hero-main-search mb-4" style="max-width: 520px;">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="bg-white p-1.5 rounded-3 shadow-sm d-flex align-items-center border">
                                <input type="text" name="q"
                                    class="form-control border-0 ps-3 py-2.5 shadow-none text-slate-800"
                                    placeholder="What are you looking for?" required style="font-size: 0.95rem;">
                                <button type="submit" class="btn btn-primary px-4 py-2.5 fw-bold rounded-2 ms-2">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Popular Searches Strip (Flex Wrap to 2nd Line) -->
                    <div class="d-flex align-items-center flex-wrap gap-2 py-1 mb-2 mb-lg-0" style="max-width: 540px;">
                        <span class="small fw-bold text-slate-900 me-1">Popular Searches:</span>
                        <a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}"
                            class="search-pill-btn text-nowrap">ERP Software</a>
                        <a href="{{ route('solutions.show', 'crm-software-in-lucknow') }}"
                            class="search-pill-btn text-nowrap">CRM Software</a>
                        <a href="{{ route('solutions.show', 'hrms-software-in-lucknow') }}"
                            class="search-pill-btn text-nowrap">HRMS Software</a>
                        <a href="{{ route('services.show', 'website-development-company-in-lucknow') }}"
                            class="search-pill-btn text-nowrap">Website Development</a>
                        <a href="{{ route('services.show', 'mobile-app-development-company-in-lucknow') }}"
                            class="search-pill-btn text-nowrap">Mobile App</a>
                    </div>
                </div>

                <!-- Mobile Hero Image (Visible on Mobile & Tablet) -->
                <div class="col-12 d-lg-none mt-3">
                    <div class="hero-mobile-image-card position-relative rounded-4 overflow-hidden shadow-sm border">
                        <img src="{{ asset('images/lucknow_monuments_skyline.jpg') }}"
                            alt="Lucknow Monuments Skyline Rumi Darwaza & Bara Imambara"
                            class="w-100 object-fit-cover" style="height: 200px; display: block;">
                        <div class="position-absolute bottom-0 start-0 end-0 p-2 bg-dark bg-opacity-75 text-white text-center extra-small fw-semibold">
                            <i class="bi bi-geo-alt-fill text-warning me-1"></i> Software & IT Hub of Lucknow
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Container for Homepage Sections -->
    <div class="container my-5">

        <!-- Section 2: Explore Popular Software Solutions -->
        <section class="mb-5 pb-3">
            <div class="text-center mb-4">
                <h2 class="h3 fw-bold text-slate-900">Explore Popular Software Solutions</h2>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}"
                        class="solution-grid-card text-decoration-none d-block text-center p-3 h-100">
                        <div class="icon-circle bg-primary-subtle text-primary mx-auto mb-3">
                            <i class="bi bi-diagram-3 fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-1" style="font-size: 0.95rem;">ERP Software</h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Manage your entire business in one
                            place</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('solutions.show', 'crm-software-in-lucknow') }}"
                        class="solution-grid-card text-decoration-none d-block text-center p-3 h-100">
                        <div class="icon-circle bg-primary-subtle text-primary mx-auto mb-3">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-1" style="font-size: 0.95rem;">CRM Software</h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Build better customer relationships
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('solutions.show', 'hrms-software-in-lucknow') }}"
                        class="solution-grid-card text-decoration-none d-block text-center p-3 h-100">
                        <div class="icon-circle bg-primary-subtle text-primary mx-auto mb-3">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-1" style="font-size: 0.95rem;">HRMS Software</h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Streamline HR & employee management
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('solutions.show', 'billing-software-in-lucknow') }}"
                        class="solution-grid-card text-decoration-none d-block text-center p-3 h-100">
                        <div class="icon-circle bg-primary-subtle text-primary mx-auto mb-3">
                            <i class="bi bi-receipt fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-1" style="font-size: 0.95rem;">Billing Software</h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Simple & efficient billing
                            solutions</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('solutions.show', 'school-management-software-in-lucknow') }}"
                        class="solution-grid-card text-decoration-none d-block text-center p-3 h-100">
                        <div class="icon-circle bg-primary-subtle text-primary mx-auto mb-3">
                            <i class="bi bi-bank fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-1" style="font-size: 0.95rem;">School Management Software
                        </h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Complete solution for schools &
                            institutions</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('services.show', 'software-development-companies-in-lucknow') }}"
                        class="solution-grid-card text-decoration-none d-block text-center p-3 h-100">
                        <div class="icon-circle bg-primary-subtle text-primary mx-auto mb-3">
                            <i class="bi bi-arrow-right-circle fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-1" style="font-size: 0.95rem;">View More Solutions</h6>
                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Explore all software solutions</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- Section 3: Software Development Cost Guides -->
        <section class="mb-5 pb-3">
            <div class="text-center mb-4">
                <h2 class="h3 fw-bold text-slate-900">Software Development Cost Guides</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="cost-card-box h-100">
                        <div class="cost-card-img">
                            <img src="{{ asset('images/cost-guides/software-development-cost.png') }}"
                                alt="Software Development Cost">
                        </div>
                        <div class="cost-card-body text-center">
                            <h6 class="cost-card-title">
                                <a href="{{ route('cost-guides.show', 'software-development-cost-in-lucknow') }}">
                                    Software Development Cost in Lucknow
                                </a>
                            </h6>
                            <p class="text-muted small mb-0">Detailed cost breakdown and pricing factors</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cost-card-box h-100">
                        <div class="cost-card-img">
                            <img src="{{ asset('images/cost-guides/website-development-cost.jpg') }}"
                                alt="Website Development Cost">
                        </div>
                        <div class="cost-card-body text-center">
                            <h6 class="cost-card-title">
                                <a href="{{ route('cost-guides.show', 'website-development-cost-in-lucknow') }}">
                                    Website Development Cost in Lucknow
                                </a>
                            </h6>
                            <p class="text-muted small mb-0">Complete guide with pricing factors</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cost-card-box h-100">
                        <div class="cost-card-img">
                            <img src="{{ asset('images/cost-guides/mobile-app-development-cost.png') }}"
                                alt="Mobile App Cost">
                        </div>
                        <div class="cost-card-body text-center">
                            <h6 class="cost-card-title">
                                <a href="{{ route('cost-guides.show', 'mobile-app-development-cost-in-lucknow') }}">
                                    Mobile App Development Cost
                                </a>
                            </h6>
                            <p class="text-muted small mb-0">Android & iOS app cost guide</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cost-card-box h-100">
                        <div class="cost-card-img">
                            <img src="{{ asset('images/cost-guides/erp-development-cost.png') }}"
                                alt="ERP Software Cost">
                        </div>
                        <div class="cost-card-body text-center">
                            <h6 class="cost-card-title">
                                <a href="{{ route('cost-guides.show', 'erp-software-cost-in-lucknow') }}">
                                    ERP Software Cost in India
                                </a>
                            </h6>
                            <p class="text-muted small mb-0">Features, modules & cost estimation</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cost-card-box h-100">
                        <div class="cost-card-img">
                            <img src="{{ asset('images/cost-guides/crm-software-cost.jpg') }}"
                                alt="CRM Software Cost">
                        </div>
                        <div class="cost-card-body text-center">
                            <h6 class="cost-card-title">
                                <a href="{{ route('cost-guides.show', 'crm-software-cost-in-lucknow') }}">
                                    CRM Software Cost in Lucknow
                                </a>
                            </h6>
                            <p class="text-muted small mb-0">Sales funnel automation & pricing</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="cost-card-box h-100">
                        <div class="cost-card-img">
                            <img src="{{ asset('images/cost-guides/custom-software-cost.jpg') }}"
                                alt="Custom Software Development Cost">
                        </div>
                        <div class="cost-card-body text-center">
                            <h6 class="cost-card-title">
                                <a href="{{ route('cost-guides.show', 'custom-software-development-cost') }}">
                                    Custom Software Development Cost
                                </a>
                            </h6>
                            <p class="text-muted small mb-0">Scope, team & architecture pricing</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Technology Guides -->
        <section class="mb-5 pb-3">
            <div class="text-center mb-4">
                <h2 class="h3 fw-bold text-slate-900">Technology Guides</h2>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('technology.show', 'laravel-development') }}"
                        class="tech-grid-card text-decoration-none d-block text-center p-3 h-100 bg-white border rounded-4 shadow-sm">
                        <div class="tech-icon-wrap mb-2 text-danger">
                            <i class="bi bi-layers fs-2"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-0" style="font-size: 0.9rem;">Laravel Development</h6>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('technology.show', 'php-development') }}"
                        class="tech-grid-card text-decoration-none d-block text-center p-3 h-100 bg-white border rounded-4 shadow-sm">
                        <div class="tech-icon-wrap mb-2 text-primary">
                            <i class="bi bi-code-slash fs-2"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-0" style="font-size: 0.9rem;">PHP Development</h6>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('technology.show', 'flutter-app-development') }}"
                        class="tech-grid-card text-decoration-none d-block text-center p-3 h-100 bg-white border rounded-4 shadow-sm">
                        <div class="tech-icon-wrap mb-2 text-info">
                            <i class="bi bi-phone-vibrate fs-2"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-0" style="font-size: 0.9rem;">Flutter Development</h6>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('technology.show', 'react-development') }}"
                        class="tech-grid-card text-decoration-none d-block text-center p-3 h-100 bg-white border rounded-4 shadow-sm">
                        <div class="tech-icon-wrap mb-2 text-info">
                            <i class="bi bi-lightning-charge fs-2"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-0" style="font-size: 0.9rem;">React Development</h6>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('technology.show', 'nodejs-development') }}"
                        class="tech-grid-card text-decoration-none d-block text-center p-3 h-100 bg-white border rounded-4 shadow-sm">
                        <div class="tech-icon-wrap mb-2 text-success">
                            <i class="bi bi-node-plus fs-2"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-0" style="font-size: 0.9rem;">Node.js Development</h6>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('technology.show', 'python-development') }}"
                        class="tech-grid-card text-decoration-none d-block text-center p-3 h-100 bg-white border rounded-4 shadow-sm">
                        <div class="tech-icon-wrap mb-2 text-warning">
                            <i class="bi bi-terminal fs-2"></i>
                        </div>
                        <h6 class="fw-bold text-slate-900 mb-0" style="font-size: 0.9rem;">Python Development</h6>
                    </a>
                </div>
            </div>
        </section>

        <!-- Section 5: Latest Articles & Trending Searches -->
        <section class="mb-5 pb-3">
            <div class="row g-4">
                <!-- Left 7 Cols: Latest Articles & Insights -->
                <div class="col-lg-7">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="fw-bold text-slate-900 mb-0">Latest Articles & Insights</h3>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-sm fw-bold px-3 py-1.5 rounded-3">
                            View All Articles <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    @if(isset($latestPosts) && $latestPosts->count() > 0)
                        <div class="d-flex flex-column gap-3">
                            @foreach($latestPosts->take(3) as $post)
                                <div class="article-card-box d-flex gap-3 align-items-center">
                                    <div style="width: 110px; height: 85px; flex-shrink: 0; background: #090d16;"
                                        class="rounded-3 overflow-hidden">
                                        <img src="{{ $post->featured_image ? asset($post->featured_image) : 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=400&q=80' }}"
                                            alt="{{ $post->title }}" class="w-100 h-100 object-fit-cover"
                                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=400&q=80';">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="article-card-title">
                                            <a href="{{ route('blog.show', $post->slug) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h6>
                                        <p class="text-muted small mb-1 line-clamp-2" style="font-size: 0.82rem;">
                                            {{ $post->excerpt }}</p>
                                        <div class="d-flex align-items-center gap-2 text-muted small"
                                            style="font-size: 0.75rem;">
                                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                            <span>&bull;</span>
                                            <span><i class="bi bi-clock me-1"></i> {{ $post->reading_time_minutes }} min
                                                read</span>
                                            @if($post->category)
                                                <span>&bull;</span>
                                                <span class="text-primary font-weight-bold">{{ $post->category->name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right 5 Cols: Trending Searches -->
                <div class="col-lg-5">
                    <h3 class="fw-bold text-slate-900 mb-4">Trending Searches</h3>

                    <div class="trending-search-card">
                        <a href="{{ route('services.show', 'software-company-in-lucknow') }}"
                            class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> Best Software Company in Lucknow
                        </a>
                        <a href="{{ route('services.show', 'software-development-company-in-lucknow') }}"
                            class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> Software Development Company in Lucknow
                        </a>
                        <a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}" class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> ERP Software in Lucknow
                        </a>
                        <a href="{{ route('services.show', 'website-development-company-in-lucknow') }}"
                            class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> Website Development in Lucknow
                        </a>
                        <a href="{{ route('services.show', 'mobile-app-development-company-in-lucknow') }}"
                            class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> Mobile App Development in Lucknow
                        </a>
                        <a href="{{ route('solutions.show', 'crm-software-in-lucknow') }}" class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> CRM Software in Lucknow
                        </a>
                        <a href="{{ route('solutions.show', 'hrms-software-in-lucknow') }}"
                            class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> HRMS Software in Lucknow
                        </a>
                        <a href="{{ route('services.show', 'custom-software-development-lucknow') }}"
                            class="trending-search-item">
                            <i class="bi bi-graph-up-arrow"></i> Custom Software Development
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 6: Comprehensive Guide for Website, Mobile App & Custom Software Development in Lucknow -->
        <section class="mt-5 mb-5 pb-3">
            <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm">
                <div class="mb-4">
                    <span class="badge bg-primary text-uppercase px-3 py-2 mb-2" style="font-size: 0.75rem;">Complete Lucknow Tech & Software Guide</span>
                    <h2 class="h3 fw-bold text-slate-900 mb-3">Website, Mobile App & Custom Software Development Services in Lucknow</h2>
                    <p class="text-slate-600 lead" style="font-size: 1.02rem; line-height: 1.6;">
                        Looking to build a custom website, mobile application, or enterprise software system in Lucknow? Explore detailed insights on technology stacks, cost estimates, and recommended software development companies in Aliganj, Lucknow.
                    </p>
                </div>

                <div class="row g-4 my-2">
                    <!-- Pillar 1: Website Development -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-slate-50 rounded-3 border h-100">
                            <div class="text-primary fs-3 mb-2"><i class="bi bi-globe"></i></div>
                            <h5 class="fw-bold text-slate-900 h6 mb-2">Website Development Company in Lucknow</h5>
                            <p class="small text-slate-600 mb-3" style="font-size: 0.84rem;">
                                Get responsive corporate websites, e-commerce stores, custom Web APIs, and SEO-optimized web portals engineered with Laravel, PHP, and React.
                            </p>
                            <a href="{{ route('services.show', 'website-development-company-in-lucknow') }}" class="small fw-bold text-primary text-decoration-none">
                                Explore Web Services <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Pillar 2: Mobile App Development -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-slate-50 rounded-3 border h-100">
                            <div class="text-success fs-3 mb-2"><i class="bi bi-phone"></i></div>
                            <h5 class="fw-bold text-slate-900 h6 mb-2">Mobile App Development Company in Lucknow</h5>
                            <p class="small text-slate-600 mb-3" style="font-size: 0.84rem;">
                                High-performance Android and iOS mobile app development using Flutter and React Native with native API integration and Play Store publishing.
                            </p>
                            <a href="{{ route('services.show', 'mobile-app-development-company-in-lucknow') }}" class="small fw-bold text-success text-decoration-none">
                                Explore Mobile App Services <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Pillar 3: Custom Software & ERP -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-slate-50 rounded-3 border h-100">
                            <div class="text-info fs-3 mb-2"><i class="bi bi-cpu"></i></div>
                            <h5 class="fw-bold text-slate-900 h6 mb-2">Custom Software & ERP Systems</h5>
                            <p class="small text-slate-600 mb-3" style="font-size: 0.84rem;">
                                Tailored enterprise ERP software, custom CRM solutions, HRMS payroll, inventory management, and school/hospital billing software in Lucknow.
                            </p>
                            <a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}" class="small fw-bold text-info text-decoration-none">
                                Explore ERP Solutions <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Pillar 4: Software Cost & Pricing Guides -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-slate-50 rounded-3 border h-100">
                            <div class="text-warning fs-3 mb-2"><i class="bi bi-calculator"></i></div>
                            <h5 class="fw-bold text-slate-900 h6 mb-2">Transparent Software Cost Guides</h5>
                            <p class="small text-slate-600 mb-3" style="font-size: 0.84rem;">
                                Understand exact pricing factors for custom software, website creation, mobile app development, and ERP software licensing in Lucknow & India.
                            </p>
                            <a href="{{ route('cost-guides.index') }}" class="small fw-bold text-warning text-decoration-none">
                                View Cost Breakdown <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- High-Search Volume Keyword Tag Cloud -->
                <div class="mt-4 pt-4 border-top">
                    <h6 class="fw-bold text-slate-900 mb-3"><i class="bi bi-search me-2 text-primary"></i> Popular High-Intent Google Search Topics in Lucknow:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('services.show', 'software-development-company-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Software Development Company in Lucknow</a>
                        <a href="{{ route('services.show', 'website-development-company-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Website Development Company in Lucknow</a>
                        <a href="{{ route('services.show', 'mobile-app-development-company-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Mobile App Development Company in Lucknow</a>
                        <a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">ERP Software Development Lucknow</a>
                        <a href="{{ route('solutions.show', 'crm-software-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Custom CRM Software Lucknow</a>
                        <a href="{{ route('solutions.show', 'billing-software-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">GST Billing & Inventory Software</a>
                        <a href="{{ route('technology.show', 'laravel-development') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Laravel Web Developers Lucknow</a>
                        <a href="{{ route('technology.show', 'flutter-app-development') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Flutter Mobile App Developers</a>
                        <a href="{{ route('cost-guides.show', 'software-development-cost-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Software Development Cost in Lucknow</a>
                        <a href="{{ route('cost-guides.show', 'website-development-cost-in-lucknow') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Website Development Cost Guide</a>
                        <a href="{{ route('locations.show', 'aliganj') }}" class="badge bg-light text-slate-800 border p-2 text-decoration-none">Software Developers Aliganj Lucknow</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 7: Contextual Recommendation -->
        <section class="mb-5 pb-3">
            <x-recommended-provider-card category="homepage" ctaText="Explore Software Solutions" />
        </section>

        <!-- Section 7: Frequently Asked Questions Grid -->
        <section class="mb-5">
            <div class="text-center mb-4">
                <h2 class="h3 fw-bold text-slate-900">Frequently Asked Questions</h2>
            </div>

            <x-faq-accordion :faqs="$homeFaqs" id="homeFaqsAccordion" />
        </section>
    </div>
</x-layout>