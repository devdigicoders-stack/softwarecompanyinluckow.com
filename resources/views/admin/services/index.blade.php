<x-admin-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Services Management</h2>
            <p class="text-muted mb-0">Manage dedicated SEO service pages.</p>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Icon</th>
                        <th>Service Title</th>
                        <th>SEO Slug</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td><i class="bi {{ $service->icon }} fs-4 text-primary"></i></td>
                            <td class="fw-bold">{{ $service->title }}</td>
                            <td><code>/{{ $service->slug }}</code></td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-eye"></i> View Page</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No services found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
