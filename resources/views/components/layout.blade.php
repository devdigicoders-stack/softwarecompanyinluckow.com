@props([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'keywords' => null,
    'ogImage' => null,
    'post' => null,
    'faqs' => null,
    'breadcrumbs' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-seo-head 
        :title="$title" 
        :description="$description" 
        :canonical="$canonical" 
        :keywords="$keywords" 
        :ogImage="$ogImage" 
    />
    <x-schema-org 
        :post="$post" 
        :faqs="$faqs" 
        :breadcrumbs="$breadcrumbs" 
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Publication Custom Design System -->
    <link rel="stylesheet" href="{{ asset('css/publication.css') }}">

    @stack('styles')
</head>
<body>

    <!-- Top Utility Bar (Matching Mockup 100%) -->
    <div class="top-ticker-bar d-none d-md-block py-2">
        <div class="container-fluid px-xl-5 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <span class="d-inline-flex align-items-center gap-1.5 text-slate-300">
                    <i class="bi bi-geo-alt text-primary"></i> Available in Lucknow, Kanpur, Gorakhpur
                </span>
                <a href="tel:919198483820" class="d-inline-flex align-items-center gap-1.5 text-slate-300 text-decoration-none hover-text-white">
                    <i class="bi bi-telephone text-primary"></i> +91 9198483820 / +91 6394296293
                </a>
                <a href="mailto:info@softwarecompanyinlucknow.com" class="d-inline-flex align-items-center gap-1.5 text-slate-300 text-decoration-none hover-text-white">
                    <i class="bi bi-envelope text-primary"></i> info@softwarecompanyinlucknow.com
                </a>
            </div>
            <div class="d-flex align-items-center gap-4">
                <a href="{{ route('about') }}" class="text-slate-300 text-decoration-none hover-text-white">About Us</a>
                <a href="{{ route('contact') }}" class="text-slate-300 text-decoration-none hover-text-white">Contact Us</a>
                <a href="{{ route('blogs.index') }}" class="text-slate-300 text-decoration-none hover-text-white">Write for Us</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header (Matching Mockup 100%) -->
    <header class="pub-header shadow-sm">
        <nav class="navbar navbar-expand-xl navbar-light py-3.5">
            <div class="container-fluid px-xl-5">
                <!-- Previous Header Logo (Commented as requested) -->
                
                <a class="pub-brand" href="{{ route('home') }}">
                    <div class="brand-logo-icon">
                        <i class="bi bi-shield-check fs-5"></i>
                    </div>
                    <div class="brand-text ms-1">
                        <span class="brand-title">Software Company</span>
                        <span class="brand-subtitle text-primary">in <span id="navTypewriterText">Lucknow</span></span>
                    </div>
                </a>
           

                <!-- New Header Logo -->
                <!-- <a class="navbar-brand py-0 me-3" href="{{ route('home') }}">
                    <img src="{{ asset('images/header-logo.png') }}" alt="Softek Technologies - Software Company in Lucknow" style="height: 56px; width: auto; object-fit: contain;">
                </a> -->

                <div class="d-flex align-items-center gap-2 d-xl-none">
                    <a href="{{ route('search') }}" class="btn btn-primary btn-sm px-3"><i class="bi bi-search"></i></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pubNavbar" aria-controls="pubNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="pubNavbar">
                    <ul class="navbar-nav mx-auto mb-2 mb-xl-0 gap-xl-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        
                        <!-- Software Solutions Mega Menu Dropdown -->
                        <li class="nav-item dropdown dropdown-mega position-static">
                            <a class="nav-link dropdown-toggle {{ request()->is('solutions*') || request()->is('*-software-in-lucknow') ? 'active' : '' }}" href="#" id="solutionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Software Solutions
                            </a>
                            <div class="dropdown-menu mega-menu-dropdown border-0 shadow-lg" aria-labelledby="solutionsDropdown">
                                <!-- Mega Menu Header Banner -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3 border-bottom gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge text-white px-3 py-1.5 rounded-pill extra-small fw-bold" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                                            <i class="bi bi-diagram-3-fill me-1"></i> Software Solutions
                                        </span>
                                        <h5 class="fw-bold text-slate-900 mb-0 fs-6 d-none d-md-block">Enterprise & Custom Business Software Suite</h5>
                                    </div>
                                    <a href="tel:916394296293" class="btn btn-outline-success btn-sm fw-bold rounded-pill px-3 mega-btn-explore">
                                        <i class="bi bi-telephone-fill me-1"></i> <span>Consult Software Architect</span>
                                    </a>
                                </div>

                                <!-- 3 Columns Grid -->
                                <div class="row g-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="d-flex flex-column gap-1">
                                            <a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-diagram-3 text-success me-1.5"></i> ERP Software</span>
                                                <span class="mega-desc">Multi-branch inventory, GST billing & HR</span>
                                            </a>
                                            <a href="{{ route('solutions.show', 'crm-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-people text-primary me-1.5"></i> CRM Software</span>
                                                <span class="mega-desc">Sales pipeline & WhatsApp lead automation</span>
                                            </a>
                                            <a href="{{ route('solutions.show', 'hrms-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-person-badge text-info me-1.5"></i> HRMS Software</span>
                                                <span class="mega-desc">Biometric attendance & salary slip PDF</span>
                                            </a>
                                            <a href="{{ route('solutions.show', 'food-delivery-app-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-bag-heart text-danger me-1.5"></i> Food Delivery App</span>
                                                <span class="mega-desc">0% aggregator fee, driver GPS & KOT</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="d-flex flex-column gap-1">
                                            <a href="{{ route('solutions.show', 'billing-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-receipt text-warning me-1.5"></i> Billing & POS Software</span>
                                                <span class="mega-desc">Thermal printing, barcode & UPI QR</span>
                                            </a>
                                            <a href="{{ route('solutions.show', 'inventory-management-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-box-seam text-secondary me-1.5"></i> Inventory Software</span>
                                                <span class="mega-desc">Warehouse stock, batch expiry & POs</span>
                                            </a>
                                            <a href="{{ route('solutions.show', 'mobile-app-development-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-phone-vibrate text-success me-1.5"></i> Mobile App Development</span>
                                                <span class="mega-desc">Flutter iOS & Android apps, Play Store</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="d-flex flex-column gap-1">
                                            <a href="{{ route('solutions.show', 'school-management-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-book text-primary me-1.5"></i> School Management ERP</span>
                                                <span class="mega-desc">Online fee gateway & parent app</span>
                                            </a>
                                            <a href="{{ route('solutions.show', 'hospital-management-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-hospital text-danger me-1.5"></i> Hospital HMS Software</span>
                                                <span class="mega-desc">OPD/IPD billing, pathology & EHR</span>
                                            </a>
                                            <a href="{{ route('solutions.show', 'mlm-software-in-lucknow') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-diagram-2 text-info me-1.5"></i> MLM Network Software</span>
                                                <span class="mega-desc">Binary/Matrix payouts & genealogy</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Technologies Mega Menu Dropdown -->
                        <li class="nav-item dropdown dropdown-mega position-static">
                            <a class="nav-link dropdown-toggle {{ request()->is('technology*') ? 'active' : '' }}" href="#" id="techDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Technologies
                            </a>
                            <div class="dropdown-menu mega-menu-dropdown border-0 shadow-lg" aria-labelledby="techDropdown">
                                <!-- Mega Menu Header Banner -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3 border-bottom gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge text-white px-3 py-1.5 rounded-pill extra-small fw-bold" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                                            <i class="bi bi-cpu-fill me-1"></i> Tech Stacks
                                        </span>
                                        <h5 class="fw-bold text-slate-900 mb-0 fs-6 d-none d-md-block">Modern Frameworks & Backend Infrastructure</h5>
                                    </div>
                                    <a href="{{ route('technology.best-web-tech') }}" class="btn btn-outline-success btn-sm fw-bold rounded-pill px-3 mega-btn-explore">
                                        <span>Compare All Tech Stacks</span> <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>

                                <!-- 2 Columns Grid -->
                                <div class="row g-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="d-flex flex-column gap-1">
                                            <a href="{{ route('technology.show', 'laravel-development') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-layers text-danger me-1.5"></i> Laravel 12 Development</span>
                                                <span class="mega-desc">Full-Stack PHP MVC, Eloquent ORM & REST APIs</span>
                                            </a>
                                            <a href="{{ route('technology.show', 'php-development') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-code-slash text-primary me-1.5"></i> Core PHP Development</span>
                                                <span class="mega-desc">PHP 8.2 OOP engineering & legacy refactoring</span>
                                            </a>
                                            <a href="{{ route('technology.show', 'flutter-app-development') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-phone-vibrate text-info me-1.5"></i> Flutter Mobile Apps</span>
                                                <span class="mega-desc">Single codebase cross-platform iOS & Android</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="d-flex flex-column gap-1">
                                            <a href="{{ route('technology.show', 'react-development') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-lightning text-warning me-1.5"></i> React.js & Next.js</span>
                                                <span class="mega-desc">Interactive UI, Virtual DOM & SSR applications</span>
                                            </a>
                                            <a href="{{ route('technology.show', 'nodejs-development') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-node-plus text-success me-1.5"></i> Node.js Development</span>
                                                <span class="mega-desc">Async V8 event loop microservices & WebSockets</span>
                                            </a>
                                            <a href="{{ route('technology.show', 'python-development') }}" class="mega-link">
                                                <span class="mega-title"><i class="bi bi-terminal text-primary me-1.5"></i> Python & AI Backend</span>
                                                <span class="mega-desc">Django, FastAPI web APIs & Machine Learning</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Cost Guides Dropdown -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('cost-guides*') ? 'active' : '' }}" href="{{ route('cost-guides.index') }}">Cost Guides</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('blogs*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Blogs</a>
                        </li>
                        <!-- Best Web Tech Mega Menu Dropdown -->
                        <li class="nav-item dropdown dropdown-mega position-static">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('technology.best-web-tech') || request()->is('best-technology-for-website-development') ? 'active' : '' }}" 
                               href="{{ route('technology.best-web-tech') }}" id="bestWebTechDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Best Web Tech</span>
                            </a>
                            <div class="dropdown-menu mega-menu-dropdown border-0 shadow-lg" aria-labelledby="bestWebTechDropdown">
                                <!-- Mega Menu Header Banner -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3 border-bottom gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge text-white px-3 py-1.5 rounded-pill extra-small fw-bold" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                                            <i class="bi bi-fire me-1 text-warning"></i> 2026 Technology Decision Matrix
                                        </span>
                                        <h5 class="fw-bold text-slate-900 mb-0 fs-6 d-none d-md-block">Compare All 20 Tech Stacks & Frameworks</h5>
                                    </div>
                                    <a href="{{ route('technology.best-web-tech') }}" class="btn btn-outline-success btn-sm fw-bold rounded-pill px-3 mega-btn-explore">
                                        <span>Explore Full Comparison Guide</span> <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>

                                <!-- 4 Columns Grid -->
                                <div class="row g-3">
                                    <!-- Col 1: Framework Battles -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="mega-menu-col">
                                            <h6 class="fw-extrabold text-uppercase extra-small tracking-wider mb-2 d-flex align-items-center gap-1.5" style="color: #059669;">
                                                <i class="bi bi-layers-fill fs-6" style="color: #059669;"></i> <span>Framework Battles</span>
                                            </h6>
                                            <div class="d-flex flex-column gap-1">
                                                <a href="{{ route('technology.show', 'laravel-vs-wordpress') }}" class="mega-link">
                                                    <span class="mega-title">Laravel vs WordPress</span>
                                                    <span class="mega-desc">Custom MVC vs Plugin CMS</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'procedural-php-vs-laravel') }}" class="mega-link">
                                                    <span class="mega-title">PHP vs Laravel</span>
                                                    <span class="mega-desc">Procedural vs Enterprise MVC</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'nodejs-vs-laravel') }}" class="mega-link">
                                                    <span class="mega-title">Node.js vs Laravel</span>
                                                    <span class="mega-desc">Event Loop vs Full-Stack PHP</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'php-vs-nodejs') }}" class="mega-link">
                                                    <span class="mega-title">PHP vs Node.js</span>
                                                    <span class="mega-desc">Server-side vs V8 Runtime</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'laravel-vs-codeigniter') }}" class="mega-link">
                                                    <span class="mega-title">Laravel vs CodeIgniter</span>
                                                    <span class="mega-desc">Eloquent vs Lightweight MVC</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Col 2: Frontend & Full-Stack -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="mega-menu-col">
                                            <h6 class="fw-extrabold text-uppercase extra-small tracking-wider mb-2 d-flex align-items-center gap-1.5" style="color: #0284c7;">
                                                <i class="bi bi-code-square fs-6" style="color: #0284c7;"></i> <span>Frontend & Full-Stack</span>
                                            </h6>
                                            <div class="d-flex flex-column gap-1">
                                                <a href="{{ route('technology.show', 'react-vs-laravel') }}" class="mega-link">
                                                    <span class="mega-title">React vs Laravel</span>
                                                    <span class="mega-desc">Virtual DOM vs API Engine</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'vuejs-vs-reactjs') }}" class="mega-link">
                                                    <span class="mega-title">Vue.js vs React.js</span>
                                                    <span class="mega-desc">Template Syntax vs JSX</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'nextjs-vs-laravel') }}" class="mega-link">
                                                    <span class="mega-title">Next.js vs Laravel</span>
                                                    <span class="mega-desc">React SSR vs PHP Monolith</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'react-vs-angular') }}" class="mega-link">
                                                    <span class="mega-title">React vs Angular</span>
                                                    <span class="mega-desc">UI Library vs TypeScript FW</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'django-vs-laravel') }}" class="mega-link">
                                                    <span class="mega-title">Django vs Laravel</span>
                                                    <span class="mega-desc">Python vs PHP 8.2 Ecosystem</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Col 3: CMS & E-Commerce -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="mega-menu-col">
                                            <h6 class="fw-extrabold text-uppercase extra-small tracking-wider mb-2 d-flex align-items-center gap-1.5" style="color: #d97706;">
                                                <i class="bi bi-cart-check-fill fs-6" style="color: #d97706;"></i> <span>CMS & E-Commerce</span>
                                            </h6>
                                            <div class="d-flex flex-column gap-1">
                                                <a href="{{ route('technology.show', 'wordpress-vs-custom-website') }}" class="mega-link">
                                                    <span class="mega-title">WordPress vs Custom Site</span>
                                                    <span class="mega-desc">0% Plugin Vulnerabilities</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'shopify-vs-laravel') }}" class="mega-link">
                                                    <span class="mega-title">Shopify vs Laravel</span>
                                                    <span class="mega-desc">SaaS Fees vs 100% IP Code</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'shopify-vs-woocommerce') }}" class="mega-link">
                                                    <span class="mega-title">Shopify vs WooCommerce</span>
                                                    <span class="mega-desc">Hosted vs Open-Source</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'woocommerce-vs-laravel') }}" class="mega-link">
                                                    <span class="mega-title">WooCommerce vs Laravel</span>
                                                    <span class="mega-desc">Plugin Store vs Custom Scale</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'wordpress-vs-wix') }}" class="mega-link">
                                                    <span class="mega-title">WordPress vs Wix</span>
                                                    <span class="mega-desc">Open CMS vs Hosted Builder</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Col 4: Databases, AI & Mobile -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="mega-menu-col">
                                            <h6 class="fw-extrabold text-uppercase extra-small tracking-wider mb-2 d-flex align-items-center gap-1.5" style="color: #8b5cf6;">
                                                <i class="bi bi-cpu-fill fs-6" style="color: #8b5cf6;"></i> <span>Databases & Mobile</span>
                                            </h6>
                                            <div class="d-flex flex-column gap-1">
                                                <a href="{{ route('technology.show', 'nodejs-vs-python') }}" class="mega-link">
                                                    <span class="mega-title">Node.js vs Python</span>
                                                    <span class="mega-desc">Async Concurrency vs AI/ML</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'django-vs-nodejs') }}" class="mega-link">
                                                    <span class="mega-title">Django vs Node.js</span>
                                                    <span class="mega-desc">Python Web vs JS Runtime</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'flutter-vs-react-native') }}" class="mega-link">
                                                    <span class="mega-title">Flutter vs React Native</span>
                                                    <span class="mega-desc">Google Dart vs Meta React</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'mysql-vs-mongodb') }}" class="mega-link">
                                                    <span class="mega-title">MySQL vs MongoDB</span>
                                                    <span class="mega-desc">Relational RDBMS vs NoSQL</span>
                                                </a>
                                                <a href="{{ route('technology.show', 'postgresql-vs-mysql') }}" class="mega-link">
                                                    <span class="mega-title">PostgreSQL vs MySQL</span>
                                                    <span class="mega-desc">Object-Relational vs RDBMS</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                    <div class="d-none d-xl-flex align-items-center gap-2" style="gap: 10px;">
                        <a href="tel:919198483820" class="btn btn-outline-primary rounded-3 px-3 py-1.5 fw-bold text-nowrap" style="font-size: 0.85rem;" title="Call +91 9198483820">
                            <i class="bi bi-telephone-fill me-1"></i> +91 9198483820
                        </a>
                       
                        <a href="https://wa.me/916394296293?text=Hello%20Software Company in Lucknow,%20I%20want%20to%20know%20more%20about%20your%20software%20services" target="_blank" rel="noopener" class="btn btn-success rounded-3 px-3 py-1.5 fw-bold text-nowrap" style="background-color: #25D366; border-color: #25D366; font-size: 0.85rem;" title="WhatsApp Us">
                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="{{ route('search') }}" class="btn btn-primary rounded-3 shadow-sm" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;" title="Search">
                            <i class="bi bi-search fs-6"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Breadcrumbs Component -->
    @if(!empty($breadcrumbs))
        <x-breadcrumbs :items="$breadcrumbs" />
    @endif

    <!-- Main Content Body -->
    <main>
        {{ $slot }}
    </main>

    <!-- Multi-Column Footer Matching Mockup -->
    <footer class="pub-footer">
        <div class="container">
            <!-- Main Footer Links Grid -->
            <div class="row g-4 mb-4">
                <!-- Column 1: Brand & Description (Left Side) -->
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="brand-logo-icon bg-primary text-white">
                            <i class="bi bi-shield-check fs-5"></i>
                        </div>
                        <div>
                            <h5 class="text-white fw-bold mb-0" style="font-size: 1.05rem;">Software Company</h5>
                            <span class="text-primary small fw-bold">in Lucknow</span>
                        </div>
                    </div>
                    <p class="text-slate-400 small pe-lg-2 mb-3" style="line-height: 1.6;">
                        Your trusted source for software solutions, technology guides, cost information and the best software companies in Lucknow.
                    </p>

                    <!-- Direct Contact Details (Left Side Space) -->
                    <div class="mb-3 pt-2">
                        <p class="small text-slate-300 mb-1 d-flex align-items-center gap-2">
                            <i class="bi bi-telephone-fill text-primary"></i> 
                            <a href="tel:919198483820" class="text-slate-300 text-decoration-none hover-text-primary">+91 9198483820</a> / 
                            <a href="tel:916394296293" class="text-slate-300 text-decoration-none hover-text-primary">+91 6394296293</a>
                        </p>
                        <p class="small text-slate-300 mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-envelope-fill text-primary"></i> 
                            <a href="mailto:info@softwarecompanyinlucknow.com" class="text-slate-300 text-decoration-none hover-text-primary">info@softwarecompanyinlucknow.com</a>
                        </p>
                    </div>

                    <div class="d-flex gap-2 mb-3">
                        <a href="https://www.facebook.com/Software Company in LucknowTech/" target="_blank" rel="noopener" class="social-icon-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://x.com/Software Company in LucknowTech" target="_blank" rel="noopener" class="social-icon-btn" title="Twitter/X"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" target="_blank" rel="noopener" class="social-icon-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" target="_blank" rel="noopener" class="social-icon-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" target="_blank" rel="noopener" class="social-icon-btn" title="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>

                    <!-- Service Coverage Under Social Icons -->
                    <div class="pt-2">
                        <p class="small text-slate-300 mb-0 d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt-fill text-primary mt-1"></i> 
                            <span>Available in Lucknow, Kanpur, Gorakhpur</span>
                        </p>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}">Software Solutions</a></li>
                        <li><a href="{{ route('technology.show', 'laravel-development') }}">Technologies</a></li>
                        <li><a href="{{ route('cost-guides.index') }}">Cost Guides</a></li>
                        <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li><a href="{{ route('services.show', 'software-development-companies-in-lucknow') }}">Companies</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Column 3: Top Solutions -->
                <div class="col-lg-2 col-md-6">
                    <h5>Top Solutions</h5>
                    <ul>
                        <li><a href="{{ route('solutions.show', 'erp-software-in-lucknow') }}">ERP Software</a></li>
                        <li><a href="{{ route('solutions.show', 'crm-software-in-lucknow') }}">CRM Software</a></li>
                        <li><a href="{{ route('solutions.show', 'hrms-software-in-lucknow') }}">HRMS Software</a></li>
                        <li><a href="{{ route('solutions.show', 'billing-software-in-lucknow') }}">Billing Software</a></li>
                        <li><a href="{{ route('solutions.show', 'school-management-software-in-lucknow') }}">School Software</a></li>
                        <li><a href="{{ route('solutions.show', 'inventory-management-software-in-lucknow') }}">Inventory Software</a></li>
                        <li><a href="{{ route('solutions.show', 'mlm-software-in-lucknow') }}">MLM Software</a></li>
                    </ul>
                </div>

                <!-- Column 4: Top Technologies -->
                <div class="col-lg-2 col-md-6">
                    <h5>Top Technologies</h5>
                    <ul>
                        <li><a href="{{ route('technology.show', 'laravel-development') }}">Laravel</a></li>
                        <li><a href="{{ route('technology.show', 'php-development') }}">PHP</a></li>
                        <li><a href="{{ route('technology.show', 'flutter-app-development') }}">Flutter</a></li>
                        <li><a href="{{ route('technology.show', 'react-development') }}">React</a></li>
                        <li><a href="{{ route('technology.show', 'nodejs-development') }}">Node.js</a></li>
                <li><a href="{{ route('technology.show', 'python-development') }}">Python</a></li>
                        <li><a href="{{ route('technology.show', 'api-development') }}">MySQL</a></li>
                    </ul>
                </div>

                <!-- Column 5: Subscribe & Contact Helpline (Right Side) -->
                <div class="col-lg-3 col-md-6">
                    <h5>Subscribe to Newsletter</h5>
                    <p class="text-slate-400 small mb-3">Get the latest updates, articles and guides in your inbox.</p>

                    @if(session('newsletter_success'))
                        <div class="alert alert-success py-2 px-3 small rounded-2 border-0 mb-3" style="background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0 !important;">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('newsletter_success') }}
                        </div>
                    @endif

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" id="footerSubscribeForm" class="mb-3">
                        @csrf
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control form-control-sm border-0 py-2.5 px-3 rounded-2 @error('email') is-invalid @enderror" placeholder="Enter your email address" value="{{ old('email') }}" required style="background: rgba(255, 255, 255, 0.95); color: #0f172a;">
                            @error('email')<div class="text-danger small mt-1" style="font-size: 0.78rem;">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" id="footerSubscribeBtn" class="btn btn-primary w-100 fw-bold py-2 rounded-2 shadow-sm d-flex align-items-center justify-content-center gap-1.5">
                            <span>Subscribe</span>
                        </button>
                    </form>

                    <!-- Direct Support Contacts (Right Side Space) -->
                    <div class="p-3 rounded-3" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08);">
                        <h6 class="text-white fw-bold mb-2 small"><i class="bi bi-headset text-primary me-1.5"></i> Direct Phone &amp; Email</h6>
                        <p class="small text-slate-300 mb-1">
                            <i class="bi bi-telephone-fill text-primary me-1"></i> 
                            <a href="tel:919198483820" class="text-slate-300 text-decoration-none hover-text-primary">+91 9198483820</a> / 
                            <a href="tel:916394296293" class="text-slate-300 text-decoration-none hover-text-primary">+91 6394296293</a>
                        </p>
                        <p class="small text-slate-300 mb-0">
                            <i class="bi bi-envelope-fill text-primary me-1"></i> 
                            <a href="mailto:info@softwarecompanyinlucknow.com" class="text-slate-300 text-decoration-none hover-text-primary">info@softwarecompanyinlucknow.com</a>
                        </p>
                    </div>
                </div>
            </div>
                
            <!-- Bottom Copyright & Legal Links Bar -->
            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="mb-2 mb-md-0">
                    &copy; {{ date('Y') }} Software Company in Lucknow. All Rights Reserved.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                    <a href="{{ route('terms') }}">Terms & Conditions</a>
                    <a href="{{ route('sitemap') }}">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp & Phone Call Quick Action CTAs (Left Side) -->
    <div class="position-fixed bottom-0 start-0 p-3 d-flex flex-column gap-2" style="z-index: 1080;">
        <a href="https://wa.me/916394296293?text=Hello%20Software Company in Lucknow,%20I%20want%20to%20know%20more%20about%20your%20software%20services" target="_blank" rel="noopener" class="btn btn-success rounded-circle shadow-lg d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px; background-color: #25D366; border-color: #25D366; font-size: 1.5rem;" title="WhatsApp: +91 6394296293">
            <i class="bi bi-whatsapp"></i>
        </a>
        <a href="tel:919198483820" class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px; font-size: 1.3rem;" title="Call Helpline (+91 9198483820)">
            <i class="bi bi-telephone-fill"></i>
        </a>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Start of Tawk.to Script -->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63bfbed047425128790d02ba/1gmig2oet';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!-- Footer Newsletter Spinner Handler -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const footerForm = document.getElementById('footerSubscribeForm');
            const footerBtn = document.getElementById('footerSubscribeBtn');

            if (footerForm && footerBtn) {
                footerForm.addEventListener('submit', function() {
                    footerBtn.disabled = true;
                    footerBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1.5" role="status" aria-hidden="true"></span> <span>Subscribing...</span>';
                });
            }
        });
    </script>

    <!-- Dynamic Typewriter City Loop Script (Lucknow -> Kanpur -> Gorakhpur) -->
    <style>
        .typewriter-cursor {
            display: inline-block;
            margin-left: 2px;
            font-weight: 300;
            animation: blinkTypewriterCursor 0.75s infinite;
        }
        @keyframes blinkTypewriterCursor {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locations = ['Lucknow', 'Kanpur', 'Gorakhpur'];
            const heroTextElem = document.getElementById('heroTypewriterText');
            const navTextElem = document.getElementById('navTypewriterText');

            if (!heroTextElem && !navTextElem) return;

            let wordIdx = 0;
            let charIdx = locations[0].length;
            let isDeleting = true; // Start by deleting after initial pause

            const typeSpeed = 100;
            const eraseSpeed = 60;
            const holdDelay = 2000;

            function runTypewriter() {
                const currentWord = locations[wordIdx];

                if (isDeleting) {
                    charIdx--;
                } else {
                    charIdx++;
                }

                const text = currentWord.substring(0, charIdx);
                if (heroTextElem) heroTextElem.textContent = text;
                if (navTextElem) navTextElem.textContent = text;

                let delay = isDeleting ? eraseSpeed : typeSpeed;

                if (!isDeleting && charIdx === currentWord.length) {
                    // Full word typed -> Pause, then start erasing
                    delay = holdDelay;
                    isDeleting = true;
                } else if (isDeleting && charIdx === 0) {
                    // Full word erased -> Next city, then start typing
                    isDeleting = false;
                    wordIdx = (wordIdx + 1) % locations.length;
                    delay = 350;
                }

                setTimeout(runTypewriter, delay);
            }

            // Start typewriter deletion loop after initial pause
            setTimeout(runTypewriter, holdDelay);
        });
    </script>

    <!-- Global Enquiry Modal Component -->
    <x-enquiry-modal />

    @stack('scripts')
</body>
</html>
