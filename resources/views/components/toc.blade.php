@props([
    'items' => []
])

@if(!empty($items) && is_array($items))
<div class="toc-box">
    <div class="toc-title d-flex align-items-center">
        <i class="bi bi-list-nested me-2 text-primary"></i> Table of Contents
    </div>
    <ul class="toc-list">
        @foreach($items as $item)
            <li>
                <a href="#{{ $item['id'] ?? Str::slug($item['title'] ?? '') }}">
                    <i class="bi bi-chevron-right text-primary me-1" style="font-size: 0.75rem;"></i> {{ $item['title'] ?? $item }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endif
