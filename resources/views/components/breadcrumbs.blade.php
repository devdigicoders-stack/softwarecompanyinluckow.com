@props([
    'items' => [], // Supports either ['Home' => url, 'Current' => null] OR [['name' => 'Home', 'url' => url], ...]
])

@if(!empty($items))
<nav aria-label="breadcrumb" class="pub-breadcrumb bg-light border-bottom py-2">
    <div class="container">
        <ol class="breadcrumb mb-0 small">
            @foreach($items as $key => $val)
                @php
                    if (is_array($val)) {
                        $label = $val['name'] ?? ($val['label'] ?? '');
                        $link = $val['url'] ?? null;
                    } else {
                        $label = $key;
                        $link = $val;
                    }
                @endphp
                @if(!$loop->last && !empty($link))
                    <li class="breadcrumb-item"><a href="{{ $link }}" class="text-decoration-none text-secondary">{{ $label }}</a></li>
                @else
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">{{ $label }}</li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
@endif
