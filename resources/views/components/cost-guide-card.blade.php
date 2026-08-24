@props([
    'title',
    'slug',
    'excerpt',
    'category' => 'Cost Guide',
    'readTime' => '6 min read'
])

<div class="pub-card d-flex flex-column justify-content-between">
    <div>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="pub-badge mb-0"><i class="bi bi-calculator me-1"></i> {{ $category }}</span>
            <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $readTime }}</span>
        </div>
        <h4 class="article-headline mt-2">
            <a href="{{ route('cost-guides.show', $slug) }}">{{ $title }}</a>
        </h4>
        <p class="text-muted small line-clamp-3">
            {{ $excerpt }}
        </p>
    </div>
    <div class="pt-3 border-top d-flex align-items-center justify-content-between">
        <span class="text-primary fw-bold small"><i class="bi bi-file-earmark-text me-1"></i> Cost Breakdown & Factors</span>
        <a href="{{ route('cost-guides.show', $slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Read Guide <i class="bi bi-arrow-right"></i></a>
    </div>
</div>
