<x-admin-layout pageTitle="Blog Management">
    <!-- Header Row -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Blog Articles</h3>
            <p class="text-secondary small mb-0">Create, edit, optimize SEO, and manage blog publication status.</p>
        </div>
        <div>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-glass-primary">
                <i class="bi bi-plus-lg me-1"></i> Write New Blog
            </a>
        </div>
    </div>

    <!-- Filter & Search Bar Card -->
    <div class="glass-card p-3 mb-4" style="position: relative; z-index: 35;">
        <form action="{{ route('admin.posts.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control glass-input border-start-0" placeholder="Search by title or content..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-6 col-md-3">
                <input type="hidden" name="status" id="postStatusInput" value="{{ request('status') }}">
                <div class="dropdown w-100">
                    <button class="btn glass-input bg-white w-100 d-flex align-items-center justify-content-between py-2 px-3 dropdown-toggle text-slate-800" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-semibold text-truncate me-1" style="font-size: 0.88rem;">
                            @if(request('status') === 'published') Published Only
                            @elseif(request('status') === 'draft') Drafts Only
                            @elseif(request('status') === 'featured') Featured Only
                            @elseif(request('status') === 'trending') Trending Only
                            @elseif(request('status') === 'popular') Popular Only
                            @else All Statuses & Flags
                            @endif
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start w-100 shadow-lg border p-1 rounded-3 mt-1" style="min-width: 180px;">
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === '' || !request('status') ? 'active text-white' : '' }}" style="{{ request('status') === '' || !request('status') ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postStatusInput').value=''; this.closest('form').submit();">All Statuses & Flags</a></li>
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === 'published' ? 'active text-white' : '' }}" style="{{ request('status') === 'published' ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postStatusInput').value='published'; this.closest('form').submit();">Published Only</a></li>
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === 'draft' ? 'active text-white' : '' }}" style="{{ request('status') === 'draft' ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postStatusInput').value='draft'; this.closest('form').submit();">Drafts Only</a></li>
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === 'featured' ? 'active text-white' : '' }}" style="{{ request('status') === 'featured' ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postStatusInput').value='featured'; this.closest('form').submit();">Featured Only</a></li>
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === 'trending' ? 'active text-white' : '' }}" style="{{ request('status') === 'trending' ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postStatusInput').value='trending'; this.closest('form').submit();">Trending Only</a></li>
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('status') === 'popular' ? 'active text-white' : '' }}" style="{{ request('status') === 'popular' ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postStatusInput').value='popular'; this.closest('form').submit();">Popular Only</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-6 col-md-2">
                <input type="hidden" name="category_id" id="postCategoryInput" value="{{ request('category_id') }}">
                @php
                    $selectedCatName = 'All Categories';
                    if (request('category_id')) {
                        $matchedCat = $categories->firstWhere('id', request('category_id'));
                        if ($matchedCat) $selectedCatName = $matchedCat->name;
                    }
                @endphp
                <div class="dropdown w-100">
                    <button class="btn glass-input bg-white w-100 d-flex align-items-center justify-content-between py-2 px-3 dropdown-toggle text-slate-800" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-semibold text-truncate me-1" style="font-size: 0.88rem;">{{ $selectedCatName }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end w-100 shadow-lg border p-1 rounded-3 mt-1" style="min-width: 200px; max-height: 280px; overflow-y: auto;">
                        <li><a class="dropdown-item rounded-2 small py-1.5 {{ !request('category_id') ? 'active text-white' : '' }}" style="{{ !request('category_id') ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postCategoryInput').value=''; this.closest('form').submit();">All Categories</a></li>
                        @foreach($categories as $cat)
                            <li><a class="dropdown-item rounded-2 small py-1.5 {{ request('category_id') == $cat->id ? 'active text-white' : '' }}" style="{{ request('category_id') == $cat->id ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('postCategoryInput').value='{{ $cat->id }}'; this.closest('form').submit();">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-glass-primary w-100 py-2">Filter</button>
                @if(request()->hasAny(['search', 'status', 'category_id']))
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-glass-outline px-2" title="Reset Filters"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Blog Table Card -->
    <div class="glass-card overflow-hidden">
        @if($posts->count() > 0)
            <div class="table-responsive">
                <table class="table glass-table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Image</th>
                            <th style="min-width: 380px;">Title & Slug</th>
                            <th style="white-space: nowrap;">Category</th>
                            <th style="white-space: nowrap;">Author</th>
                            <th style="white-space: nowrap;">Status</th>
                            <th style="white-space: nowrap;">Featured</th>
                            <th style="white-space: nowrap;">Trending</th>
                            <th style="white-space: nowrap;">Popular</th>
                            <th style="white-space: nowrap;">Views (IP Log)</th>
                            <th style="white-space: nowrap;">Date</th>
                            <th class="text-end" style="white-space: nowrap;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <div class="rounded-3 overflow-hidden bg-slate-900 border" style="width: 56px; height: 40px;">
                                        <img src="{{ $post->featured_image ? asset($post->featured_image) : 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=200&q=80' }}"
                                            alt="{{ $post->title }}" class="w-100 h-100 object-fit-cover"
                                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=200&q=80';">
                                    </div>
                                </td>
                                <td style="min-width: 380px; max-width: 550px;">
                                    <div class="fw-bold text-slate-900" style="font-size: 0.92rem; line-height: 1.35;" title="{{ $post->title }}">
                                        {{ $post->title }}
                                    </div>
                                    <small class="text-muted text-monospace d-block mt-0.5" style="font-size: 0.76rem; word-break: break-all;">/blogs/{{ $post->slug }}</small>
                                </td>
                                <td>
                                    <span class="badge-category">{{ $post->category->name ?? 'General' }}</span>
                                </td>
                                <td>
                                    <small class="text-slate-600">{{ $post->author->name ?? 'Editorial Staff' }}</small>
                                </td>
                                <td>
                                    <button type="button" class="btn p-0 border-0 toggle-status-btn" data-post-id="{{ $post->id }}" title="Toggle Publish Status">
                                        @if($post->is_published)
                                            <span class="badge-glass-published" id="statusBadge-{{ $post->id }}"><i class="bi bi-check-circle-fill me-1"></i> Published</span>
                                        @else
                                            <span class="badge-glass-draft" id="statusBadge-{{ $post->id }}"><i class="bi bi-clock-history me-1"></i> Draft</span>
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn p-0 border-0 toggle-featured-btn" data-post-id="{{ $post->id }}" title="Toggle Hero Featured Spotlight">
                                        @if($post->is_featured)
                                            <span class="badge bg-warning text-dark fw-bold px-2 py-1" id="featuredBadge-{{ $post->id }}"><i class="bi bi-star-fill me-1"></i> Featured</span>
                                        @else
                                            <span class="badge bg-light text-muted border px-2 py-1" id="featuredBadge-{{ $post->id }}"><i class="bi bi-star me-1"></i> Normal</span>
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn p-0 border-0 toggle-trending-btn" data-post-id="{{ $post->id }}" title="Toggle Trending Status">
                                        @if($post->is_trending)
                                            <span class="badge bg-danger text-white fw-bold px-2 py-1" id="trendingBadge-{{ $post->id }}"><i class="bi bi-fire me-1"></i> Trending</span>
                                        @else
                                            <span class="badge bg-light text-muted border px-2 py-1" id="trendingBadge-{{ $post->id }}"><i class="bi bi-fire me-1"></i> Off</span>
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn p-0 border-0 toggle-popular-btn" data-post-id="{{ $post->id }}" title="Toggle Popular Status">
                                        @if($post->is_popular)
                                            <span class="badge bg-info text-dark fw-bold px-2 py-1" id="popularBadge-{{ $post->id }}"><i class="bi bi-graph-up-arrow me-1"></i> Popular</span>
                                        @else
                                            <span class="badge bg-light text-muted border px-2 py-1" id="popularBadge-{{ $post->id }}"><i class="bi bi-graph-up me-1"></i> Off</span>
                                        @endif
                                    </button>
                                </td>
                                <td class="text-nowrap" style="white-space: nowrap;">
                                    <button type="button" class="btn btn-sm btn-light border text-slate-800 fw-bold px-2.5 py-1 rounded-pill d-inline-flex align-items-center gap-1.5 shadow-2xs" onclick="openIpViewsModal({{ $post->id }})" title="Click to view IP Address visitor log" style="white-space: nowrap; font-size: 0.78rem;">
                                        <i class="bi bi-eye-fill text-emerald-600"></i>
                                        <span>{{ number_format($post->view_count) }}</span>
                                        <span class="text-muted fw-normal">Views</span>
                                    </button>
                                </td>
                                <td class="text-muted small">
                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-end" style="white-space: nowrap;">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('blogs.show', $post->slug) }}" target="_blank" class="btn-action-view" title="Preview on public website"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn-action-edit" title="Edit Article"><i class="bi bi-pencil-square"></i></a>
                                        <button type="button" class="btn-action-delete" onclick="confirmDeletePost({{ $post->id }}, '{{ addslashes($post->title) }}')" title="Delete Article"><i class="bi bi-trash"></i></button>
                                        <form id="deletePostForm-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-none">
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

            <div class="p-3 border-top d-flex justify-content-between align-items-center">
                <span class="small text-muted">Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} blogs</span>
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 px-4">
                <div class="rounded-circle bg-emerald-50 text-emerald-600 d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: rgba(5, 150, 105, 0.1);">
                    <i class="bi bi-journal-plus fs-1" style="color: #059669;"></i>
                </div>
                <h5 class="fw-bold text-slate-900 mb-2">No blogs yet</h5>
                <p class="text-muted small mb-4" style="max-width: 420px; margin: 0 auto;">
                    Start publishing your first article to attract organic search traffic and establish technology leadership in Lucknow.
                </p>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-glass-primary py-2 px-4">
                    + Write Your First Blog
                </a>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Toggle Published Status
            document.querySelectorAll('.toggle-status-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    const badge = document.getElementById('statusBadge-' + postId);

                    fetch(`/admin/blogs/${postId}/toggle-status`, {
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
                            if (data.is_published) {
                                badge.className = 'badge-glass-published';
                                badge.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Published';
                            } else {
                                badge.className = 'badge-glass-draft';
                                badge.innerHTML = '<i class="bi bi-clock-history me-1"></i> Draft';
                            }

                            if (typeof showGlassToast === 'function') {
                                showGlassToast('success', 'Status Updated', data.message);
                            }
                        }
                    })
                    .catch(error => console.error('Error toggling status:', error));
                });
            });

            // Toggle Featured Status
            document.querySelectorAll('.toggle-featured-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    const badge = document.getElementById('featuredBadge-' + postId);

                    fetch(`/admin/blogs/${postId}/toggle-featured`, {
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
                            // Reset all other featured badges to Normal
                            document.querySelectorAll('[id^="featuredBadge-"]').forEach(b => {
                                b.className = 'badge bg-light text-muted border px-2 py-1';
                                b.innerHTML = '<i class="bi bi-star me-1"></i> Normal';
                            });

                            if (data.is_featured) {
                                badge.className = 'badge bg-warning text-dark fw-bold px-2 py-1';
                                badge.innerHTML = '<i class="bi bi-star-fill me-1"></i> Featured';
                            }

                            if (typeof showGlassToast === 'function') {
                                showGlassToast('success', 'Featured Updated', data.message);
                            }
                        }
                    })
                    .catch(error => console.error('Error toggling featured status:', error));
                });
            });

            // Toggle Trending Status
            document.querySelectorAll('.toggle-trending-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    const badge = document.getElementById('trendingBadge-' + postId);

                    fetch(`/admin/blogs/${postId}/toggle-trending`, {
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
                            if (data.is_trending) {
                                badge.className = 'badge bg-danger text-white fw-bold px-2 py-1';
                                badge.innerHTML = '<i class="bi bi-fire me-1"></i> Trending';
                            } else {
                                badge.className = 'badge bg-light text-muted border px-2 py-1';
                                badge.innerHTML = '<i class="bi bi-fire me-1"></i> Off';
                            }

                            if (typeof showGlassToast === 'function') {
                                showGlassToast('success', 'Trending Updated', data.message);
                            }
                        }
                    })
                    .catch(error => console.error('Error toggling trending status:', error));
                });
            });

            // Toggle Popular Status
            document.querySelectorAll('.toggle-popular-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    const badge = document.getElementById('popularBadge-' + postId);

                    fetch(`/admin/blogs/${postId}/toggle-popular`, {
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
                            if (data.is_popular) {
                                badge.className = 'badge bg-info text-dark fw-bold px-2 py-1';
                                badge.innerHTML = '<i class="bi bi-graph-up-arrow me-1"></i> Popular';
                            } else {
                                badge.className = 'badge bg-light text-muted border px-2 py-1';
                                badge.innerHTML = '<i class="bi bi-graph-up me-1"></i> Off';
                            }

                            if (typeof showGlassToast === 'function') {
                                showGlassToast('success', 'Popular Updated', data.message);
                            }
                        }
                    })
                    .catch(error => console.error('Error toggling popular status:', error));
                });
            });
        });

        function confirmDeletePost(id, title) {
            confirmAction({
                title: 'Delete Blog Article?',
                text: `Are you sure you want to delete "${title}"?`,
                icon: 'warning',
                confirmText: 'Yes, Delete Article',
                cancelText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deletePostForm-${id}`).submit();
                }
            });
        }

        function openIpViewsModal(postId) {
            const modal = new bootstrap.Modal(document.getElementById('ipViewsModal'));
            const titleEl = document.getElementById('ipViewsPostTitle');
            const totalViewsEl = document.getElementById('modalTotalViews');
            const uniqueIpsEl = document.getElementById('modalUniqueIps');
            const tableBody = document.getElementById('ipViewsTableBody');

            titleEl.textContent = 'Loading article...';
            totalViewsEl.textContent = '...';
            uniqueIpsEl.textContent = '...';
            tableBody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-muted"><div class="spinner-border spinner-border-sm text-primary me-2"></div> Loading IP logs...</td></tr>';
            
            modal.show();

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            fetch(`/admin/blogs/${postId}/ip-views`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(res => res.json())
            .then(data => {
                titleEl.textContent = data.post_title;
                totalViewsEl.textContent = data.total_views;
                uniqueIpsEl.textContent = data.unique_ips_count;

                if (data.views && data.views.length > 0) {
                    tableBody.innerHTML = data.views.map((view, idx) => `
                        <tr>
                            <td class="small text-muted align-top">${idx + 1}</td>
                            <td class="align-top">
                                <span class="badge bg-dark-subtle text-dark border font-monospace px-2 py-1" style="font-size: 0.82rem;">
                                    <i class="bi bi-laptop me-1 text-primary"></i> ${view.ip_address}
                                </span>
                            </td>
                            <td class="align-top">
                                <div class="fw-bold text-slate-800" style="font-size: 0.84rem;">
                                    <i class="bi bi-globe me-1 text-primary"></i> ${view.browser_info}
                                </div>
                                <div class="text-muted small mt-1 text-break font-monospace" style="font-size: 0.73rem; word-break: break-all;">
                                    ${view.user_agent}
                                </div>
                            </td>
                            <td class="align-top text-nowrap"><small class="text-muted"><i class="bi bi-clock me-1 text-emerald-600"></i> ${view.viewed_at}</small></td>
                        </tr>
                    `).join('');
                } else {
                    tableBody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-muted"><i class="bi bi-info-circle me-1"></i> No IP view records found for this article yet.</td></tr>';
                }
            })
            .catch(err => {
                console.error('Error fetching IP views:', err);
                tableBody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-danger"><i class="bi bi-exclamation-triangle-fill me-1"></i> Failed to load IP logs.</td></tr>';
            });
        }
    </script>

    <!-- IP Views Log Modal -->
    <div class="modal fade" id="ipViewsModal" tabindex="-1" aria-labelledby="ipViewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-modal border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-bottom px-4 py-3">
                    <div>
                        <h5 class="modal-title fw-bold text-slate-900 mb-0" id="ipViewsModalLabel"><i class="bi bi-shield-lock-fill text-emerald-600 me-2"></i> IP Views & Visitor Log</h5>
                        <small class="text-muted font-monospace" id="ipViewsPostTitle">Article title...</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border text-center">
                                <span class="text-muted small d-block mb-1">Total Post Views</span>
                                <h4 class="fw-bold text-emerald-600 mb-0" id="modalTotalViews">0</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border text-center">
                                <span class="text-muted small d-block mb-1">Unique IP Visitors</span>
                                <h4 class="fw-bold text-primary mb-0" id="modalUniqueIps">0</h4>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive rounded-3 border" style="max-height: 320px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light sticky-top" style="z-index: 1;">
                                <tr>
                                    <th>#</th>
                                    <th>IP Address</th>
                                    <th>User Agent / Browser</th>
                                    <th>Visit Timestamp</th>
                                </tr>
                            </thead>
                            <tbody id="ipViewsTableBody">
                                <tr><td colspan="4" class="text-center py-4 text-muted"><div class="spinner-border spinner-border-sm text-primary me-2"></div> Loading IP logs...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2.5">
                    <button type="button" class="btn btn-secondary text-white fw-bold px-4 rounded-3" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endpush
</x-admin-layout>
