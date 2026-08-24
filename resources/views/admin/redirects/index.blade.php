<x-admin-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">301 URL Redirect Manager</h2>
            <p class="text-muted mb-0">Manage permanent 301 redirects to preserve SEO juice when URLs change.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="admin-card p-4">
                <h5 class="fw-bold mb-3">Add New Redirect</h5>
                <form action="{{ route('admin.redirects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="old_url" class="form-label fw-bold">Old Path <span class="text-danger">*</span></label>
                        <input type="text" name="old_url" id="old_url" class="form-control" placeholder="/old-software-page" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_url" class="form-label fw-bold">Target Path / URL <span class="text-danger">*</span></label>
                        <input type="text" name="new_url" id="new_url" class="form-control" placeholder="/software-development-company-in-lucknow" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_code" class="form-label fw-bold">HTTP Status Code</label>
                        <select name="status_code" id="status_code" class="form-select">
                            <option value="301" selected>301 Permanent Redirect</option>
                            <option value="302">302 Temporary Redirect</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary fw-bold w-100">Create Redirect Rule</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="admin-card p-4">
                <h5 class="fw-bold mb-3">Active Redirect Rules</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Old Path</th>
                                <th>Target Path</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($redirects as $redirect)
                                <tr>
                                    <td><code>{{ $redirect->old_url }}</code></td>
                                    <td><code>{{ $redirect->new_url }}</code></td>
                                    <td><span class="badge bg-primary">{{ $redirect->status_code }}</span></td>
                                    <td>
                                        <form action="{{ route('admin.redirects.destroy', $redirect) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this redirect?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">No custom redirect rules configured.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
