<x-admin-layout pageTitle="Tag Management">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Blog Tags</h3>
            <p class="text-secondary small mb-0" style="color: #475569;">Manage keyword tags attached to blog articles.</p>
        </div>
        <div>
            <button type="button" class="btn btn-glass-primary" data-bs-toggle="modal" data-bs-target="#createTagModal">
                <i class="bi bi-plus-lg me-1"></i> Add New Tag
            </button>
        </div>
    </div>

    <!-- Tag Glass Table -->
    <div class="glass-card overflow-hidden">
        @if($tags->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle">
                    <thead>
                        <tr>
                            <th>Tag Name</th>
                            <th>Slug</th>
                            <th>Blogs Count</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>
                                    <span class="badge-tag-name">#{{ $tag->name }}</span>
                                </td>
                                <td>
                                    <span class="text-slate-slug">/tag/{{ $tag->slug }}</span>
                                </td>
                                <td>
                                    <span class="badge-tag-count">{{ $tag->posts_count }} articles</span>
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn-action-edit" data-bs-toggle="modal" data-bs-target="#editTagModal-{{ $tag->id }}" title="Edit Tag"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn-action-delete" onclick="confirmDeleteTag({{ $tag->id }}, '{{ addslashes($tag->name) }}')" title="Delete Tag"><i class="bi bi-trash"></i></button>
                                        <form id="deleteTagForm-{{ $tag->id }}" action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>

                                    <!-- Edit Tag Modal -->
                                    <div class="modal fade text-start" id="editTagModal-{{ $tag->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content glass-card border-0 p-4">
                                                <div class="modal-header border-bottom pb-2">
                                                    <h5 class="modal-title fw-bold text-slate-900">Edit Tag</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body py-3">
                                                        <div class="mb-3">
                                                            <label class="glass-label">Tag Name</label>
                                                            <input type="text" name="name" class="form-control glass-input" value="{{ $tag->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="glass-label">Slug</label>
                                                            <input type="text" name="slug" class="form-control glass-input" value="{{ $tag->slug }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-top pt-2">
                                                        <button type="button" class="btn btn-glass-outline" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-glass-primary">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $tags->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-tags fs-1 text-slate-400 d-block mb-2"></i>
                <p class="text-muted mb-3">No tags created yet.</p>
                <button type="button" class="btn btn-glass-primary" data-bs-toggle="modal" data-bs-target="#createTagModal">+ Add Tag</button>
            </div>
        @endif
    </div>

    <!-- Create Tag Modal -->
    <div class="modal fade" id="createTagModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content glass-card border-0 p-4">
                <div class="modal-header border-bottom pb-2">
                    <h5 class="modal-title fw-bold text-slate-900">Add New Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label class="glass-label">Tag Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control glass-input" placeholder="e.g. Flutter, Laravel, ERP" required>
                        </div>
                        <div class="mb-3">
                            <label class="glass-label">URL Slug</label>
                            <input type="text" name="slug" class="form-control glass-input" placeholder="flutter">
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-2">
                        <button type="button" class="btn btn-glass-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-glass-primary">Create Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function confirmDeleteTag(id, name) {
            confirmAction({
                title: 'Delete Tag?',
                text: `Are you sure you want to delete tag "#${name}"?`,
                icon: 'warning',
                confirmText: 'Yes, Delete',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteTagForm-${id}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
