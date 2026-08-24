<x-admin-layout pageTitle="Dashboard Overview">
    <!-- Welcome Header Card -->
    <div class="glass-card p-4 mb-4 border-0 shadow-sm"
        style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(241, 245, 249, 0.9));">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Welcome back, Admin 👋</h3>
                <p class="text-secondary small mb-0" style="color: #475569; font-size: 0.95rem;">Manage your blog
                    content and website enquiries from one place.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-glass-primary">
                    <i class="bi bi-plus-lg me-1"></i> Write New Blog
                </a>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-glass-outline">
                    <i class="bi bi-newspaper me-1"></i> View All Blogs
                </a>
                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-glass-outline position-relative">
                    <i class="bi bi-envelope me-1"></i> Contact Enquiries
                    @if($newContactsCount > 0)
                        <span class="badge bg-danger rounded-pill ms-1"
                            style="font-size: 0.75rem;">{{ $newContactsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.subscribers.index') }}" class="btn btn-glass-outline">
                    <i class="bi bi-mailbox me-1"></i> Subscribers ({{ $totalSubscribers }})
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-glass-outline">
                    <i class="bi bi-question-circle me-1"></i> Page FAQs ({{ $totalFaqsCount }})
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Statistics Cards Grid with Vibrant Glass Colors -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Blogs -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div
                class="glass-card glass-card-hover stat-card-emerald p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold small text-uppercase"
                            style="color: #065f46; font-size: 0.82rem; letter-spacing: 0.04em;">Total Blogs</span>
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 44px; height: 44px; background: #059669; color: #ffffff;">
                            <i class="bi bi-journal-richtext fs-4"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-3">
                        <h2 class="fw-bold mb-0" style="color: #064e3b; font-size: 2.2rem;">{{ $totalPosts }}</h2>
                        <span class="text-emerald-800 small fw-semibold" style="color: #065f46;">articles</span>
                    </div>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between"
                    style="font-size: 0.82rem; border-color: rgba(16, 185, 129, 0.2) !important;">
                    <span class="fw-bold" style="color: #047857;">Content Database</span>
                    <i class="bi bi-arrow-right fw-bold" style="color: #059669;"></i>
                </div>
            </div>
        </div>

        <!-- 2. Published Blogs -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="glass-card glass-card-hover stat-card-sky p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold small text-uppercase"
                            style="color: #0369a1; font-size: 0.82rem; letter-spacing: 0.04em;">Published</span>
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 44px; height: 44px; background: #0284c7; color: #ffffff;">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-3">
                        <h2 class="fw-bold mb-0" style="color: #0c4a6e; font-size: 2.2rem;">{{ $publishedPostsCount }}
                        </h2>
                        <span class="badge-glass-published">Live on site</span>
                    </div>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between"
                    style="font-size: 0.82rem; border-color: rgba(14, 165, 233, 0.2) !important;">
                    <span class="fw-bold" style="color: #0369a1;">Organic Google Index</span>
                    <i class="bi bi-globe fw-bold" style="color: #0284c7;"></i>
                </div>
            </div>
        </div>

        <!-- 3. Draft Blogs -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div
                class="glass-card glass-card-hover stat-card-amber p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold small text-uppercase"
                            style="color: #92400e; font-size: 0.82rem; letter-spacing: 0.04em;">Drafts</span>
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 44px; height: 44px; background: #d97706; color: #ffffff;">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-3">
                        <h2 class="fw-bold mb-0" style="color: #78350f; font-size: 2.2rem;">{{ $draftPostsCount }}</h2>
                        <span class="badge-glass-draft">Unpublished</span>
                    </div>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between"
                    style="font-size: 0.82rem; border-color: rgba(245, 158, 11, 0.2) !important;">
                    <span class="fw-bold" style="color: #92400e;">Pending review</span>
                    <i class="bi bi-clock-history fw-bold" style="color: #d97706;"></i>
                </div>
            </div>
        </div>

        <!-- 4. Contact Messages -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div
                class="glass-card glass-card-hover stat-card-indigo p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold small text-uppercase"
                            style="color: #3730a3; font-size: 0.82rem; letter-spacing: 0.04em;">Contact Enquiries</span>
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 44px; height: 44px; background: #4f46e5; color: #ffffff;">
                            <i class="bi bi-envelope-open-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2 mb-3">
                        <h2 class="fw-bold mb-0" style="color: #312e81; font-size: 2.2rem;">{{ $totalContacts }}</h2>
                        @if($newContactsCount > 0)
                            <span class="badge-glass-new">{{ $newContactsCount }} NEW</span>
                        @else
                            <span class="badge-glass-read">All read</span>
                        @endif
                    </div>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between"
                    style="font-size: 0.82rem; border-color: rgba(99, 102, 241, 0.2) !important;">
                    <span class="fw-bold" style="color: #3730a3;">Public Submissions</span>
                    <i class="bi bi-chat-left-text fw-bold" style="color: #4f46e5;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Content & Enquiries Row -->
    <div class="row g-4 mb-4">
        <!-- Recent Blogs (7 Cols) -->
        <div class="col-12 col-lg-7">
            <div class="glass-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                    <h5 class="fw-bold text-slate-900 mb-0" style="color: #0f172a;">
                        <i class="bi bi-journal-text text-emerald-600 me-2"></i> Recent Blogs
                    </h5>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-glass-outline">View All</a>
                </div>

                @if($recentPosts->count() > 0)
                    <div class="table-responsive">
                        <table class="table glass-table align-middle">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPosts as $post)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-slate-900 line-clamp-2"
                                                style="max-width: 220px; font-size: 0.9rem;" title="{{ $post->title }}">
                                                {{ $post->title }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-category">{{ $post->category->name ?? 'Uncategorized' }}</span>
                                        </td>
                                        <td>
                                            @if($post->is_published)
                                                <span class="badge-glass-published">Published</span>
                                            @else
                                                <span class="badge-glass-draft">Draft</span>
                                            @endif
                                        </td>
                                        <td class="text-slate-600 small fw-medium" style="white-space: nowrap;">
                                            {{ $post->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="text-end" style="white-space: nowrap;">
                                            <div class="d-inline-flex gap-1">
                                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                                    class="btn-action-view" title="Preview Live"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn-action-edit"
                                                    title="Edit Article"><i class="bi bi-pencil-square"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-file-earmark-plus fs-1 text-slate-400 d-block mb-2"></i>
                        <p class="mb-2 fw-semibold">No blog posts found yet.</p>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-glass-primary btn-sm">+ Write Your First
                            Blog</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Contact Enquiries (5 Cols) -->
        <div class="col-12 col-lg-5">
            <div class="glass-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                    <h5 class="fw-bold text-slate-900 mb-0" style="color: #0f172a;">
                        <i class="bi bi-inbox-fill text-info me-2"></i> Recent Contact Leads
                    </h5>
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-glass-outline">View
                        All</a>
                </div>

                @if($recentContacts->count() > 0)
                    <div class="d-flex flex-column gap-2.5">
                        @foreach($recentContacts as $contact)
                            <div class="bg-white border rounded-3 p-3 shadow-sm">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <h6 class="fw-bold text-slate-900 mb-0" style="font-size: 0.95rem;">{{ $contact->name }}</h6>
                                    @if($contact->status === 'new')
                                        <span class="badge-glass-new">NEW</span>
                                    @else
                                        <span class="badge-glass-read">READ</span>
                                    @endif
                                </div>
                                <div class="text-slate-600 small mb-2 text-truncate" style="font-size: 0.82rem;">
                                    <i class="bi bi-envelope text-muted me-1"></i>{{ $contact->email }}
                                    @if($contact->phone)
                                        &bull; <i class="bi bi-telephone text-muted me-1"></i>{{ $contact->phone }}
                                    @endif
                                </div>
                                <p class="small text-slate-700 mb-2 line-clamp-2" style="font-size: 0.85rem; line-height: 1.45;">
                                    "{{ $contact->message }}"
                                </p>
                                <div class="d-flex align-items-center justify-content-between pt-2 border-top" style="font-size: 0.78rem;">
                                    <span class="text-muted"><i class="bi bi-clock me-1"></i>{{ $contact->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 text-nowrap fw-bold" style="font-size: 0.78rem;">
                                        <i class="bi bi-eye me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 text-slate-400 d-block mb-2"></i>
                        <p class="mb-0 fw-semibold">No contact messages received yet.</p>
                        <small class="text-muted">Public contact submissions will appear here.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Admin Login Activity Logs Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="glass-card p-4">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-3 border-bottom pb-2">
                    <div>
                        <h5 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">
                            <i class="bi bi-shield-lock-fill text-emerald-600 me-2"></i> Security Audit & Admin Login
                            Activity Logs
                        </h5>
                        <p class="text-muted small mb-0" style="font-size: 0.82rem;">
                            Live audit tracking of admin login history, IP origins, reverse-geocoded addresses, and
                            active session durations.
                        </p>
                    </div>
                    <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-sm btn-glass-outline text-nowrap flex-shrink-0">
                        <i class="bi bi-clock-history me-1"></i> View Full Login History
                    </a>
                </div>

                @if(isset($recentActivityLogs) && $recentActivityLogs->count() > 0)
                    <div class="table-responsive">
                        <table class="table glass-table align-middle mb-0" style="min-width: 1000px;">
                            <thead>
                                <tr>
                                    <th style="min-width: 180px;">Admin User</th>
                                    <th style="min-width: 110px;">Event</th>
                                    <th style="min-width: 280px;">Location & Geocoded Address</th>
                                    <th style="min-width: 180px;">IP & Browser / OS</th>
                                    <th style="min-width: 130px;">Session Duration</th>
                                    <th style="min-width: 130px;">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentActivityLogs as $log)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-slate-900" style="font-size: 0.9rem;">
                                                {{ $log->admin_name ?? 'Admin User' }}</div>
                                            <div class="small text-muted" style="font-size: 0.78rem;">
                                                {{ $log->admin_email ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            @if($log->event_type === 'login')
                                                <span
                                                    class="badge bg-emerald-100 text-emerald border border-emerald px-2 py-1 rounded-2"
                                                    style="background: rgba(5, 150, 105, 0.12); color: #059669; font-weight: 700; font-size: 0.75rem;">
                                                    <i class="bi bi-box-arrow-in-right me-1"></i> LOGIN
                                                </span>
                                            @elseif($log->event_type === 'logout')
                                                <span class="badge bg-slate-100 text-slate-700 border px-2 py-1 rounded-2"
                                                    style="background: #f1f5f9; color: #475569; font-weight: 700; font-size: 0.75rem;">
                                                    <i class="bi bi-power me-1"></i> LOGOUT
                                                </span>
                                            @else
                                                <span class="badge bg-info-subtle text-info border px-2 py-1 rounded-2"
                                                    style="font-weight: 700; font-size: 0.75rem;">
                                                    {{ strtoupper($log->event_type) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td style="min-width: 280px; max-width: 380px;">
                                            @php
                                                $mapsUrl = null;
                                                if ($log->latitude && $log->longitude) {
                                                    $mapsUrl = "https://www.google.com/maps?q={$log->latitude},{$log->longitude}";
                                                } elseif ($log->location_address) {
                                                    $mapsUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($log->location_address);
                                                }
                                            @endphp
                                            @if($mapsUrl)
                                                <a href="{{ $mapsUrl }}" target="_blank" class="location-map-card d-inline-flex align-items-start gap-2 text-decoration-none"
                                                    title="{{ $log->location_address }} - Click to view exact location on Google Maps">
                                                    <i class="bi bi-geo-alt-fill text-danger map-pin-icon mt-1 flex-shrink-0"
                                                        style="font-size: 1.05rem; color: #ef4444;"></i>
                                                    <div>
                                                        <div class="fw-semibold location-text"
                                                            style="font-size: 0.86rem; color: #0f172a; line-height: 1.35;">
                                                            {{ $log->location_address ?? 'GPS Location Coordinates' }}
                                                            <i class="bi bi-box-arrow-up-right external-icon ms-1"
                                                                style="font-size: 0.75rem; color: #64748b;"></i>
                                                        </div>
                                                        @if($log->latitude && $log->longitude)
                                                            <div class="small text-muted mt-0.5"
                                                                style="font-size: 0.75rem; color: #64748b;">
                                                                Coords: {{ number_format((float) $log->latitude, 4) }},
                                                                {{ number_format((float) $log->longitude, 4) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </a>
                                            @else
                                                <div class="d-flex align-items-start gap-1.5">
                                                    <i class="bi bi-geo-alt-fill text-danger mt-0.5"
                                                        style="font-size: 1.05rem; color: #ef4444;"></i>
                                                    <span class="fw-semibold text-slate-800"
                                                        style="font-size: 0.86rem; color: #0f172a;">{{ $log->location_address ?? 'GPS Location Coordinates' }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="small fw-semibold text-slate-900" style="font-size: 0.84rem;">
                                                <i class="bi bi-hdd-network me-1 text-primary"></i>
                                                {{ $log->ip_address ?? '127.0.0.1' }}
                                            </div>
                                            <div class="small text-muted" style="font-size: 0.78rem;">
                                                {{ $log->browser ?? 'Browser' }} &bull; {{ $log->device_os ?? 'OS' }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2.5 py-1 font-monospace"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-clock me-1 text-secondary"></i>
                                                {{ $log->session_duration ?? '00h 00m 01s' }}
                                            </span>
                                        </td>
                                        <td style="white-space: nowrap;">
                                            <div class="small fw-semibold text-slate-900">
                                                {{ $log->created_at ? $log->created_at->format('M d, Y h:i A') : 'N/A' }}</div>
                                            <div class="small text-muted" style="font-size: 0.75rem;">
                                                {{ $log->created_at ? $log->created_at->diffForHumans() : '' }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-shield-check fs-1 text-slate-400 d-block mb-2"></i>
                        <p class="mb-0 fw-semibold">No login activity logs recorded yet.</p>
                        <small class="text-muted">Admin login activity with location data will appear here
                            automatically.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>