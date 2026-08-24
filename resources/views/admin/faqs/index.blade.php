<x-admin-layout pageTitle="Manage Page FAQs">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Page FAQs Management</h3>
            <p class="text-secondary small mb-0">Manage dynamic FAQs across all website pages (Contact, Home, About, Solutions, Services, etc.).</p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" id="bulkDeleteBtn" class="btn btn-danger rounded-3 shadow-sm d-none align-items-center gap-1.5 px-3 py-2 text-nowrap" onclick="confirmBulkDelete()" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-trash-fill me-1"></i><span>Delete Selected (<span id="selectedCount">0</span>)</span>
            </button>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-glass-primary px-3 py-2 text-nowrap" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-plus-lg me-1"></i> Add New FAQ
            </a>
            <div class="badge-glass-new px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 text-nowrap" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-question-circle-fill me-1"></i>
                <span><strong>{{ $totalFaqs }}</strong> Total FAQs</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search Card -->
    <div class="glass-card p-3 mb-4" style="position: relative; z-index: 35;">
        <form action="{{ route('admin.faqs.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control glass-input border-start-0" placeholder="Search by question, answer or page..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <input type="hidden" name="page_name" id="faqPageNameInput" value="{{ request('page_name') }}">
                @php
                    $selectedFaqPage = 'All Pages';
                    if (request('page_name')) {
                        $selectedFaqPage = 'Page: ' . ucfirst(request('page_name'));
                    }
                @endphp
                <div class="dropdown w-100">
                    <button class="btn glass-input bg-white w-100 d-flex align-items-center justify-content-between py-2 px-3 dropdown-toggle text-slate-800" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-semibold text-truncate me-1" style="font-size: 0.88rem;">{{ $selectedFaqPage }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start w-100 shadow-lg border p-1 rounded-3 mt-1" style="min-width: 200px; max-height: 280px; overflow-y: auto;">
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ !request('page_name') ? 'active text-white' : '' }}" style="{{ !request('page_name') ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('faqPageNameInput').value=''; this.closest('form').submit();">All Pages (Filter by Page...)</a></li>
                        @foreach($distinctPages as $p)
                            <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('page_name') == $p ? 'active text-white' : '' }}" style="{{ request('page_name') == $p ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('faqPageNameInput').value='{{ $p }}'; this.closest('form').submit();">Page: {{ ucfirst($p) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-glass-primary w-100 py-2">Filter</button>
                @if(request()->has('search') || request()->has('page_name'))
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-glass-outline px-2" title="Reset Filters"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="{{ route('admin.faqs.bulk-delete') }}" method="POST" class="d-none">
        @csrf
        <div id="bulkDeleteInputsContainer"></div>
    </form>

    <!-- FAQs Glass Table -->
    <div class="glass-card overflow-hidden">
        @if($faqs->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle mb-0" style="min-width: 780px;">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center">
                                <input type="checkbox" id="selectAllCheckbox" class="form-check-input" style="cursor: pointer;" title="Select All">
                            </th>
                            <th style="width: 130px;">Target Page</th>
                            <th style="min-width: 320px;">Question &amp; Answer</th>
                            <th style="width: 80px;" class="text-center">Order</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 110px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="faq-checkbox form-check-input" value="{{ $faq->id }}" style="cursor: pointer;">
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 text-uppercase fw-bold" style="font-size: 0.75rem;">
                                        {{ $faq->page_name }}
                                    </span>
                                </td>
                                <td style="min-width: 320px; max-width: 450px;">
                                    <div class="fw-bold text-slate-900 mb-1" style="font-size: 0.95rem; color: #0f172a; line-height: 1.45;">
                                        <i class="bi bi-question-circle-fill me-1.5" style="color: #0284c7;"></i> {{ $faq->question }}
                                    </div>
                                    <div class="small" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; color: #475569; font-size: 0.86rem; line-height: 1.5;">
                                        {{ $faq->answer }}
                                    </div>
                                </td>
                                <td class="text-center font-monospace fw-bold text-slate-700">
                                    #{{ $faq->order_index }}
                                </td>
                                <td>
                                    @if($faq->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 fw-semibold" style="font-size: 0.78rem;">Active</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1" style="font-size: 0.78rem;">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn-action-edit" title="Edit FAQ"><i class="bi bi-pencil"></i></a>
                                        <button type="button" class="btn-action-delete text-danger" onclick="confirmDeleteFaq({{ $faq->id }}, '{{ addslashes(Str::limit($faq->question, 40)) }}')" title="Delete FAQ"><i class="bi bi-trash"></i></button>
                                        <form id="deleteFaqForm-{{ $faq->id }}" action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $faqs->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 px-4">
                <div class="rounded-circle bg-info-subtle text-info d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px;">
                    <i class="bi bi-question-circle fs-1"></i>
                </div>
                <h5 class="fw-bold text-slate-900 mb-2">No FAQs found</h5>
                <p class="text-muted small mb-3">Add FAQs to display dynamic question accordion sections across website pages.</p>
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-glass-primary px-4 py-2">
                    <i class="bi bi-plus-lg me-1"></i> Create First FAQ
                </a>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        function confirmDeleteFaq(id, question) {
            confirmAction({
                title: 'Delete FAQ?',
                text: `Are you sure you want to delete "${question}"?`,
                icon: 'warning',
                confirmText: 'Yes, Delete',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteFaqForm-${id}`).submit();
                }
            });
        }

        function updateBulkDeleteUI() {
            const checkboxes = document.querySelectorAll('.faq-checkbox');
            const selectedCheckboxes = document.querySelectorAll('.faq-checkbox:checked');
            const bulkBtn = document.getElementById('bulkDeleteBtn');
            const selectedCountEl = document.getElementById('selectedCount');
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');

            if (selectedCountEl) {
                selectedCountEl.textContent = selectedCheckboxes.length;
            }

            if (bulkBtn) {
                if (selectedCheckboxes.length > 0) {
                    bulkBtn.classList.remove('d-none');
                    bulkBtn.classList.add('d-inline-flex');
                } else {
                    bulkBtn.classList.add('d-none');
                    bulkBtn.classList.remove('d-inline-flex');
                }
            }

            if (selectAllCheckbox && checkboxes.length > 0) {
                selectAllCheckbox.checked = checkboxes.length === selectedCheckboxes.length;
            }
        }

        function confirmBulkDelete() {
            const selectedCheckboxes = document.querySelectorAll('.faq-checkbox:checked');
            if (selectedCheckboxes.length === 0) return;

            confirmAction({
                title: 'Delete Selected FAQs?',
                text: `Are you sure you want to delete ${selectedCheckboxes.length} selected FAQs?`,
                icon: 'warning',
                confirmText: 'Yes, Delete Selected',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('bulkDeleteForm');
                    const container = document.getElementById('bulkDeleteInputsContainer');
                    container.innerHTML = '';

                    selectedCheckboxes.forEach(cb => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'ids[]';
                        input.value = cb.value;
                        container.appendChild(input);
                    });

                    form.submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Select All Checkbox Handler
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    document.querySelectorAll('.faq-checkbox').forEach(cb => {
                        cb.checked = this.checked;
                    });
                    updateBulkDeleteUI();
                });
            }

            // Individual Checkbox Handlers
            document.querySelectorAll('.faq-checkbox').forEach(cb => {
                cb.addEventListener('change', updateBulkDeleteUI);
            });
        });
    </script>
    @endpush
</x-admin-layout>
