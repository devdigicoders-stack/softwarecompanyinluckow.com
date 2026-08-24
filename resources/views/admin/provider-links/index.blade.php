<x-admin-layout title="Provider External Link Map Management">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 fw-bold mb-1">Provider External Link Map</h2>
            <p class="text-muted small mb-0">Configure target URLs and track outbound referral clicks.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-link-45deg text-primary me-2"></i> Add Provider Link Mapping</h5>
                    <form action="{{ route('admin.provider-links.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="anchor_text" class="form-label font-semibold">Anchor Text / Label</label>
                            <input type="text" name="anchor_text" id="anchor_text" class="form-control" placeholder="e.g. website development services" required>
                        </div>
                        <div class="mb-3">
                            <label for="target_url" class="form-label font-semibold">Target URL</label>
                            <input type="url" name="target_url" id="target_url" class="form-control" placeholder="https://softwarecompanyinlucknow.com/service/website-development" required>
                        </div>
                        <div class="mb-3">
                            <label for="service_category" class="form-label font-semibold">Service Category Scope</label>
                            <select name="service_category" id="service_category" class="form-select" required>
                                <option value="general">General / Homepage</option>
                                <option value="software">Custom Software</option>
                                <option value="web">Web Development</option>
                                <option value="app">Mobile Apps</option>
                                <option value="erp">ERP Solutions</option>
                                <option value="crm">CRM Solutions</option>
                                <option value="hrms">HRMS Solutions</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="context_notes" class="form-label font-semibold">Context Notes</label>
                            <textarea name="context_notes" id="context_notes" class="form-control" rows="2" placeholder="e.g. Recommended link for web development cost guide"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary fw-bold w-100 py-2">
                            <i class="bi bi-plus-circle me-1"></i> Save Link Mapping
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-diagram-2 text-primary me-2"></i> Active External Link Maps</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Anchor & Category</th>
                                    <th>Target URL</th>
                                    <th>Clicks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($links as $link)
                                    <tr>
                                        <td>
                                            <strong class="d-block text-dark">{{ $link->anchor_text }}</strong>
                                            <span class="badge bg-light text-primary border">{{ $link->service_category }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ $link->target_url }}" target="_blank" class="small text-truncate d-block" style="max-width: 220px;">
                                                {{ $link->target_url }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-success px-2 py-1"><i class="bi bi-cursor-fill me-1"></i> {{ $link->click_count }}</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.provider-links.destroy', $link) }}" method="POST" onsubmit="return confirm('Delete this link mapping?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No custom link mappings added yet. System defaults to homepage.</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
