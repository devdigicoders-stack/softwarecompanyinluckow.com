<?php

namespace Database\Seeders;

use App\Models\SoftwareSolution;
use Illuminate\Database\Seeder;

class SolutionSeeder extends Seeder
{
    public function run(): void
    {
        $solutions = [
            [
                'title' => 'HRMS Software in Lucknow',
                'slug' => 'hrms-software-in-lucknow',
                'h1_title' => 'HRMS Software in Lucknow',
                'tagline' => 'Human Resource Management & Automated Payroll System',
                'excerpt' => 'Complete HRMS software in Lucknow for attendance tracking, biometric integration, automated payroll, leave management, and employee self-service portals.',
                'content' => '<h2>Complete Human Resource & Payroll Management Software</h2><p>Streamline employee operations with our automated HRMS software in Lucknow. Manage biometric attendance, calculate complex salary structures with PF/ESI deductions, track leave requests, and provide employees with a self-service mobile portal.</p>',
                'icon' => 'bi-person-badge-fill',
                'features' => [
                    ['title' => 'Biometric & Geo-Attendance', 'desc' => 'Sync face scanners and GPS mobile punch-ins.'],
                    ['title' => 'Automated Payroll & Payslips', 'desc' => 'Generate instant PDF payslips with PF/ESI/TDS tax deductions.'],
                ],
                'pricing_factors' => [
                    ['factor' => 'Employee Count', 'desc' => 'Tiered pricing based on total active active workforce numbers.'],
                    ['factor' => 'Biometric Hardware Sync', 'desc' => 'API setup fees for custom attendance machine integration.'],
                ],
                'sort_order' => 1,
            ],
            [
                'title' => 'School Management Software in Lucknow',
                'slug' => 'school-management-software-in-lucknow',
                'h1_title' => 'School Management Software in Lucknow',
                'tagline' => 'Comprehensive ERP for Schools, Colleges & Coaching Institutes',
                'excerpt' => 'Advanced school management software in Lucknow with online fee collection, student report cards, SMS alerts, timetable generator, and parent app.',
                'content' => '<h2>School ERP & Campus Management System</h2><p>Digitize school administration with an all-in-one School ERP system. Automate online fee collection via UPI/Netbanking, send instant homework & attendance SMS notifications to parents, generate automated report cards, and manage library & hostel records.</p>',
                'icon' => 'bi-book-fill',
                'sort_order' => 2,
            ],
            [
                'title' => 'Hospital Management Software in Lucknow',
                'slug' => 'hospital-management-software-in-lucknow',
                'h1_title' => 'Hospital Management Software in Lucknow',
                'tagline' => 'Integrated Healthcare ERP, OPD/IPD Billing & EMR Software',
                'excerpt' => 'NABH-compliant hospital management software in Lucknow for OPD registration, IPD bed management, electronic medical records (EMR), and pharmacy inventory.',
                'content' => '<h2>NABH-Compliant Hospital Information System (HIS)</h2><p>Enhance patient care and clinical operations with custom Hospital Management Software. Features OPD patient queues, IPD admission & bed allocation, digital doctor prescription templates, ICMR lab reporting, and pharmacy billing automation.</p>',
                'icon' => 'bi-hospital-fill',
                'sort_order' => 3,
            ],
            [
                'title' => 'Billing Software in Lucknow',
                'slug' => 'billing-software-in-lucknow',
                'h1_title' => 'Billing & GST Invoicing Software in Lucknow',
                'tagline' => 'Fast Point-of-Sale (POS) & GST Accounting Software',
                'excerpt' => 'Easy-to-use billing software in Lucknow for retail shops, wholesalers, and service businesses with GST invoicing, barcode printing, and inventory sync.',
                'content' => '<h2>Fast GST Invoicing & POS Billing System</h2><p>Speed up checkout queues with responsive GST billing software. Print thermal invoices, generate e-way bills, track inventory stock alerts, and reconcile GST returns effortlessly.</p>',
                'icon' => 'bi-receipt-cutoff',
                'sort_order' => 4,
            ],
            [
                'title' => 'Inventory Management Software in Lucknow',
                'slug' => 'inventory-management-software-in-lucknow',
                'h1_title' => 'Inventory Management Software in Lucknow',
                'tagline' => 'Stock Tracking, Warehouse & Purchase Order Management Software',
                'excerpt' => 'Smart inventory management software in Lucknow with multi-warehouse stock sync, batch/expiry tracking, low stock alerts, and purchase orders.',
                'content' => '<h2>Real-Time Warehouse & Stock Control System</h2><p>Prevent stockouts and overstock costs with custom Inventory Management Software. Track batch numbers, expiry dates, serial numbers, and warehouse transfers across multiple locations in Lucknow.</p>',
                'icon' => 'bi-boxes',
                'sort_order' => 5,
            ],
            [
                'title' => 'MLM Software Company in Lucknow',
                'slug' => 'mlm-software-company-in-lucknow',
                'h1_title' => 'MLM Software Company in Lucknow',
                'tagline' => 'Binary, Matrix, Generation & Hybrid Multi-Level Marketing Software',
                'excerpt' => 'Custom MLM software development in Lucknow with automated commission calculation, distributor genealogy tree, e-wallet, and payout reports.',
                'content' => '<h2>Secure & Scalable Multi-Level Marketing Software</h2><p>Launch your network marketing company with custom MLM software engineered for accuracy and speed. Supports Binary, Matrix, Generation, Board, and Level plan calculations with instant e-wallet payouts.</p>',
                'icon' => 'bi-share-fill',
                'sort_order' => 6,
            ],
            [
                'title' => 'Restaurant Management Software in Lucknow',
                'slug' => 'restaurant-management-software-in-lucknow',
                'h1_title' => 'Restaurant Management & POS Software in Lucknow',
                'tagline' => 'KOT Billing, Table Management & Swiggy/Zomato API Integration',
                'excerpt' => 'All-in-one restaurant POS billing software in Lucknow with Kitchen Order Tickets (KOT), QR digital menus, recipe costing, and online order aggregator sync.',
                'content' => '<h2>Restaurant POS & Kitchen Automation System</h2><p>Accelerate table turnaround and kitchen delivery with custom Restaurant Management Software. Print instant KOTs, manage table reservations, track raw ingredient inventory, and sync orders from Swiggy & Zomato.</p>',
                'icon' => 'bi-cup-hot-fill',
                'sort_order' => 7,
            ],
            [
                'title' => 'Hotel Management Software in Lucknow',
                'slug' => 'hotel-management-software-in-lucknow',
                'h1_title' => 'Hotel Management Software in Lucknow',
                'tagline' => 'Property Management System (PMS) & Online Room Booking Engine',
                'excerpt' => 'Custom hotel management software in Lucknow for front desk booking, housekeeping status, room service billing, and OTA channel manager sync.',
                'content' => '<h2>Hotel Property Management System (PMS)</h2><p>Streamline resort and hotel operations with an integrated PMS. Manage front desk guest check-ins, room availability grid, housekeeping schedules, and OTA channel manager integrations (MakeMyTrip, Goibibo, Booking.com).</p>',
                'icon' => 'bi-building-fill-check',
                'sort_order' => 8,
            ],
            [
                'title' => 'ERP Software Development Lucknow',
                'slug' => 'erp-software-development-lucknow',
                'h1_title' => 'ERP Software Development Solutions in Lucknow',
                'tagline' => 'Enterprise System Integration & Tailored ERP Architecture',
                'excerpt' => 'Custom ERP software development services in Lucknow connecting accounting, inventory, manufacturing, and HR into one secure cloud application.',
                'content' => '<h2>Custom ERP Architecture & Development</h2><p>Build custom ERP solutions designed specifically around your enterprise operational workflows. Gain real-time executive dashboard visibility into business profitability, inventory turnover, and employee efficiency.</p>',
                'icon' => 'bi-diagram-3',
                'sort_order' => 9,
            ],
            [
                'title' => 'CRM Software Development Lucknow',
                'slug' => 'crm-software-development-lucknow',
                'h1_title' => 'CRM Software Development in Lucknow',
                'tagline' => 'Custom Sales Automation & Customer Engagement Architecture',
                'excerpt' => 'Bespoke CRM software development in Lucknow for automated lead assignment, sales pipeline analytics, and multi-channel customer communication.',
                'content' => '<h2>Custom CRM Engineering Solutions</h2><p>Supercharge your sales team with bespoke CRM software tailored for Indian business environments. Integrate WhatsApp API, IVR call recording, email drip campaigns, and automated lead scoring.</p>',
                'icon' => 'bi-person-badge',
                'sort_order' => 10,
            ],
        ];

        foreach ($solutions as $sol) {
            SoftwareSolution::updateOrCreate(['slug' => $sol['slug']], $sol);
        }
    }
}
