<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        // Fallback default rich content mapping for unique search intent pages
        $serviceData = $this->getSearchIntentData($slug, $service);

        $allServices = Service::where('is_active', true)->take(6)->get();

        $relatedPosts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Services & Guides', 'url' => route('home')],
            ['name' => $serviceData['title'], 'url' => ''],
        ];

        return view('services.show', array_merge($serviceData, compact('allServices', 'relatedPosts', 'breadcrumbs')));
    }

    private function getSearchIntentData(string $slug, ?Service $service): array
    {
        if ($service) {
            return [
                'title' => $service->meta_title ?? $service->title,
                'h1' => $service->h1_title ?? $service->title,
                'meta_description' => $service->meta_description ?? $service->excerpt,
                'keywords' => $service->keywords ?? ($service->title.', software company in lucknow, best software company in lucknow, web development company in lucknow, IT company lucknow'),
                'excerpt' => $service->excerpt,
                'content' => $service->content,
                'icon' => $service->icon ?? 'bi-code-slash',
                'features' => $service->features ?? [],
                'benefits' => $service->benefits ?? [],
                'process' => $service->process ?? [],
                'faqs' => $this->ensureTenFaqs($service->faqs ?? [], $service->title, $slug),
                'slug' => $service->slug,
            ];
        }

        $data = $this->getIntentMapBySlug($slug);
        $data['slug'] = $slug;
        $data['keywords'] = $data['keywords'] ?? ($data['h1'].', software company in lucknow, best software company in lucknow, web development company in lucknow, top IT companies lucknow');
        $data['faqs'] = $this->ensureTenFaqs($data['faqs'] ?? [], $data['h1'] ?? $slug, $slug);

        return $data;
    }

    private function getIntentMapBySlug(string $slug): array
    {
        $intentMap = [
            'software-company-in-lucknow' => [
                'title' => 'Software Company in Lucknow: Complete Guide & Information Portal',
                'h1' => 'Software Company in Lucknow — Selection & IT Information Guide',
                'meta_description' => 'Looking for a software company in Lucknow? Learn what software development companies do, key selection criteria, business software solutions, and provider recommendations.',
                'excerpt' => 'An educational guide answering what to check when searching for a software company in Lucknow, cost factors, tech stack standards, and provider selection tips.',
                'icon' => 'bi-building-gear',
                'features' => [
                    'Custom Enterprise Software Architecture',
                    'Mobile & Web Application Engineering',
                    'ERP, CRM, and HRMS Business Systems',
                    'API Integration & Cloud Deployment',
                ],
                'benefits' => [
                    'Clear framework for evaluating local software development providers.',
                    'Understanding of key cost drivers and project scoping.',
                    'Objective criteria for technical stack verification.',
                ],
                'faqs' => [
                    ['question' => 'What services does a software company in Lucknow provide?', 'answer' => 'A top software company in Lucknow provides custom software development, enterprise ERP/CRM systems, web application engineering, cross-platform mobile apps (Flutter/React Native), API development, cloud deployment, and post-launch SLA maintenance.'],
                    ['question' => 'How do I choose the right software company in Lucknow for my business?', 'answer' => 'Evaluate providers based on objective criteria: verified technology stack expertise (Laravel, PHP 8.2+, Flutter, React), 100% source code IP ownership policies, transparent milestone scope documentation, and SLA support commitments.'],
                    ['question' => 'Why is Software Company in Lucknow recommended as a software provider in Lucknow?', 'answer' => 'Software Company in Lucknow (incorporated in 2019, CIN: U72900UP2019PTC113696) is an established software engineering company in Aliganj, Lucknow, with 6+ years of domain experience and 1000+ completed software projects.'],
                    ['question' => 'What is the average cost of software development in Lucknow?', 'answer' => 'Software costs depend on scope complexity: basic custom websites start from ₹15,000 to ₹35,000, specialized web applications range from ₹50,000 to ₹1,50,000, and full-scale enterprise ERP or multi-platform mobile apps range from ₹1,50,000 to ₹5,000,000+.'],
                    ['question' => 'Do software development companies in Lucknow sign NDAs?', 'answer' => 'Yes. Reputable software development firms execute bilateral Non-Disclosure Agreements (NDAs) prior to project discovery to protect client intellectual property and data confidentiality.'],
                    ['question' => 'What tech stacks are most popular for software development in Lucknow?', 'answer' => 'Popular high-performance tech stacks include Laravel 12 (PHP 8.2+), React, Vue.js, Flutter for native iOS & Android mobile apps, Node.js backends, Python for data AI, and MySQL/PostgreSQL databases.'],
                    ['question' => 'Do clients retain 100% full source code ownership?', 'answer' => 'Yes. Upon project sign-off and final payment, Software Company in Lucknow transfers 100% full IP rights, database schemas, and clean uncompiled source code directly to the client.'],
                    ['question' => 'How long does custom software engineering take?', 'answer' => 'Typical timelines: standard business websites require 1-2 weeks, custom web portals take 4-8 weeks, and complex multi-module enterprise ERP systems take 8-16 weeks.'],
                    ['question' => 'Can local Lucknow software companies build cloud SaaS products?', 'answer' => 'Yes. Engineering teams build scalable multi-tenant SaaS platforms with automated billing, role permissions, RESTful APIs, and AWS/DigitalOcean cloud infrastructure.'],
                    ['question' => 'What kind of post-launch technical support is provided?', 'answer' => 'Software companies provide Service Level Agreements (SLAs) offering 24/7 server health monitoring, security patches, performance tuning, bug fixes, and feature upgrades.'],
                ],
            ],
            'best-software-company-in-lucknow' => [
                'title' => 'How to Find the Best Software Company in Lucknow: Objective Criteria',
                'h1' => 'Evaluating Software Development Companies in Lucknow',
                'meta_description' => 'Objective guide to evaluating software companies in Lucknow. Compare providers based on code architecture, customization capabilities, security standards, and support SLAs.',
                'excerpt' => 'Learn how businesses can objectively evaluate software development partners in Lucknow without relying on sponsored lists or unverified ratings.',
                'icon' => 'bi-sliders',
                'features' => [
                    'Code Quality & Architectural Security Standards',
                    'Full Source Code & IP Ownership Policies',
                    'Dedicated SLA Support & Bug-Fix Commitments',
                    'Milestone-Based Transparent Pricing',
                ],
                'benefits' => [
                    'Avoid project delays and hidden cost surprises.',
                    'Ensure software scalability for future business expansion.',
                    'Protect core business data with strict security protocols.',
                ],
                'faqs' => [
                    ['question' => 'What makes a software development company reliable in Lucknow?', 'answer' => 'Reliability comes from structured software engineering practices, transparent milestone contracts, verified client case studies, code security standards, and formal post-deployment SLAs.'],
                    ['question' => 'How can I verify a software company\'s technical credentials?', 'answer' => 'Request a live demo of past enterprise projects, ask for code architecture documentation, verify incorporation status (MCA/GSTIN), and meet the technical lead developers in person.'],
                    ['question' => 'Is custom software better than ready-made template software?', 'answer' => 'Yes. Custom software is built specifically for your business processes, eliminating recurring per-user monthly subscription fees and allowing unlimited scalability.'],
                    ['question' => 'How do software companies protect client data during development?', 'answer' => 'Leading companies enforce SSL encryption, database role access control, Git code repository access limits, and sign formal NDAs with clients and developers.'],
                    ['question' => 'What is the role of a Service Level Agreement (SLA) in software projects?', 'answer' => 'An SLA guarantees response times for bug fixes, server uptime monitoring, routine security patches, and ongoing maintenance after the software is deployed.'],
                    ['question' => 'Can custom software integrate with existing payment gateways and accounting tools?', 'answer' => 'Yes. Developers integrate RESTful APIs for Razorpay, Paytm, PhonePe, Tally, ZKTEco biometric devices, and WhatsApp gateways.'],
                    ['question' => 'Why should I choose a Lucknow-based software company over offshore agencies?', 'answer' => 'Choosing a local Lucknow provider enables in-person discovery meetings, local time zone alignment, rapid communication, and cost efficiency.'],
                    ['question' => 'What deliverables should I expect upon software project completion?', 'answer' => 'Deliverables include full compiled & source code repositories, database SQL schemas, user admin documentation, API documentation, and server deployment credentials.'],
                    ['question' => 'How are software maintenance costs structured after launch?', 'answer' => 'Maintenance is typically offered as an annual SLA contract (10-20% of project cost) or hourly maintenance packages covering server updates and enhancements.'],
                    ['question' => 'How does milestone-based software pricing protect the client?', 'answer' => 'Milestone pricing splits payments across project phases (e.g. Design, Beta Build, Final Deployment), ensuring you pay only after reviewing each deliverable.'],
                ],
            ],
            'software-development-companies-in-lucknow' => [
                'title' => 'Software Development Companies in Lucknow: IT Ecosystem Overview',
                'h1' => 'Software Development Companies & IT Directory in Lucknow',
                'meta_description' => 'Explore the growing ecosystem of software development companies in Lucknow. Discover local IT hubs in Gomti Nagar, Vibhuti Khand, and Hazratganj.',
                'excerpt' => 'Lucknow is rapidly becoming a major IT destination in North India. Learn about the software development ecosystem, talent pool, and key technological trends.',
                'icon' => 'bi-diagram-3',
                'features' => [
                    'Gomti Nagar IT Park & Tech Hubs',
                    'High Availability of Skilled Software Engineers',
                    'Cost-Effective Enterprise Software Development',
                    'Modern Stack Implementations (Laravel, Flutter, React)',
                ],
                'benefits' => [
                    'Understand Lucknow\'s regional IT landscape.',
                    'Compare software capabilities across local technology zones.',
                ],
                'faqs' => [
                    ['question' => 'Why are businesses choosing Lucknow for software development?', 'answer' => 'Lucknow offers high-caliber engineering talent, state-of-the-art IT infrastructure in Gomti Nagar and Aliganj, and 40% lower development costs compared to tier-1 metros.'],
                    ['question' => 'Where are the primary IT tech hubs located in Lucknow?', 'answer' => 'Key IT clusters include Gomti Nagar & Vibhuti Khand Cyber Heights, Aliganj IT corridor, Hazratganj commercial hub, and Indira Nagar.'],
                    ['question' => 'What technologies do software companies in Lucknow specialize in?', 'answer' => 'Local software engineering teams specialize in Laravel (PHP), Flutter mobile app development, React, Vue.js, Node.js, Python, and cloud database architecture.'],
                    ['question' => 'Can Lucknow software companies handle enterprise-grade projects?', 'answer' => 'Yes. Top companies like Software Company in Lucknow architect multi-branch ERP systems, hospital management software, school portals, and high-concurrency SaaS apps.'],
                    ['question' => 'How do software pricing rates in Lucknow compare to NCR or Bengaluru?', 'answer' => 'Lucknow offers 30-50% lower developer billing rates for equivalent senior engineer talent due to lower operational costs, providing high ROI for startups and enterprises.'],
                    ['question' => 'Do software development companies in Lucknow offer mobile app engineering?', 'answer' => 'Yes. Companies build cross-platform mobile apps using Flutter and React Native for Android & iOS, complete with offline storage and push notifications.'],
                    ['question' => 'What processes do software development companies use for project management?', 'answer' => 'Most firms follow Agile/Scrum methodologies with weekly sprint demos, Jira/Trello task tracking, Git version control, and staging preview links.'],
                    ['question' => 'Are software development companies in Lucknow GST registered?', 'answer' => 'Yes. Established companies operate as registered Private Limited or LLP entities with GST compliance, issuing legal tax invoices and input tax credits.'],
                    ['question' => 'Can I get a custom ERP or CRM built by a Lucknow software company?', 'answer' => 'Yes. Companies engineer tailored ERP and CRM systems matching your exact inventory, HR payroll, and sales workflows without monthly license fees.'],
                    ['question' => 'How can I schedule a discovery meeting with a Lucknow software team?', 'answer' => 'You can request a consultation through company contact portals, schedule a call with a solution architect, or visit their office in Aliganj or Gomti Nagar.'],
                ],
            ],
            'web-development-company-in-lucknow' => [
                'title' => 'Web Development Company in Lucknow: Web App & Portal Guide',
                'h1' => 'Web Development Services & Architecture in Lucknow',
                'meta_description' => 'Guide to web development services in Lucknow. Understand custom web portals, SaaS application architecture, backend APIs, and responsive design.',
                'excerpt' => 'Comprehensive information guide on custom web application development, administrative backends, RESTful APIs, and cloud-hosted web portals in Lucknow.',
                'icon' => 'bi-globe',
                'features' => [
                    'Custom Web Application Development (PHP 8.2+, Laravel)',
                    'RESTful API Backend Integration',
                    'Responsive UI/UX Front-End Design',
                    'Cloud Server & Database Optimization',
                ],
                'benefits' => [
                    'Fast page load times and mobile-first responsiveness.',
                    'Scalable database structure for high user traffic.',
                ],
                'faqs' => [
                    ['question' => 'What is the difference between a static website and a custom web application?', 'answer' => 'A static website displays informational content, whereas a custom web application includes dynamic database interactions, user logins, role access, billing gateways, and workflow automation.'],
                    ['question' => 'Which web development framework is best for custom business portals?', 'answer' => 'Laravel (PHP 8.2+) is widely considered the best framework for web applications due to its built-in security, high-performance ORM, rapid development tools, and scalable architecture.'],
                    ['question' => 'How much does custom web development cost in Lucknow?', 'answer' => 'Basic corporate websites range from ₹15,000 to ₹35,000, while feature-rich custom web applications and SaaS portals range from ₹45,000 to ₹3,00,000+ depending on backend logic.'],
                    ['question' => 'Are web applications optimized for mobile devices and search engines?', 'answer' => 'Yes. Web applications are engineered using responsive Bootstrap/Tailwind layouts, semantic HTML5, fast PageSpeed rendering, and structured JSON-LD schema markup for SEO.'],
                    ['question' => 'Can web applications integrate with external databases and third-party APIs?', 'answer' => 'Yes. Web applications seamlessly connect with RESTful/GraphQL APIs, payment gateways (Razorpay/Paytm), SMS/WhatsApp APIs, and external ERP or CRM systems.'],
                    ['question' => 'How long does it take to develop a custom web application in Lucknow?', 'answer' => 'Standard web development timelines range from 2 weeks for business websites to 4-8 weeks for complex custom web portals and administrative dashboards.'],
                    ['question' => 'Do I get full administrative control over website content?', 'answer' => 'Yes. Custom web applications include intuitive admin panels that allow your staff to manage content, view user leads, generate reports, and update settings easily.'],
                    ['question' => 'What web hosting servers are recommended for web applications?', 'answer' => 'We recommend secure cloud VPS hosting platforms like AWS, DigitalOcean, or Linode running Nginx/Apache with SSL encryption and automated database backups.'],
                    ['question' => 'How is data security managed in custom web development?', 'answer' => 'Security features include CSRF protection, SQL injection prevention, password hashing (Bcrypt/Argon2), role-based permission access control (RBAC), and HTTPS encryption.'],
                    ['question' => 'Do web development companies in Lucknow provide post-launch maintenance?', 'answer' => 'Yes. Web development contracts include post-launch support agreements covering server upgrades, security patches, bug fixes, and feature updates.'],
                ],
            ],
            'mobile-app-development-company-in-lucknow' => [
                'title' => 'Mobile App Development Company in Lucknow: Android & iOS Guide',
                'h1' => 'Mobile App Development Services & Architecture in Lucknow',
                'meta_description' => 'Guide to mobile app development in Lucknow. Learn about native Android/iOS development, Flutter cross-platform apps, API backends, and Play Store publishing.',
                'excerpt' => 'Discover how modern mobile applications are built in Lucknow using Flutter and native frameworks, including push notifications, geolocation, and secure API backends.',
                'icon' => 'bi-phone',
                'features' => [
                    'Cross-Platform Flutter Development',
                    'Native Android & iOS Application Engineering',
                    'Secure REST API Backend Integration',
                    'App Store & Google Play Store Publishing',
                ],
                'benefits' => [
                    'Single codebase cross-platform apps reducing development costs.',
                    'Native performance with smooth UI graphics.',
                ],
                'faqs' => [
                    ['question' => 'Why is Flutter recommended for mobile app development in Lucknow?', 'answer' => 'Flutter enables developers to write a single codebase that compiles natively for both Android and iOS, reducing mobile app development costs by up to 40% while maintaining 60fps performance.'],
                    ['question' => 'How long does mobile app development take in Lucknow?', 'answer' => 'Standard mobile application projects take between 4 to 12 weeks depending on feature scope, UI design requirements, and backend API complexity.'],
                    ['question' => 'How much does mobile app development cost in Lucknow?', 'answer' => 'Basic mobile app projects start around ₹35,000 to ₹75,000, while complex cross-platform apps with custom backends range from ₹80,000 to ₹4,00,000+.'],
                    ['question' => 'Does the mobile app development company handle Google Play and Apple App Store publishing?', 'answer' => 'Yes. Reputable mobile app developers assist with developer account setup, app store submission, privacy policy guidelines, and app approval workflows.'],
                    ['question' => 'Can mobile apps work offline without an active internet connection?', 'answer' => 'Yes. Apps can be built with local SQLite/Hive offline storage that syncs automatically with central servers whenever an internet connection is re-established.'],
                    ['question' => 'What native device features can be integrated into mobile apps?', 'answer' => 'Mobile apps can integrate GPS live tracking, camera barcode scanners, biometric fingerprint/FaceID auth, push notifications, Bluetooth, and payment SDKs.'],
                    ['question' => 'Who owns the mobile app source code and developer accounts?', 'answer' => 'Clients retain 100% full intellectual property (IP) rights, source code files, and control over published app store accounts.'],
                    ['question' => 'How are backend APIs developed for mobile apps?', 'answer' => 'Backend APIs are typically built using secure Laravel (PHP) or Node.js RESTful endpoints that communicate via JSON payloads with token authentication (JWT/Sanctum).'],
                    ['question' => 'How are app updates managed after publishing on stores?', 'answer' => 'Over-the-air updates or new store version releases are uploaded to Play Store and App Store as part of ongoing maintenance support.'],
                    ['question' => 'What is the process for getting a mobile app quote in Lucknow?', 'answer' => 'Share your app concept wireframes or feature list with a solution architect to receive a detailed breakdown of UI design, backend development, and app store deployment.'],
                ],
            ],
            'custom-software-development-lucknow' => [
                'title' => 'Custom Software Development Lucknow: Tailored Business Solutions',
                'h1' => 'Custom Software Engineering Guide in Lucknow',
                'meta_description' => 'Learn about custom software development in Lucknow. Discover why tailored business software outperforms generic subscription software.',
                'excerpt' => 'Custom software is designed around your unique business processes, eliminating recurring subscription fees and providing total control over features and data.',
                'icon' => 'bi-cpu',
                'features' => [
                    '100% Tailored Business Logic & Workflows',
                    'Zero Monthly Per-User Licensing Fees',
                    'Full Intellectual Property & Source Code Ownership',
                    'Custom Admin Dashboards & Reporting',
                ],
                'benefits' => [
                    'Build software that adapts to your business, not vice versa.',
                    'Scale seamlessly without user-count cost penalties.',
                ],
                'faqs' => [
                    ['question' => 'Who owns the source code in a custom software project?', 'answer' => 'In a custom software project with Software Company in Lucknow, your business owns 100% full intellectual property and complete source code rights upon project sign-off.'],
                    ['question' => 'Why choose custom software engineering over off-the-shelf software?', 'answer' => 'Custom software fits your exact business workflows without compromise, eliminates perpetual monthly per-user fees, and allows unlimited customization as your company grows.'],
                    ['question' => 'What is the custom software development process in Lucknow?', 'answer' => 'We follow a 4-phase Agile methodology: 1) Requirements Analysis & SRS, 2) UI/UX & Database Architecture, 3) Iterative Development & QA Testing, and 4) Deployment & Maintenance.'],
                    ['question' => 'How much does custom software development cost in Lucknow?', 'answer' => 'Custom software pricing depends on scope complexity, module count, and API integrations. Projects typically range from ₹40,000 for simple business systems to ₹3,50,000+ for enterprise platforms.'],
                    ['question' => 'Can custom software be upgraded in the future as business needs expand?', 'answer' => 'Yes. Custom software is architected using modular MVC frameworks (like Laravel), making it straightforward to add new modules, user roles, or integrations at any time.'],
                    ['question' => 'How does custom software eliminate recurring subscription costs?', 'answer' => 'Off-the-shelf SaaS charges per-user monthly fees that increase as your team grows. Custom software is a one-time capital investment where you own the platform completely.'],
                    ['question' => 'Can custom software integrate with existing hardware like printers and scanners?', 'answer' => 'Yes. Custom software integrates directly with thermal receipt printers, barcode scanners, ZKTEco biometric machines, and IoT sensors.'],
                    ['question' => 'How is data backup and security handled in custom software?', 'answer' => 'Custom software includes automated daily database backups, SSL encryption, database sanitization, and role-based access restrictions.'],
                    ['question' => 'Do software companies in Lucknow provide user training for staff?', 'answer' => 'Yes. Full project delivery includes comprehensive staff user training sessions, video walkthroughs, and user manual documentation.'],
                    ['question' => 'How do I start a custom software project in Lucknow?', 'answer' => 'Schedule a discovery session with a software consultant to review your manual spreadsheet workflows, define functional specifications, and receive a milestone proposal.'],
                ],
            ],
        ];

        $data = $intentMap[$slug] ?? [
            'title' => ucwords(str_replace('-', ' ', $slug)).' Guide',
            'h1' => ucwords(str_replace('-', ' ', $slug)),
            'meta_description' => 'Information guide on '.str_replace('-', ' ', $slug).' in Lucknow.',
            'excerpt' => 'Detailed guide breaking down software development standards, technology stack considerations, and provider evaluation tips in Lucknow.',
            'icon' => 'bi-code-slash',
            'features' => [
                'Custom Software Engineering & Architecture',
                'Web & Mobile App Solutions',
                'Enterprise Database Management',
                'Dedicated Post-Launch Support',
            ],
            'benefits' => [
                'High performance code execution.',
                'Scalable infrastructure and security.',
            ],
            'faqs' => [
                ['question' => 'What should I look for when selecting a software developer in Lucknow?', 'answer' => 'Evaluate past portfolio work, code security standards, technology stack expertise, source code IP transfer policies, and client support agreements.'],
                ['question' => 'How do software development companies structure project pricing?', 'answer' => 'Pricing is structured based on milestone deliverables (e.g. Design, Backend Development, Testing, Deployment) to ensure client review before payments.'],
                ['question' => 'What technical documentation is provided with custom software?', 'answer' => 'Deliverables include Database ERD diagrams, API documentation, Admin User Manuals, and Server Deployment Guides.'],
                ['question' => 'Can software built by a local company scale to thousands of users?', 'answer' => 'Yes. Using clean MVC frameworks like Laravel, Redis caching, and AWS cloud auto-scaling, software can easily support millions of daily transactions.'],
                ['question' => 'Do software companies sign Non-Disclosure Agreements (NDAs)?', 'answer' => 'Yes. NDA contracts are standard practice to safeguard business workflows and confidential data.'],
                ['question' => 'What is the role of quality assurance (QA) testing in software projects?', 'answer' => 'QA testing identifies bugs, security vulnerabilities, cross-browser compatibility issues, and load bottlenecks before live deployment.'],
                ['question' => 'Can web applications be converted into mobile apps later?', 'answer' => 'Yes. By exposing RESTful API endpoints from the web backend, developers can build Flutter mobile apps that connect seamlessly to the existing database.'],
                ['question' => 'What cloud servers are best for hosting business software?', 'answer' => 'AWS EC2, DigitalOcean Droplets, and Linode VPS provide reliable performance, high uptime, and automated backup options.'],
                ['question' => 'How are software bugs handled after project launch?', 'answer' => 'Post-launch SLA agreements include dedicated bug-fix support with guaranteed response times based on issue severity.'],
                ['question' => 'How can I get an accurate cost quote for my software requirements?', 'answer' => 'List your core business modules, target user roles, and integrations, then schedule a discovery call with a lead software architect.'],
            ],
        ];

        $data['slug'] = $slug;
        $data['faqs'] = $this->ensureTenFaqs($data['faqs'] ?? [], $data['h1'] ?? $slug);

        return $data;
    }

    private function ensureTenFaqs(array $faqs, string $contextName, string $slug = ''): array
    {
        if (! empty($slug)) {
            $dbFaqs = Faq::getForPage($slug);
            if ($dbFaqs->isEmpty()) {
                $dbFaqs = Faq::getForPage('services');
            }
            if ($dbFaqs->isNotEmpty()) {
                return $dbFaqs->toArray();
            }
        }

        if (count($faqs) >= 10) {
            return $faqs;
        }

        $defaultFillers = [
            ['question' => 'What technical stack is used for '.$contextName.'?', 'answer' => 'We utilize modern, high-performance tech stacks including Laravel 12 (PHP 8.2+), Flutter for cross-platform mobile apps, React, Vue.js, MySQL, and secure AWS cloud hosting.'],
            ['question' => 'Who owns the full source code and intellectual property rights?', 'answer' => 'Upon project completion and final milestone sign-off, complete source code ownership, database schemas, and IP rights are 100% transferred to the client.'],
            ['question' => 'What is the standard development timeline for '.$contextName.'?', 'answer' => 'Development timelines range from 2-4 weeks for standard modules to 8-12 weeks for enterprise-grade solutions with extensive custom business logic.'],
            ['question' => 'Do you sign a Non-Disclosure Agreement (NDA) before starting?', 'answer' => 'Yes. We sign bilateral NDAs before reviewing sensitive business requirements or proprietary technical workflows to ensure strict data confidentiality.'],
            ['question' => 'What post-launch SLA technical support options are available?', 'answer' => 'We offer structured Service Level Agreements (SLAs) covering 24/7 server health monitoring, security updates, bug fixes, database optimization, and continuous feature upgrades.'],
            ['question' => 'How is software pricing evaluated for '.$contextName.'?', 'answer' => 'Pricing is calculated based on functional scope, custom user roles, third-party API integrations, database scale, and post-deployment support requirements.'],
            ['question' => 'Can '.$contextName.' integrate with external APIs and payment gateways?', 'answer' => 'Yes. Our solutions support seamless RESTful/GraphQL API integrations with payment gateways (Razorpay, Paytm), WhatsApp/SMS gateways, biometric devices, and accounting tools.'],
            ['question' => 'How do you ensure data security and privacy in '.$contextName.'?', 'answer' => 'Security measures include CSRF protection, SQL injection prevention, Bcrypt password hashing, SSL encryption, and role-based access control (RBAC).'],
            ['question' => 'Is in-person discovery consultation available in Lucknow?', 'answer' => 'Yes! We welcome clients to visit our corporate headquarters in Aliganj, Lucknow, to discuss software requirements and review live project prototypes.'],
            ['question' => 'How are project updates and communication managed during development?', 'answer' => 'We follow Agile development with weekly sprint progress demos, staging preview links, dedicated Slack/WhatsApp project channels, and transparent milestone tracking.'],
        ];

        foreach ($defaultFillers as $filler) {
            if (count($faqs) >= 10) {
                break;
            }
            $faqs[] = $filler;
        }

        return $faqs;
    }
}
