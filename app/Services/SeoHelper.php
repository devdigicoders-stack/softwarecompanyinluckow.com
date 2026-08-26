<?php

namespace App\Services;

class SeoHelper
{
    public static function defaultMeta(): array
    {
        $baseUrl = config('app.url', 'https://softwarecompanyinlucknow.com');

        return [
            'title' => 'Software Company in Lucknow | Website Development, Mobile App & Custom Software',
            'description' => 'Top software company in Lucknow for website development, mobile app development (Android & iOS), custom ERP, CRM, billing software, and transparent software development cost guides.',
            'keywords' => 'website development company in lucknow, mobile app development company in lucknow, custom software development lucknow, erp software in lucknow, crm software lucknow, billing software lucknow, website banwane ke liye company, app development cost lucknow, software cost in lucknow, top software companies in lucknow',
            'canonical' => url()->current(),
            'og_type' => 'website',
            'og_image' => $baseUrl.'/images/og-default.jpg',
            'author' => 'Software Company in Lucknow',
            'robots' => 'index, follow',
        ];
    }

    public static function generateOrganizationSchema(): array
    {
        $baseUrl = config('app.url', 'https://softwarecompanyinlucknow.com');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Software Company in Lucknow',
            'url' => $baseUrl,
            'logo' => $baseUrl.'/images/logo.png',
            'description' => 'Premier software development company and technology news publication in Lucknow providing custom software, mobile apps, web applications, ERP, and CRM solutions.',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Cyber Heights, Vibhuti Khand, Gomti Nagar',
                'addressLocality' => 'Lucknow',
                'addressRegion' => 'Uttar Pradesh',
                'postalCode' => '226010',
                'addressCountry' => 'IN',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+91-9876543210',
                'contactType' => 'customer service',
                'areaServed' => 'IN',
                'availableLanguage' => ['English', 'Hindi'],
            ],
            'sameAs' => [
                'https://facebook.com/softwarecompanyinlucknow',
                'https://twitter.com/software_lko',
                'https://linkedin.com/company/softwarecompanyinlucknow',
            ],
        ];
    }

    public static function generateLocalBusinessSchema(): array
    {
        $baseUrl = config('app.url', 'https://softwarecompanyinlucknow.com');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'ITService',
            'name' => 'Software Company in Lucknow',
            'image' => $baseUrl.'/images/og-default.jpg',
            '@id' => $baseUrl.'/#organization',
            'url' => $baseUrl,
            'telephone' => '+91-9876543210',
            'priceRange' => '₹₹₹',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Cyber Heights, Vibhuti Khand, Gomti Nagar',
                'addressLocality' => 'Lucknow',
                'addressRegion' => 'Uttar Pradesh',
                'postalCode' => '226010',
                'addressCountry' => 'IN',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 26.8500,
                'longitude' => 80.9999,
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                ],
                'opens' => '09:00',
                'closes' => '19:00',
            ],
        ];
    }

    public static function generateBreadcrumbSchema(array $items): array
    {
        $list = [];
        $position = 1;

        foreach ($items as $name => $url) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $name,
                'item' => $url,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $list,
        ];
    }

    public static function generateArticleSchema($post): array
    {
        $baseUrl = config('app.url', 'https://softwarecompanyinlucknow.com');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'description' => $post->excerpt,
            'image' => [
                $post->featured_image ? (str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset($post->featured_image)) : $baseUrl.'/images/og-default.jpg',
            ],
            'datePublished' => $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $post->author ? $post->author->name : 'Tech Editorial Team',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Software Company in Lucknow',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $baseUrl.'/images/logo.png',
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('blogs.show', $post->slug),
            ],
        ];
    }

    public static function generateFaqSchema(array $faqs): array
    {
        $faqItems = [];

        foreach ($faqs as $faq) {
            if (isset($faq['question']) && isset($faq['answer'])) {
                $faqItems[] = [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'],
                    ],
                ];
            }
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqItems,
        ];
    }
}
