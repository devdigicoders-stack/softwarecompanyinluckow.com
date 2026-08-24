<x-admin-layout pageTitle="Category Management">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Blog Categories</h3>
            <p class="text-secondary small mb-0" style="color: #475569;">Manage taxonomy categories for article grouping and SEO indexing.</p>
        </div>
        <div>
            <button type="button" class="btn btn-glass-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                <i class="bi bi-plus-lg me-1"></i> Add New Category
            </button>
        </div>
    </div>

    <!-- Category Glass Table -->
    <div class="glass-card overflow-hidden">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Blogs Count</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="fw-bold text-slate-900" style="color: #0f172a;">
                                    <i class="bi bi-folder2-open me-2 text-emerald-600"></i> {{ $category->name }}
                                </td>
                                <td>
                                    <span class="text-slate-slug">/category/{{ $category->slug }}</span>
                                </td>
                                <td style="max-width: 300px; color: #334155; font-weight: 500;">
                                    {{ $category->description ?: '—' }}
                                </td>
                                <td>
                                    <span class="badge-tag-count">{{ $category->posts_count }} articles</span>
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn-action-edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal-{{ $category->id }}" title="Edit Category"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn-action-delete" onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')" title="Delete Category"><i class="bi bi-trash"></i></button>
                                        <form id="deleteCategoryForm-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-none">
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
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-folder-plus fs-1 text-slate-400 d-block mb-2"></i>
                <p class="text-muted mb-3">No categories created yet.</p>
                <button type="button" class="btn btn-glass-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">+ Add Category</button>
            </div>
        @endif
    </div>

    <!-- Edit Category Modals -->
    @foreach($categories as $category)
        <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-card border-0 p-4">
                    <div class="modal-header border-bottom pb-2">
                        <h5 class="modal-title fw-bold text-slate-900">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body py-3">
                            <div class="mb-3">
                                <label class="glass-label">Category Name</label>
                                <input type="text" name="name" class="form-control glass-input" value="{{ $category->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="glass-label">Slug</label>
                                <input type="text" name="slug" class="form-control glass-input" value="{{ $category->slug }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="glass-label">Description</label>
                                <textarea name="description" rows="3" class="form-control glass-input">{{ $category->description }}</textarea>
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
    @endforeach

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card border-0 p-4">
                <div class="modal-header border-bottom pb-2">
                    <h5 class="modal-title fw-bold text-slate-900">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label class="glass-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control glass-input" placeholder="e.g. Software Cost & Guides" required>
                        </div>
                        <div class="mb-3">
                            <label class="glass-label">URL Slug</label>
                            <input type="text" name="slug" class="form-control glass-input" placeholder="software-cost-guides">
                            <small class="text-muted">Leave empty to auto-generate from name.</small>
                        </div>
                        <div class="mb-3">
                            <label class="glass-label">Description</label>
                            <textarea name="description" rows="3" class="form-control glass-input" placeholder="Brief category description for SEO listing..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-2">
                        <button type="button" class="btn btn-glass-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-glass-primary">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function confirmDeleteCategory(id, name) {
            confirmAction({
                title: 'Delete Category?',
                text: `Are you sure you want to delete category "${name}"?`,
                icon: 'warning',
                confirmText: 'Yes, Delete',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteCategoryForm-${id}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
