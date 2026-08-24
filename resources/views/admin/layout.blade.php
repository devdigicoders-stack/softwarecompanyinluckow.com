<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Dashboard' }} | Software Company in Lucknow</title>

    <!-- Favicon Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">

    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Admin Glass System CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-glass.css') }}">

    @stack('styles')
</head>

<body class="admin-body">

    <!-- Global Floating Top-Right Glass Toast Container -->
    <div id="toastContainer"></div>

    @php
        $unreadContactCount = \App\Models\ContactSubmission::where('status', 'new')->count();
        $isBlogActive = request()->routeIs('admin.posts.*', 'admin.categories.*', 'admin.tags.*', 'admin.authors.*');
    @endphp

    <div class="d-flex min-vh-100">

        <!-- Sidebar (Desktop persistent) -->
        <aside
            class="glass-sidebar d-none d-lg-flex flex-column p-0 position-fixed top-0 bottom-0 left-0"
            style="z-index: 1030;">
            
            <!-- Fixed Top Brand Logo Header -->
            <div class="sidebar-header p-3 border-bottom border-slate-800" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                <a href="{{ route('admin.dashboard') }}"
                    class="d-flex align-items-center gap-3 text-white text-decoration-none px-2 py-1 sidebar-brand-container">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-white flex-shrink-0"
                        style="width: 40px; height: 40px; background: #059669;">
                        <i class="bi bi-cpu-fill fs-4"></i>
                    </div>
                    <div class="sidebar-brand-text">
                        <div class="fw-bold text-white lh-1" style="font-size: 1.05rem;">Software Company</div>
                        <small style="color: #10b981; font-size: 0.78rem; font-weight: 600;">in Lucknow CMS</small>
                    </div>
                </a>
            </div>

            <!-- Scrollable Middle Navigation Area -->
            <div class="sidebar-body p-3 flex-grow-1">
                <ul class="nav flex-column gap-1 list-unstyled mb-0">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            title="Dashboard">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!-- Blogs Submenu Accordion -->
                    <li>
                        <a class="sidebar-nav-link d-flex align-items-center justify-content-between {{ $isBlogActive ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#desktopBlogSubmenu" role="button"
                            aria-expanded="{{ $isBlogActive ? 'true' : 'false' }}" aria-controls="desktopBlogSubmenu"
                            title="Blogs & Content">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-journal-richtext"></i>
                                <span>Blogs & Content</span>
                            </div>
                            <i class="bi bi-chevron-down small" style="font-size: 0.8rem;"></i>
                        </a>
                        <div class="collapse {{ $isBlogActive ? 'show' : '' }}" id="desktopBlogSubmenu">
                            <div class="sidebar-submenu d-flex flex-column gap-1 w-100">
                                <a href="{{ route('admin.posts.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}"
                                    title="All Articles">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>All Articles</span>
                                </a>
                                <a href="{{ route('admin.posts.create') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.posts.create') ? 'active' : '' }}"
                                    title="Write New Blog">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Write New Blog</span>
                                </a>
                                <a href="{{ route('admin.categories.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                                    title="Categories">
                                    <i class="bi bi-folder2-open"></i>
                                    <span>Categories</span>
                                </a>
                                <a href="{{ route('admin.tags.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}"
                                    title="Tags">
                                    <i class="bi bi-tags"></i>
                                    <span>Tags</span>
                                </a>
                                <a href="{{ route('admin.authors.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.authors.*') ? 'active' : '' }}"
                                    title="Authors">
                                    <i class="bi bi-people"></i>
                                    <span>Authors</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Quick Modal Enquiries -->
                    <li>
                        <a href="{{ route('admin.enquiries.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}"
                            title="Quick Modal Enquiries">
                            <i class="bi bi-chat-left-dots"></i>
                            <span>Quick Enquiries</span>
                            @if(($unreadEnquiryCount ?? 0) > 0)
                                <span class="badge bg-warning text-dark rounded-pill ms-auto"
                                    style="font-size: 0.72rem;">{{ $unreadEnquiryCount }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Contact Messages -->
                    <li>
                        <a href="{{ route('admin.contact-messages.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}"
                            title="Contact Messages">
                            <i class="bi bi-envelope"></i>
                            <span>Contact Messages</span>
                            @if($unreadContactCount > 0)
                                <span class="badge bg-danger rounded-pill ms-auto"
                                    style="font-size: 0.72rem;">{{ $unreadContactCount }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Newsletter Subscribers -->
                    <li>
                        <a href="{{ route('admin.subscribers.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}"
                            title="Newsletter Subscribers">
                            <i class="bi bi-mailbox"></i>
                            <span>Newsletter Subscribers</span>
                        </a>
                    </li>

                    <!-- Dynamic Page FAQs -->
                    <li>
                        <a href="{{ route('admin.faqs.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"
                            title="Manage Page FAQs">
                            <i class="bi bi-question-circle"></i>
                            <span>Manage Page FAQs</span>
                        </a>
                    </li>

                    <!-- Login History & Security Activity Logs -->
                    <li>
                        <a href="{{ route('admin.activity-logs.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.activity-logs.*', 'admin.login-history.*') ? 'active' : '' }}"
                            title="Login History">
                            <i class="bi bi-clock-history"></i>
                            <span>Login History</span>
                        </a>
                    </li>

                    <!-- Account & Security Settings -->
                    <li>
                        <a href="{{ route('admin.settings.edit') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
                            title="Account Settings">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Fixed Bottom Profile & Logout Footer -->
            <div class="sidebar-footer p-3 border-top border-slate-800" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                <a href="{{ route('home') }}" target="_blank" class="sidebar-nav-link mb-2"
                    style="color: #94a3b8 !important;" title="View Public Site">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>View Public Site</span>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" id="logoutForm">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                        class="btn btn-outline-danger w-100 rounded-3 sidebar-logout-btn d-flex align-items-center justify-content-center justify-content-lg-start gap-2 small fw-bold px-3 py-2"
                        title="Logout">
                        <i class="bi bi-power fs-5"></i> <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="mobileSidebar" style="background: #0f172a;">
            <div class="offcanvas-header border-bottom border-slate-800"
                style="border-color: rgba(255, 255, 255, 0.1) !important;">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-white flex-shrink-0"
                        style="width: 32px; height: 32px; background: #059669;">
                        <i class="bi bi-cpu-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="offcanvas-title fw-bold text-white lh-1 mb-0" id="mobileSidebarLabel">Software Company</h6>
                        <small style="color: #10b981; font-size: 0.72rem; font-weight: 600;">in Lucknow CMS</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between p-3">
                <ul class="nav flex-column gap-1 list-unstyled mb-0">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Mobile Blog Submenu Accordion -->
                    <li>
                        <a class="sidebar-nav-link d-flex align-items-center justify-content-between {{ $isBlogActive ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#mobileBlogSubmenu" role="button"
                            aria-expanded="{{ $isBlogActive ? 'true' : 'false' }}" aria-controls="mobileBlogSubmenu">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-journal-richtext"></i>
                                <span>Blogs & Content</span>
                            </div>
                            <i class="bi bi-chevron-down small" style="font-size: 0.8rem;"></i>
                        </a>
                        <div class="collapse {{ $isBlogActive ? 'show' : '' }}" id="mobileBlogSubmenu">
                            <div class="sidebar-submenu d-flex flex-column gap-1 w-100">
                                <a href="{{ route('admin.posts.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>All Articles</span>
                                </a>
                                <a href="{{ route('admin.posts.create') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.posts.create') ? 'active' : '' }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Write New Blog</span>
                                </a>
                                <a href="{{ route('admin.categories.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                    <i class="bi bi-folder2-open"></i>
                                    <span>Categories</span>
                                </a>
                                <a href="{{ route('admin.tags.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                                    <i class="bi bi-tags"></i>
                                    <span>Tags</span>
                                </a>
                                <a href="{{ route('admin.authors.index') }}"
                                    class="sidebar-subnav-link {{ request()->routeIs('admin.authors.*') ? 'active' : '' }}">
                                    <i class="bi bi-people"></i>
                                    <span>Authors</span>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Quick Modal Enquiries -->
                    <li>
                        <a href="{{ route('admin.enquiries.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
                            <i class="bi bi-chat-left-dots"></i>
                            <span>Quick Enquiries</span>
                            @if(($unreadEnquiryCount ?? 0) > 0)
                                <span class="badge bg-warning text-dark rounded-pill ms-auto"
                                    style="font-size: 0.72rem;">{{ $unreadEnquiryCount }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Contact Messages -->
                    <li>
                        <a href="{{ route('admin.contact-messages.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                            <i class="bi bi-envelope"></i>
                            <span>Contact Messages</span>
                            @if($unreadContactCount > 0)
                                <span class="badge bg-danger rounded-pill ms-auto"
                                    style="font-size: 0.72rem;">{{ $unreadContactCount }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Newsletter Subscribers -->
                    <li>
                        <a href="{{ route('admin.subscribers.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                            <i class="bi bi-mailbox"></i>
                            <span>Newsletter Subscribers</span>
                        </a>
                    </li>

                    <!-- Dynamic Page FAQs -->
                    <li>
                        <a href="{{ route('admin.faqs.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                            <i class="bi bi-question-circle"></i>
                            <span>Manage Page FAQs</span>
                        </a>
                    </li>

                    <!-- Login History & Security Activity Logs -->
                    <li>
                        <a href="{{ route('admin.activity-logs.index') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.activity-logs.*', 'admin.login-history.*') ? 'active' : '' }}">
                            <i class="bi bi-clock-history"></i>
                            <span>Login History</span>
                        </a>
                    </li>

                    <!-- Account & Security Settings -->
                    <li>
                        <a href="{{ route('admin.settings.edit') }}"
                            class="sidebar-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                </ul>

                <div class="pt-3 border-top border-slate-800"
                    style="border-color: rgba(255, 255, 255, 0.1) !important;">
                    <a href="{{ route('home') }}" target="_blank" class="sidebar-nav-link mb-2 text-slate-400"
                        style="color: #94a3b8 !important;" title="View Public Site">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Public Site</span>
                    </a>
                    <button type="button" onclick="confirmLogout()"
                        class="btn btn-outline-danger w-100 rounded-3 text-start px-3 py-2 d-flex align-items-center gap-2 small fw-bold">
                        <i class="bi bi-power fs-6"></i> Logout
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Wrapper -->
        <div class="flex-grow-1 d-flex flex-column" id="mainContentWrapper">

            <!-- Top Navbar -->
            <header class="glass-navbar px-3 px-md-4 py-2.5 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <!-- Sidebar Collapse/Extend Toggle Button for Desktop -->
                    <button id="sidebarToggleBtn"
                        class="btn p-0 border-0 bg-transparent text-slate-900 d-none d-lg-inline-flex align-items-center justify-content-center me-2"
                        style="width: 36px; height: 36px;" title="Toggle Sidebar">
                        <i class="bi bi-list fs-2" style="color: #0f172a;"></i>
                    </button>

                    <!-- Mobile Drawer Toggle Button -->
                    <button class="btn btn-outline-secondary d-lg-none rounded-3 px-2 py-1" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                        <i class="bi bi-list fs-4"></i>
                    </button>

                    <h5 class="fw-bold text-slate-900 mb-0 ms-1 d-none d-sm-block" style="color: #0f172a;">
                        {{ $pageTitle ?? 'Admin Panel' }}
                    </h5>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <button
                            class="btn glass-card border d-flex align-items-center gap-2 py-1.5 px-3 dropdown-toggle shadow-sm rounded-pill"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="text-white d-flex align-items-center justify-content-center fw-bold rounded-circle shadow-sm"
                                style="width: 32px; height: 32px; background: linear-gradient(135deg, #059669, #10b981); font-size: 0.85rem;">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="fw-bold small text-slate-800 d-none d-md-inline"
                                style="color: #0f172a; font-size: 0.88rem;">{{ auth()->user()->name ?? 'Admin' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end glass-card border shadow-lg p-2 rounded-4 mt-2"
                            style="min-width: 220px;">
                            <li class="px-3 py-2 border-bottom mb-1">
                                <span class="d-block fw-bold small text-slate-900"
                                    style="color: #0f172a;">{{ auth()->user()->name ?? 'Administrator' }}</span>
                                <span class="d-block text-muted small" style="font-size: 0.78rem;">{{
                                    auth()->user()->email ?? 'admin@example.com' }}</span>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-3 py-1.5 small text-slate-700 fw-semibold {{ request()->routeIs('admin.settings.*') ? 'active text-white bg-primary' : '' }}"
                                    href="{{ route('admin.settings.edit') }}">
                                    <i class="bi bi-gear-fill me-2 text-primary"></i> Account Settings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-3 py-1.5 small text-slate-700"
                                    href="{{ route('home') }}" target="_blank">
                                    <i class="bi bi-box-arrow-up-right me-2 text-primary"></i> Public Website
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <button type="button" onclick="confirmLogout()"
                                    class="dropdown-item rounded-3 py-1.5 small text-danger fw-semibold">
                                    <i class="bi bi-power me-2"></i> Logout
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-3 p-md-4 flex-grow-1">
                {{ $slot }}
            </main>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Toast & SweetAlert2 Script -->
    <script>
        // Global Glass Toast Notification Function
        function showGlassToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `glass-toast glass-toast-${type}`;

            let icon = 'bi-check-circle-fill';
            if (type === 'error') icon = 'bi-exclamation-octagon-fill';
            if (type === 'warning') icon = 'bi-exclamation-triangle-fill';
            if (type === 'info') icon = 'bi-info-circle-fill';

            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="bi ${icon}"></i>
                </div>
                <div class="flex-grow-1 me-2">
                    <div class="fw-bold text-slate-900 small lh-sm" style="color: #0f172a;">${title}</div>
                    <div class="small text-secondary lh-sm mt-1" style="font-size: 0.84rem;">${message}</div>
                </div>
                <button type="button" class="btn-close ms-auto small" onclick="closeToast(this.parentElement)" style="font-size: 0.75rem;"></button>
                <div class="toast-progress"></div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                closeToast(toast);
            }, 5000);
        }

        function closeToast(toast) {
            if (!toast || toast.classList.contains('toast-hiding')) return;
            toast.classList.add('toast-hiding');
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.parentElement.removeChild(toast);
                }
            }, 300);
        }

        // SweetAlert2 Confirmation Dialog Helper
        function confirmAction(options) {
            return Swal.fire({
                title: options.title || 'Are you sure?',
                text: options.text || 'This action cannot be undone.',
                icon: options.icon || 'warning',
                showCancelButton: true,
                confirmButtonText: options.confirmText || 'Yes, proceed',
                cancelButtonText: options.cancelText || 'Cancel',
                customClass: {
                    popup: 'swal-glass-modal',
                    confirmButton: 'btn-swal-confirm',
                    cancelButton: 'btn-swal-cancel'
                },
                buttonsStyling: false
            });
        }

        // SweetAlert2 Logout Confirmation
        function confirmLogout() {
            confirmAction({
                title: 'Sign Out of Admin Panel?',
                text: 'Are you sure you want to end your current admin session?',
                icon: 'question',
                confirmText: 'Yes, Sign Out',
                cancelText: 'Stay Signed In'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Restore saved desktop sidebar collapsed state
            const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
            if (sidebarToggleBtn) {
                if (localStorage.getItem('admin_sidebar_collapsed') === 'true') {
                    document.body.classList.add('sidebar-collapsed');
                }

                sidebarToggleBtn.addEventListener('click', function () {
                    document.body.classList.toggle('sidebar-collapsed');
                    const isCollapsed = document.body.classList.contains('sidebar-collapsed');
                    localStorage.setItem('admin_sidebar_collapsed', isCollapsed);
                });
            }

            // Auto-trigger Global Toasts for Session Messages & Validation Errors
            @if(session('success'))
                showGlassToast('success', 'Success', "{{ session('success') }}");
            @endif

            @if(session('error'))
                showGlassToast('error', 'Error', "{{ session('error') }}");
            @endif

            @if(session('warning'))
                showGlassToast('warning', 'Warning', "{{ session('warning') }}");
            @endif

            @if(session('info'))
                showGlassToast('info', 'Notice', "{{ session('info') }}");
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    showGlassToast('error', 'Validation Error', "{{ $error }}");
                @endforeach
            @endif

            // Global pulse for active admin session
            @if(auth()->check())
                setInterval(function() {
                    fetch("{{ route('admin.activity-logs.pulse') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    }).catch(function() {});
                }, 60000);
            @endif
        });
    </script>
    @stack('scripts')
</body>

</html>