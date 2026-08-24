@props([
    'faqs' => [],
    'id' => 'faqAccordion'
])

@if(!empty($faqs))
    @php
        $faqsList = is_object($faqs) && method_exists($faqs, 'toArray') ? $faqs->toArray() : (array)$faqs;
        $half = ceil(count($faqsList) / 2);
        $col1 = array_slice($faqsList, 0, $half);
        $col2 = array_slice($faqsList, $half);
    @endphp

    <div class="row g-3" id="{{ $id }}">
        <!-- Left Column -->
        <div class="col-md-6">
            <div class="accordion accordion-flush bg-white rounded-4 p-3 border shadow-sm h-100">
                @foreach($col1 as $index => $faq)
                    <div class="accordion-item border-bottom last-border-0">
                        <h2 class="accordion-header" id="heading-{{ $id }}-l-{{ $index }}">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} fw-bold py-3 text-slate-900" style="font-size: 0.95rem;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $id }}-l-{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $id }}-l-{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $id }}-l-{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $id }}-l-{{ $index }}">
                            <div class="accordion-body text-slate-600 small pt-0 pb-3">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-6">
            <div class="accordion accordion-flush bg-white rounded-4 p-3 border shadow-sm h-100">
                @foreach($col2 as $index => $faq)
                    <div class="accordion-item border-bottom last-border-0">
                        <h2 class="accordion-header" id="heading-{{ $id }}-r-{{ $index }}">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} fw-bold py-3 text-slate-900" style="font-size: 0.95rem;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $id }}-r-{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $id }}-r-{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $id }}-r-{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $id }}-r-{{ $index }}">
                            <div class="accordion-body text-slate-600 small pt-0 pb-3">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
