<?php

namespace Database\Seeders;

use App\Models\ProviderLink;
use App\Models\RecommendedProvider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        $provider = RecommendedProvider::firstOrCreate(
            ['slug' => 'lucknow-it-solutions'],
            [
                'name' => 'Lucknow IT Solutions',
                'logo' => '/images/logo.png',
                'short_description' => 'Custom software development, web applications, mobile apps and business software solutions.',
                'full_description' => 'Lucknow IT Solutions is a software development provider in Lucknow delivering tailored enterprise software, web applications, Android/iOS mobile apps, and ERP/CRM systems for businesses.',
                'services' => [
                    'Custom Software Development',
                    'Web Application Development',
                    'Mobile App Development (Flutter/Android/iOS)',
                    'ERP & CRM Software Systems',
                    'E-commerce Solutions',
                    'API & Cloud Infrastructure',
                ],
                'technologies' => [
                    'PHP',
                    'Laravel',
                    'Flutter',
                    'React',
                    'Node.js',
                    'Python',
                    'MySQL',
                ],
                'location' => 'Lucknow, Uttar Pradesh',
                'official_website' => 'https://softwarecompanyinlucknow.com/',
                'disclosure_note' => 'Some recommendations on this website may be associated with premier IT software providers in Lucknow.',
                'is_active' => true,
            ]
        );

        $defaultLinks = [
            [
                'anchor_text' => 'software development services',
                'target_url' => 'https://softwarecompanyinlucknow.com/',
                'service_category' => 'software',
                'context_notes' => 'General software development recommendations',
            ],
            [
                'anchor_text' => 'website development services',
                'target_url' => 'https://softwarecompanyinlucknow.com/',
                'service_category' => 'web',
                'context_notes' => 'Web development recommendation',
            ],
            [
                'anchor_text' => 'mobile app development',
                'target_url' => 'https://softwarecompanyinlucknow.com/',
                'service_category' => 'app',
                'context_notes' => 'Mobile application development recommendation',
            ],
            [
                'anchor_text' => 'ERP software solutions',
                'target_url' => 'https://softwarecompanyinlucknow.com/',
                'service_category' => 'erp',
                'context_notes' => 'ERP business software recommendation',
            ],
            [
                'anchor_text' => 'CRM software solutions',
                'target_url' => 'https://softwarecompanyinlucknow.com/',
                'service_category' => 'crm',
                'context_notes' => 'CRM software recommendation',
            ],
            [
                'anchor_text' => 'HRMS software',
                'target_url' => 'https://softwarecompanyinlucknow.com/',
                'service_category' => 'hrms',
                'context_notes' => 'HRMS & payroll recommendation',
            ],
        ];

        foreach ($defaultLinks as $link) {
            ProviderLink::firstOrCreate(
                ['anchor_text' => $link['anchor_text']],
                array_merge($link, ['recommended_provider_id' => $provider->id])
            );
        }
    }
}
