<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\LocationPage;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class LocationController extends Controller
{
    public function show(string $slug): View
    {
        $location = LocationPage::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $allLocations = LocationPage::where('is_active', true)
            ->where('id', '!=', $location->id)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $relatedPosts = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $breadcrumbs = [
            'Home' => route('home'),
            'Lucknow Local IT Hubs' => route('locations.show', 'gomti-nagar'),
            $location->area_name => null,
        ];

        $location->faqs = $this->ensureTenLocationFaqs($location->faqs ?? [], $location->area_name, $slug);

        return view('locations.show', compact('location', 'allLocations', 'services', 'relatedPosts', 'breadcrumbs'));
    }

    private function ensureTenLocationFaqs(array $faqs, string $areaName, string $slug = ''): array
    {
        if (! empty($slug)) {
            $dbFaqs = Faq::getForPage($slug);
            if ($dbFaqs->isEmpty()) {
                $dbFaqs = Faq::getForPage('locations');
            }
            if ($dbFaqs->isNotEmpty()) {
                return $dbFaqs->toArray();
            }
        }
        if (count($faqs) >= 10) {
            return $faqs;
        }

        $defaultFillers = [
            ['question' => 'Are software development services available in '.$areaName.', Lucknow?', 'answer' => 'Yes. Software Company in Lucknow provides full-stack software development, custom web applications, mobile apps, ERP systems, and IT consultation for businesses in '.$areaName.' and surrounding Lucknow hubs.'],
            ['question' => 'Can we schedule an in-person software consultation in '.$areaName.'?', 'answer' => 'Yes! Our engineering team conducts in-person discovery meetings in '.$areaName.', or you can visit our corporate headquarters in Aliganj, Lucknow.'],
            ['question' => 'What software engineering tech stacks are available for businesses in '.$areaName.'?', 'answer' => 'We specialize in modern tech stacks including Laravel 12 (PHP 8.2+), Flutter for Android & iOS mobile apps, React, Vue.js, Node.js, and AWS cloud hosting.'],
            ['question' => 'Who owns the full source code and intellectual property rights?', 'answer' => 'Clients retain 100% full intellectual property (IP) rights, uncompiled source code repositories, and database schemas upon project completion.'],
            ['question' => 'Do software development contracts in '.$areaName.' include NDAs?', 'answer' => 'Yes. We sign bilateral Non-Disclosure Agreements (NDAs) prior to project discovery to protect business logic and confidential data.'],
            ['question' => 'How much does custom software development cost for companies in '.$areaName.'?', 'answer' => 'Software pricing ranges from ₹15,000 for standard websites to ₹45,000-₹2,50,000+ for enterprise web applications, ERPs, and mobile apps.'],
            ['question' => 'What is the typical software development timeline for clients in '.$areaName.'?', 'answer' => 'Timelines range from 2 weeks for business portals to 4-12 weeks for complex custom enterprise software platforms.'],
            ['question' => 'Do you provide post-launch SLA technical support in '.$areaName.'?', 'answer' => 'Yes. We provide formal Service Level Agreements (SLAs) covering 24/7 server health monitoring, security patches, bug fixes, and feature updates.'],
            ['question' => 'Can custom software integrate with payment gateways and WhatsApp APIs?', 'answer' => 'Yes. Custom applications integrate RESTful APIs for Razorpay, Paytm, PhonePe, official WhatsApp Business APIs, and biometric hardware.'],
            ['question' => 'How can a business in '.$areaName.' get a free technical quote?', 'answer' => 'Call 0522-4235604 / +91 6394296293 or submit a consultation request on our contact portal to receive an itemized proposal.'],
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
