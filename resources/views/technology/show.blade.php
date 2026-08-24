<x-layout 
    :title="$title"
    :description="$meta_description"
    :keywords="$keywords ?? ''"
    :canonical="route('technology.show', Str::slug($h1))"
    :breadcrumbs="$breadcrumbs"
    :faqs="$faqs"
>
    <!-- Technology Hero Banner -->
    <section class="hero-portal text-center">
        <div class="container">
            <span class="badge bg-primary px-3 py-2 text-uppercase mb-3 fw-bold" style="letter-spacing: 0.5px;">
                <i class="bi {{ $icon }} me-1"></i> Technology Stack Guide
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
                    <h2 class="h3 fw-bold text-dark mb-4"><i class="bi bi-star-fill text-warning me-2"></i> Key Architecture Benefits & Capabilities</h2>
                    
                    <div class="row g-3 mb-4">
                        @foreach($benefits as $benefit)
                            <div class="col-12">
                                <div class="p-3 bg-light rounded-3 border d-flex align-items-start gap-3">
                                    <i class="bi bi-check-circle-fill text-success fs-4 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">Architecture Advantage</h6>
                                        <p class="text-secondary small mb-0">{{ $benefit }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="my-5">
                        <h3 class="fw-bold text-dark mb-3">Objective Provider Evaluation</h3>
                        <p class="text-secondary">
                            When hiring developers or choosing a software partner skilled in {{ explode(' ', $h1)[0] }}, ensure they provide clean source code access, automated testing protocols, and proper documentation.
                        </p>
                        <x-comparison-table category="technology" />
                    </div>

                    <!-- Interactive Tech Stack Calculator -->
                    <div class="my-5">
                        <x-tech-calculator />
                    </div>

                    <!-- Recommended Provider Section -->
                    <div class="my-5">
                        <h3 class="fw-bold text-dark mb-3">Recommended Technology Partner</h3>
                        <p class="text-secondary">
                            For enterprise software projects requiring expertise in modern frameworks, custom APIs, and secure database architecture in Lucknow:
                        </p>

                        <x-recommended-provider-card 
                            category="technology"
                            ctaText="Explore Technology Stack"
                        />
                    </div>

                    <!-- FAQs -->
                    <div class="mt-5">
                        <h3 class="fw-bold text-dark mb-4"><i class="bi bi-question-circle-fill text-primary me-2"></i> Frequently Asked Questions</h3>
                        <x-faq-accordion :faqs="$faqs" />
                    </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-cpu-fill text-primary me-2"></i> Supported Tech</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('technology.show', 'laravel-development') }}" class="badge bg-light text-dark border p-2 text-decoration-none">Laravel</a>
                            <a href="{{ route('technology.show', 'php-development') }}" class="badge bg-light text-dark border p-2 text-decoration-none">PHP 8.2+</a>
                            <a href="{{ route('technology.show', 'flutter-app-development') }}" class="badge bg-light text-dark border p-2 text-decoration-none">Flutter</a>
                            <a href="{{ route('technology.show', 'react-development') }}" class="badge bg-light text-dark border p-2 text-decoration-none">React</a>
                            <a href="{{ route('technology.show', 'nodejs-development') }}" class="badge bg-light text-dark border p-2 text-decoration-none">Node.js</a>
                            <a href="{{ route('technology.show', 'python-development') }}" class="badge bg-light text-dark border p-2 text-decoration-none">Python</a>
                            <a href="{{ route('technology.show', 'api-development') }}" class="badge bg-light text-dark border p-2 text-decoration-none">REST APIs</a>
                        </div>
                    </div>

                    <div class="p-4 rounded-4 bg-dark text-white shadow-sm text-center">
                        <i class="bi bi-chat-left-quote-fill fs-1 text-primary mb-2 d-block"></i>
                        <h5 class="fw-bold text-white mb-2">Need Technical Guidance?</h5>
                        <p class="small text-slate-300 mb-3">Discuss your technical architecture directly with senior software developers.</p>
                        <div class="d-flex flex-column gap-2 mb-2">
                            <a href="tel:919198483820" class="btn btn-primary btn-sm fw-bold w-100 py-2" style="border-radius: 6px;">
                                <i class="bi bi-telephone-fill me-1"></i>9198483820
                            </a>
                          
                            <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20technology%20services" target="_blank" rel="noopener" class="btn text-white btn-sm fw-bold w-100 py-2" style="background-color: #25D366; border-color: #25D366; border-radius: 6px;">
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
