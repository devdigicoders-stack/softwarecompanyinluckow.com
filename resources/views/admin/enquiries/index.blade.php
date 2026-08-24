<x-admin-layout pageTitle="Quick Modal Enquiries">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Quick Modal Enquiries</h3>
            <p class="text-secondary small mb-0">View and manage project quotes and enquiry submissions from the global modal.</p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" id="bulkDeleteBtn" class="btn btn-danger rounded-3 shadow-sm d-none align-items-center gap-1.5 px-3 py-2 text-nowrap" onclick="confirmBulkDelete()" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-trash-fill me-1"></i><span>Delete Selected (<span id="selectedCount">0</span>)</span>
            </button>
            <div class="badge-glass-new px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 text-nowrap" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-chat-left-dots-fill text-primary me-1"></i>
                <span><strong>{{ $unreadCount }}</strong> Unread Enquiries</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Card -->
    <div class="glass-card p-3 mb-4">
        <form action="{{ route('admin.enquiries.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-12 col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control glass-input border-start-0" placeholder="Search by name, mobile number, email, or requirement..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-12 col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-glass-primary w-100 py-2">Filter</button>
                @if(request()->has('search'))
                    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-glass-outline px-2" title="Reset Search"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="{{ route('admin.enquiries.bulk-delete') }}" method="POST" class="d-none">
        @csrf
        <div id="bulkDeleteInputsContainer"></div>
    </form>

    <!-- Enquiries Glass Table -->
    <div class="glass-card overflow-hidden">
        @if($enquiries->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center">
                                <input type="checkbox" id="selectAllCheckbox" class="form-check-input" style="cursor: pointer;" title="Select All">
                            </th>
                            <th>Name & Contact Details</th>
                            <th>Requirement Overview</th>
                            <th>Source Page</th>
                            <th>Submitted Date</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enquiries as $enquiry)
                            <tr class="{{ $enquiry->status === 'unread' ? 'table-warning-subtle' : '' }}">
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input row-checkbox" value="{{ $enquiry->id }}" style="cursor: pointer;" onchange="updateBulkDeleteState()">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-circle-sm bg-primary-subtle text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.9rem;">
                                            {{ strtoupper(substr($enquiry->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark font-semibold" style="font-size: 0.95rem;">{{ $enquiry->name }}</strong>
                                            <div class="small text-muted d-flex align-items-center gap-2" style="font-size: 0.8rem;">
                                                <span><i class="bi bi-telephone text-primary me-1"></i> +91 {{ $enquiry->mobile }}</span>
                                                @if($enquiry->email)
                                                    <span>• <i class="bi bi-envelope me-1"></i> {{ $enquiry->email }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($enquiry->requirement)
                                        <span class="d-block text-truncate text-slate-700" style="max-width: 260px;" title="{{ $enquiry->requirement }}">
                                            {{ $enquiry->requirement }}
                                        </span>
                                    @else
                                        <span class="text-muted italic small">No requirement details provided</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge px-2.5 py-1.5 fw-semibold shadow-xs" style="font-size: 0.78rem; background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;">
                                        <i class="bi bi-globe me-1" style="color: #2563eb;"></i>{{ $enquiry->source_page ?? 'general_modal' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-slate-600 small" style="font-size: 0.82rem;">
                                        <i class="bi bi-calendar3 me-1 text-primary"></i> {{ $enquiry->created_at->format('M d, Y') }}
                                        <small class="d-block text-muted" style="font-size: 0.75rem;">{{ $enquiry->created_at->format('h:i A') }}</small>
                                    </span>
                                </td>
                                <td>
                                    @if($enquiry->status === 'unread')
                                        <span class="badge bg-warning text-dark font-medium px-2.5 py-1">New</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary font-medium px-2.5 py-1">Read</span>
                                    @endif
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <a href="tel:91{{ $enquiry->mobile }}" class="btn-action-view text-success" title="Call Mobile"><i class="bi bi-telephone-fill"></i></a>
                                        <a href="https://wa.me/91{{ $enquiry->mobile }}?text=Hello%20{{ urlencode($enquiry->name) }},%20thank%20you%20for%20your%20enquiry%20with%20us." target="_blank" class="btn-action-view text-emerald-600" title="WhatsApp Chat" style="color: #25D366;"><i class="bi bi-whatsapp"></i></a>
                                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn-action-view text-primary" title="View Full Details"><i class="bi bi-eye-fill"></i></a>
                                        <button type="button" class="btn-action-delete text-danger" onclick="confirmDeleteEnquiry({{ $enquiry->id }}, '{{ addslashes($enquiry->name) }}')" title="Delete Enquiry"><i class="bi bi-trash"></i></button>
                                        <form id="deleteEnquiryForm-{{ $enquiry->id }}" action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" method="POST" class="d-none">
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

            @if($enquiries->hasPages())
                <div class="p-3 border-top">
                    {{ $enquiries->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                </div>
                <h5 class="fw-bold text-slate-800">No Enquiries Found</h5>
                <p class="text-muted small">No quick modal enquiries matching your criteria were found.</p>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const selectedCountSpan = document.getElementById('selectedCount');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');
        const bulkDeleteInputsContainer = document.getElementById('bulkDeleteInputsContainer');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                rowCheckboxes.forEach(cb => cb.checked = this.checked);
                updateBulkDeleteState();
            });
        }

        function updateBulkDeleteState() {
            const selected = document.querySelectorAll('.row-checkbox:checked');
            const count = selected.length;

            if (selectedCountSpan) selectedCountSpan.textContent = count;

            if (count > 0) {
                bulkDeleteBtn.classList.remove('d-none');
                bulkDeleteBtn.classList.add('d-inline-flex');
            } else {
                bulkDeleteBtn.classList.add('d-none');
                bulkDeleteBtn.classList.remove('d-inline-flex');
                if (selectAllCheckbox) selectAllCheckbox.checked = false;
            }
        }

        function confirmBulkDelete() {
            const selected = document.querySelectorAll('.row-checkbox:checked');
            if (selected.length === 0) return;

            if (confirm(`Are you sure you want to delete ${selected.length} selected enquiry record(s)? This action cannot be undone.`)) {
                bulkDeleteInputsContainer.innerHTML = '';
                selected.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = cb.value;
                    bulkDeleteInputsContainer.appendChild(input);
                });
                bulkDeleteForm.submit();
            }
        }

        function confirmDeleteEnquiry(id, name) {
            if (confirm(`Are you sure you want to delete enquiry from "${name}"?`)) {
                document.getElementById(`deleteEnquiryForm-${id}`).submit();
            }
        }
    </script>
    @endpush
</x-admin-layout>
