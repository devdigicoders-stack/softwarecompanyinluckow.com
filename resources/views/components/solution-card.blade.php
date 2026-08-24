@props([
    'solution'
])

<div class="service-portal-card border-top border-primary border-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="service-icon-box mb-0">
            <i class="bi {{ $solution->icon ?? 'bi-cpu' }}"></i>
        </div>
        <span class="badge bg-light text-primary border border-primary px-3 py-1">Enterprise Software</span>
    </div>
    <h3 class="service-card-title">
        <a href="{{ route('solutions.show', $solution->slug) }}">{{ $solution->title }}</a>
    </h3>
    <p class="service-card-text">
        {{ Str::limit($solution->excerpt, 120) }}
    </p>
    <a href="{{ route('solutions.show', $solution->slug) }}" class="link-read-more">
        Explore Solution & Pricing <i class="bi bi-arrow-right"></i>
    </a>
</div>
