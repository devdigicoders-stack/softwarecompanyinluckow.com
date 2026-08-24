<x-layout 
    :title="$location->meta_title ?? ($location->h1_title . ' | Software Company in Lucknow')"
    :description="$location->meta_description ?? $location->excerpt"
    :canonical="$location->canonical_url ?? route('locations.show', $location->slug)"
    :faqs="$location->faqs"
    :breadcrumbs="$breadcrumbs"
>
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <span class="badge bg-primary text-uppercase px-3 py-2 mb-3">Lucknow IT Hub</span>
            <h1 class="display-5 fw-bold text-slate-900 mb-3">{{ $location->h1_title }}</h1>
            <p class="lead text-slate-600 mb-4">{{ $location->excerpt }}</p>
            <div class="d-flex flex-wrap align-items-center gap-3 mb-2" style="gap: 12px;">
                <a href="tel:919198483820" class="btn btn-primary btn-lg fw-bold">
                    <i class="bi bi-telephone-fill me-1.5"></i> Call: +91 9198483820
                </a>
                <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20software%20services%20in%20{{ urlencode($location->area_name) }}" target="_blank" rel="noopener" class="btn btn-success btn-lg fw-bold text-white" style="background-color: #25D366; border-color: #25D366;">
                    <i class="bi bi-whatsapp me-1.5"></i> WhatsApp
                </a>
            </div>
        </div>
    </section>

    <section class="py-5 bg-slate-50">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="editorial-article">
                        <div class="article-body-content">
                            {!! $location->content !!}
                        </div>

                        @if(!empty($location->faqs))
                            <div class="mt-5 pt-4 border-top">
                                <h3 class="fw-bold text-slate-900 mb-4"><i class="bi bi-question-circle text-primary me-2"></i> Local IT FAQs: {{ $location->area_name }}</h3>
                                <x-faq-accordion :faqs="$location->faqs" id="locationFaqsAccordion" />
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-widget mb-4">
                        <h4 class="widget-title"><i class="bi bi-geo-alt text-primary me-2"></i> Other IT Hubs in Lucknow</h4>
                        <div class="list-group list-group-flush">
                            @foreach($allLocations as $loc)
                                <a href="{{ route('locations.show', $loc->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                                    <span class="fw-semibold text-slate-800"><i class="bi bi-building me-2 text-primary"></i> {{ $loc->area_name }}</span>
                                    <i class="bi bi-chevron-right text-muted small"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-4 rounded-4 bg-dark text-white shadow-sm text-center">
                        <i class="bi bi-headset fs-1 text-primary mb-2 d-block"></i>
                        <h5 class="fw-bold text-white mb-2">Software Services in {{ $location->area_name }}</h5>
                        <p class="small text-slate-300 mb-3">Speak directly with lead software engineers in Lucknow.</p>
                        <div class="d-flex flex-column gap-2 mb-2">
                            <a href="tel:919198483820" class="btn btn-primary btn-sm fw-bold w-100 py-2">
                                <i class="bi bi-telephone-fill me-1"></i> Call: +91 9198483820
                            </a>
                            <a href="tel:916394296293" class="btn btn-outline-light btn-sm fw-bold w-100 py-2">
                                <i class="bi bi-telephone-fill me-1"></i> Call: +91 6394296293
                            </a>
                            <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20software%20services%20in%20{{ urlencode($location->area_name) }}" target="_blank" rel="noopener" class="btn text-white btn-sm fw-bold w-100 py-2" style="background-color: #25D366; border-color: #25D366;">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp: +91 6394296293
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
