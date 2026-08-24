<x-layout title="Technology News, Software Guides & IT Insights | Lucknow Tech Portal"
    description="Stay updated with software development trends, enterprise tech cost guides, ERP/CRM analysis, and local Lucknow IT ecosystem updates."
    :breadcrumbs="$breadcrumbs"
    :faqs="$faqs ?? []">
    <!-- Portal Header Hero -->
    <section class="hero-portal py-5">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span
                        class="badge bg-emerald-500 text-white rounded-pill px-3 py-2 mb-3 font-monospace text-uppercase fw-bold shadow-sm"
                        style="font-size: 0.75rem; background-color: #059669;">
                        <i class="bi bi-journal-text me-1"></i> Official Tech Publication
                    </span>
                    <h1 class="display-5 fw-extrabold text-white mb-3 tracking-tight">Software & Technology <span
                            class="text-gradient-blue" style="background: linear-gradient(135deg, #34d399 0%, #10b981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Journal</span></h1>
                    <p class="hero-subtitle mb-0 text-slate-300 fs-6">
                        In-depth technical analysis, software development cost guides, technology architecture insights,
                        and IT industry news from Lucknow.
                    </p>
                </div>

                <div class="col-lg-6">
                    <form action="{{ route('blog.index') }}" method="GET" id="searchForm" class="w-100 ms-lg-auto" style="max-width: 540px;">
                        <div class="hero-search-pill position-relative d-flex align-items-center bg-white rounded-pill p-1.5 shadow-lg border border-white-20">
                            <span class="ps-3 pe-2 text-emerald-600 d-flex align-items-center"><i class="bi bi-search fs-5" style="color: #059669;"></i></span>
                            <input type="text" name="search" id="searchInput" class="form-control border-0 shadow-none bg-transparent py-2.5 px-1 text-slate-800 fw-medium" placeholder="Search articles, guides & topics..." value="{{ request('search') }}" style="font-size: 0.95rem;">
                            @if(request('search'))
                                <a href="{{ route('blog.index') }}" class="btn text-slate-400 p-0 me-2" title="Clear Search"><i class="bi bi-x-circle-fill fs-5"></i></a>
                            @endif
                            <button class="btn rounded-pill px-4 py-2.5 fw-bold text-white flex-shrink-0 d-inline-flex align-items-center gap-1.5 shadow-sm" type="submit" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); border: none;">
                                <span>Search</span> <i class="bi bi-arrow-right-short fs-5"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- AJAX Filter Category Strip (Scrollable & Responsive) -->
    <section class="category-filter-bar bg-white border-bottom sticky-top py-3" style="top: 0; z-index: 1020; backdrop-filter: blur(12px); background: rgba(255,255,255,0.95);">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <!-- Scrollable Categories Buttons Strip -->
                <div class="category-scroll-wrapper flex-grow-1 overflow-auto me-2">
                    <div class="d-flex align-items-center gap-2 text-nowrap pb-1" id="categoryButtons">
                        <button class="btn cat-pill-btn {{ !request('category') ? 'active' : '' }} filter-cat-btn flex-shrink-0"
                            data-category="">
                            All Categories
                        </button>
                        @foreach($categories as $cat)
                            <button
                                class="btn cat-pill-btn {{ request('category') === $cat->slug ? 'active' : '' }} filter-cat-btn flex-shrink-0"
                                data-category="{{ $cat->slug }}">
                                {{ $cat->name }} <span class="cat-pill-count">{{ $cat->posts_count }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Sort Filter -->
                <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-auto">
                    <span class="small font-monospace text-uppercase fw-bold text-slate-500 d-none d-sm-inline"><i
                            class="bi bi-sort-down me-1"></i> Sort:</span>
                    <select class="form-select form-select-sm rounded-3 shadow-none border-slate-300 w-auto"
                        id="sortFilter" style="font-size: 0.85rem; padding: 6px 30px 6px 12px;">
                        <option value="latest" {{ request('filter') === 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="popular" {{ request('filter') === 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="trending" {{ request('filter') === 'trending' ? 'selected' : '' }}>Trending</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Posts Grid Section (Full-Width 3-Column Layout) -->
    <section class="py-5 bg-slate-50">
        <div class="container">
            <div class="row">
                <!-- Articles Grid Column (Full Width 12 Cards) -->
                <div class="col-12">
                    <div id="postsGridContainer">
                        @include('blog.partials.posts-grid', ['posts' => $posts])
                    </div>
                </div>
            </div>

            @if(!empty($faqs))
                <div class="mt-5 pt-4 border-top">
                    <x-faq-accordion :faqs="$faqs" />
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let currentCategory = "{{ request('category') }}";
                let currentFilter = "{{ request('filter', 'latest') }}";
                let currentSearch = "{{ request('search') }}";

                const container = document.getElementById('postsGridContainer');
                const catButtons = document.querySelectorAll('.filter-cat-btn');
                const sortSelect = document.getElementById('sortFilter');

                function fetchPosts(page = 1) {
                    container.style.opacity = '0.5';
                    const params = new URLSearchParams({
                        page: page,
                        category: currentCategory,
                        filter: currentFilter,
                        search: currentSearch
                    });

                    fetch("{{ route('blog.index') }}?" + params.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            container.innerHTML = data.html;
                            container.style.opacity = '1';
                            window.history.pushState({}, '', "{{ route('blog.index') }}?" + params.toString());
                        })
                        .catch(err => {
                            container.style.opacity = '1';
                            console.error('Error fetching articles:', err);
                        });
                }

                catButtons.forEach(btn => {
                    btn.addEventListener('click', function () {
                        catButtons.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        currentCategory = this.getAttribute('data-category');
                        fetchPosts(1);
                    });
                });

                if (container) {
                    container.addEventListener('click', function (e) {
                        const paginationLink = e.target.closest('.pagination a');
                        if (paginationLink) {
                            e.preventDefault();
                            const url = new URL(paginationLink.href);
                            const page = url.searchParams.get('page') || 1;
                            fetchPosts(page);
                            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    });
                }

                if (sortSelect) {
                    sortSelect.addEventListener('change', function () {
                        currentFilter = this.value;
                        fetchPosts(1);
                    });
                }
            });
        </script>
    @endpush
</x-layout>