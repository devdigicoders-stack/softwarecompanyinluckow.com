<x-admin-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">SEO Metadata Overrides</h2>
            <p class="text-muted mb-0">Customize route-level meta titles, descriptions, and OpenGraph tags.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="admin-card p-4">
                <h5 class="fw-bold mb-3">Add Custom Route SEO</h5>
                <form action="{{ route('admin.seo.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="route_name" class="form-label fw-bold">Route Name <span class="text-danger">*</span></label>
                        <input type="text" name="route_name" id="route_name" class="form-control" placeholder="e.g. home or about" required>
                    </div>
                    <div class="mb-3">
                        <label for="meta_title" class="form-label fw-bold">Meta Title <span class="text-danger">*</span></label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="meta_description" class="form-label fw-bold">Meta Description <span class="text-danger">*</span></label>
                        <textarea name="meta_description" id="meta_description" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="canonical_url" class="form-label fw-bold">Canonical URL Override</label>
                        <input type="text" name="canonical_url" id="canonical_url" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary fw-bold w-100">Save SEO Metadata</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="admin-card p-4">
                <h5 class="fw-bold mb-3">Saved Meta Entries</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Route</th>
                                <th>Meta Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($metadatas as $meta)
                                <tr>
                                    <td><code>{{ $meta->route_name }}</code></td>
                                    <td>{{ Str::limit($meta->meta_title, 40) }}</td>
                                    <td>
                                        <form action="{{ route('admin.seo.destroy', $meta) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete SEO settings?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted">No custom SEO overrides created.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
