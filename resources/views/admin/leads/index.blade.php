<x-admin-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Contact Submissions & Consultations</h2>
            <p class="text-muted mb-0">Manage customer project requests and leads.</p>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Received</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Company</th>
                        <th>Service Requested</th>
                        <th>Budget</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <td><small class="text-muted">{{ $lead->created_at->format('M d, Y H:i') }}</small></td>
                            <td class="fw-bold">{{ $lead->name }}</td>
                            <td>
                                <div><a href="mailto:{{ $lead->email }}" class="text-decoration-none">{{ $lead->email }}</a></div>
                                <small class="text-muted"><a href="tel:{{ $lead->phone }}" class="text-decoration-none text-muted">{{ $lead->phone }}</a></small>
                            </td>
                            <td>{{ $lead->company ?? 'N/A' }}</td>
                            <td><span class="badge bg-light text-primary border">{{ $lead->service ?? 'General' }}</span></td>
                            <td>{{ $lead->budget ?? 'N/A' }}</td>
                            <td><small class="text-slate-600" style="max-width: 250px; display: block;">{{ Str::limit($lead->message, 80) }}</small></td>
                            <td>
                                <form action="{{ route('admin.leads.status', $lead) }}" method="POST" class="d-inline">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>NEW</option>
                                        <option value="read" {{ $lead->status === 'read' ? 'selected' : '' }}>READ</option>
                                        <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>CONTACTED</option>
                                        <option value="resolved" {{ $lead->status === 'resolved' ? 'selected' : '' }}>RESOLVED</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this lead entry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">No lead submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $leads->links() }}
        </div>
    </div>
</x-admin-layout>
