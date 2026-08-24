<x-admin-layout pageTitle="Login History & Security Audit Logs">
    <style>
        .location-map-card {
            color: #1e293b;
            text-decoration: none !important;
            transition: all 0.2s ease-in-out;
            display: inline-flex;
            align-items: flex-start;
            gap: 8px;
            padding: 6px 10px;
            margin: -4px -10px;
            border-radius: 8px;
        }
        .location-map-card:hover {
            background: rgba(37, 99, 235, 0.08) !important;
            color: #2563eb !important;
            text-decoration: none !important;
        }
        .location-map-card:hover .location-text {
            color: #2563eb !important;
            text-decoration: none !important;
        }
        .location-map-card:hover .map-pin-icon {
            transform: scale(1.2);
            color: #dc2626 !important;
        }
        .location-map-card:hover .external-icon {
            transform: translate(2px, -2px);
            color: #2563eb !important;
        }
        .map-pin-icon, .external-icon {
            transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
        }
    </style>

    <!-- Header Summary Card -->
    <div class="card border-0 shadow-sm p-4 mb-4" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px;">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">
                    <i class="bi bi-shield-lock-fill text-emerald-600 me-2" style="color: #059669;"></i> Security Audit & Admin Login History
                </h3>
                <p class="text-secondary small mb-0" style="color: #475569; font-size: 0.92rem;">
                    Real-time tracking of admin login sessions, IP origins, geocoded locations, and session durations.
                </p>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <a href="{{ route('admin.activity-logs.export') }}" class="btn btn-glass-primary">
                    <i class="bi bi-download me-1.5"></i> Export Audit CSV
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Stats Cards Grid -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Logins -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="fw-bold small text-uppercase text-secondary" style="font-size: 0.78rem; letter-spacing: 0.04em;">Total Logins</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; background: rgba(5, 150, 105, 0.12); color: #059669;">
                        <i class="bi bi-box-arrow-in-right fs-5"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h2 class="fw-bold text-slate-900 mb-0" style="font-size: 2rem; color: #0f172a;">{{ number_format($totalLogins) }}</h2>
                    <span class="small fw-semibold text-emerald-700" style="color: #047857;">Sessions</span>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted small" style="font-size: 0.78rem;">
                    <span>Successful auths</span>
                    <i class="bi bi-shield-check text-emerald-600" style="color: #059669;"></i>
                </div>
            </div>
        </div>

        <!-- 2. Total Logouts -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="fw-bold small text-uppercase text-secondary" style="font-size: 0.78rem; letter-spacing: 0.04em;">Total Logouts</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; background: rgba(2, 132, 199, 0.12); color: #0284c7;">
                        <i class="bi bi-power fs-5"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h2 class="fw-bold text-slate-900 mb-0" style="font-size: 2rem; color: #0f172a;">{{ number_format($totalLogouts) }}</h2>
                    <span class="small fw-semibold text-sky-700" style="color: #0369a1;">Signouts</span>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted small" style="font-size: 0.78rem;">
                    <span>Explicit logouts</span>
                    <i class="bi bi-door-closed text-sky-600" style="color: #0284c7;"></i>
                </div>
            </div>
        </div>

        <!-- 3. Unique Locations -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="fw-bold small text-uppercase text-secondary" style="font-size: 0.78rem; letter-spacing: 0.04em;">Unique Locations</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; background: rgba(79, 70, 229, 0.12); color: #4f46e5;">
                        <i class="bi bi-geo-alt-fill fs-5"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h2 class="fw-bold text-slate-900 mb-0" style="font-size: 2rem; color: #0f172a;">{{ number_format($uniqueLocationsCount) }}</h2>
                    <span class="small fw-semibold text-indigo-700" style="color: #4338ca;">IP Origins</span>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted small" style="font-size: 0.78rem;">
                    <span>Verified Geolocation</span>
                    <i class="bi bi-pin-map text-indigo-600" style="color: #4f46e5;"></i>
                </div>
            </div>
        </div>

        <!-- 4. Active Session -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 14px;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="fw-bold small text-uppercase text-secondary" style="font-size: 0.78rem; letter-spacing: 0.04em;">Active Session</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; background: rgba(217, 119, 6, 0.12); color: #d97706;">
                        <i class="bi bi-clock-history fs-5"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h3 class="fw-bold mb-0" id="activeSessionText" style="color: #059669; font-size: 1.6rem;">
                        {{ $activeSession ? $activeSession->formatted_duration : 'Active Now' }}
                    </h3>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted small" style="font-size: 0.78rem;">
                    <span>Live duration tracking</span>
                    <i class="bi bi-activity text-amber-600" style="color: #d97706;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Form -->
    <div class="mb-4" style="position: relative; z-index: 35;">
        <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-12 col-md-5 col-lg-5">
                <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <span class="input-group-text bg-white border-end-0 text-secondary px-3"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control bg-white border-start-0 py-2" placeholder="Search by admin name, email, IP, location..." value="{{ request('search') }}" style="font-size: 0.9rem;">
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <input type="hidden" name="filter" id="activityFilterInput" value="{{ request('filter', 'all') }}">
                <div class="dropdown w-100">
                    <button class="btn bg-white border shadow-sm w-100 d-flex align-items-center justify-content-between py-2 px-3 dropdown-toggle text-slate-800" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 10px; font-size: 0.9rem; color: #0f172a;">
                        <span class="fw-semibold text-truncate me-2">
                            @if(request('filter') === 'logins')
                                <i class="bi bi-box-arrow-in-right text-success me-1.5"></i> Logins Only
                            @elseif(request('filter') === 'logout')
                                <i class="bi bi-power text-secondary me-1.5"></i> Logouts Only
                            @elseif(request('filter') === 'system_actions')
                                <i class="bi bi-gear text-primary me-1.5"></i> Other System Actions
                            @else
                                <i class="bi bi-filter-circle me-1.5" style="color: #059669;"></i> All Event Types
                            @endif
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start w-100 shadow-lg border p-1 rounded-3 mt-1" style="min-width: 100%;">
                        <li>
                            <a class="dropdown-item rounded-2 small py-2 d-flex align-items-center gap-2 {{ request('filter', 'all') === 'all' ? 'active text-white' : '' }}" 
                               style="{{ request('filter', 'all') === 'all' ? 'background: #059669;' : '' }}"
                               href="#" onclick="event.preventDefault(); document.getElementById('activityFilterInput').value='all'; this.closest('form').submit();">
                                <i class="bi bi-filter-circle"></i> All Event Types
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-2 small py-2 d-flex align-items-center gap-2 {{ request('filter') === 'logins' ? 'active text-white' : '' }}" 
                               style="{{ request('filter') === 'logins' ? 'background: #059669;' : '' }}"
                               href="#" onclick="event.preventDefault(); document.getElementById('activityFilterInput').value='logins'; this.closest('form').submit();">
                                <i class="bi bi-box-arrow-in-right"></i> Logins Only
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-2 small py-2 d-flex align-items-center gap-2 {{ request('filter') === 'logout' ? 'active text-white' : '' }}" 
                               style="{{ request('filter') === 'logout' ? 'background: #059669;' : '' }}"
                               href="#" onclick="event.preventDefault(); document.getElementById('activityFilterInput').value='logout'; this.closest('form').submit();">
                                <i class="bi bi-power"></i> Logouts Only
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-2 small py-2 d-flex align-items-center gap-2 {{ request('filter') === 'system_actions' ? 'active text-white' : '' }}" 
                               style="{{ request('filter') === 'system_actions' ? 'background: #059669;' : '' }}"
                               href="#" onclick="event.preventDefault(); document.getElementById('activityFilterInput').value='system_actions'; this.closest('form').submit();">
                                <i class="bi bi-gear"></i> Other System Actions
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-glass-primary w-100 py-2 shadow-sm" style="border-radius: 10px;">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                @if(request('search') || request('filter'))
                    <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-outline-secondary bg-white shadow-sm px-3 py-2" style="border-radius: 10px;" title="Reset Filters"><i class="bi bi-x-lg"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- High-Contrast Audit Table Card -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden; background: #ffffff;">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 p-4 pb-3 border-bottom" style="border-color: #f1f5f9 !important;">
            <div>
                <h5 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">
                    <i class="bi bi-list-stars me-2" style="color: #059669;"></i> Real-Time Security Audit Trail
                </h5>
                <p class="text-muted small mb-0" style="font-size: 0.84rem;">
                    Hover & click any location card to open exact coordinates in Google Maps.
                </p>
            </div>
            <span class="badge bg-light text-secondary border px-3 py-1.5 flex-shrink-0 text-nowrap" style="font-size: 0.8rem; border-radius: 8px;">
                Showing {{ $logs->firstItem() ?? 0 }}-{{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} records
            </span>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0; min-width: 1000px;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 14px 20px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; min-width: 180px;">Admin User</th>
                        <th style="padding: 14px 16px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; min-width: 110px;">Event</th>
                        <th style="padding: 14px 20px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; min-width: 280px;">Location & Geocoded Address</th>
                        <th style="padding: 14px 16px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; min-width: 180px;">IP & Browser / OS</th>
                        <th style="padding: 14px 16px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; min-width: 130px;">Session Duration</th>
                        <th style="padding: 14px 20px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; min-width: 130px; text-align: right;">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        @php
                            $mapsUrl = null;
                            if ($log->latitude && $log->longitude) {
                                $mapsUrl = "https://www.google.com/maps?q={$log->latitude},{$log->longitude}";
                            } elseif ($log->location_address) {
                                $mapsUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($log->location_address);
                            }
                        @endphp
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 20px;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle fw-bold d-flex align-items-center justify-content-center flex-shrink-0"
                                         style="width: 38px; height: 38px; background: rgba(5, 150, 105, 0.12); color: #059669; font-size: 0.9rem;">
                                        {{ strtoupper(substr($log->admin_name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div style="min-width: 0;">
                                        <div class="fw-bold text-slate-900 text-truncate" style="font-size: 0.92rem; color: #0f172a;">{{ $log->admin_name ?? 'System Administrator' }}</div>
                                        <div class="small text-secondary text-truncate" style="font-size: 0.8rem; color: #64748b;">{{ $log->admin_email ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 16px 16px;">
                                @if($log->event_type === 'login')
                                    <span class="badge px-3 py-1.5 rounded-pill" style="background: rgba(5, 150, 105, 0.12); color: #059669; border: 1px solid rgba(5, 150, 105, 0.3); font-weight: 700; font-size: 0.75rem;">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> LOGIN
                                    </span>
                                @elseif($log->event_type === 'logout')
                                    <span class="badge px-3 py-1.5 rounded-pill" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-weight: 700; font-size: 0.75rem;">
                                        <i class="bi bi-power me-1"></i> LOGOUT
                                    </span>
                                @else
                                    <span class="badge px-3 py-1.5 rounded-pill bg-light text-dark border" style="font-weight: 700; font-size: 0.75rem;">
                                        {{ strtoupper(str_replace('_', ' ', $log->event_type)) }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 16px 20px; min-width: 280px; max-width: 380px;">
                                @if($mapsUrl)
                                    <a href="{{ $mapsUrl }}" target="_blank" class="location-map-card d-inline-flex align-items-start gap-2 text-decoration-none" title="Click to view exact location on Google Maps">
                                        <i class="bi bi-geo-alt-fill text-danger map-pin-icon mt-1 flex-shrink-0" style="font-size: 1.1rem; color: #ef4444;"></i>
                                        <div>
                                            <div class="fw-semibold location-text" style="font-size: 0.88rem; color: #0f172a; line-height: 1.35;">
                                                {{ $log->location_address ?? 'GPS Location Coordinates' }}
                                                <i class="bi bi-box-arrow-up-right external-icon ms-1" style="font-size: 0.75rem; color: #64748b;"></i>
                                            </div>
                                            @if($log->latitude && $log->longitude)
                                                <div class="small text-muted mt-0.5" style="font-size: 0.76rem; color: #64748b;">
                                                    Coords: {{ number_format((float)$log->latitude, 4) }}, {{ number_format((float)$log->longitude, 4) }}
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                @else
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-geo-alt-fill text-danger mt-0.5" style="font-size: 1.1rem; color: #ef4444;"></i>
                                        <span class="fw-semibold text-slate-800" style="font-size: 0.88rem; color: #0f172a;">{{ $log->location_address ?? 'GPS Location Coordinates' }}</span>
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 16px 16px;">
                                <div class="fw-semibold text-slate-900" style="font-size: 0.86rem; color: #0f172a;">
                                    <i class="bi bi-hdd-network me-1" style="color: #0284c7;"></i> {{ $log->ip_address ?? '127.0.0.1' }}
                                </div>
                                <div class="small text-muted" style="font-size: 0.78rem;">
                                    {{ $log->browser ?? 'Browser' }} &bull; {{ $log->device_os ?? 'OS' }}
                                </div>
                            </td>
                            <td style="padding: 16px 16px;">
                                <span class="badge bg-light text-dark border px-2.5 py-1.5 font-monospace" style="font-size: 0.8rem; border-radius: 6px;">
                                    <i class="bi bi-clock me-1 text-secondary"></i> {{ $log->formatted_duration }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: right; white-space: nowrap;">
                                <div class="fw-semibold text-slate-900" style="font-size: 0.86rem; color: #0f172a;">{{ $log->created_at ? $log->created_at->format('M d, Y h:i A') : 'N/A' }}</div>
                                <div class="small text-muted" style="font-size: 0.76rem;">{{ $log->created_at ? $log->created_at->diffForHumans() : '' }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-shield-x fs-1 text-slate-400 d-block mb-2"></i>
                                <p class="mb-0 fw-semibold">No activity audit logs found matching your filter criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div class="p-3 border-top" style="background: #f8fafc;">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Heartbeat pulse to sync active session duration periodically
            function pulseSession() {
                fetch("{{ route('admin.activity-logs.pulse') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }).then(res => res.json()).then(data => {
                    if (data.success && data.session_duration) {
                        const activeEl = document.getElementById('activeSessionText');
                        if (activeEl) {
                            activeEl.textContent = data.session_duration;
                        }
                    }
                }).catch(() => {});
            }

            // Initial pulse call & interval every 15 seconds
            pulseSession();
            setInterval(pulseSession, 15000);
        });
    </script>
    @endpush
</x-admin-layout>
