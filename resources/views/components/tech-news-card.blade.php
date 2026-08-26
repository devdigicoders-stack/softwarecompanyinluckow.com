@props([
    'post'
])

@php
    $defaultImg = 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80';
    $imgSrc = $defaultImg;

    if (!empty($post->featured_image)) {
        if (str_starts_with($post->featured_image, 'http')) {
            $imgSrc = $post->featured_image;
        } else {
            $imgSrc = asset($post->featured_image);
        }
    }

    $defaultAvatar = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80';
    $avatarSrc = $defaultAvatar;
    if ($post->author && !empty($post->author->avatar)) {
        $avatarSrc = str_starts_with($post->author->avatar, 'http') ? $post->author->avatar : asset($post->author->avatar);
    }
@endphp

<article class="news-card-featured w-100 h-100 d-flex flex-column {{ !empty($post->is_featured) ? 'is-featured-card' : '' }}">
    <div class="news-card-img-wrap flex-shrink-0 position-relative">
        <a href="{{ route('blogs.show', $post->slug) }}" class="d-block w-100 h-100 position-relative">
            <img src="{{ $imgSrc }}" 
                 alt="{{ $post->alt_text ?? $post->title }}" 
                 loading="lazy"
                 onerror="this.onerror=null; this.src='{{ $defaultImg }}';">
        </a>
        @if(!empty($post->is_featured))
            <span class="card-featured-tag">
                <i class="bi bi-star-fill text-warning"></i> Featured
            </span>
        @elseif(!empty($post->is_trending))
            <span class="card-featured-tag bg-danger text-white border-0">
                <i class="bi bi-fire text-warning"></i> Trending
            </span>
        @elseif(!empty($post->is_popular))
            <span class="card-featured-tag bg-info text-dark border-0">
                <i class="bi bi-graph-up-arrow me-1"></i> Popular
            </span>
        @endif
        @if($post->category)
            <span class="card-category-tag">
                <i class="bi bi-tag-fill me-1"></i>{{ $post->category->name }}
            </span>
        @endif
    </div>
    
    <div class="news-card-body d-flex flex-column flex-grow-1">
        <div class="news-meta d-flex align-items-center gap-2 mb-2">
            <span class="d-inline-flex align-items-center gap-1.5 me-auto fw-semibold text-slate-700">
                <img src="{{ $avatarSrc }}" alt="{{ $post->author ? $post->author->name : 'Tech Editor' }}" class="rounded-circle border me-1" style="width: 22px; height: 22px; object-fit: cover;" onerror="this.onerror=null; this.src='{{ $defaultAvatar }}';">
                {{ $post->author ? $post->author->name : 'Tech Editor' }}
            </span>
            <span class="text-muted small"><i class="bi bi-clock text-emerald-600 me-1"></i> {{ $post->reading_time_minutes ?? 5 }} min</span>
        </div>

        <h3 class="news-card-title">
            <a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>

        <p class="news-card-excerpt">
            {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
        </p>

        <div class="news-card-footer mt-auto d-flex align-items-center justify-content-between pt-3 border-top">
            <span class="small text-slate-400 font-monospace" style="font-size: 0.75rem;">
                <i class="bi bi-calendar3 me-1"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
            </span>
            <a href="{{ route('blogs.show', $post->slug) }}" class="link-read-more">
                Read Article <i class="bi bi-arrow-right ms-1 transition-icon"></i>
            </a>
        </div>
    </div>
</article>
