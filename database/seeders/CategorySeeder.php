<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Software Development', 'slug' => 'software-development', 'description' => 'Custom software architecture, enterprise systems, and engineering best practices.'],
            ['name' => 'Web Development', 'slug' => 'web-development', 'description' => 'Frontend & backend web applications, full-stack frameworks, and web design.'],
            ['name' => 'Mobile App Development', 'slug' => 'mobile-apps', 'description' => 'iOS, Android, Flutter, and cross-platform mobile application engineering.'],
            ['name' => 'Business Software', 'slug' => 'business-software', 'description' => 'ERP, CRM, HRMS, and enterprise automation solutions.'],
            ['name' => 'ERP Solutions', 'slug' => 'erp', 'description' => 'Enterprise Resource Planning architecture, module design, and implementation.'],
            ['name' => 'CRM Systems', 'slug' => 'crm', 'description' => 'Customer Relationship Management strategies, sales funnels, and customer automation.'],
            ['name' => 'AI & Automation', 'slug' => 'ai', 'description' => 'Artificial intelligence, machine learning models, and workflow automation.'],
            ['name' => 'Lucknow IT News', 'slug' => 'lucknow-it', 'description' => 'IT ecosystem developments, tech updates, and software hubs in Lucknow.'],
            ['name' => 'Software Cost Guides', 'slug' => 'software-cost-guides', 'description' => 'Pricing estimates, development budget guides, and ROI analysis.'],
            ['name' => 'Tutorials & Engineering', 'slug' => 'tutorials', 'description' => 'Technical walkthroughs, coding benchmarks, and architectural guides.'],
            ['name' => 'Industry Solutions', 'slug' => 'industry-solutions', 'description' => 'Healthcare, education, retail, real estate, and finance software solutions.'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
