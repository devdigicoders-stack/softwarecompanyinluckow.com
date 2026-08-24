<?php

namespace App\Http\Controllers;

use App\Models\ClickTracking;
use App\Models\ProviderLink;
use Illuminate\Http\Request;

class ClickTrackerController extends Controller
{
    public function track(Request $request)
    {
        $category = $request->query('category', 'general');
        $ctaType = $request->query('cta', 'inline');
        $customTarget = $request->query('target');

        // Look up link map or default to homepage
        $providerLink = ProviderLink::where('service_category', $category)
            ->where('is_active', true)
            ->first();

        $targetUrl = $customTarget ?? ($providerLink->target_url ?? 'https://softwarecompanyinlucknow.com/');

        if ($providerLink) {
            $providerLink->increment('click_count');
        }

        // Log click details
        ClickTracking::create([
            'provider_link_id' => $providerLink?->id,
            'target_url' => $targetUrl,
            'referrer_url' => $request->headers->get('referer'),
            'cta_type' => $ctaType,
            'user_ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->away($targetUrl);
    }
}
