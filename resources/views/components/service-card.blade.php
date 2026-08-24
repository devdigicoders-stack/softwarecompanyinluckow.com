@props([
    'service'
])

<div class="service-portal-card">
    <div class="service-icon-box">
        <i class="bi {{ $service->icon ?? 'bi-code-slash' }}"></i>
    </div>
    <h3 class="service-card-title">
        <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
    </h3>
    <p class="service-card-text">
        {{ Str::limit($service->excerpt, 120) }}
    </p>
    <a href="{{ route('services.show', $service->slug) }}" class="link-read-more">
        Explore Service Details <i class="bi bi-arrow-right"></i>
    </a>
</div>
