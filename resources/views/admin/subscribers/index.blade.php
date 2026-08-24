<x-admin-layout pageTitle="Newsletter Subscribers">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Newsletter Subscribers</h3>
            <p class="text-secondary small mb-0">View and manage subscriber email addresses collected from footer newsletter form.</p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" id="bulkDeleteBtn" class="btn btn-danger rounded-3 shadow-sm d-none align-items-center gap-1.5 px-3 py-2 text-nowrap" onclick="confirmBulkDelete()" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-trash-fill me-1"></i><span>Delete Selected (<span id="selectedCount">0</span>)</span>
            </button>
            <div class="badge-glass-new px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 text-nowrap" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-mailbox me-1"></i>
                <span><strong>{{ $totalSubscribers }}</strong> Total Subscribers</span>
            </div>
        </div>
    </div>

    <!-- Search Card -->
    <div class="glass-card p-3 mb-4">
        <form action="{{ route('admin.subscribers.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-12 col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control glass-input border-start-0" placeholder="Search by subscriber email address..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-12 col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-glass-primary w-100 py-2">Filter</button>
                @if(request()->has('search'))
                    <a href="{{ route('admin.subscribers.index') }}" class="btn btn-glass-outline px-2" title="Reset Search"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="{{ route('admin.subscribers.bulk-delete') }}" method="POST" class="d-none">
        @csrf
        <div id="bulkDeleteInputsContainer"></div>
    </form>

    <!-- Subscribers Glass Table -->
    <div class="glass-card overflow-hidden">
        @if($subscribers->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle mb-0" style="min-width: 650px;">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center">
                                <input type="checkbox" id="selectAllCheckbox" class="form-check-input" style="cursor: pointer;" title="Select All">
                            </th>
                            <th>Subscriber Email</th>
                            <th>Subscribed Date</th>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribers as $sub)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="subscriber-checkbox form-check-input" value="{{ $sub->id }}" style="cursor: pointer;">
                                </td>
                                <td>
                                    <div class="fw-bold text-slate-900" style="font-size: 0.95rem;">
                                        <i class="bi bi-envelope me-1.5 text-primary"></i>
                                        <a href="mailto:{{ $sub->email }}" class="text-decoration-none text-slate-900">{{ $sub->email }}</a>
                                    </div>
                                </td>
                                <td class="text-muted small">
                                    {{ $sub->created_at->format('M d, Y') }}
                                    <div style="font-size: 0.72rem;">{{ $sub->created_at->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <span class="text-monospace text-muted small">{{ $sub->ip_address ?: 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 fw-semibold" style="font-size: 0.8rem;">
                                        <i class="bi bi-check-circle-fill me-1"></i> Subscribed
                                    </span>
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <a href="mailto:{{ $sub->email }}?subject=Update%20from%20SoftwareCompanyInLucknow" class="btn-action-view" title="Send Email"><i class="bi bi-reply-fill"></i></a>
                                        <button type="button" class="btn-action-delete text-danger" onclick="confirmDeleteSubscriber({{ $sub->id }}, '{{ addslashes($sub->email) }}')" title="Delete Subscriber"><i class="bi bi-trash"></i></button>
                                        <form id="deleteSubscriberForm-{{ $sub->id }}" action="{{ route('admin.subscribers.destroy', $sub->id) }}" method="POST" class="d-none">
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
                {{ $subscribers->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 px-4">
                <div class="rounded-circle bg-info-subtle text-info d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px;">
                    <i class="bi bi-mailbox fs-1"></i>
                </div>
                <h5 class="fw-bold text-slate-900 mb-2">No newsletter subscribers yet</h5>
                <p class="text-muted small mb-0" style="max-width: 420px; margin: 0 auto;">
                    User email addresses submitted via the website footer newsletter form will automatically appear here.
                </p>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        function confirmDeleteSubscriber(id, email) {
            confirmAction({
                title: 'Delete Subscriber Email?',
                text: `Are you sure you want to delete "${email}" from subscribers list?`,
                icon: 'warning',
                confirmText: 'Yes, Delete',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteSubscriberForm-${id}`).submit();
                }
            });
        }

        function updateBulkDeleteUI() {
            const checkboxes = document.querySelectorAll('.subscriber-checkbox');
            const selectedCheckboxes = document.querySelectorAll('.subscriber-checkbox:checked');
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
            const selectedCheckboxes = document.querySelectorAll('.subscriber-checkbox:checked');
            if (selectedCheckboxes.length === 0) return;

            confirmAction({
                title: 'Delete Selected Subscribers?',
                text: `Are you sure you want to delete ${selectedCheckboxes.length} selected subscriber emails?`,
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
                    document.querySelectorAll('.subscriber-checkbox').forEach(cb => {
                        cb.checked = this.checked;
                    });
                    updateBulkDeleteUI();
                });
            }

            // Individual Checkbox Handlers
            document.querySelectorAll('.subscriber-checkbox').forEach(cb => {
                cb.addEventListener('change', updateBulkDeleteUI);
            });
        });
    </script>
    @endpush
</x-admin-layout>
