<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\SoftwareSolution;
use Illuminate\Contracts\View\View;

class SolutionController extends Controller
{
    public function show(string $slug): View
    {
        $solution = SoftwareSolution::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        $solutionData = $this->getSolutionData($slug, $solution);

        $allSolutions = SoftwareSolution::where('is_active', true)->take(6)->get();

        $relatedPosts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Software Solutions', 'url' => route('home')],
            ['name' => $solutionData['title'], 'url' => ''],
        ];

        return view('solutions.show', array_merge($solutionData, compact('allSolutions', 'relatedPosts', 'breadcrumbs')));
    }

    private function getSolutionData(string $slug, ?SoftwareSolution $solution): array
    {
        if ($solution) {
            return [
                'title' => $solution->meta_title ?? $solution->title,
                'h1' => $solution->h1_title ?? $solution->title,
                'meta_description' => $solution->meta_description ?? $solution->excerpt,
                'keywords' => $solution->keywords ?? ($solution->title.', software company in lucknow, best software company in lucknow'),
                'excerpt' => $solution->excerpt,
                'content' => $solution->content,
                'icon' => $solution->icon ?? 'bi-diagram-3',
                'features' => $solution->features ?? [],
                'benefits' => $solution->benefits ?? [],
                'target_audience' => $solution->target_audience ?? [],
                'faqs' => $this->ensureTenSolutionFaqs($solution->faqs ?? [], $solution->title, $slug),
                'slug' => $solution->slug,
            ];
        }

        $data = $this->getSolutionMapBySlug($slug);
        $data['slug'] = $slug;
        $data['keywords'] = $data['keywords'] ?? ($data['h1'].', software company in lucknow, best software company in lucknow, IT solutions lucknow');
        $data['faqs'] = $this->ensureTenSolutionFaqs($data['faqs'] ?? [], $data['h1'] ?? $slug, $slug);

        return $data;
    }

    private function ensureTenSolutionFaqs(array $faqs, string $contextName, string $slug = ''): array
    {
        if (! empty($slug)) {
            $dbFaqs = Faq::getForPage($slug);
            if ($dbFaqs->isEmpty()) {
                $dbFaqs = Faq::getForPage('solutions');
            }
            if ($dbFaqs->isNotEmpty()) {
                return $dbFaqs->toArray();
            }
        }

        while (count($faqs) < 10) {
            $faqs[] = ['question' => "Common question about $contextName", 'answer' => "Our team provides tailored solutions for $contextName to ensure your business efficiency and growth."];
        }

        return $faqs;
    }

    private function getSolutionMapBySlug(string $slug): array
    {
        $solutionsMap = [
            'erp-software-in-lucknow' => [
                'title' => 'ERP Software in Lucknow: Enterprise Resource Planning Systems Guide',
                'h1' => 'ERP Software Guide & Implementation in Lucknow',
                'icon' => 'bi-diagram-3',
                'meta_description' => 'Comprehensive guide to ERP software in Lucknow. Learn about custom ERP modules for inventory, accounting, HR, supply chain, and multi-branch management.',
                'excerpt' => 'ERP (Enterprise Resource Planning) software centralizes your business operations—from inventory tracking and financial accounting to HR and sales—into a single database.',
                'features' => [
                    'Multi-Module System (Finance, HR, Inventory, Sales, Procurement)',
                    'Multi-Branch Data Synchronization & Role Permissions',
                    'Real-Time Analytical Dashboards & Automated Financial Reports',
                    'GST-Compliant Invoicing & Accounting Module',
                ],
                'target_audience' => ['Manufacturing Units', 'Wholesale Distributors', 'Multi-Branch Enterprises', 'Construction Companies'],
                'benefits' => [
                    'Eliminate data silos between departments.',
                    'Automate repetitive operational tasks.',
                    'Improve decision-making with real-time financial reporting.',
                ],
                'faqs' => [
                    ['question' => 'What is ERP software and why does a business need it?', 'answer' => 'ERP (Enterprise Resource Planning) software integrates core business functions—inventory, accounting, HR, procurement, and sales—into a single centralized database to streamline workflows and eliminate manual errors.'],
                    ['question' => 'What modules are included in custom ERP software developed in Lucknow?', 'answer' => 'Standard custom ERP modules include Inventory & Stock Management, GST Financial Accounting, HR Payroll & Biometric Attendance, Purchase Order Requisitions, CRM Lead Tracking, and Executive Reporting Dashboards.'],
                    ['question' => 'Can ERP software sync data across multiple branches in Uttar Pradesh?', 'answer' => 'Yes. Cloud-hosted custom ERP software enables real-time multi-branch data synchronization, centralized stock tracking, and role-based branch manager permissions.'],
                    ['question' => 'How much does ERP software development cost in Lucknow?', 'answer' => 'Custom ERP implementation cost depends on module count and user roles. Typical custom ERP development ranges from ₹80,000 for mid-sized business setups to ₹5,000,000+ for multi-facility enterprise deployments.'],
                    ['question' => 'Is custom ERP software better than SAP or Tally?', 'answer' => 'Custom ERP software offers 100% alignment with your exact operational workflows, zero recurring monthly per-user licensing fees, and full source code ownership, whereas SAP or generic SaaS require expensive ongoing licensing.'],
                    ['question' => 'How long does ERP software implementation take?', 'answer' => 'Implementation timeline typically spans 8 to 16 weeks, including discovery, UI/UX workflow prototyping, database migration from spreadsheets/Tally, staff training, and deployment.'],
                    ['question' => 'Can ERP software generate GST tax reports and E-Way bills?', 'answer' => 'Yes. Custom ERP systems integrate GST tax rules, automated GSTR-1/GSTR-3B tax summary exports, and direct E-Way bill API integrations.'],
                    ['question' => 'How is data security maintained in enterprise ERP software?', 'answer' => 'Security measures include role-based access control (RBAC), database field encryption, SSL/TLS transport security, automated daily backups, and detailed user audit trail logs.'],
                    ['question' => 'Can custom ERP software integrate with mobile apps for field staff?', 'answer' => 'Yes. Developers build companion Flutter mobile apps connected via RESTful APIs for field sales agents, warehouse stock auditors, and delivery drivers.'],
                    ['question' => 'Do Lucknow software companies provide ERP user training and support?', 'answer' => 'Yes. Companies like Software Company in Lucknow provide comprehensive hands-on staff training, video tutorials, and ongoing SLA maintenance support.'],
                ],
            ],
            'crm-software-in-lucknow' => [
                'title' => 'CRM Software in Lucknow: Customer & Sales Pipeline System Guide',
                'h1' => 'CRM Software & Sales Automation Guide in Lucknow',
                'icon' => 'bi-people',
                'meta_description' => 'Guide to CRM software in Lucknow. Discover custom lead management tools, automated sales pipelines, WhatsApp integration, and customer support tracking.',
                'excerpt' => 'CRM (Customer Relationship Management) software helps businesses capture leads, manage sales pipelines, automate follow-ups, and build long-term customer loyalty.',
                'features' => [
                    'Lead Capture & Sales Funnel Stage Tracking',
                    'Automated Follow-Up Reminders & WhatsApp/SMS Integration',
                    'Customer Interaction History & Communication Logs',
                    'Sales Executive Performance & Target Analytics',
                ],
                'target_audience' => ['Real Estate Agencies', 'Education Institutes', 'B2B Sales Teams', 'Service Providers'],
                'benefits' => [
                    'Increase sales conversion rates by reducing response times.',
                    'Never lose track of potential client follow-ups.',
                    'Monitor sales team activities in real-time.',
                ],
                'faqs' => [
                    ['question' => 'How does custom CRM software boost sales conversion rates?', 'answer' => 'Custom CRM software consolidates leads from website forms, WhatsApp, Facebook ads, and IndiaMART into a central dashboard, assigning lead tasks instantly to sales executives with automated follow-up reminders.'],
                    ['question' => 'Can CRM software integrate with WhatsApp Business API and SMS gateways?', 'answer' => 'Yes. Custom CRM systems integrate official WhatsApp Business APIs and SMS gateways to send automated instant replies, quote PDFs, and follow-up templates.'],
                    ['question' => 'How much does custom CRM software development cost in Lucknow?', 'answer' => 'Custom CRM software pricing ranges from ₹45,000 for specialized small business sales pipelines to ₹1,80,000+ for multi-tier call center and omnichannel sales CRMs.'],
                    ['question' => 'Can CRM track sales executive calls and performance targets?', 'answer' => 'Yes. CRM dashboards track call logs, lead conversion metrics, daily follow-up counts, deals closed, and monthly revenue targets per sales team member.'],
                    ['question' => 'How does CRM software prevent lead leakage?', 'answer' => 'Every inquiry is locked into the system with role-based access. Sales staff cannot delete leads, and overdue follow-ups trigger escalation alerts to managers.'],
                    ['question' => 'Is custom CRM better than Zoho CRM or Salesforce?', 'answer' => 'Custom CRM provides a tailored user interface matching your exact sales steps without per-user monthly subscription fees, keeping operational costs low as your sales force grows.'],
                    ['question' => 'Can CRM software handle post-sales customer support ticketing?', 'answer' => 'Yes. Modules can include customer ticket management, SLA response tracking, service contracts, and renewal reminders.'],
                    ['question' => 'How long does custom CRM software development take?', 'answer' => 'Standard CRM development and setup takes between 4 to 8 weeks, including workflow customization and sales team onboarding.'],
                    ['question' => 'Can CRM data be accessed securely via mobile devices?', 'answer' => 'Yes. Custom CRMs feature mobile-responsive web interfaces and dedicated Flutter mobile apps for field sales representatives.'],
                    ['question' => 'How do I get a custom CRM quotation in Lucknow?', 'answer' => 'Contact a software consultant at Software Company in Lucknow to outline your lead acquisition channels, sales stages, and reporting requirements for an itemized scope and proposal.'],
                ],
            ],
            'hrms-software-in-lucknow' => [
                'title' => 'HRMS Software in Lucknow: Human Resource & Payroll System Guide',
                'h1' => 'HRMS Software & Payroll Management Guide in Lucknow',
                'icon' => 'bi-person-badge',
                'meta_description' => 'Comprehensive guide to HRMS software in Lucknow. Learn about automated biometric attendance, salary calculation, leave management, and employee portals.',
                'excerpt' => 'HRMS (Human Resource Management System) software automates employee attendance, salary slip generation, leave approvals, performance evaluations, and compliance reporting.',
                'features' => [
                    'Biometric & Mobile GPS Attendance Integration',
                    'Automated Payroll Calculation & Salary Slip Generation',
                    'Leave Request Workflow & Holiday Calendar Management',
                    'Employee Self-Service Portal & Document Vault',
                ],
                'target_audience' => ['Corporate Offices', 'IT Companies', 'Hospitals & Clinics', 'Manufacturing Plants'],
                'benefits' => [
                    'Reduce HR administrative workload by up to 70%.',
                    'Ensure accurate tax and salary calculations.',
                    'Improve employee satisfaction with self-service mobile portals.',
                ],
                'faqs' => [
                    ['question' => 'Can HRMS software integrate with biometric fingerprint and facial recognition hardware?', 'answer' => 'Yes. Custom HRMS software connects seamlessly via local network or cloud API sync with ZKTEco, Matrix, Realtime, and facial recognition attendance devices.'],
                    ['question' => 'How does HRMS software automate monthly payroll processing?', 'answer' => 'HRMS automatically calculates working days, late arrivals, overtime, leave deductions, PF, ESI, TDS tax deductions, and generates downloadable monthly salary slips in PDF format.'],
                    ['question' => 'Does HRMS include an Employee Self-Service (ESS) portal?', 'answer' => 'Yes. Employees log into dedicated web or mobile portals to submit leave requests, view attendance logs, download salary slips, and update personal documents.'],
                    ['question' => 'How much does HRMS software cost in Lucknow?', 'answer' => 'Custom HRMS pricing ranges from ₹40,000 for standard corporate offices to ₹1,50,000+ for enterprise multi-shift manufacturing or hospital deployments.'],
                    ['question' => 'Can HRMS track field employee attendance using mobile GPS tracking?', 'answer' => 'Yes. Mobile HRMS apps feature geotagged and geofenced attendance selfie check-ins for field sales and site engineers.'],
                    ['question' => 'How are leave quotas and holiday calendars managed in HRMS?', 'answer' => 'HR managers configure custom leave policies (Casual, Sick, Earned Leave), accrual rules, approval hierarchies, and company holiday calendars.'],
                    ['question' => 'Is HRMS software compliant with Indian labor laws and PF/ESI calculations?', 'answer' => 'Yes. HRMS software incorporates Provident Fund (PF), Employee State Insurance (ESI), Professional Tax (PT), and TDS statutory compliance formulas.'],
                    ['question' => 'How long does HRMS implementation take?', 'answer' => 'Implementation typically takes 3 to 6 weeks, including biometric hardware synchronization and employee master data import.'],
                    ['question' => 'How is employee document security maintained in HRMS?', 'answer' => 'Document vaults use encrypted storage and strict role-based view/download permissions to protect confidential employee records.'],
                    ['question' => 'How do I start HRMS implementation for my company in Lucknow?', 'answer' => 'Share your shift schedules, leave policy rules, and payroll structures with Software Company in Lucknow software architects to receive a customized implementation plan.'],
                ],
            ],
            'billing-software-in-lucknow' => [
                'title' => 'Billing Software in Lucknow: GST Invoicing & POS Systems Guide',
                'h1' => 'Billing & GST Invoicing Software Guide in Lucknow',
                'icon' => 'bi-receipt',
                'meta_description' => 'Explore billing software in Lucknow. Discover GST-compliant invoicing systems, point of sale (POS) billing, thermal printing, and barcode scanner integration.',
                'excerpt' => 'Fast, accurate billing software enables retail stores, wholesalers, and service businesses to generate GST invoices, track stock levels, and accept digital payments.',
                'features' => [
                    'GST-Compliant Invoicing & E-Way Bill Generation',
                    'Thermal Receipt Printing & Barcode Scanner Integration',
                    'Real-Time Stock Deductions & Low-Stock Alerts',
                    'Multi-Payment Mode Support (UPI, Credit Card, Cash)',
                ],
                'target_audience' => ['Retail Stores', 'Supermarkets', 'Hardware Shops', 'Service Centers'],
                'benefits' => [
                    'Speed up checkout counter queues.',
                    'Prevent inventory leakage with automated stock deduction.',
                    'Generate instant GST tax return reports.',
                ],
                'faqs' => [
                    ['question' => 'Is billing software suitable for small retail shops and wholesalers in Lucknow?', 'answer' => 'Yes. Lightweight POS billing software runs efficiently on standard desktop PCs, laptops, or touch tablets, accelerating counter checkout times.'],
                    ['question' => 'Does billing software support GST invoicing and GSTR reporting?', 'answer' => 'Yes. The software automatically calculates CGST, SGST, IGST rates, generates HSN/SAC code breakdowns, and exports GSTR-1 return filing data.'],
                    ['question' => 'Can billing software connect to thermal printers and barcode scanners?', 'answer' => 'Yes. Custom POS software connects natively with 2-inch and 3-inch thermal receipt printers, USB/wireless barcode scanners, and cash drawers.'],
                    ['question' => 'How much does custom billing software cost in Lucknow?', 'answer' => 'Single-counter POS billing software starts around ₹15,000 to ₹35,000, while multi-counter retail chain billing systems range from ₹45,000 to ₹1,20,000+.'],
                    ['question' => 'Can billing software track inventory stock in real-time?', 'answer' => 'Yes. Every invoice automatically deducts items from current inventory stock, triggering low-stock alerts when reorder levels are reached.'],
                    ['question' => 'Does billing software support UPI QR code payment integration?', 'answer' => 'Yes. Billing screens display dynamic UPI QR codes so customers can pay instantly using PhonePe, Google Pay, or Paytm.'],
                    ['question' => 'Can billing software operate offline if internet connection drops?', 'answer' => 'Yes. Offline POS billing systems save invoices locally on counter computers and synchronize data with the central cloud database when internet restores.'],
                    ['question' => 'How are customer credit ledgers (Udhari/Khata) managed in billing software?', 'answer' => 'Billing software includes customer ledger tracking, credit limit alerts, outstanding balance reports, and automated SMS reminder alerts.'],
                    ['question' => 'How long does it take to deploy billing software at a retail outlet?', 'answer' => 'Deployment and cashier staff training take 2 to 5 days, including barcode product catalog setup.'],
                    ['question' => 'How do I purchase billing software in Lucknow?', 'answer' => 'Contact Software Company in Lucknow in Aliganj for a live demo, hardware compatibility check, and customized software setup.'],
                ],
            ],
            'inventory-management-software-in-lucknow' => [
                'title' => 'Inventory Management Software in Lucknow: Stock Control Guide',
                'h1' => 'Inventory & Stock Management Software Guide in Lucknow',
                'icon' => 'bi-box-seam',
                'meta_description' => 'Guide to inventory management software in Lucknow. Learn about warehouse stock tracking, batch numbers, expiry dates, and purchase orders.',
                'excerpt' => 'Inventory management software tracks raw materials, finished products, batch numbers, purchase orders, and supplier ledgers across multiple warehouses.',
                'features' => [
                    'Multi-Warehouse & Godown Stock Tracking',
                    'Batch Number, Serial Number & Expiry Date Management',
                    'Automated Purchase Requisition & Supplier Ledgers',
                    'Stock Audit Reports & Reorder Point Alerts',
                ],
                'target_audience' => ['Pharma Distributors', 'FMCG Wholesalers', 'Manufacturing Units', 'Electronics Retailers'],
                'benefits' => [
                    'Prevent stockouts and overstocking expenses.',
                    'Track expired or slow-moving items easily.',
                ],
                'faqs' => [
                    ['question' => 'What is inventory management software and why is it essential?', 'answer' => 'Inventory management software monitors stock levels, purchase requisitions, supplier ledgers, warehouse transfers, and batch expiry dates to prevent stockouts and inventory leakage.'],
                    ['question' => 'How does inventory software handle pharmaceutical expiry dates?', 'answer' => 'Custom inventory software uses First-Expiry, First-Out (FEFO) logic, alerting staff to sell items nearing expiration first and locking expired batches.'],
                    ['question' => 'Can inventory software manage stock across multiple godowns and warehouses?', 'answer' => 'Yes. Centralized multi-warehouse inventory systems track stock transfers between main godowns and branch outlets with automated dispatch gate passes.'],
                    ['question' => 'How much does inventory management software cost in Lucknow?', 'answer' => 'Inventory software pricing ranges from ₹35,000 for single-godown wholesalers to ₹1,50,000+ for complex multi-warehouse manufacturing inventory systems.'],
                    ['question' => 'Does inventory software integrate with purchase order and supplier management modules?', 'answer' => 'Yes. The system manages supplier purchase orders, Goods Received Notes (GRN), purchase returns, and automated supplier payment ledgers.'],
                    ['question' => 'Can mobile handheld barcode scanners be used for stock auditing?', 'answer' => 'Yes. Handheld Android barcode scanners and mobile apps allow warehouse staff to perform instant physical stock audits.'],
                    ['question' => 'How are reorder stock alerts calculated?', 'answer' => 'The software tracks minimum threshold safety stock levels for each SKU, generating automated purchase requisitions when stock drops.'],
                    ['question' => 'Can inventory software integrate with accounting software like Tally?', 'answer' => 'Yes. Custom inventory systems export XML/Excel data or connect via direct REST APIs to synchronize financial ledgers with Tally.'],
                    ['question' => 'How long does inventory software setup take?', 'answer' => 'Setup and master item catalog import typically take 2 to 4 weeks depending on SKU count and warehouse complexity.'],
                    ['question' => 'How do I request an inventory software demonstration in Lucknow?', 'answer' => 'Schedule a discovery session with Software Company in Lucknow software architects to review your inventory workflows and stock tracking needs.'],
                ],
            ],
            'school-management-software-in-lucknow' => [
                'title' => 'School Management Software in Lucknow: ERP for Educational Institutes',
                'h1' => 'School & College Management Software Guide in Lucknow',
                'icon' => 'bi-book',
                'meta_description' => 'School management software guide in Lucknow. Learn about student admission, online fee collection, examination marksheets, and parent mobile apps.',
                'excerpt' => 'School ERP software manages student admissions, fee collection with online payment gateways, attendance, exam marksheets, and parent-teacher communication.',
                'features' => [
                    'Student Admission & Digital ID Card Generation',
                    'Fee Structure Management & Online Payment Gateway Integration',
                    'Examination Marksheets & Report Card Generation',
                    'Parent Mobile App & SMS Notification System',
                ],
                'target_audience' => ['Schools & Colleges', 'Coaching Institutes', 'Degree Colleges', 'Pre-Schools'],
                'benefits' => [
                    'Automate fee reminder alerts and digital receipts.',
                    'Enhance parent-teacher communication.',
                ],
                'faqs' => [
                    ['question' => 'What core modules are included in school management ERP software?', 'answer' => 'Core modules include Student Admission, Fee Collection & Online Payment Gateway, Attendance Management, Exam Marksheets & Report Cards, Library Management, Transport Tracking, and Parent Mobile Apps.'],
                    ['question' => 'Can parents pay school fees online through a mobile app?', 'answer' => 'Yes. Custom school ERP apps integrate UPI, credit card, and net banking payment gateways for instant online fee payments, automated SMS alerts, and digital receipt generation.'],
                    ['question' => 'How does the software generate student examination report cards?', 'answer' => 'Teachers input subject marks through web or mobile portals, and the system automatically calculates grades, percentages, class ranks, and generates printable PDF report cards.'],
                    ['question' => 'How much does school management software cost in Lucknow?', 'answer' => 'School ERP pricing ranges from ₹30,000 for basic school administrative setups to ₹1,50,000+ for large institutions requiring custom parent apps and transport GPS sync.'],
                    ['question' => 'Can school ERP send automated daily attendance SMS alerts to parents?', 'answer' => 'Yes. When daily student attendance is marked by class teachers, absent alerts are sent automatically to parents via WhatsApp and SMS gateways.'],
                    ['question' => 'Does the software support school bus GPS tracking?', 'answer' => 'Yes. Transport management modules integrate GPS hardware trackers, allowing parents to track live school bus locations on mobile apps.'],
                    ['question' => 'Can school management software handle coaching institute fee structures?', 'answer' => 'Yes. The software easily configures installment-based fee plans, discount vouchers, and batch scheduling for coaching institutes.'],
                    ['question' => 'Is data backup secure for large student records?', 'answer' => 'Yes. Cloud school ERP solutions maintain encrypted daily database backups on secure AWS servers with zero data loss guarantees.'],
                    ['question' => 'How long does school ERP implementation take?', 'answer' => 'System setup, student master data import, and staff training take 2 to 4 weeks.'],
                    ['question' => 'How can a school in Lucknow request an ERP demo?', 'answer' => 'Contact Software Company in Lucknow to schedule an on-site or online live demonstration of the school ERP and parent mobile application.'],
                ],
            ],
            'hospital-management-software-in-lucknow' => [
                'title' => 'Hospital Management Software in Lucknow: HMS & Clinic ERP Guide',
                'h1' => 'Hospital & Clinic Management Software Guide in Lucknow',
                'icon' => 'bi-hospital',
                'meta_description' => 'Hospital management software (HMS) guide in Lucknow. Learn about OPD registration, IPD billing, electronic health records (EHR), and lab reports.',
                'excerpt' => 'HMS software digitizes hospital workflows—from OPD patient registration and IPD bed allocation to electronic prescriptions, pathology labs, and pharmacy billing.',
                'features' => [
                    'OPD Patient Registration & Doctor Appointment Scheduling',
                    'IPD Admission, Bed Allocation & Final Billing',
                    'Electronic Medical Records (EMR) & Digital Prescriptions',
                    'Pathology Laboratory & Diagnostic Report Generation',
                ],
                'target_audience' => ['Hospitals', 'Polyclinics', 'Pathology Labs', 'Diagnostic Centers'],
                'benefits' => [
                    'Reduce patient wait times at OPD counters.',
                    'Maintain complete patient medical history securely.',
                ],
                'faqs' => [
                    ['question' => 'What is Hospital Management Software (HMS) and what departments does it cover?', 'answer' => 'HMS software digitizes hospital administrative and clinical operations, covering OPD Registration, IPD Bed Management, Electronic Medical Records (EMR), Pathology Lab, Radiology, Pharmacy Billing, and TPA Insurance Billing.'],
                    ['question' => 'How does HMS streamline OPD patient registration and doctor queue management?', 'answer' => 'OPD modules generate instant UHID numbers, print patient consultation slips, assign token numbers, and manage doctor queue display boards.'],
                    ['question' => 'Can HMS software manage pathology laboratory test reports?', 'answer' => 'Yes. Lab technicians input test result values into pathology modules, which auto-generate digital test reports with doctor signatures for print or WhatsApp delivery.'],
                    ['question' => 'How much does hospital management software cost in Lucknow?', 'answer' => 'Clinic and OPD software pricing starts around ₹35,000, while multi-bed hospital ERP systems range from ₹80,000 to ₹3,50,000+ depending on bed count and module integration.'],
                    ['question' => 'Is HMS software compliant with medical data privacy and NABH standards?', 'answer' => 'Yes. Custom HMS solutions utilize encrypted database fields, strict role access control, and audit logs to comply with medical record privacy guidelines.'],
                    ['question' => 'Does HMS support TPA health insurance claim processing and final IPD billing?', 'answer' => 'Yes. IPD modules track bed charges, doctor visit fees, medicine expenses, lab tests, TPA pre-authorization limits, and final itemized discharge bills.'],
                    ['question' => 'Can doctors write digital prescriptions on tablets or PCs?', 'answer' => 'Yes. EMR modules feature fast digital prescription builders with pre-saved medicine master templates, dosage instructions, and diagnostic test requisitions.'],
                    ['question' => 'Does HMS integrate with hospital pharmacy inventory?', 'answer' => 'Yes. IPD and OPD prescriptions automatically sync with the hospital pharmacy module for barcode billing and stock deduction.'],
                    ['question' => 'How long does HMS software deployment take at a hospital?', 'answer' => 'Deployment, doctor template setup, and hospital staff training typically take 3 to 6 weeks.'],
                    ['question' => 'How can a hospital or polyclinic in Lucknow schedule an HMS consultation?', 'answer' => 'Connect with Software Company in Lucknow software engineering team in Aliganj for a comprehensive HMS demonstration and hospital workflow assessment.'],
                ],
            ],
            'food-delivery-app-in-lucknow' => [
                'title' => 'Food Delivery App & Restaurant Management Software in Lucknow',
                'h1' => 'Food Delivery App & Restaurant Software Guide in Lucknow',
                'icon' => 'bi-bag-heart-fill',
                'meta_description' => 'Food delivery app development and restaurant software guide in Lucknow. Discover custom Customer Apps, Driver Delivery Apps, Restaurant Admin Panels, and Live Order Tracking.',
                'excerpt' => 'Food delivery software and mobile apps empower restaurant owners and multi-branch food chains to accept online orders, manage delivery drivers with live GPS tracking, and eliminate 30% third-party aggregator commissions.',
                'features' => [
                    'Customer Ordering App (iOS & Android) with Digital Menu',
                    'Live Order GPS Tracking & Real-Time Driver Allocation',
                    'Restaurant Kitchen Order Ticket (KOT) POS System',
                    'Aggregator Commission Saver & Direct UPI Payment Gateway',
                ],
                'target_audience' => ['Restaurants & Cafes', 'Cloud Kitchens', 'Multi-Branch Food Chains', 'Bakery & Sweet Shops'],
                'benefits' => [
                    'Save up to 30% commission per order compared to third-party apps.',
                    'Own your customer database, phone numbers, and ordering habits.',
                    'Accelerate kitchen dispatch times with digital KOT displays.',
                ],
                'faqs' => [
                    ['question' => 'Why build a custom food delivery app instead of relying solely on Zomato or Swiggy?', 'answer' => 'Custom food delivery apps eliminate 25%-30% aggregator commission per order, give you 100% ownership of your customer contact database for re-marketing, and let you offer direct discount loyalty points.'],
                    ['question' => 'What 3 mobile apps/portals are included in a complete food delivery system?', 'answer' => 'A complete food delivery system includes: 1) Customer Ordering App (iOS/Android), 2) Driver Delivery App with live Google Maps GPS navigation, and 3) Restaurant Admin & Kitchen KOT Dashboard.'],
                    ['question' => 'How does live order tracking work for customers and delivery drivers?', 'answer' => 'The driver app streams real-time GPS coordinates via WebSockets/Firebase to the customer app, showing live driver movement on Google Maps from kitchen dispatch to customer doorstep.'],
                    ['question' => 'How much does custom food delivery app development cost in Lucknow?', 'answer' => 'Custom food delivery software pricing ranges from ₹65,000 for single-restaurant ordering apps to ₹2,50,000+ for multi-vendor food delivery marketplaces.'],
                    ['question' => 'Does the software support Kitchen Order Tickets (KOT) and POS thermal printing?', 'answer' => 'Yes. Incoming online orders auto-print Kitchen Order Tickets (KOT) on kitchen thermal printers and update cashier POS screens instantly.'],
                    ['question' => 'Can customers pay via UPI, Credit Cards, and Cash on Delivery (COD)?', 'answer' => 'Yes. Systems integrate Razorpay, PhonePe, Paytm, and Google Pay for instant UPI payments alongside Cash on Delivery options.'],
                    ['question' => 'Can cloud kitchens run multiple virtual food brands from one admin panel?', 'answer' => 'Yes. Cloud kitchen management software allows managing multiple virtual menu brands and kitchens from a single centralized dashboard.'],
                    ['question' => 'How long does custom food delivery app development take?', 'answer' => 'Standard food delivery app deployment takes 4 to 8 weeks, including Play Store and App Store submission.'],
                    ['question' => 'Do you provide full source code and IP ownership?', 'answer' => 'Yes. Software Company in Lucknow transfers 100% full source code, admin panel credentials, and database rights on project completion.'],
                    ['question' => 'How can I get a quotation for a food delivery app in Lucknow?', 'answer' => 'Contact Software Company in Lucknow in Aliganj for a live demo of customer, driver, and admin apps.'],
                ],
            ],
            'mobile-app-development-in-lucknow' => [
                'title' => 'Mobile App Development in Lucknow: Android & iOS Application Guide',
                'h1' => 'Mobile App Development & Engineering Guide in Lucknow',
                'icon' => 'bi-phone-vibrate',
                'meta_description' => 'Guide to mobile app development in Lucknow. Learn about Flutter cross-platform apps, native Android & iOS development, backend REST APIs, and Play Store publishing.',
                'excerpt' => 'Custom mobile app development enables businesses to engage customers, automate field workforce operations, process mobile payments, and build high-grade iOS and Android applications.',
                'features' => [
                    'Cross-Platform Flutter & Native Android/iOS App Engineering',
                    'Real-Time Push Notifications & In-App Chat Messaging',
                    'Secure REST API Backend Integration & Encrypted Auth',
                    'Google Play Store & Apple App Store Publishing',
                ],
                'target_audience' => ['E-Commerce Businesses', 'Healthcare & Telemedicine', 'Education & EdTech', 'Logistics & Field Service'],
                'benefits' => [
                    'Reach millions of mobile users across Android and iOS.',
                    'Boost customer engagement with instant push notifications.',
                    'Accelerate time-to-market with single-codebase Flutter development.',
                ],
                'faqs' => [
                    ['question' => 'What is the best technology for mobile app development in Lucknow?', 'answer' => 'Flutter (Dart) is the top choice for cross-platform app development, allowing single-codebase compilation for high-performance iOS and Android apps at 40% lower cost.'],
                    ['question' => 'How much does mobile app development cost in Lucknow?', 'answer' => 'Mobile app development pricing ranges from ₹45,000 for standard business service apps to ₹1,80,000+ for complex e-commerce, food delivery, or fintech applications.'],
                    ['question' => 'How long does it take to build and launch a mobile app?', 'answer' => 'Development typically takes 4 to 10 weeks, spanning UI/UX Figma prototyping, API development, mobile frontend coding, QA testing, and store publishing.'],
                    ['question' => 'Do you publish the mobile app to Google Play Store and Apple App Store?', 'answer' => 'Yes. Full service includes store developer account setup, app privacy policy compliance, screenshot asset design, and store approval management.'],
                    ['question' => 'How are real-time push notifications sent to mobile app users?', 'answer' => 'Apps integrate Firebase Cloud Messaging (FCM) to send targeted promotional push notifications, transaction alerts, and order status updates.'],
                    ['question' => 'Can mobile apps connect to our existing website database?', 'answer' => 'Yes. Developers build secure RESTful APIs (Node.js/Laravel) to sync app data with your existing web database in real time.'],
                    ['question' => 'Is source code ownership transferred to the client?', 'answer' => 'Yes. Software Company in Lucknow provides 100% source code repository access and IP ownership upon project delivery.'],
                    ['question' => 'What post-launch app maintenance support is provided?', 'answer' => 'Maintenance packages include OS updates (Android 14/iOS 17 compatibility), server uptime monitoring, bug fixes, and feature upgrades.'],
                    ['question' => 'Can mobile apps work offline without internet connection?', 'answer' => 'Yes. Offline-first apps store data locally in SQLite/Hive databases and auto-sync with the cloud when internet reconnects.'],
                    ['question' => 'How do I start a mobile app project in Lucknow?', 'answer' => 'Schedule a consultation with Software Company in Lucknow to discuss your app idea, wireframes, and target features.'],
                ],
            ],
        ];

        $data = $solutionsMap[$slug] ?? [
            'title' => ucwords(str_replace('-', ' ', $slug)).' Guide',
            'h1' => ucwords(str_replace('-', ' ', $slug)),
            'meta_description' => 'Business software solution guide for '.str_replace('-', ' ', $slug).' in Lucknow.',
            'excerpt' => 'Comprehensive information guide breaking down software features, workflow benefits, customization factors, and provider selection.',
            'icon' => 'bi-diagram-3',
            'features' => [
                'Custom Business Workflow Automation',
                'Role-Based User Security',
                'Centralized Database Architecture',
                'Reporting & Analytics Dashboards',
            ],
            'target_audience' => ['SMEs', 'Enterprise Businesses', 'Local Retailers', 'Service Providers'],
            'benefits' => [
                'Improve operational efficiency.',
                'Reduce manual administrative errors.',
            ],
            'faqs' => [
                ['question' => 'How can custom software be tailored for specific business needs in Lucknow?', 'answer' => 'Custom software developers analyze your current manual or spreadsheet processes and design database fields and UI forms matching your exact business rules.'],
                ['question' => 'What is the advantage of custom business software over ready-made SaaS?', 'answer' => 'Custom business software provides 100% workflow alignment, zero monthly per-user licensing fees, full source code ownership, and unlimited database scalability.'],
                ['question' => 'How is data security maintained in custom business software?', 'answer' => 'Security features include role-based access control (RBAC), database field encryption, SSL/TLS transport security, automated daily backups, and detailed user audit logs.'],
                ['question' => 'Can custom software integrate with mobile apps for field staff?', 'answer' => 'Yes. Companion Flutter mobile apps connect via RESTful APIs for field sales agents, delivery teams, or remote supervisors.'],
                ['question' => 'What hosting servers are recommended for enterprise business software?', 'answer' => 'Secure cloud VPS hosting platforms like AWS EC2, DigitalOcean Droplets, or Linode VPS provide reliable performance, high uptime, and automated backup options.'],
                ['question' => 'How long does custom business software development take?', 'answer' => 'Typical development timelines range from 4 to 8 weeks for standard business management tools to 8-16 weeks for complex enterprise platforms.'],
                ['question' => 'Who owns the intellectual property and source code?', 'answer' => 'Your company retains 100% full intellectual property (IP) rights and complete source code files upon project completion.'],
                ['question' => 'Do software companies in Lucknow provide user training for employees?', 'answer' => 'Yes. Delivery includes comprehensive hands-on staff training sessions, video walkthroughs, and user manual documentation.'],
                ['question' => 'What ongoing technical support options are offered post-launch?', 'answer' => 'Structured Service Level Agreements (SLAs) cover 24/7 server health monitoring, security patches, bug fixes, database optimization, and continuous feature upgrades.'],
                ['question' => 'How can I get an accurate cost quote for a software solution?', 'answer' => 'List your core business modules, target user roles, and desired integrations, then schedule a discovery call with a software architect.'],
            ],
        ];

        $data['slug'] = $slug;
        $data['faqs'] = $this->ensureTenSolutionFaqs($data['faqs'] ?? [], $data['h1'] ?? $slug, $slug);

        return $data;
    }
}
