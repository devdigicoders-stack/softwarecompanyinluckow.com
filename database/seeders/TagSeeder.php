<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Laravel', 'PHP', 'Flutter', 'React', 'Node.js', 'Python',
            'Custom ERP', 'CRM', 'HRMS', 'School Software', 'Hospital ERP',
            'Software Cost', 'Lucknow IT', 'Gomti Nagar', 'API Development',
            'Cloud AWS', 'Cybersecurity', 'Mobile App', 'Web Design', 'SaaS',
        ];

        foreach ($tags as $tagName) {
            Tag::updateOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName]
            );
        }
    }
}
