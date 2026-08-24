<x-layout 
    title="Search Results | Software Company in Lucknow"
    description="Search results for software development, web development, app development, and business software in Lucknow."
    :breadcrumbs="$breadcrumbs ?? []"
    :faqs="$searchFaqs ?? []"
>
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <h1 class="h2 fw-bold text-slate-900 mb-3">Search Results for: "{{ $query }}"</h1>
            
            <form action="{{ route('search') }}" method="GET" class="max-w-2xl">
                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" name="q" class="form-control" placeholder="Search services, articles, solutions..." value="{{ $query }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Search</button>
                </div>
            </form>
        </div>
    </section>

    <section class="py-5 bg-slate-50">
        <div class="container">
            @if(!empty($query))
                <!-- Services & Solutions Found -->
                @if($services->count() > 0 || $solutions->count() > 0)
                    <div class="mb-5">
                        <h3 class="fw-bold text-slate-900 mb-4"><i class="bi bi-gear-wide-connected text-primary me-2"></i> Matching Services & Software Solutions</h3>
                        <div class="row g-4">
                            @foreach($services as $service)
                                <div class="col-md-4">
                                    <x-service-card :service="$service" />
                                </div>
                            @endforeach
                            @foreach($solutions as $solution)
                                <div class="col-md-4">
                                    <x-solution-card :solution="$solution" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Blog Articles Found -->
                @if($posts->count() > 0)
                    <div>
                        <h3 class="fw-bold text-slate-900 mb-4"><i class="bi bi-journal-text text-primary me-2"></i> Related Articles & Insights</h3>
                        <div class="row g-4">
                            @foreach($posts as $post)
                                <div class="col-md-4">
                                    <x-tech-news-card :post="$post" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($services->isEmpty() && $solutions->isEmpty() && $posts->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-search-heart display-1 text-muted"></i>
                        <h4 class="mt-3 text-slate-700">No results found for "{{ $query }}"</h4>
                        <p class="text-muted">Try searching with broader terms like "Software", "Web Development", or "Cost".</p>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <p class="text-muted">Please enter a search query above.</p>
                </div>
            @endif

            @if(!empty($searchFaqs))
                <div class="mt-5 pt-4 border-top">
                    <x-faq-accordion :faqs="$searchFaqs" />
                </div>
            @endif
        </div>
    </section>
</x-layout>
