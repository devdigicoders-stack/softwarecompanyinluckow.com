<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Software Development Company in Lucknow',
                'slug' => 'software-development-company-in-lucknow',
                'h1_title' => 'Software Development Company in Lucknow',
                'tagline' => 'Enterprise Custom Software Engineering & Cloud Application Architecture',
                'excerpt' => 'Premier software development company in Lucknow delivering tailored enterprise applications, SaaS platforms, custom databases, and cloud software engineering for high-growth businesses.',
                'content' => '<h2>Enterprise Software Development Services in Lucknow</h2><p>As a leading software company in Lucknow, we architect robust, scalable, and secure custom software systems tailored precisely to your operational requirements. From business workflow automation to complex enterprise resource databases, our engineers combine deep domain expertise with modern web and mobile tech stacks.</p><p>We build software with clean MVC architecture, RESTful and GraphQL APIs, high-throughput database design, and ISO-compliant security standards. Whether you are a startup building a SaaS product or an enterprise automating complex supply chain workflows in Uttar Pradesh, our Lucknow-based engineering team delivers turn-key software products built for long-term scalability.</p>',
                'icon' => 'bi-cpu-fill',
                'features' => [
                    ['title' => 'Custom Architecture', 'desc' => 'Tailored software architecture designed around your business logic.'],
                    ['title' => 'High Concurrency Databases', 'desc' => 'Optimized MySQL/PostgreSQL databases handling millions of records.'],
                    ['title' => 'API-First Design', 'desc' => 'Seamless REST/GraphQL integration with third-party software.'],
                    ['title' => 'SLA & 24/7 Support', 'desc' => 'Dedicated maintenance and server monitoring agreements.'],
                ],
                'technologies' => ['Laravel 12', 'PHP 8.2+', 'Python', 'Node.js', 'React.js', 'MySQL', 'AWS'],
                'faqs' => [
                    ['question' => 'Why choose a local software development company in Lucknow?', 'answer' => 'Working with a local software company in Lucknow allows for face-to-face discovery workshops, real-time collaboration, local market alignment, and rapid SLA support.'],
                    ['question' => 'What is your software development process?', 'answer' => 'We follow an 4-phase Agile methodology: 1) Requirements Analysis & Specs, 2) UI/UX & Database Prototyping, 3) Iterative Development, and 4) Deployment with continuous SLA maintenance.'],
                ],
                'sort_order' => 1,
            ],
            [
                'title' => 'Web Development Company in Lucknow',
                'slug' => 'web-development-company-in-lucknow',
                'h1_title' => 'Web Development Company in Lucknow',
                'tagline' => 'High-Performance Web Applications & Modern Business Portals',
                'excerpt' => 'Leading web development company in Lucknow crafting responsive, fast, and SEO-first web applications using Laravel, React, Vue, and Bootstrap 5.',
                'content' => '<h2>Custom Web Development Services in Lucknow</h2><p>We build modern web applications that deliver exceptional speed, airtight security, and intuitive user experiences. Our web development team in Lucknow leverages Laravel, PHP, React, and Bootstrap to craft custom web portals, customer dashboards, and high-concurrency web platforms.</p><p>Every web project is built with mobile responsiveness, SEO semantic HTML5, fast PageSpeed rendering, and structured JSON-LD data to help your business achieve organic search visibility and high conversion rates.</p>',
                'icon' => 'bi-globe',
                'features' => [
                    ['title' => 'SEO-First HTML5 Layouts', 'desc' => 'Built with semantic tags and optimal PageSpeed loading speeds.'],
                    ['title' => 'Responsive Bootstrap 5 UI', 'desc' => 'Flawless performance across mobile, tablet, and desktop.'],
                    ['title' => 'Custom Admin Dashboards', 'desc' => 'Intuitive management panels for total content control.'],
                ],
                'technologies' => ['Laravel 12', 'Bootstrap 5', 'Vue.js', 'React.js', 'JavaScript', 'MySQL'],
                'faqs' => [
                    ['question' => 'How much does web development cost in Lucknow?', 'answer' => 'Basic corporate websites start around ₹15,000 to ₹35,000, while complex custom web applications range from ₹50,000 to ₹3,500,000+ depending on features and custom backend logic.'],
                ],
                'sort_order' => 2,
            ],
            [
                'title' => 'Website Development Company in Lucknow',
                'slug' => 'website-development-company-in-lucknow',
                'h1_title' => 'Website Development Company in Lucknow',
                'tagline' => 'Corporate & Publication Website Design with High-Speed Performance',
                'excerpt' => 'Professional website development company in Lucknow delivering fast, responsive, and SEO-optimized business websites for brands across UP.',
                'content' => '<h2>Professional Website Engineering & Design in Lucknow</h2><p>Your website is the primary digital face of your business. We engineer corporate websites, publication portals, and service gateways designed to load in under 2 seconds, communicate your value proposition clearly, and capture high-quality business leads.</p>',
                'icon' => 'bi-window-stack',
                'features' => [
                    ['title' => 'Custom Design Identity', 'desc' => 'Unique UI/UX without generic templates.'],
                    ['title' => 'Lead Generation Forms', 'desc' => 'Integrated CRM and lead tracking capabilities.'],
                ],
                'technologies' => ['HTML5', 'CSS3', 'JavaScript', 'Laravel Blade', 'Bootstrap 5'],
                'sort_order' => 3,
            ],
            [
                'title' => 'Mobile App Development Company in Lucknow',
                'slug' => 'mobile-app-development-company-in-lucknow',
                'h1_title' => 'Mobile App Development Company in Lucknow',
                'tagline' => 'Native & Cross-Platform iOS and Android App Engineering',
                'excerpt' => 'Top mobile app development company in Lucknow specializing in Flutter, React Native, iOS, and Android mobile applications.',
                'content' => '<h2>Cross-Platform & Native Mobile App Development</h2><p>We design and develop high-performance mobile applications for Android and iOS using Flutter and React Native. From e-commerce mobile apps to enterprise field agent tracking applications, our mobile solutions deliver smooth 60fps performance and offline synchronization.</p>',
                'icon' => 'bi-phone-fill',
                'features' => [
                    ['title' => 'Single Codebase Flutter', 'desc' => 'Cost-effective deployment to iOS App Store & Google Play.'],
                    ['title' => 'Offline Storage Sync', 'desc' => 'Local SQLite data sync for seamless offline app usage.'],
                ],
                'technologies' => ['Flutter', 'React Native', 'Firebase', 'REST APIs', 'SQLite'],
                'sort_order' => 4,
            ],
            [
                'title' => 'Custom Software Development Lucknow',
                'slug' => 'custom-software-development-lucknow',
                'h1_title' => 'Custom Software Development in Lucknow',
                'tagline' => 'Bespoke Software Engineering Built to Your Exact Business Workflows',
                'excerpt' => 'Bespoke software development services in Lucknow tailored for enterprises, medical centers, schools, and manufacturing units seeking 100% custom workflow automation.',
                'content' => '<h2>100% Custom Software Solutions for Growing Businesses</h2><p>Off-the-shelf software often forces your company to compromise your unique operations. Our custom software development in Lucknow ensures your application mirrors your business processes perfectly—eliminating operational bottlenecks and reducing manual data entry error by up to 90%.</p>',
                'icon' => 'bi-code-square',
                'sort_order' => 5,
            ],
            [
                'title' => 'ERP Software Company in Lucknow',
                'slug' => 'erp-software-company-in-lucknow',
                'h1_title' => 'ERP Software Development Company in Lucknow',
                'tagline' => 'Integrated Enterprise Resource Planning Systems',
                'excerpt' => 'Custom ERP software development company in Lucknow delivering modular systems for inventory, accounting, HR, supply chain, and manufacturing.',
                'content' => '<h2>Custom Enterprise Resource Planning (ERP) Systems</h2><p>Unify your entire company operations with a centralized custom ERP system. We build modular ERP software that integrates inventory tracking, purchase orders, GST invoicing, HR payroll, and real-time financial reporting under a single secure dashboard.</p>',
                'icon' => 'bi-diagram-3-fill',
                'sort_order' => 6,
            ],
            [
                'title' => 'CRM Software Company in Lucknow',
                'slug' => 'crm-software-company-in-lucknow',
                'h1_title' => 'CRM Software Company in Lucknow',
                'tagline' => 'Customer Relationship & Sales Lead Automation Software',
                'excerpt' => 'Custom CRM software company in Lucknow empowering sales teams with lead tracking, deal pipelines, WhatsApp automation, and performance analytics.',
                'content' => '<h2>Automate Your Sales Pipeline with Custom CRM Software</h2><p>Accelerate revenue conversion with a custom CRM engineered for your sales force. Track leads from capture to deal closure, automate follow-up reminders, generate instant WhatsApp quotes, and monitor sales agent productivity with real-time reporting dashboards.</p>',
                'icon' => 'bi-people-fill',
                'sort_order' => 7,
            ],
            [
                'title' => 'E-Commerce Development Company in Lucknow',
                'slug' => 'ecommerce-development-company-in-lucknow',
                'h1_title' => 'E-Commerce Development Company in Lucknow',
                'tagline' => 'High-Conversion Online Stores & Multi-Vendor Marketplaces',
                'excerpt' => 'Custom e-commerce website and mobile app development in Lucknow with integrated payment gateways, logistics APIs, and inventory automation.',
                'content' => '<h2>Scalable E-Commerce Platforms & Online Marketplaces</h2><p>Launch high-converting online stores engineered for maximum transaction speed. We build custom e-commerce web applications and mobile apps integrated with Razorpay, Cashfree, Shiprocket, and automated GST billing.</p>',
                'icon' => 'bi-cart-check-fill',
                'sort_order' => 8,
            ],
            [
                'title' => 'Laravel Development Company in Lucknow',
                'slug' => 'laravel-development-company-in-lucknow',
                'h1_title' => 'Laravel Development Company in Lucknow',
                'tagline' => 'Enterprise PHP & Laravel 12 Web Application Engineering',
                'excerpt' => 'Expert Laravel development company in Lucknow delivering scalable web applications, API services, and microservices using PHP 8.2+ and Laravel 12.',
                'content' => '<h2>Enterprise Laravel Framework Development Services</h2><p>Laravel is the world\'s most popular PHP framework for enterprise web engineering. Our certified Laravel developers in Lucknow specialize in clean architecture, Eloquent ORM optimization, queue workers, Redis caching, and robust API endpoints.</p>',
                'icon' => 'bi-filetype-php',
                'sort_order' => 9,
            ],
            [
                'title' => 'PHP Development Company in Lucknow',
                'slug' => 'php-development-company-in-lucknow',
                'h1_title' => 'PHP Development Company in Lucknow',
                'tagline' => 'High-Performance Modern PHP Web Applications & API Architecture',
                'excerpt' => 'Custom PHP development services in Lucknow for enterprise web portals, SaaS platforms, and backend web APIs using modern PHP 8.2+ standards.',
                'content' => '<h2>Modern PHP 8.2+ Engineering Solutions</h2><p>Modern PHP powered by PHP 8.2+ offers unmatched performance, strict typing, and instant response times. We build secure PHP web applications with high concurrency throughput and database optimizations.</p>',
                'icon' => 'bi-code-slash',
                'sort_order' => 10,
            ],
            [
                'title' => 'Flutter App Development Company in Lucknow',
                'slug' => 'flutter-app-development-company-in-lucknow',
                'h1_title' => 'Flutter App Development Company in Lucknow',
                'tagline' => 'Cross-Platform Android & iOS Apps with Native Performance',
                'excerpt' => 'Flutter mobile app development company in Lucknow crafting beautiful, high-speed apps for Android, iOS, and web from a single codebase.',
                'content' => '<h2>Cross-Platform Flutter Mobile Engineering</h2><p>Build native-quality mobile apps at half the cost and development time using Google\'s Flutter framework. Our mobile app developers in Lucknow design pixel-perfect interfaces with smooth animations and fast API integration.</p>',
                'icon' => 'bi-layers-fill',
                'sort_order' => 11,
            ],
            [
                'title' => 'React Development Company in Lucknow',
                'slug' => 'react-development-company-in-lucknow',
                'h1_title' => 'React Development Company in Lucknow',
                'tagline' => 'Interactive Single-Page Applications (SPA) & Dynamic Web UIs',
                'excerpt' => 'React.js web development company in Lucknow building fast, interactive dashboards and single-page web applications.',
                'content' => '<h2>Dynamic Frontend Engineering with React.js</h2><p>Create engaging, lightning-fast user interfaces with React.js. We specialize in building complex admin portals, SaaS dashboards, and real-time data interfaces with state management.</p>',
                'icon' => 'bi-filetype-jsx',
                'sort_order' => 12,
            ],
            [
                'title' => 'Node.js Development Company in Lucknow',
                'slug' => 'nodejs-development-company-in-lucknow',
                'h1_title' => 'Node.js Development Company in Lucknow',
                'tagline' => 'Real-Time Backend Services & Microservices Architecture',
                'excerpt' => 'Node.js development company in Lucknow delivering high-concurrency event-driven APIs, WebSocket services, and microservices.',
                'content' => '<h2>High-Throughput Node.js Microservices</h2><p>For applications requiring real-time updates, chat engines, or high-throughput API endpoints, our Node.js engineering team in Lucknow delivers scalable non-blocking event-driven architectures.</p>',
                'icon' => 'bi-filetype-js',
                'sort_order' => 13,
            ],
            [
                'title' => 'Python Development Company in Lucknow',
                'slug' => 'python-development-company-in-lucknow',
                'h1_title' => 'Python Development Company in Lucknow',
                'tagline' => 'AI, Data Analytics, Django & Fast-API Web Backends',
                'excerpt' => 'Python software development company in Lucknow specializing in AI model integrations, Django web applications, data analytics, and automation scripts.',
                'content' => '<h2>Python Engineering & Artificial Intelligence</h2><p>Leverage the power of Python for automated data analytics, machine learning model integrations, Django enterprise web portals, and high-performance FastAPI microservices.</p>',
                'icon' => 'bi-filetype-py',
                'sort_order' => 14,
            ],
            [
                'title' => 'API Development Company in Lucknow',
                'slug' => 'api-development-company-in-lucknow',
                'h1_title' => 'API Development Company in Lucknow',
                'tagline' => 'Secure RESTful & GraphQL Microservices Architecture',
                'excerpt' => 'Custom API development and third-party integration company in Lucknow for payment gateways, SMS/WhatsApp services, ERPs, and cloud apps.',
                'content' => '<h2>Secure RESTful & GraphQL API Integration Services</h2><p>Connect your business software with ecosystem tools via robust API engineering. We design secure API endpoints protected by JWT/OAuth authentication, rate limiting, and comprehensive OpenAPI documentation.</p>',
                'icon' => 'bi-shield-lock-fill',
                'sort_order' => 15,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }
    }
}
