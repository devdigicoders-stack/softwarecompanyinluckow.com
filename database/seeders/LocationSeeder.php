<?php

namespace Database\Seeders;

use App\Models\LocationPage;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'area_name' => 'Gomti Nagar',
                'slug' => 'gomti-nagar',
                'h1_title' => 'Software Company in Gomti Nagar, Lucknow',
                'excerpt' => 'Leading software development company serving tech startups, IT firms, and corporate offices across Gomti Nagar, Lucknow.',
                'content' => '<h2>Software Development Services in Gomti Nagar, Lucknow</h2><p>Gomti Nagar is the premier commercial and IT hub of Lucknow, housing major tech parks, corporate offices, and fast-growing enterprises. Our software company provides custom web application engineering, mobile app development, ERP, and CRM solutions for businesses located across Gomti Nagar Phase 1, Phase 2, and Gomti Nagar Extension.</p>',
                'faqs' => [
                    ['question' => 'Where is your software development office located in Gomti Nagar?', 'answer' => 'Our corporate technical facility is located at Cyber Heights, Vibhuti Khand, Gomti Nagar, Lucknow.'],
                ],
            ],
            [
                'area_name' => 'Hazratganj',
                'slug' => 'hazratganj',
                'h1_title' => 'Software & Web Development Company in Hazratganj, Lucknow',
                'excerpt' => 'Custom software engineering and web application development for retail brands, trading houses, and commercial establishments in Hazratganj.',
                'content' => '<h2>Custom IT & Software Solutions in Hazratganj</h2><p>Hazratganj is the central business district of Lucknow. We empower local retailers, showrooms, legal firms, and corporate entities in Hazratganj with modern POS software, e-commerce web portals, and custom CRM software.</p>',
            ],
            [
                'area_name' => 'Aliganj',
                'slug' => 'aliganj',
                'h1_title' => 'Software Company in Aliganj, Lucknow',
                'excerpt' => 'Enterprise software development, billing software, and custom mobile app solutions for businesses in Aliganj, Lucknow.',
                'content' => '<h2>Software Engineering Services in Aliganj</h2><p>Aliganj is a major commercial and educational hub in North Lucknow. We deliver custom school management software, billing applications, and custom web portals for businesses operating in Aliganj.</p>',
            ],
            [
                'area_name' => 'Indira Nagar',
                'slug' => 'indira-nagar',
                'h1_title' => 'Software Development Company in Indira Nagar, Lucknow',
                'excerpt' => 'Tailored software solutions, mobile app development, and ERP systems for enterprises in Indira Nagar, Lucknow.',
                'content' => '<h2>IT & Web Engineering Services in Indira Nagar</h2><p>Providing robust custom software development, inventory management software, and mobile apps for enterprises and commercial stores in Indira Nagar.</p>',
            ],
            [
                'area_name' => 'Vibhuti Khand',
                'slug' => 'vibhuti-khand',
                'h1_title' => 'Software Development Company in Vibhuti Khand, Gomti Nagar',
                'excerpt' => 'Enterprise cloud software, SaaS platform development, and custom web solutions in Vibhuti Khand IT zone.',
                'content' => '<h2>High-Tech Software Development in Vibhuti Khand</h2><p>Vibhuti Khand is home to Lucknow\'s IT towers and financial institutions. We provide enterprise-grade Laravel development, Python microservices, and mobile app development right from the heart of Vibhuti Khand.</p>',
            ],
            [
                'area_name' => 'Faizabad Road',
                'slug' => 'faizabad-road',
                'h1_title' => 'Software Company on Faizabad Road, Lucknow',
                'excerpt' => 'Custom software, school management ERP, and web development along the Faizabad Road tech corridor.',
                'content' => '<h2>Software Engineering along Faizabad Road Corridor</h2><p>Serving educational institutes, hospitals, and real estate developers along Faizabad Road with custom ERPs, billing software, and mobile applications.</p>',
            ],
            [
                'area_name' => 'Mahanagar',
                'slug' => 'mahanagar',
                'h1_title' => 'Software Company in Mahanagar, Lucknow',
                'tagline' => 'Professional Web & Mobile Software Solutions in Mahanagar',
                'excerpt' => 'Custom web development, mobile apps, and billing software for commercial businesses in Mahanagar.',
                'content' => '<h2>Custom Web & Software Development in Mahanagar</h2><p>Delivering high-performance business software, website design, and mobile app solutions for merchants and healthcare providers in Mahanagar, Lucknow.</p>',
            ],
            [
                'area_name' => 'Alambagh',
                'slug' => 'alambagh',
                'h1_title' => 'Software Development Company in Alambagh, Lucknow',
                'excerpt' => 'Billing software, inventory management, and mobile apps for retail and wholesale hubs in Alambagh.',
                'content' => '<h2>Retail & ERP Software Solutions in Alambagh</h2><p>Alambagh is one of Lucknow\'s major transportation and retail trading hubs. We build fast POS billing software, inventory tracking tools, and custom mobile apps for traders in Alambagh.</p>',
            ],
            [
                'area_name' => 'Chinhat',
                'slug' => 'chinhat',
                'h1_title' => 'Software Company in Chinhat Industrial Area, Lucknow',
                'excerpt' => 'Industrial ERP, manufacturing software, and warehouse inventory systems in Chinhat, Lucknow.',
                'content' => '<h2>Manufacturing & Industrial ERP Software in Chinhat</h2><p>Providing specialized manufacturing ERP software, warehouse management tools, and supply chain applications for industrial units in Chinhat.</p>',
            ],
        ];

        foreach ($locations as $loc) {
            LocationPage::updateOrCreate(['slug' => $loc['slug']], $loc);
        }
    }
}
