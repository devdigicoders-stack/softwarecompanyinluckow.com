<div id="recommendation-tool"
    class="glass-card p-4 p-md-5 rounded-4 shadow-lg border border-primary-subtle bg-gradient-light mb-5">
    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <span class="badge text-white rounded-pill px-3 py-1.5 text-uppercase fw-bold mb-2 d-inline-flex align-items-center gap-1.5"
                style="font-size: 0.75rem; background-color: #059669;">
                <i class="bi bi-cpu-fill fs-6 text-white"></i> <span>Interactive Selector Tool</span>
            </span>
            <h2 class="fw-bold text-slate-900 mb-1">Technology Stack Finder & Calculator</h2>
            <p class="text-secondary mb-0">Select your project requirements below to receive an instant, benchmarked
                tech stack recommendation (Laravel, WordPress, React, Node.js).</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm"
                style="width: 56px; height: 56px; background-color: #d1fae5; color: #047857;">
                <i class="bi bi-sliders fs-3"></i>
            </div>
        </div>
    </div>

    <!-- Inputs Row -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <label for="toolType" class="form-label fw-bold text-slate-800 d-flex align-items-center gap-1.5 mb-2">
                <i class="bi bi-diagram-3-fill fs-5" style="color: #0284c7;"></i> <span>1. Project Type</span>
            </label>
            <select id="toolType" class="form-select glass-input py-2.5 fw-medium rounded-3 border-slate-300">
                <option value="enterprise" selected>Enterprise Software / ERP / Portal</option>
                <option value="webapp">High-Traffic Web Application / SaaS / SPA</option>
                <option value="ecommerce">E-Commerce Store / Marketplace</option>
                <option value="realtime">Real-Time Messaging / Streaming / Tracking</option>
                <option value="blog">Content Blog / News Site / Portal</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="toolTraffic" class="form-label fw-bold text-slate-800 d-flex align-items-center gap-1.5 mb-2">
                <i class="bi bi-people-fill fs-5" style="color: #059669;"></i> <span>2. Monthly Users (Traffic Scale)</span>
            </label>
            <select id="toolTraffic" class="form-select glass-input py-2.5 fw-medium rounded-3 border-slate-300">
                <option value="low">Under 10,000 Visitors / Month (MVP / Small)</option>
                <option value="medium" selected>10,000 - 100,000 Visitors / Month (Growing Scale)</option>
                <option value="high">100,000+ High Concurrency Visitors (Scale-up)</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="toolPriority" class="form-label fw-bold text-slate-800 d-flex align-items-center gap-1.5 mb-2">
                <i class="bi bi-shield-check fs-5" style="color: #d97706;"></i> <span>3. Main Project Priority</span>
            </label>
            <select id="toolPriority" class="form-select glass-input py-2.5 fw-medium rounded-3 border-slate-300">
                <option value="security" selected>Maximum Security & Data Privacy</option>
                <option value="speed">Sub-second Speed & Instant Virtual DOM</option>
                <option value="turnaround">Fastest MVP Launch & Quick Turnaround</option>
                <option value="cost">Lowest Total Cost of Ownership (0 SaaS Fees)</option>
            </select>
        </div>
    </div>

    <!-- Action Button -->
    <div class="text-center mb-4">
        <button type="button" id="calcTechBtn" class="btn btn-primary btn-lg px-5 shadow-sm fw-bold transition-all text-white"
            style="border-radius: 10px; background: linear-gradient(135deg, #059669 0%, #047857 100%); border: none;">
            <i class="bi bi-cpu-fill fs-5 me-2 text-white" id="calcBtnIcon"></i> <span id="calcBtnText">Generate Optimal Tech Stack</span>
        </button>
    </div>

    <!-- Calculation Result Card (Hidden by default until Generate button click) -->
    <div id="techResultCard" class="p-4 p-md-4 rounded-4 border bg-white shadow-sm transition-all d-none"
        style="min-height: 220px;">
        <!-- Card Header Banner -->
        <div class="border-bottom pb-3 mb-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                <span class="text-uppercase tracking-wider fw-bold extra-small d-inline-flex align-items-center gap-1.5" style="color: #059669;">
                    <i class="bi bi-stars fs-6" style="color: #d97706;"></i> <span>Optimal Architecture & Stack Match</span>
                </span>
                <span class="badge text-white px-3 py-1.5 rounded-pill extra-small fw-bold shadow-sm d-inline-flex align-items-center gap-1"
                    style="background: linear-gradient(135deg, #059669 0%, #047857 100%);" id="resMatchScore">
                    <i class="bi bi-patch-check-fill text-white fs-6"></i> <span>99% Compatibility Match</span>
                </span>
            </div>
            <h3 id="resStackTitle" class="fw-extrabold text-slate-900 mb-0 fs-4 fs-md-3" style="line-height: 1.35; word-break: break-word;">
                Laravel 12 + MySQL + Redis
            </h3>
        </div>

        <!-- Advantages Section -->
        <div class="mb-4">
            <h6 class="fw-bold text-slate-900 mb-3 fs-6 d-flex align-items-center gap-2">
                <i class="bi bi-check2-circle fs-5" style="color: #059669;"></i> <span>Key Architectural Advantages:</span>
            </h6>
            <ul id="resReasonsList" class="text-slate-700 gap-3 d-flex flex-column mb-0 ps-0 list-unstyled">
                <!-- Populated by JS -->
            </ul>
        </div>

        <!-- Metrics & Action Box (Spacious Responsive Bar) -->
        <div class="p-4 rounded-4 border border-slate-200 shadow-sm" style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
            <div class="row g-4 align-items-center">
                <!-- Timeline & Budget Column -->
                <div class="col-lg-6">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between p-3 bg-white rounded-3 border shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: #e0f2fe; color: #0284c7;">
                                    <i class="bi bi-clock-history fs-5"></i>
                                </div>
                                <div>
                                    <span class="text-slate-500 fw-bold extra-small text-uppercase d-block mb-0.5">Est. Development Timeline</span>
                                    <span id="resTimeline" class="fw-extrabold text-slate-900 fs-6">6 to 12 Weeks</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between p-3 bg-white rounded-3 border shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: #d1fae5; color: #059669;">
                                    <i class="bi bi-tag-fill fs-5"></i>
                                </div>
                                <div>
                                    <span class="text-slate-500 fw-bold extra-small text-uppercase d-block mb-0.5">Est. Project Investment</span>
                                    <span id="resBudget" class="fw-extrabold fs-6" style="color: #059669;">₹60,000 - ₹1.6L+</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTAs Column -->
                <div class="col-lg-6">
                    <div class="d-flex flex-column gap-3">
                        <button type="button" class="btn btn-primary fw-bold text-white shadow-sm w-100 py-3 d-flex align-items-center justify-content-center gap-2 rounded-3 transition-all fs-6" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); border: none; letter-spacing: 0.3px;" data-bs-toggle="modal" data-bs-target="#globalEnquiryModal">
                            <i class="bi bi-send-fill text-white fs-5"></i> <span>Get Free Technical Quote</span>
                        </button>
                        <div class="row g-2">
                            <div class="col-6">
                                <a id="resWhatsappCta"
                                    href="https://wa.me/916394296293?text=Hello%20Software%20Company%20in%20Lucknow,%20I%20want%20to%20consult%20regarding%20my%20project%20tech%20stack"
                                    target="_blank" rel="noopener"
                                    class="btn btn-success fw-bold text-white shadow-sm w-100 py-2.5 d-flex align-items-center justify-content-center gap-2 rounded-3 transition-all"
                                    style="background-color: #25D366; border-color: #25D366; font-size: 0.875rem; white-space: nowrap;">
                                    <i class="bi bi-whatsapp fs-5 text-white"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="tel:916394296293"
                                    class="btn btn-outline-success fw-bold w-100 py-2.5 d-flex align-items-center justify-content-center gap-2 rounded-3 transition-all"
                                    style="color: #059669; border-color: #059669; font-size: 0.875rem; white-space: nowrap;">
                                    <i class="bi bi-telephone-fill fs-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guarantee Footer -->
            <div class="mt-4 pt-3 border-top border-slate-200 d-flex align-items-center justify-content-center gap-2 extra-small fw-semibold text-slate-600 text-center">
                <i class="bi bi-shield-check fs-5 flex-shrink-0" style="color: #059669;"></i>
                <span>100% Full Source Code & IP Ownership Transferred on Project Delivery.</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function () {
            function initTechCalculator() {
                const calcBtn = document.getElementById('calcTechBtn');
                const calcBtnText = document.getElementById('calcBtnText');
                const calcBtnIcon = document.getElementById('calcBtnIcon');
                const resultCard = document.getElementById('techResultCard');
                const resTitle = document.getElementById('resStackTitle');
                const resScore = document.getElementById('resMatchScore');
                const resList = document.getElementById('resReasonsList');
                const resTimeline = document.getElementById('resTimeline');
                const resBudget = document.getElementById('resBudget');
                const resWhatsappCta = document.getElementById('resWhatsappCta');

                const selectType = document.getElementById('toolType');
                const selectTraffic = document.getElementById('toolTraffic');
                const selectPriority = document.getElementById('toolPriority');

                if (!selectType || !resultCard) return;

                function calculateRecommendation(type, traffic, priority) {
                    let stackName = 'Laravel 12 + MySQL + Redis';
                    let matchScore = 98;
                    let timeline = '4 to 8 Weeks';
                    let budget = '₹40,000 - ₹85,000';
                    let reasons = [];

                    if (type === 'blog') {
                        if (priority === 'cost' || priority === 'turnaround') {
                            stackName = 'WordPress CMS + Elementor / SEO Plugins';
                            matchScore = 99;
                            timeline = '1 to 2 Weeks';
                            budget = '₹12,000 - ₹25,000';
                            reasons = [
                                'Fast non-technical content creation, article publishing, and media management panel.',
                                'Pre-built SEO plugins for instant Google indexing and meta tag customization.',
                                'Lowest initial setup investment for simple content publishing.'
                            ];
                        } else {
                            stackName = 'Laravel 12 Blade + MySQL (Custom CMS)';
                            matchScore = 96;
                            timeline = '2 to 4 Weeks';
                            budget = '₹25,000 - ₹45,000';
                            reasons = [
                                'Sub-second page loading speeds with zero heavy plugin bloat.',
                                'Built-in CSRF, XSS, and SQL injection protection.',
                                '100% full source code ownership with zero monthly plugin renewal costs.'
                            ];
                        }
                    } else if (type === 'ecommerce') {
                        if (priority === 'cost' || (priority === 'turnaround' && traffic === 'low')) {
                            stackName = 'WordPress + WooCommerce + Razorpay Gateway';
                            matchScore = 95;
                            timeline = '2 to 3 Weeks';
                            budget = '₹20,000 - ₹40,000';
                            reasons = [
                                'Turnkey e-commerce store with product catalog, cart, and payment gateway.',
                                'Easy order management and inventory status tracking panel.',
                                'Cost-effective MVP launch for small to medium product catalogs.'
                            ];
                        } else if (priority === 'speed' || priority === 'webapp') {
                            stackName = 'Laravel 12 + Vue.js / Inertia + MySQL + Razorpay';
                            matchScore = 99;
                            timeline = '5 to 8 Weeks';
                            budget = '₹50,000 - ₹1,20,000';
                            reasons = [
                                'Sub-second checkout flow with responsive single-page UX rendering.',
                                'Webhook payment callbacks handling Razorpay & Paytm securely.',
                                'High-performance product caching supporting thousands of concurrent shoppers.'
                            ];
                        } else {
                            stackName = 'Laravel 12 Enterprise E-Commerce + Redis + MySQL';
                            matchScore = 98;
                            timeline = '6 to 10 Weeks';
                            budget = '₹75,000 - ₹1,80,000';
                            reasons = [
                                'Unlimited product catalog scale with multi-vendor and multi-warehouse roles.',
                                'Automated tax calculation, invoice PDF generation, and GST compliance.',
                                'Zero recurring monthly Shopify platform or commission fees.'
                            ];
                        }
                    } else if (type === 'realtime') {
                        if (priority === 'speed' || traffic === 'high') {
                            stackName = 'Node.js + NestJS + Socket.io + Redis + MongoDB';
                            matchScore = 99;
                            timeline = '6 to 10 Weeks';
                            budget = '₹60,000 - ₹1,50,000';
                            reasons = [
                                'Asynchronous event loop handling 10,000+ simultaneous WebSocket streams.',
                                'Sub-millisecond real-time push notifications, chat, and live tracking.',
                                'Microservices-ready architecture with Redis Pub/Sub messaging.'
                            ];
                        } else {
                            stackName = 'Node.js (Express) + React.js + Socket.io + PostgreSQL';
                            matchScore = 97;
                            timeline = '4 to 8 Weeks';
                            budget = '₹45,000 - ₹95,000';
                            reasons = [
                                'Full JavaScript stack (Node + React) maximizing developer velocity.',
                                'Real-time bi-directional data synchronization between client and server.',
                                'Scalable relational storage for user accounts and transaction logs.'
                            ];
                        }
                    } else if (type === 'webapp') {
                        if (priority === 'speed' || traffic === 'high') {
                            stackName = 'Next.js (React) + Laravel 12 REST API + Redis';
                            matchScore = 99;
                            timeline = '6 to 10 Weeks';
                            budget = '₹55,000 - ₹1,40,000';
                            reasons = [
                                'Virtual DOM client rendering giving app-like instant tab transitions.',
                                'Next.js Server-Side Rendering (SSR) for maximum Google SEO rankings.',
                                'Decoupled API backend allowing Flutter/iOS mobile apps to share the server.'
                            ];
                        } else if (priority === 'turnaround') {
                            stackName = 'Laravel 12 + Livewire / Alpine.js (Full-Stack PHP)';
                            matchScore = 97;
                            timeline = '3 to 5 Weeks';
                            budget = '₹30,000 - ₹65,000';
                            reasons = [
                                'Rapid full-stack reactive development without complex API boilerplate.',
                                'Built-in user authentication, role permissions, and email notifications.',
                                'Single unified codebase reducing deployment overhead.'
                            ];
                        } else {
                            stackName = 'Laravel 12 + Vue.js 3 + PostgreSQL / MySQL';
                            matchScore = 98;
                            timeline = '4 to 8 Weeks';
                            budget = '₹40,000 - ₹90,000';
                            reasons = [
                                'Reactive front-end UI components coupled with enterprise PHP backend.',
                                'Eloquent ORM query optimization protecting against data breaches.',
                                '100% full source code ownership with zero recurring per-user fees.'
                            ];
                        }
                    } else { // enterprise
                        if (priority === 'speed') {
                            stackName = 'Laravel 12 + React.js + Redis Cluster + MySQL';
                            matchScore = 98;
                            timeline = '8 to 12 Weeks';
                            budget = '₹80,000 - ₹2,00,000+';
                            reasons = [
                                'Enterprise REST API backend with responsive React dashboard user interface.',
                                'Redis in-memory caching for sub-100ms response times under peak load.',
                                'Strict role-based access control (RBAC), audit logging, and automated backups.'
                            ];
                        } else if (priority === 'turnaround') {
                            stackName = 'Laravel 12 (MVC) + Bootstrap 5 + MySQL';
                            matchScore = 96;
                            timeline = '4 to 6 Weeks';
                            budget = '₹40,000 - ₹85,000';
                            reasons = [
                                'Rapid enterprise module assembly with pre-built Blade components.',
                                'Built-in security middleware preventing CSRF, XSS, and SQL injection.',
                                'Clean maintainable codebase for smooth in-house developer handovers.'
                            ];
                        } else {
                            stackName = 'Laravel 12 + Eloquent ORM + Redis + MySQL (Enterprise ERP)';
                            matchScore = 99;
                            timeline = '6 to 12 Weeks';
                            budget = '₹60,000 - ₹1,60,000+';
                            reasons = [
                                'Robust Eloquent ORM with multi-table relationships and schema migrations.',
                                'Asynchronous queue workers for background PDF generation & email alerts.',
                                '100% complete IP and source code ownership with zero monthly per-user SaaS fees.'
                            ];
                        }
                    }

                    if (traffic === 'high' && !reasons.some(r => r.includes('Redis') || r.includes('concurrency'))) {
                        reasons.push('Includes Redis distributed caching layer to support 100,000+ high concurrency traffic peaks.');
                    }

                    if (priority === 'security') {
                        matchScore = Math.max(matchScore, 99);
                    }

                    return {
                        stackName: stackName,
                        matchScore: matchScore + '% Compatibility Match',
                        timeline: timeline,
                        budget: budget,
                        reasons: reasons
                    };
                }

                function updateRecommendationUI(animate = false) {
                    const type = selectType.value;
                    const traffic = selectTraffic.value;
                    const priority = selectPriority.value;

                    if (animate) {
                        resultCard.classList.remove('d-none');
                        if (calcBtnText && calcBtnIcon) {
                            calcBtnIcon.className = 'bi bi-arrow-repeat spin me-2 fs-5 text-white';
                            calcBtnText.textContent = 'Calculating Optimal Stack...';
                            resultCard.style.opacity = '0.5';
                        }
                    }

                    setTimeout(() => {
                        const result = calculateRecommendation(type, traffic, priority);

                        if (resTitle) resTitle.textContent = result.stackName;
                        if (resScore) resScore.innerHTML = `<i class="bi bi-patch-check-fill me-1 text-white fs-6"></i> <span>${result.matchScore}</span>`;
                        if (resTimeline) resTimeline.textContent = result.timeline;
                        if (resBudget) resBudget.textContent = result.budget;

                        if (resList) {
                            resList.innerHTML = '';
                            result.reasons.forEach(reason => {
                                const li = document.createElement('li');
                                li.className = 'd-flex align-items-start gap-3 p-3 bg-white rounded-3 border border-slate-200 shadow-xs';
                                li.innerHTML = `<div class="rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0 mt-0.5" style="width: 32px; height: 32px; min-width: 32px; background: #d1fae5; color: #047857;"><i class="bi bi-check-lg fw-bold fs-5"></i></div> <span class="fw-medium text-slate-800 fs-6" style="line-height: 1.5;">${reason}</span>`;
                                resList.appendChild(li);
                            });
                        }

                        if (resWhatsappCta) {
                            const msg = `Hello Software Company in Lucknow, I used your Tech Calculator tool for my ${type} project (${traffic} users, ${priority} priority) and am interested in consulting for ${result.stackName}.`;
                            resWhatsappCta.href = `https://wa.me/916394296293?text=${encodeURIComponent(msg)}`;
                        }

                        if (animate) {
                            if (calcBtnText && calcBtnIcon) {
                                calcBtnIcon.className = 'bi bi-cpu-fill fs-5 me-2 text-white';
                                calcBtnText.textContent = 'Generate Optimal Tech Stack';
                            }
                            resultCard.style.opacity = '1';
                            resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            resultCard.style.boxShadow = '0 0 25px rgba(5, 150, 105, 0.35)';
                            setTimeout(() => {
                                resultCard.style.boxShadow = '';
                            }, 1200);
                        }
                    }, animate ? 250 : 0);
                }

                // Event listener for button click
                if (calcBtn) {
                    calcBtn.addEventListener('click', function () {
                        updateRecommendationUI(true);
                    });
                }

                // Event listeners for select changes (only update if result card is already visible)
                [selectType, selectTraffic, selectPriority].forEach(select => {
                    if (select) {
                        select.addEventListener('change', function () {
                            if (!resultCard.classList.contains('d-none')) {
                                updateRecommendationUI(false);
                            }
                        });
                    }
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initTechCalculator);
            } else {
                initTechCalculator();
            }
        })();
    </script>
    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .spin {
            display: inline-block;
            animation: spin 0.8s linear infinite;
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        .shadow-xs {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .extra-small {
            font-size: 0.8rem;
        }
    </style>
@endpush