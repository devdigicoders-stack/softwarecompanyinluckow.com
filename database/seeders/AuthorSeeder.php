<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Vikramaditya Roy',
                'slug' => 'vikramaditya-roy',
                'role' => 'Principal Software Architect',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'bio' => 'Senior Technical Architect with 14+ years of expertise in enterprise PHP, Laravel, cloud architecture, and microservices design.',
                'twitter' => '@vroy_tech',
                'linkedin' => 'https://linkedin.com/in/vroy-tech',
            ],
            [
                'name' => 'Ananya Srivastava',
                'slug' => 'ananya-srivastava',
                'role' => 'Lead Editor & Tech Analyst',
                'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=200&q=80',
                'bio' => 'Technology Journalist and ERP Consultant specializing in business software analysis, cost modeling, and digital transformation in Uttar Pradesh.',
                'twitter' => '@ananya_editor',
                'linkedin' => 'https://linkedin.com/in/ananya-tech-editor',
            ],
            [
                'name' => 'Siddharth Verma',
                'slug' => 'siddharth-verma',
                'role' => 'Head of Mobile Engineering',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'bio' => 'Mobile Applications Lead specialized in cross-platform Flutter engineering, React Native, and high-concurrency cloud backend integrations.',
                'twitter' => '@sidd_mobile',
                'linkedin' => 'https://linkedin.com/in/siddharth-verma-mobile',
            ],
        ];

        foreach ($authors as $author) {
            Author::updateOrCreate(['slug' => $author['slug']], $author);
        }
    }
}
