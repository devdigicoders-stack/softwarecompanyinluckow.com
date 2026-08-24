<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqsByPage = [
            'contact' => [
                [
                    'question' => 'How soon will your engineering team respond to my inquiry?',
                    'answer' => 'Our technical solution architects respond to all consultation requests within 2 to 4 business hours. For urgent software requirements, you can also call us directly at 0522-4235604 or +91 6394296293.',
                ],
                [
                    'question' => 'Can we schedule a consultation meeting for custom software development?',
                    'answer' => 'Yes! We welcome clients across Lucknow, Kanpur, and Gorakhpur. You can connect with our lead developers, project managers, and UI/UX designers to discuss your software scope.',
                ],
                [
                    'question' => 'Do you sign Non-Disclosure Agreements (NDAs) before project discussion?',
                    'answer' => 'Absolutely. We prioritize intellectual property protection and client privacy. We execute a bilateral NDA before you share sensitive business workflows or technical documentation.',
                ],
                [
                    'question' => 'What details should I prepare before requesting a software quotation?',
                    'answer' => 'Having a brief overview of your business goals, target users, required modules (e.g., admin panel, user roles, payment gateway), and expected delivery timeline helps us provide a precise scope and cost estimate.',
                ],
                [
                    'question' => 'Do you provide post-launch maintenance and technical support?',
                    'answer' => 'Yes, every software project delivered by our team comes with dedicated Service Level Agreements (SLAs) covering server management, bug fixes, security updates, and feature enhancements.',
                ],
                [
                    'question' => 'What tech stack do you use for web and mobile development?',
                    'answer' => 'We specialize in modern, high-performance tech stacks including Laravel (PHP 8.2+), React, Vue.js, Flutter for cross-platform iOS & Android mobile apps, Node.js, and scalable MySQL/PostgreSQL databases.',
                ],
                [
                    'question' => 'Is initial technical consultation and project scoping free of charge?',
                    'answer' => 'Yes! We provide complimentary initial technical discovery sessions and itemized project scope proposals to help you understand software architecture options and development estimates.',
                ],
                [
                    'question' => 'What are your payment terms and milestone structures for software projects?',
                    'answer' => 'We follow transparent milestone-based payments: typically 20-30% initial deposit, milestone payments upon UI design approval and backend module completion, and final balance upon UAT sign-off and IP code transfer.',
                ],
                [
                    'question' => 'Can you work with existing legacy codebases or third-party APIs?',
                    'answer' => 'Yes. Our senior engineers specialize in legacy code refactoring, system modernization, API integrations, and database migrations for existing business software platforms.',
                ],
                [
                    'question' => 'How can remote or outstation clients collaborate during software development?',
                    'answer' => 'We provide structured remote project management via weekly video milestone reviews, staging server preview URLs, real-time Slack/WhatsApp developer communication, and Jira/Trello task tracking.',
                ],
            ],

            'home' => [
                [
                    'question' => 'What is the purpose of softwarecompanyinlucknow.com?',
                    'answer' => 'softwarecompanyinlucknow.com is an educational information portal, software comparison platform, and technology guide dedicated to Lucknow\'s IT ecosystem. It helps business owners understand software solutions, cost drivers, and evaluate software development companies objectively.',
                ],
                [
                    'question' => 'How can I choose the right software development company in Lucknow?',
                    'answer' => 'Evaluate providers based on objective criteria: verified technology stack expertise (Laravel 12, PHP 8.2+, Flutter, React), custom code architecture vs template scripts, 100% source code IP ownership, milestone scope clarity, and post-deployment Service Level Agreement (SLA) support.',
                ],
                [
                    'question' => 'How is custom software development cost calculated in Lucknow?',
                    'answer' => 'Software cost depends on project scope, number of custom user roles, third-party API integrations (payment gateways, WhatsApp, biometric devices), mobile vs web platform requirements, data security protocols, and long-term maintenance scope.',
                ],
                [
                    'question' => 'Why choose our recommended software development services in Lucknow?',
                    'answer' => 'Software Company in Lucknow provides comprehensive software engineering services with availability in Lucknow, Kanpur, Gorakhpur & across Uttar Pradesh.',
                ],
                [
                    'question' => 'What software development services are available in Lucknow?',
                    'answer' => 'Software companies in Lucknow offer custom web application development, mobile app development (iOS & Android via Flutter/React Native), enterprise ERP software, CRM platforms, HRMS payroll systems, billing & inventory software, and API integration services.',
                ],
                [
                    'question' => 'What is the difference between custom software and ready-made SaaS applications?',
                    'answer' => 'Custom software is engineered specifically around your unique business workflows, giving you total IP ownership with zero monthly per-user licensing fees. Ready-made SaaS applications require recurring payments and force your business to adapt to rigid default workflows.',
                ],
                [
                    'question' => 'Which technology stack is best for custom enterprise software development?',
                    'answer' => 'For enterprise web backends, Laravel (PHP 8.2+) and Python provide high security, scalable Eloquent ORM, and rapid development capabilities. For mobile apps, Flutter enables native-level performance across iOS and Android from a single codebase.',
                ],
                [
                    'question' => 'Do software development companies in Lucknow provide source code ownership?',
                    'answer' => 'Reputable software development providers transfer 100% full intellectual property (IP) and complete source code ownership to the client upon project completion and final milestone payment.',
                ],
                [
                    'question' => 'How long does it take to develop a custom web or mobile software application?',
                    'answer' => 'Development timelines vary based on project scale: standard business websites take 1 to 2 weeks, custom web portals take 4 to 8 weeks, and complex enterprise ERP or multi-platform mobile apps take 8 to 16 weeks.',
                ],
                [
                    'question' => 'Do software companies in Lucknow offer ongoing maintenance and SLA support?',
                    'answer' => 'Yes. Leading software development firms provide formal Service Level Agreements (SLAs) covering server monitoring, security updates, bug fixes, database optimization, and continuous technical upgrades.',
                ],
            ],

            'about' => [
                [
                    'question' => 'Who is Software Company in Lucknow?',
                    'answer' => 'Software Company in Lucknow is an established software engineering portal and IT guide in Lucknow. We specialize in custom web applications, mobile apps, ERP systems, CRM software, and enterprise software engineering.',
                ],
                [
                    'question' => 'Where are your software development services available?',
                    'answer' => 'Our software development services are available in Lucknow, Kanpur, Gorakhpur, and across Uttar Pradesh. You can reach our engineering team directly at 0522-4235604 or +91 6394296293.',
                ],
                [
                    'question' => 'What software development services do you provide in Lucknow?',
                    'answer' => 'We provide end-to-end IT services including custom web software development, mobile app development (iOS & Android via Flutter/React Native), enterprise ERP systems, CRM platforms, HRMS solutions, billing software, and custom API integrations.',
                ],
                [
                    'question' => 'Do clients get 100% full source code ownership?',
                    'answer' => 'Yes. Upon project completion and milestone sign-off, our engineering team transfers complete source code ownership, database schemas, IP rights, and technical documentation to the client.',
                ],
                [
                    'question' => 'How many years of experience does the software development team have?',
                    'answer' => 'Our software team has over 6 years of core software engineering experience, delivering 1000+ successful projects across enterprise, healthcare, education, retail, and government sectors.',
                ],
                [
                    'question' => 'Are your software developers in-house or outsourced?',
                    'answer' => 'All our software architects, full-stack web developers, Flutter mobile developers, UI/UX designers, and QA testers are 100% full-time in-house employees.',
                ],
                [
                    'question' => 'Do you sign Non-Disclosure Agreements (NDAs) before project discovery?',
                    'answer' => 'Yes. Client data confidentiality and intellectual property security are paramount. We routinely sign bilateral Non-Disclosure Agreements (NDAs) before discussing sensitive business logic or proprietary workflows.',
                ],
                [
                    'question' => 'What tech stack standards does our software engineering team follow?',
                    'answer' => 'We engineer software using enterprise-grade tech stacks including Laravel 12 (PHP 8.2+), Flutter for cross-platform mobile apps, React, Vue.js, Node.js, Python, MySQL, PostgreSQL, and AWS cloud infrastructure.',
                ],
                [
                    'question' => 'Can we connect with your team for an initial software consultation?',
                    'answer' => 'Yes! We welcome clients in Lucknow, Kanpur, Gorakhpur, and nearby regions to schedule discovery workshops to review software requirements, view live project demos, and map out technical architecture.',
                ],
                [
                    'question' => 'What post-launch SLA technical support options do you offer?',
                    'answer' => 'We offer structured Service Level Agreements (SLAs) that include 24/7 server health monitoring, routine security patches, bug fixes, database optimization, and continuous feature enhancements.',
                ],
            ],

            'solutions' => [
                [
                    'question' => 'What modules are included in a custom ERP software solution?',
                    'answer' => 'Standard custom ERP modules include inventory management, financial accounting, sales & lead management, HR & payroll, purchase orders, customer relationship management (CRM), and real-time executive analytics dashboards.',
                ],
                [
                    'question' => 'How does custom software improve operational efficiency over manual spreadsheets?',
                    'answer' => 'Custom software automates repetitive data entry, eliminates human calculation errors, provides real-time multi-branch synchronization, enforces strict data access roles, and generates instant compliance reports.',
                ],
                [
                    'question' => 'Can your software solutions integrate with third-party payment gateways and WhatsApp APIs?',
                    'answer' => 'Yes. We integrate RESTful APIs for Razorpay, Paytm, Cashfree, WhatsApp Business API for automated notifications, biometric attendance machines, and SMS gateways.',
                ],
                [
                    'question' => 'Is our company data secure on a custom cloud server environment?',
                    'answer' => 'We implement enterprise security standards: SSL/TLS encryption in transit, AES-256 database encryption at rest, role-based permission access, automated daily cloud backups, and regular vulnerability audits.',
                ],
                [
                    'question' => 'Can your software handle multi-location or multi-branch business operations?',
                    'answer' => 'Yes. Our software solutions support multi-location inventory tracking, centralized multi-store billing, branch-level permission scoping, and consolidated group financial reporting.',
                ],
            ],

            'services' => [
                [
                    'question' => 'What custom software development services do you offer in Lucknow?',
                    'answer' => 'We offer custom web application development, mobile app development (iOS & Android via Flutter/React Native), enterprise ERP systems, CRM software, HRMS payroll solutions, billing software, and custom API development.',
                ],
                [
                    'question' => 'What is your software development process and methodology?',
                    'answer' => 'We follow an agile 4-stage development framework: 1) Requirement Gathering & Scoping, 2) Architecture Blueprint & UI Wireframes, 3) Sprint-based Coding & QA Testing, 4) UAT Handover, Deployment, and SLA Support.',
                ],
                [
                    'question' => 'Do you provide dedicated software developer hiring or team extension models?',
                    'answer' => 'Yes. In addition to turnkey fixed-scope project delivery, we provide dedicated developer allocation on a monthly dedicated retainer model for ongoing web and mobile software development.',
                ],
                [
                    'question' => 'What is the average turnaround time for a custom software project in Lucknow?',
                    'answer' => 'Web applications typically take 4 to 8 weeks, while comprehensive enterprise ERP or multi-platform mobile apps take 8 to 16 weeks depending on feature complexity.',
                ],
                [
                    'question' => 'Do you provide SLA maintenance after project deployment?',
                    'answer' => 'Yes. Every project includes post-deployment SLA warranty coverage for server configuration, bug fixes, security updates, and performance tuning.',
                ],
            ],

            'technology' => [
                [
                    'question' => 'Why is Laravel recommended for enterprise web application development?',
                    'answer' => 'Laravel provides an robust PHP framework with built-in authentication, Eloquent ORM, secure database migrations, queue management, CSRF/XSS protection, and exceptional scalability for enterprise web apps.',
                ],
                [
                    'question' => 'What are the advantages of Flutter for cross-platform mobile app development?',
                    'answer' => 'Flutter enables high-performance native iOS and Android apps from a single Dart codebase, reducing development cost and time-to-market by 40-50% while maintaining 60fps UI performance.',
                ],
                [
                    'question' => 'How does React or Vue.js enhance the user interface of web applications?',
                    'answer' => 'React and Vue.js provide reactive component-driven UI architecture, allowing single-page web applications (SPAs) to update dynamically without page reloads, delivering a desktop-like user experience.',
                ],
                [
                    'question' => 'Which database system is best for custom business software?',
                    'answer' => 'MySQL and PostgreSQL are enterprise-proven relational databases offering ACID compliance, foreign key constraints, high concurrency handling, and seamless integration with Laravel backends.',
                ],
                [
                    'question' => 'How do you handle API security and authentication in web applications?',
                    'answer' => 'We secure REST and GraphQL APIs using OAuth 2.0, JSON Web Tokens (JWT), HTTPS SSL encryption, rate limiting, and strict input validation.',
                ],
            ],

            'locations' => [
                [
                    'question' => 'Why is Aliganj Lucknow\'s primary software & IT hub?',
                    'answer' => 'Aliganj (Sector-\'O\') is home to major registered software development companies, offering central connectivity, state-of-the-art tech infrastructure, and top engineering talent.',
                ],
                [
                    'question' => 'Can businesses in Gomti Nagar, Hazratganj, or Kanpur consult our software engineering team?',
                    'answer' => 'Yes! We serve clients across all regions of Lucknow (Aliganj, Gomti Nagar, Hazratganj, Indiranagar, Transport Nagar) as well as Kanpur, Gorakhpur, Varanasi, and international clients remotely.',
                ],
                [
                    'question' => 'Can we meet developers in person at your Aliganj office?',
                    'answer' => 'Yes! We encourage clients to schedule in-person discovery meetings at our Aliganj office to discuss technical specifications and view live software demonstrations.',
                ],
            ],

            'cost-guides' => [
                [
                    'question' => 'What factors influence the cost of software development in Lucknow?',
                    'answer' => 'Software development cost depends on scope complexity, number of custom user roles, third-party API integrations (payment gateways, WhatsApp, biometric devices), mobile platform requirements, and data security requirements.',
                ],
                [
                    'question' => 'Is custom software development more cost-effective than SaaS subscriptions in the long run?',
                    'answer' => 'Yes! Custom software requires a one-time development investment with zero recurring per-user monthly subscription fees, delivering a significantly lower Total Cost of Ownership (TCO) over 3 to 5 years.',
                ],
                [
                    'question' => 'What is the average cost of developing an enterprise ERP or billing software in Lucknow?',
                    'answer' => 'Standard custom web portals in Lucknow range from ₹35,000 to ₹75,000, while comprehensive enterprise ERP or multi-platform mobile apps range from ₹1,000,00 to ₹2,50,000+ based on module requirements.',
                ],
            ],

            'blog' => [
                [
                    'question' => 'What topics are covered in the software & tech journal?',
                    'answer' => 'Our publication covers software engineering best practices, enterprise tech architecture, custom software development guides, ERP & CRM cost breakdowns, and IT ecosystem updates from Lucknow.',
                ],
                [
                    'question' => 'Who writes the technical articles on softwarecompanyinlucknow.com?',
                    'answer' => 'Articles are authored by senior software architects, full-stack developers, and technology solution leaders in Lucknow.',
                ],
                [
                    'question' => 'How often is new software and technology content published?',
                    'answer' => 'We publish weekly deep-dive technical guides, software framework comparisons, and Lucknow IT ecosystem analysis.',
                ],
                [
                    'question' => 'How can business owners use these software guides?',
                    'answer' => 'Business leaders use our guides to evaluate software development options, understand custom software cost drivers, select appropriate tech stacks, and verify vendor credentials.',
                ],
                [
                    'question' => 'Are software cost estimates featured in the blog accurate for Lucknow?',
                    'answer' => 'Yes. Cost breakdowns reflect real-market software development pricing and developer billing rates across Lucknow, UP.',
                ],
                [
                    'question' => 'Can I submit a technical query or request an article topic?',
                    'answer' => 'Yes. You can contact our editorial and engineering team through the contact page to request specific software topic coverage or technical consultations.',
                ],
                [
                    'question' => 'What frameworks and tech stacks are analyzed in the journal?',
                    'answer' => 'We cover Laravel 12 (PHP 8.2+), Flutter cross-platform mobile app development, React, Vue.js, Node.js, Python AI, and cloud server deployment.',
                ],
                [
                    'question' => 'How does custom software engineering compare to SaaS subscriptions in articles?',
                    'answer' => 'Our editorial team objectively compares one-time custom software development against recurring SaaS subscription licensing models.',
                ],
                [
                    'question' => 'Where can I consult with software engineers in person?',
                    'answer' => 'You can schedule an in-person discovery workshop at our recommended corporate headquarters in Aliganj, Lucknow.',
                ],
            ],

            'best-technology-for-website-development' => [
                [
                    'question' => 'Which technology is best for website development in 2026?',
                    'answer' => 'For custom, secure, and scalable web applications, Laravel 12 (PHP 8.2+) combined with React.js or Vue.js is the #1 recommended technology stack. For simple content blogs, WordPress is suitable.',
                ],
                [
                    'question' => 'Why is Laravel 12 preferred over WordPress for enterprise web apps?',
                    'answer' => 'Laravel 12 provides a structured MVC architecture, enterprise ORM, 100% custom code flexibility, and built-in protection against SQL Injection and CSRF, avoiding plugin bloat and security vulnerabilities inherent in WordPress.',
                ],
                [
                    'question' => 'Can React.js or Next.js be integrated with a Laravel backend?',
                    'answer' => 'Yes! A hybrid architecture pairing Next.js/React.js for reactive front-end UI rendering with a Laravel RESTful API backend delivers maximum PageSpeed performance and security.',
                ],
                [
                    'question' => 'When should I choose Node.js over Laravel for backend development?',
                    'answer' => 'Node.js is recommended for real-time applications requiring high-concurrency WebSockets, such as live chat servers, streaming platforms, and microservice APIs.',
                ],
                [
                    'question' => 'Is procedural PHP still recommended for modern web development?',
                    'answer' => 'No. Plain procedural PHP lacks structured routing, dependency injection, and standardized security middleware. Modern PHP applications should always use frameworks like Laravel 12.',
                ],
                [
                    'question' => 'What is the average development timeline for a custom web application?',
                    'answer' => 'Development timelines range from 2 to 4 weeks for standard business web portals, up to 6 to 12 weeks for complex enterprise ERP or SaaS web platforms.',
                ],
                [
                    'question' => 'Who owns the full source code and intellectual property rights?',
                    'answer' => 'Upon project completion and final milestone sign-off, 100% full source code ownership, database schemas, and IP rights are transferred to the client.',
                ],
                [
                    'question' => 'Do software development companies in Lucknow sign NDAs?',
                    'answer' => 'Yes. Bilateral Non-Disclosure Agreements (NDAs) are executed prior to technical discovery sessions to safeguard your business requirements.',
                ],
                [
                    'question' => 'How is custom web application pricing calculated in Lucknow?',
                    'answer' => 'Pricing is evaluated based on functional scope, custom user roles, third-party API integrations (payment gateways, WhatsApp), database scale, and post-launch maintenance SLA.',
                ],
                [
                    'question' => 'What post-launch technical support SLA options are provided?',
                    'answer' => 'We offer structured Service Level Agreements (SLAs) covering 24/7 server health monitoring, security patches, bug fixes, and continuous feature enhancements.',
                ],
            ],
        ];

        foreach ($faqsByPage as $pageName => $faqList) {
            foreach ($faqList as $index => $item) {
                Faq::firstOrCreate(
                    [
                        'page_name' => $pageName,
                        'question' => $item['question'],
                    ],
                    [
                        'answer' => $item['answer'],
                        'order_index' => $index + 1,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
