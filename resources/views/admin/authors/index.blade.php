<x-admin-layout pageTitle="Author Management">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Blog Authors</h3>
            <p class="text-secondary small mb-0" style="color: #475569;">Manage authors, technical writers, and content contributors for blog posts.</p>
        </div>
        <div>
            <button type="button" class="btn btn-glass-primary" data-bs-toggle="modal" data-bs-target="#createAuthorModal">
                <i class="bi bi-person-plus-fill me-1"></i> Add New Author
            </button>
        </div>
    </div>

    <!-- Authors Glass Table -->
    <div class="glass-card overflow-hidden">
        @if($authors->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle">
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Role</th>
                            <th>Bio</th>
                            <th>Articles</th>
                            <th>Socials</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                            @php
                                $defaultAvatar = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80';
                                $avatarUrl = $author->avatar ? (str_starts_with($author->avatar, 'http') ? $author->avatar : asset($author->avatar)) : $defaultAvatar;
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $avatarUrl }}" alt="{{ $author->name }}" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;" onerror="this.onerror=null; this.src='{{ $defaultAvatar }}';">
                                        <div>
                                            <div class="fw-bold text-slate-900" style="color: #0f172a;">{{ $author->name }}</div>
                                            <small class="text-muted" style="font-size: 0.76rem;">/author/{{ $author->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-role">
                                        {{ $author->role ?: 'Senior Tech Editor' }}
                                    </span>
                                </td>
                                <td style="max-width: 280px; color: #334155; font-size: 0.86rem;">
                                    {{ Str::limit($author->bio ?: 'No bio available', 75) }}
                                </td>
                                <td>
                                    <span class="badge-tag-count">{{ $author->posts_count }} articles</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($author->twitter)
                                            <a href="{{ str_starts_with($author->twitter, 'http') ? $author->twitter : 'https://twitter.com/'.ltrim($author->twitter, '@') }}" target="_blank" class="text-secondary small" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                                        @endif
                                        @if($author->linkedin)
                                            <a href="{{ str_starts_with($author->linkedin, 'http') ? $author->linkedin : 'https://linkedin.com/in/'.ltrim($author->linkedin, '@') }}" target="_blank" class="text-primary small" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                        @endif
                                        @if(!$author->twitter && !$author->linkedin)
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn-action-edit" data-bs-toggle="modal" data-bs-target="#editAuthorModal-{{ $author->id }}" title="Edit Author"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn-action-delete" onclick="confirmDeleteAuthor({{ $author->id }}, '{{ addslashes($author->name) }}')" title="Delete Author"><i class="bi bi-trash"></i></button>
                                        <form id="deleteAuthorForm-{{ $author->id }}" action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" class="d-none">
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
                {{ $authors->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-person-badge fs-1 text-slate-400 d-block mb-2"></i>
                <p class="text-muted mb-3">No blog authors created yet.</p>
                <button type="button" class="btn btn-glass-primary" data-bs-toggle="modal" data-bs-target="#createAuthorModal">+ Add Author</button>
            </div>
        @endif
    </div>

    <!-- Edit Author Modals (Placed Outside Table to Prevent Stacking/Clipping Context Issues) -->
    @foreach($authors as $author)
        <div class="modal fade" id="editAuthorModal-{{ $author->id }}" tabindex="-1" aria-labelledby="editAuthorModalLabel-{{ $author->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content glass-card border-0 p-4">
                    <div class="modal-header border-bottom pb-2">
                        <h5 class="modal-title fw-bold text-slate-900" id="editAuthorModalLabel-{{ $author->id }}"><i class="bi bi-pencil-square text-emerald-600 me-2"></i> Edit Author: {{ $author->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body py-3">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="glass-label">Author Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control glass-input" value="{{ $author->name }}" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="glass-label">URL Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" class="form-control glass-input" value="{{ $author->slug }}" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="glass-label">Role / Job Title</label>
                                    <input type="text" name="role" class="form-control glass-input" value="{{ $author->role }}" placeholder="e.g. Lead Software Architect">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="glass-label">Change Avatar Image</label>
                                    <input type="file" name="avatar_file" class="form-control glass-input" accept="image/*">
                                </div>
                                <div class="col-12">
                                    <label class="glass-label">Bio / Description</label>
                                    <textarea name="bio" rows="3" class="form-control glass-input" placeholder="Short professional bio of the author...">{{ $author->bio }}</textarea>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="glass-label">Twitter Profile / Handle</label>
                                    <input type="text" name="twitter" class="form-control glass-input" value="{{ $author->twitter }}" placeholder="e.g. @username or URL">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="glass-label">LinkedIn Profile URL</label>
                                    <input type="text" name="linkedin" class="form-control glass-input" value="{{ $author->linkedin }}" placeholder="e.g. https://linkedin.com/in/username">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top pt-2">
                            <button type="button" class="btn btn-glass-outline" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-glass-primary">Update Author</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Create Author Modal -->
    <div class="modal fade" id="createAuthorModal" tabindex="-1" aria-labelledby="createAuthorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-card border-0 p-4">
                <div class="modal-header border-bottom pb-2">
                    <h5 class="modal-title fw-bold text-slate-900" id="createAuthorModalLabel"><i class="bi bi-person-plus-fill text-emerald-600 me-2"></i> Add New Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="glass-label">Author Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control glass-input" placeholder="e.g. Saurabh Kumar" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="glass-label">URL Slug</label>
                                <input type="text" name="slug" class="form-control glass-input" placeholder="saurabh-kumar">
                                <small class="text-muted">Auto-generates from name if left empty.</small>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="glass-label">Role / Job Title</label>
                                <input type="text" name="role" class="form-control glass-input" placeholder="e.g. Senior Tech Editor">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="glass-label">Avatar Image</label>
                                <input type="file" name="avatar_file" class="form-control glass-input" accept="image/*">
                            </div>
                            <div class="col-12">
                                <label class="glass-label">Bio / Description</label>
                                <textarea name="bio" rows="3" class="form-control glass-input" placeholder="Write a short bio describing technical expertise, experience, etc."></textarea>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="glass-label">Twitter Handle / URL</label>
                                <input type="text" name="twitter" class="form-control glass-input" placeholder="@username or URL">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="glass-label">LinkedIn Profile URL</label>
                                <input type="text" name="linkedin" class="form-control glass-input" placeholder="https://linkedin.com/in/username">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-2">
                        <button type="button" class="btn btn-glass-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-glass-primary">Create Author</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDeleteAuthor(id, name) {
            confirmAction({
                title: 'Delete Author?',
                text: `Are you sure you want to delete author "${name}"?`,
                icon: 'warning',
                confirmText: 'Yes, Delete',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteAuthorForm-${id}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
