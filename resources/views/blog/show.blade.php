<x-layout 
    :title="$post->meta_title ?? ($post->title . ' | Software Company in Lucknow')"
    :description="$post->meta_description ?? $post->excerpt"
    :keywords="$post->meta_keywords ?? (isset($post->tags) && count($post->tags) > 0 ? implode(', ', $post->tags->pluck('name')->toArray()) : ($post->title . ', software company in lucknow, IT blog lucknow'))"
    :canonical="$post->canonical_url ?? route('blogs.show', $post->slug)"
    :post="$post"
    :faqs="$post->faqs"
    :breadcrumbs="$breadcrumbs"
>
    @php
        $defaultCover = 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1200&q=80';
        $coverSrc = $defaultCover;
        if (!empty($post->featured_image)) {
            $coverSrc = str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset($post->featured_image);
        }

        $defaultAvatar = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80';
        $avatarSrc = $defaultAvatar;
        if ($post->author && !empty($post->author->avatar)) {
            $avatarSrc = str_starts_with($post->author->avatar, 'http') ? $post->author->avatar : asset($post->author->avatar);
        }

        // Process Table of Contents items dynamically if not present
        $tocItems = [];
        if (!empty($post->table_of_contents) && is_array($post->table_of_contents)) {
            foreach ($post->table_of_contents as $item) {
                $itemTag = $item['tag'] ?? (isset($item['level']) ? 'h'.$item['level'] : 'h2');
                $tocItems[] = [
                    'title' => $item['title'] ?? '',
                    'anchor' => $item['anchor'] ?? Str::slug($item['title'] ?? ''),
                    'tag' => $itemTag,
                    'level' => (int) str_replace('h', '', $itemTag)
                ];
            }
        } else {
            preg_match_all('/<h([234])([^>]*)>(.*?)<\/h\1>/i', $post->content, $matches, PREG_SET_ORDER);
            if (!empty($matches)) {
                foreach ($matches as $match) {
                    $tag = strtolower('h' . $match[1]);
                    $cleanTitle = trim(strip_tags($match[3]));
                    if (!empty($cleanTitle)) {
                        $tocItems[] = [
                            'title' => $cleanTitle,
                            'anchor' => Str::slug($cleanTitle),
                            'tag' => $tag,
                            'level' => (int) $match[1]
                        ];
                    }
                }
            }
        }

        // Inject IDs into content headings matching TOC anchors by index
        $tocIdx = 0;
        $processedContent = preg_replace_callback('/<h([234])([^>]*)>(.*?)<\/h\1>/i', function($m) use (&$tocIdx, $tocItems) {
            $tag = $m[1];
            $attrs = $m[2];
            $contentHeading = $m[3];
            $title = trim(strip_tags($contentHeading));
            
            $anchor = null;
            if (isset($tocItems[$tocIdx]['anchor'])) {
                $anchor = $tocItems[$tocIdx]['anchor'];
            } else {
                $anchor = Str::slug($title);
            }
            $tocIdx++;

            if (!empty($anchor)) {
                return "<h{$tag}{$attrs} id=\"{$anchor}\">{$contentHeading}</h{$tag}>";
            }
            return $m[0];
        }, $post->content);
    @endphp

    <!-- Article Header -->
    <article class="article-header-section pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($post->category)
                        <div class="article-category mb-2">
                            <a href="{{ route('blogs.index', ['category' => $post->category->slug]) }}" class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 text-decoration-none fw-bold" style="font-size: 0.78rem;">
                                <i class="bi bi-folder-fill me-1"></i> {{ $post->category->name }}
                            </a>
                        </div>
                    @endif

                    <h1 class="article-title mb-3">{{ $post->title }}</h1>

                    <!-- Author & Meta Bar -->
                    <div class="author-bar flex-wrap justify-content-between mb-0">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $avatarSrc }}" alt="{{ $post->author ? $post->author->name : 'Author' }}" class="author-avatar" onerror="this.onerror=null; this.src='{{ $defaultAvatar }}';">
                            <div class="author-info">
                                <h6>{{ $post->author ? $post->author->name : 'Tech Editorial Team' }}</h6>
                                <span>
                                    {{ $post->author ? ($post->author->role ?? 'Software Architect') : 'Technical Writer' }} &bull;
                                    Published {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }} 
                                    &bull; <i class="bi bi-clock me-1 text-emerald-600"></i> {{ $post->reading_time_minutes }} min read
                                    &bull; <i class="bi bi-eye me-1 text-emerald-600"></i> {{ number_format($post->view_count) }} Views
                                </span>
                            </div>
                        </div>

                        <!-- Social Share Links -->
                        <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0 ms-auto">
                            <span class="small fw-bold text-slate-500 me-1 d-none d-md-inline">Share:</span>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="social-share-btn" title="Share on Twitter">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="social-share-btn" title="Share on LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" rel="noopener" class="social-share-btn" title="Share on WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- Main Article Body & Sidebar Section -->
    <section class="py-5 bg-slate-50">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Featured Image (Aligned next to Sidebar) -->
                    <div class="featured-image-container mb-4">
                        <img src="{{ $coverSrc }}" alt="{{ $post->alt_text ?? $post->title }}" onerror="this.onerror=null; this.src='{{ $defaultCover }}';">
                    </div>
                    <div class="editorial-article">
                        <!-- Key Takeaways Box -->
                        @if(!empty($post->key_takeaways))
                            <div class="key-takeaways-box">
                                <h5><i class="bi bi-lightbulb-fill text-warning me-2"></i> Executive Summary & Key Takeaways</h5>
                                <ul class="mb-0 ps-3">
                                    @foreach($post->key_takeaways as $takeaway)
                                        <li>{{ $takeaway }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Main Article Body -->
                        <div class="article-body-content">
                            {!! $processedContent !!}
                        </div>

                        <!-- Tags Bar -->
                        @if($post->tags->count() > 0)
                            <div class="mt-5 pt-4 border-top d-flex flex-wrap align-items-center gap-2">
                                <span class="fw-bold text-slate-700 me-2"><i class="bi bi-tags me-1 text-primary"></i> Topics & Tags:</span>
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" class="topic-tag-pill">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <!-- Author Signature Box -->
                        @if($post->author)
                            <div class="author-bio-card">
                                <img src="{{ $avatarSrc }}" alt="{{ $post->author->name }}" class="author-avatar" style="width: 64px; height: 64px;" onerror="this.onerror=null; this.src='{{ $defaultAvatar }}';">
                                <div>
                                    <h6 class="fw-bold mb-1" style="font-size: 1.05rem;">Written by {{ $post->author->name }}</h6>
                                    <p class="small text-muted mb-0">{{ $post->author->bio ?? 'Lead Technology Contributor at SoftwareCompanyInLucknow.com specializing in enterprise software architecture, cloud platforms, and software cost estimation.' }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Article FAQs -->
                        @if(!empty($post->faqs))
                            <div class="mt-5 pt-4 border-top">
                                <h3 class="fw-bold text-slate-900 mb-4"><i class="bi bi-question-circle text-primary me-2"></i> Frequently Asked Questions</h3>
                                <x-faq-accordion :faqs="$post->faqs" id="articleFaqsAccordion" />
                            </div>
                        @endif

                        <!-- Related Software Services -->
                        @if(!empty($relatedServices))
                            <div class="mt-5 pt-4 border-top">
                                <h4 class="fw-bold text-slate-900 mb-3"><i class="bi bi-tools text-primary me-2"></i> Relevant Software Engineering Services</h4>
                                <div class="row g-3">
                                    @foreach($relatedServices as $relService)
                                        <div class="col-sm-6">
                                            <div class="p-3 bg-slate-50 border rounded-3 h-100 hover-shadow-sm transition-all">
                                                <h6 class="fw-bold text-slate-900 mb-1">
                                                    <a href="{{ route('services.show', $relService->slug) }}" class="text-decoration-none text-slate-900 hover-text-primary">
                                                        <i class="bi {{ $relService->icon }} me-1 text-primary"></i> {{ $relService->title }}
                                                    </a>
                                                </h6>
                                                <p class="small text-muted mb-0">{{ Str::limit($relService->excerpt, 80) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar-sticky-wrap">
                        <!-- Table of Contents Widget (Scrollable with Bullet Points) -->
                        @if(!empty($tocItems))
                            <div class="sidebar-widget mb-4">
                                <h4 class="sidebar-title d-flex align-items-center gap-2 mb-3">
                                    <i class="bi bi-list-nested text-primary"></i> Table of Contents
                                </h4>
                                <div class="toc-sidebar-container pe-2" style="max-height: 280px; overflow-y: auto; scrollbar-width: thin;">
                                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                        @foreach($tocItems as $item)
                                            @php
                                                $isSub = isset($item['level']) ? ($item['level'] > 2) : (isset($item['tag']) && in_array($item['tag'], ['h3', 'h4']));
                                            @endphp
                                            <li class="d-flex align-items-start gap-2 {{ $isSub ? 'ms-3 ps-2 border-start border-emerald-300' : '' }}">
                                                @if($isSub)
                                                    <span class="toc-bullet-dot flex-shrink-0" style="width: 5px; height: 5px; border-radius: 50%; border: 1.5px solid #059669; background-color: #ffffff; margin-top: 7px;"></span>
                                                    <a href="#{{ $item['anchor'] ?? Str::slug($item['title']) }}" class="text-slate-600 text-decoration-none hover-text-primary" style="font-size: 0.81rem; line-height: 1.4;">
                                                        {{ $item['title'] }}
                                                    </a>
                                                @else
                                                    <span class="toc-bullet-dot flex-shrink-0" style="width: 7px; height: 7px; border-radius: 50%; background-color: #059669; margin-top: 6px;"></span>
                                                    <a href="#{{ $item['anchor'] ?? Str::slug($item['title']) }}" class="text-slate-800 text-decoration-none hover-text-primary fw-semibold" style="font-size: 0.86rem; line-height: 1.45;">
                                                        {{ $item['title'] }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <!-- Related Articles Widget with Small Thumbnails -->
                        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                            <div class="sidebar-widget mb-4">
                                <h4 class="sidebar-title mb-3"><i class="bi bi-newspaper text-primary me-2"></i> Related Articles</h4>
                                @foreach($relatedPosts as $relPost)
                                    @php
                                        $relImg = 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=200&q=80';
                                        if (!empty($relPost->featured_image)) {
                                            $relImg = str_starts_with($relPost->featured_image, 'http') ? $relPost->featured_image : asset($relPost->featured_image);
                                        }
                                    @endphp
                                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom last-border-0">
                                        <a href="{{ route('blogs.show', $relPost->slug) }}" class="flex-shrink-0 d-block rounded-3 overflow-hidden shadow-xs" style="width: 72px; height: 54px; background: #0f172a;">
                                            <img src="{{ $relImg }}" alt="{{ $relPost->title }}" class="w-100 h-100" style="object-fit: cover;" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=200&q=80';">
                                        </a>
                                        <div class="flex-grow-1">
                                            @if($relPost->category)
                                                <span class="sidebar-cat-badge mb-1 text-uppercase font-monospace fw-bold" style="font-size: 0.68rem; color: #059669; background: #ecfdf5; padding: 2px 7px; border-radius: 4px;">{{ $relPost->category->name }}</span>
                                            @endif
                                            <h6 class="fw-bold mb-1 mt-0.5" style="font-size: 0.88rem; line-height: 1.35;">
                                                <a href="{{ route('blogs.show', $relPost->slug) }}" class="text-slate-900 text-decoration-none hover-text-primary">
                                                    {{ Str::limit($relPost->title, 55) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted d-block" style="font-size: 0.76rem;"><i class="bi bi-clock me-1 text-emerald-600"></i> {{ $relPost->reading_time_minutes }} min read</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Software Consultation Widget -->
                        <div class="sidebar-widget text-white border-0 shadow-sm" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                            <div class="mb-3">
                                <span class="badge bg-primary text-uppercase px-2.5 py-1" style="font-size: 0.7rem;">Free Technical Consultation</span>
                            </div>
                            <h4 class="text-white fw-bold mb-2">Build Custom Software in Lucknow?</h4>
                            <p class="small text-slate-300 mb-4">Consult with lead software architects in Lucknow for Web, App & Enterprise Software development.</p>
                            <div class="d-flex flex-column gap-2 mb-2">
                                <button type="button" class="btn btn-primary fw-bold w-100 rounded-3 py-2 shadow-sm d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#globalEnquiryModal" data-source="blog_single_sidebar">
                                    Explore Software Solutions <i class="bi bi-arrow-right"></i>
                                </button>
                                <a href="tel:919198483820" class="btn btn-outline-light fw-bold w-100 rounded-3 py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-telephone-fill me-1"></i>+91 9198483820
                                </a>
                                <a href="https://wa.me/916394296293?text=Hello,%20I%20want%20to%20know%20more%20about%20your%20software%20services" target="_blank" rel="noopener" class="btn text-white fw-bold w-100 rounded-3 py-2 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #25D366; border-color: #25D366;">
                                    <i class="bi bi-whatsapp me-1"></i>6394296293
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const articleBody = document.querySelector('.article-body-content');
                if (!articleBody) return;

                const headings = articleBody.querySelectorAll('h2, h3');
                const tocLinks = document.querySelectorAll('.toc-sidebar-container a, .table-of-contents a');

                // 1. Assign matching IDs to headings from TOC links or text slug
                tocLinks.forEach((link, idx) => {
                    const href = link.getAttribute('href');
                    if (href) {
                        const hashIdx = href.indexOf('#');
                        if (hashIdx !== -1) {
                            const anchorId = href.substring(hashIdx + 1);
                            if (headings[idx] && anchorId) {
                                headings[idx].id = anchorId;
                            }
                        }
                    }
                });

                // Fallback for remaining headings
                headings.forEach((heading, idx) => {
                    if (!heading.id) {
                        const cleanText = heading.textContent.trim();
                        const slug = cleanText.toLowerCase()
                            .replace(/[^\w\s-]/g, '')
                            .replace(/[\s_-]+/g, '-')
                            .replace(/^-+|-+$/g, '');
                        heading.id = slug || ('heading-' + idx);
                    }
                });

                // 2. Smooth click scroll handler for TOC links
                tocLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const href = this.getAttribute('href');
                        if (!href) return;
                        const hashIdx = href.indexOf('#');
                        if (hashIdx === -1) return;

                        const targetId = href.substring(hashIdx + 1);
                        const targetEl = document.getElementById(targetId);
                        if (targetEl) {
                            const navbarOffset = 110;
                            const elementPosition = targetEl.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - navbarOffset;

                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });

                            // Highlight targeted heading briefly
                            targetEl.style.transition = 'background-color 0.4s ease, padding 0.3s ease';
                            const originalBg = targetEl.style.backgroundColor;
                            targetEl.style.backgroundColor = 'rgba(5, 150, 105, 0.2)';
                            targetEl.style.borderRadius = '6px';
                            targetEl.style.paddingLeft = '10px';
                            setTimeout(() => {
                                targetEl.style.backgroundColor = originalBg;
                                targetEl.style.paddingLeft = '0px';
                            }, 1600);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layout>
