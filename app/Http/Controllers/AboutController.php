<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
use App\Models\SoftwareSolution;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function show(): View
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $solutions = SoftwareSolution::where('is_active', true)->orderBy('sort_order')->take(6)->get();

        $aboutFaqs = Faq::getForPage('about');

        $breadcrumbs = [
            'Home' => route('home'),
            'About Us' => null,
        ];

        return view('about', compact('services', 'solutions', 'aboutFaqs', 'breadcrumbs'));
    }
}
