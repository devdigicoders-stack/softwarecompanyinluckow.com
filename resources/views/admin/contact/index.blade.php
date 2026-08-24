<x-admin-layout pageTitle="Contact Messages">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Contact Enquiries</h3>
            <p class="text-secondary small mb-0">Review and manage client contact submissions from public website forms.</p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" id="bulkDeleteBtn" class="btn btn-danger rounded-3 shadow-sm d-none align-items-center gap-1.5 px-3 py-2 text-nowrap" onclick="confirmBulkDelete()" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-trash-fill me-1"></i><span>Delete Selected (<span id="selectedCount">0</span>)</span>
            </button>
            <div class="badge-glass-new px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 text-nowrap" style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-envelope-fill me-1"></i>
                <span><strong id="unreadEnquiriesCount">{{ $unreadCount }}</strong> Unread Enquiries</span>
            </div>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="glass-card p-3 mb-4" style="position: relative; z-index: 35;">
        <form action="{{ route('admin.contact-messages.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control glass-input border-start-0" placeholder="Search by name, email, phone, or message text..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-6 col-md-3">
                <input type="hidden" name="status" id="contactStatusInput" value="{{ request('status') }}">
                <div class="dropdown w-100">
                    <button class="btn glass-input bg-white w-100 d-flex align-items-center justify-content-between py-2 px-3 dropdown-toggle text-slate-800" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-semibold text-truncate me-1" style="font-size: 0.88rem;">
                            @if(request('status') === 'new') NEW (Unread)
                            @elseif(request('status') === 'read') READ Only
                            @else All Statuses
                            @endif
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end w-100 shadow-lg border p-1 rounded-3 mt-1" style="min-width: 180px;">
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ !request('status') ? 'active text-white' : '' }}" style="{{ !request('status') ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('contactStatusInput').value=''; this.closest('form').submit();">All Statuses</a></li>
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === 'new' ? 'active text-white' : '' }}" style="{{ request('status') === 'new' ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('contactStatusInput').value='new'; this.closest('form').submit();">NEW (Unread Only)</a></li>
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === 'read' ? 'active text-white' : '' }}" style="{{ request('status') === 'read' ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('contactStatusInput').value='read'; this.closest('form').submit();">READ Only</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-6 col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-glass-primary w-100 py-2">Filter</button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-glass-outline px-2" title="Reset Filters"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="{{ route('admin.contact-messages.bulk-delete') }}" method="POST" class="d-none">
        @csrf
        <div id="bulkDeleteInputsContainer"></div>
    </form>

    <!-- Messages Glass Table -->
    <div class="glass-card overflow-hidden">
        @if($submissions->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle" style="min-width: 780px;">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center">
                                <input type="checkbox" id="selectAllCheckbox" class="form-check-input" style="cursor: pointer;" title="Select All">
                            </th>
                            <th>Sender &amp; Contact Info</th>
                            <th>Required Service / Subject</th>
                            <th>Submitted Date</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $msg)
                            <tr class="{{ $msg->status === 'new' ? 'bg-emerald-50-subtle' : '' }}" id="messageRow-{{ $msg->id }}">
                                <td class="text-center">
                                    <input type="checkbox" class="message-checkbox form-check-input" value="{{ $msg->id }}" style="cursor: pointer;">
                                </td>
                                <td>
                                    <div class="fw-bold text-slate-900" style="font-size: 0.95rem;">{{ $msg->name }}</div>
                                    <div class="small text-slate-700 mt-0.5"><i class="bi bi-envelope me-1 text-muted"></i> <a href="mailto:{{ $msg->email }}" class="text-decoration-none text-slate-800">{{ $msg->email }}</a></div>
                                    <div class="small text-muted"><i class="bi bi-telephone me-1"></i> <a href="tel:{{ $msg->phone }}" class="text-decoration-none text-muted">{{ $msg->phone }}</a></div>
                                </td>
                                <td>
                                    <span class="badge px-2.5 py-1.5 fw-bold" style="color: #065f46; background-color: #ecfdf5; border: 1px solid #a7f3d0; font-size: 0.84rem; white-space: normal; text-align: left; display: inline-block; max-width: 260px;">
                                        {{ $msg->service ?: 'General Inquiry' }}
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    {{ $msg->created_at->format('M d, Y') }}
                                    <div style="font-size: 0.72rem;">{{ $msg->created_at->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <button type="button" class="btn p-0 border-0 mark-read-btn" data-msg-id="{{ $msg->id }}">
                                        @if($msg->status === 'new')
                                            <span class="badge-glass-new" id="statusBadge-{{ $msg->id }}"><i class="bi bi-envelope-fill me-1"></i> NEW</span>
                                        @else
                                            <span class="badge-glass-read" id="statusBadge-{{ $msg->id }}"><i class="bi bi-envelope-open me-1"></i> READ</span>
                                        @endif
                                    </button>
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn-action-view" data-msg-id="{{ $msg->id }}" data-bs-toggle="modal" data-bs-target="#viewMessageModal-{{ $msg->id }}" title="View Full Message"><i class="bi bi-eye"></i></button>
                                        <button type="button" class="btn-action-delete text-danger" onclick="confirmDeleteMessage({{ $msg->id }}, '{{ addslashes($msg->name) }}')" title="Delete Message"><i class="bi bi-trash"></i></button>
                                        <form id="deleteMessageForm-{{ $msg->id }}" action="{{ route('admin.contact-messages.destroy', $msg->id) }}" method="POST" class="d-none">
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
                {{ $submissions->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 px-4">
                <div class="rounded-circle bg-info-subtle text-info d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px;">
                    <i class="bi bi-inbox fs-1"></i>
                </div>
                <h5 class="fw-bold text-slate-900 mb-2">No contact messages yet</h5>
                <p class="text-muted small mb-0" style="max-width: 420px; margin: 0 auto;">
                    New enquiries submitted by prospective clients through the website contact form will automatically appear here.
                </p>
            </div>
        @endif
    </div>

    <!-- View Message Modals (Rendered outside table container for proper full-screen overlay) -->
    @if($submissions->count() > 0)
        @foreach($submissions as $msg)
            <div class="modal fade" id="viewMessageModal-{{ $msg->id }}" tabindex="-1" aria-labelledby="modalTitle-{{ $msg->id }}" aria-hidden="true" style="z-index: 1060;">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content glass-card border-0 p-4 shadow-lg" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(16px);">
                        <div class="modal-header border-bottom pb-3">
                            <div>
                                <h5 class="modal-title fw-bold text-slate-900 mb-0" id="modalTitle-{{ $msg->id }}">Enquiry from {{ $msg->name }}</h5>
                                <small class="text-muted">Submitted on {{ $msg->created_at->format('F d, Y \a\t h:i A') }}</small>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body py-4">
                            <!-- Contact Metadata Grid -->
                            <div class="row g-3 mb-4 p-3 bg-slate-50 rounded-3 border">
                                <div class="col-12 col-md-4">
                                    <span class="glass-label d-block text-muted mb-1" style="font-size: 0.75rem;">FULL NAME</span>
                                    <span class="fw-bold text-slate-900">{{ $msg->name }}</span>
                                </div>
                                <div class="col-12 col-md-5">
                                    <span class="glass-label d-block text-muted mb-1" style="font-size: 0.75rem;">EMAIL ADDRESS</span>
                                    <a href="mailto:{{ $msg->email }}" class="fw-bold text-primary text-decoration-none text-break" style="word-break: break-all;">{{ $msg->email }}</a>
                                </div>
                                <div class="col-12 col-md-3">
                                    <span class="glass-label d-block text-muted mb-1" style="font-size: 0.75rem;">PHONE NUMBER</span>
                                    <a href="tel:{{ $msg->phone }}" class="fw-bold text-slate-900 text-decoration-none" style="white-space: nowrap;">{{ $msg->phone }}</a>
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <span class="glass-label d-block text-muted mb-1" style="font-size: 0.75rem;">REQUIRED SERVICE / SUBJECT</span>
                                    <span class="fw-bold px-2.5 py-1 rounded d-inline-block" style="color: #065f46; background-color: #ecfdf5; border: 1px solid #a7f3d0; font-size: 0.88rem;">{{ $msg->service ?: 'General Inquiry' }}</span>
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <span class="glass-label d-block text-muted mb-1" style="font-size: 0.75rem;">SENDER IP</span>
                                    <span class="text-monospace text-muted small">{{ $msg->ip_address ?: 'N/A' }}</span>
                                </div>
                            </div>

                            <!-- Message Content -->
                            <div class="mb-2">
                                <label class="glass-label fw-semibold text-slate-700 mb-2">MESSAGE CONTENT / PROJECT SPECIFICATIONS</label>
                                <div class="p-3 bg-white rounded-3 border text-slate-800 lh-base shadow-sm" style="white-space: pre-wrap; font-size: 0.95rem; min-height: 100px;">{{ $msg->message }}</div>
                            </div>
                        </div>

                        <div class="modal-footer border-top pt-3 d-flex justify-content-between">
                            <div>
                                <a href="mailto:{{ $msg->email }}?subject=Re:%20Software%20Enquiry%20-%20Software%20Company%20in%20Lucknow" class="btn btn-glass-primary me-2">
                                    <i class="bi bi-reply-fill me-1"></i> Reply via Email
                                </a>
                                <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="btn btn-outline-success fw-bold rounded-3">
                                    <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                </a>
                            </div>
                            <button type="button" class="btn btn-glass-outline" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @push('scripts')
    <script>
        function confirmDeleteMessage(id, name) {
            confirmAction({
                title: 'Delete Contact Message?',
                text: `Are you sure you want to delete message from "${name}"?`,
                icon: 'warning',
                confirmText: 'Yes, Delete',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteMessageForm-${id}`).submit();
                }
            });
        }

        function updateBulkDeleteUI() {
            const checkboxes = document.querySelectorAll('.message-checkbox');
            const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
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
            const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
            if (selectedCheckboxes.length === 0) return;

            confirmAction({
                title: 'Delete Selected Messages?',
                text: `Are you sure you want to delete ${selectedCheckboxes.length} selected contact messages?`,
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

        function toggleMessageReadStatus(msgId, forceRead = false) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const badge = document.getElementById('statusBadge-' + msgId);
            const row = document.getElementById('messageRow-' + msgId);

            if (forceRead && badge && badge.classList.contains('badge-glass-read')) {
                return; // Already read
            }

            fetch(`/admin/contact-messages/${msgId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.status === 'read') {
                        if (badge) {
                            badge.className = 'badge-glass-read';
                            badge.innerHTML = '<i class="bi bi-envelope-open me-1"></i> READ';
                        }
                        if (row) {
                            row.classList.remove('bg-emerald-50-subtle');
                        }
                    } else {
                        if (badge) {
                            badge.className = 'badge-glass-new';
                            badge.innerHTML = '<i class="bi bi-envelope-fill me-1"></i> NEW';
                        }
                        if (row) {
                            row.classList.add('bg-emerald-50-subtle');
                        }
                    }

                    if (data.unreadCount !== undefined) {
                        const countEl = document.getElementById('unreadEnquiriesCount');
                        if (countEl) {
                            countEl.textContent = data.unreadCount;
                        }
                    }
                }
            })
            .catch(error => console.error('Error toggling contact status:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Select All Checkbox Handler
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    document.querySelectorAll('.message-checkbox').forEach(cb => {
                        cb.checked = this.checked;
                    });
                    updateBulkDeleteUI();
                });
            }

            // Individual Checkbox Handlers
            document.querySelectorAll('.message-checkbox').forEach(cb => {
                cb.addEventListener('change', updateBulkDeleteUI);
            });

            // Mark Read Button Handler
            document.querySelectorAll('.mark-read-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const msgId = this.getAttribute('data-msg-id');
                    if (msgId) {
                        toggleMessageReadStatus(msgId, false);
                    }
                });
            });

            // Auto mark as read when View Modal button is clicked
            document.querySelectorAll('.btn-action-view').forEach(button => {
                button.addEventListener('click', function() {
                    const msgId = this.getAttribute('data-msg-id');
                    if (msgId) {
                        toggleMessageReadStatus(msgId, true);
                    }
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>
