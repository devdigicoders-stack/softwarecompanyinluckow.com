<x-admin-layout pageTitle="Write New Blog Article">
    @push('styles')
    <!-- Summernote BS5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet" />
    <style>
        .note-editor.note-frame {
            border: 1px solid #cbd5e1 !important;
            border-radius: 12px !important;
            overflow: hidden;
            background: #ffffff;
        }
        .note-toolbar {
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        .note-modal {
            z-index: 1055 !important;
        }
        .note-modal-backdrop {
            z-index: 1050 !important;
        }
        .note-dropdown-menu {
            z-index: 1060 !important;
        }
    </style>
    @endpush

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" id="blogPostForm">
        @csrf

        <!-- Top Header & Actions -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <a href="{{ route('admin.posts.index') }}" class="text-decoration-none small text-secondary fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Back to All Blogs
                </a>
                <h3 class="fw-bold text-slate-900 mb-0" style="color: #0f172a;">Create Blog Article</h3>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" name="is_published" value="0" class="btn btn-glass-outline">
                    <i class="bi bi-file-earmark me-1"></i> Save as Draft
                </button>
                <button type="submit" name="is_published" value="1" class="btn btn-glass-primary">
                    <i class="bi bi-send-fill me-1"></i> Publish Article
                </button>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left 8 Cols: Main Content Area -->
            <div class="col-12 col-lg-8">
                <!-- Article Content Glass Card -->
                <div class="glass-card p-4 mb-4">
                    <h5 class="fw-bold text-slate-900 mb-3 border-bottom pb-2"><i class="bi bi-pencil-square text-emerald-600 me-2"></i> Article Content</h5>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="glass-label">Article Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control glass-input fs-5 fw-bold @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Best Software Development Practices in Lucknow 2026" required autofocus>
                        @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label for="slug" class="glass-label">URL Slug</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted small">/blogs/</span>
                            <input type="text" name="slug" id="slug" class="form-control glass-input border-start-0 @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="auto-generated-slug-from-title">
                        </div>
                        <small class="text-muted" style="font-size: 0.76rem;">Auto-generates from title. You can manually customize the URL slug.</small>
                        @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <!-- Category & Author Row -->
                    <div class="row g-3 mb-3" style="position: relative; z-index: 35;">
                        <div class="col-12 col-md-6">
                            <label class="glass-label">Category <span class="text-danger">*</span></label>
                            @php
                                $selectedCatId = old('category_id');
                                $currentCatName = 'Select Category';
                                if ($selectedCatId) {
                                    $catItem = $categories->firstWhere('id', $selectedCatId);
                                    if ($catItem) $currentCatName = $catItem->name;
                                }
                            @endphp
                            <input type="hidden" name="category_id" id="category_id_input" value="{{ $selectedCatId }}" required>
                            <div class="dropdown w-100">
                                <button class="btn glass-input bg-white w-100 d-flex align-items-center justify-content-between py-2.5 px-3 dropdown-toggle text-slate-800 @error('category_id') is-invalid @enderror" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="fw-semibold text-truncate me-2" id="category_id_label">{{ $currentCatName }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-start w-100 shadow-lg border p-1 rounded-3 mt-1" style="max-height: 260px; overflow-y: auto;">
                                    <li><a class="dropdown-item rounded-2 small py-2 {{ !$selectedCatId ? 'active text-white' : '' }}" style="{{ !$selectedCatId ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('category_id_input').value=''; document.getElementById('category_id_label').textContent='Select Category';">Select Category</a></li>
                                    @foreach($categories as $cat)
                                        <li><a class="dropdown-item rounded-2 small py-2 {{ $selectedCatId == $cat->id ? 'active text-white' : '' }}" style="{{ $selectedCatId == $cat->id ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('category_id_input').value='{{ $cat->id }}'; document.getElementById('category_id_label').textContent='{{ addslashes($cat->name) }}';">{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @error('category_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="glass-label">Author</label>
                            @php
                                $selectedAuthorId = old('author_id', $authors->first()->id ?? '');
                                $currentAuthorName = 'Select Author';
                                if ($selectedAuthorId) {
                                    $authorItem = $authors->firstWhere('id', $selectedAuthorId);
                                    if ($authorItem) $currentAuthorName = $authorItem->name;
                                }
                            @endphp
                            <input type="hidden" name="author_id" id="author_id_input" value="{{ $selectedAuthorId }}">
                            <div class="dropdown w-100">
                                <button class="btn glass-input bg-white w-100 d-flex align-items-center justify-content-between py-2.5 px-3 dropdown-toggle text-slate-800" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="fw-semibold text-truncate me-2" id="author_id_label">{{ $currentAuthorName }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end w-100 shadow-lg border p-1 rounded-3 mt-1" style="max-height: 260px; overflow-y: auto;">
                                    @foreach($authors as $author)
                                        <li><a class="dropdown-item rounded-2 small py-2 {{ $selectedAuthorId == $author->id ? 'active text-white' : '' }}" style="{{ $selectedAuthorId == $author->id ? 'background: #059669;' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('author_id_input').value='{{ $author->id }}'; document.getElementById('author_id_label').textContent='{{ addslashes($author->name) }}';">{{ $author->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Short Excerpt -->
                    <div class="mb-3">
                        <label for="excerpt" class="glass-label">Short Description / Excerpt <span class="text-danger">*</span></label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="form-control glass-input @error('excerpt') is-invalid @enderror" placeholder="Write a concise overview of the article to show in listing cards and meta description..." required>{{ old('excerpt') }}</textarea>
                        @error('excerpt')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <!-- Content Rich Editor -->
                    <div class="mb-3">
                        <label for="summernote" class="glass-label">Full Article Body <span class="text-danger">*</span></label>
                        <div id="summernoteWrapper">
                            <textarea name="content" id="summernote" class="form-control glass-input @error('content') is-invalid @enderror" placeholder="Write full blog content..." required>{{ old('content') }}</textarea>
                        </div>
                        @error('content')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <!-- Tags -->
                    <div class="mb-3 pt-2 border-top">
                        <label class="glass-label">Article Tags</label>
                        <div class="d-flex flex-wrap gap-2 pt-1">
                            @foreach($tags as $tag)
                                <div class="form-check form-check-inline bg-white px-3 py-1.5 rounded-3 border">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                                    <label class="form-check-label small fw-semibold text-slate-700" for="tag-{{ $tag->id }}">#{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Featured Image Glass Card -->
                <div class="glass-card p-4 mb-4">
                    <h5 class="fw-bold text-slate-900 mb-3 border-bottom pb-2"><i class="bi bi-image text-primary me-2"></i> Featured Image</h5>

                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-md-6">
                            <label for="image_file" class="glass-label">Upload Featured Image</label>
                            <input type="file" name="image_file" id="image_file" class="form-control glass-input" accept="image/jpeg,image/png,image/webp" onchange="previewImage(this)">
                            <small class="text-muted d-block mt-1">Recommended: 1200x630px JPG, PNG, or WEBP.</small>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="alt_text" class="glass-label">Image Alt Text (SEO)</label>
                            <input type="text" name="alt_text" id="alt_text" class="form-control glass-input" value="{{ old('alt_text') }}" placeholder="Descriptive alt text for search accessibility">
                        </div>
                    </div>

                    <!-- Preview Thumbnail Container -->
                    <div class="mt-3 text-center d-none" id="imagePreviewContainer">
                        <div class="position-relative d-inline-block rounded-3 overflow-hidden border shadow-sm" style="max-width: 320px; max-height: 180px;">
                            <img id="imagePreview" src="#" alt="Preview" class="w-100 h-100 object-fit-cover">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle p-1" onclick="removePreviewImage()"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Article FAQs Card -->
                <div class="glass-card p-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h5 class="fw-bold text-slate-900 mb-0">
                            <i class="bi bi-question-circle text-primary me-2"></i> Article FAQs (Frequently Asked Questions)
                        </h5>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" id="addFaqBtn">
                            <i class="bi bi-plus-lg me-1"></i> Add FAQ
                        </button>
                    </div>
                    <p class="text-secondary small mb-3">Add custom Q&A pairs for this blog post to rank on Google Search FAQ Rich Snippets.</p>

                    <div id="faqContainer" class="d-flex flex-column gap-3">
                        @if(old('faqs'))
                            @foreach(old('faqs') as $index => $faq)
                                <div class="faq-item-row p-3 rounded-3 border bg-light-subtle position-relative">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-slate-800 small"><i class="bi bi-question-square me-1 text-primary"></i> FAQ #<span class="faq-index">{{ $loop->iteration }}</span></span>
                                        <button type="button" class="btn btn-sm btn-outline-danger border-0 p-1 remove-faq-btn" title="Remove FAQ"><i class="bi bi-trash fs-6"></i></button>
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" name="faqs[{{ $index }}][question]" class="form-control glass-input" placeholder="Question (e.g. What is custom software development?)" value="{{ $faq['question'] ?? '' }}">
                                    </div>
                                    <div>
                                        <textarea name="faqs[{{ $index }}][answer]" rows="2" class="form-control glass-input" placeholder="Detailed answer response...">{{ $faq['answer'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right 4 Cols: SEO Sidebar & Real-time Google Search Preview -->
            <div class="col-12 col-lg-4">
                <div class="sticky-sidebar-col">

                    <!-- Google Search Live Preview Card -->
                    <div class="glass-card p-4 mb-4">
                        <h6 class="fw-bold text-slate-900 mb-3 d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-google text-primary me-2"></i> Google Search Preview</span>
                            <span class="badge bg-primary-subtle text-primary border small" style="font-size: 0.72rem;">Live SERP</span>
                        </h6>

                        <div class="google-preview-card">
                            <div class="google-preview-url">
                                softwarecompanyinlucknow.com <cite id="googlePreviewSlug">/blogs/sample-slug</cite>
                            </div>
                            <a href="javascript:void(0)" class="google-preview-title d-block" id="googlePreviewTitle">
                                Sample Article SEO Title | Software Company in Lucknow
                            </a>
                            <div class="google-preview-desc" id="googlePreviewDesc">
                                Looking for custom software development in Lucknow? Explore software architecture insights, website costs, and mobile app guides...
                            </div>
                        </div>
                    </div>

                    <!-- SEO Controls Glass Card -->
                    <div class="glass-card p-4 mb-4">
                        <h5 class="fw-bold text-slate-900 mb-3 border-bottom pb-2"><i class="bi bi-search text-emerald-600 me-2"></i> Search Engine Optimization</h5>

                        <!-- SEO Title -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="meta_title" class="glass-label mb-0">SEO Title</label>
                                <span class="counter-badge counter-good" id="seoTitleCounter">0 / 60</span>
                            </div>
                            <input type="text" name="meta_title" id="meta_title" class="form-control glass-input" value="{{ old('meta_title') }}" placeholder="Target title for Google Search">
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Recommended: 50–60 characters.</small>
                        </div>

                        <!-- Meta Description -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="meta_description" class="glass-label mb-0">Meta Description</label>
                                <span class="counter-badge counter-good" id="metaDescCounter">0 / 160</span>
                            </div>
                            <textarea name="meta_description" id="meta_description" rows="4" class="form-control glass-input" placeholder="Compelling meta description summary for Google SERP snippet">{{ old('meta_description') }}</textarea>
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Recommended: 140–160 characters.</small>
                        </div>

                        <!-- Canonical URL -->
                        <div class="mb-3">
                            <label for="canonical_url" class="glass-label">Canonical URL</label>
                            <input type="url" name="canonical_url" id="canonical_url" class="form-control glass-input" value="{{ old('canonical_url') }}" placeholder="https://softwarecompanyinlucknow.com/blogs/slug">
                        </div>

                        <!-- Schema Type -->
                        <div class="mb-3">
                            <label for="schema_type" class="glass-label">Structured Schema</label>
                            <select name="schema_type" id="schema_type" class="form-select glass-input">
                                <option value="Article">Article</option>
                                <option value="BlogPosting">BlogPosting</option>
                                <option value="TechArticle">TechArticle</option>
                                <option value="NewsArticle">NewsArticle</option>
                            </select>
                        </div>
                    </div>

                    <!-- Final Action Box -->
                    <div class="glass-card p-4">
                        <h6 class="fw-bold text-slate-900 mb-3 border-bottom pb-2">Publish Settings</h6>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" name="is_published" id="is_published_switch" value="1" {{ old('is_published') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-slate-800" for="is_published_switch">
                                Publish Article Immediately
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" name="is_featured" id="is_featured_switch" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-dark" for="is_featured_switch">
                                <i class="bi bi-star-fill text-warning me-1"></i> Feature on Hero Spotlight
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" name="is_trending" id="is_trending_switch" value="1" {{ old('is_trending') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-danger" for="is_trending_switch">
                                <i class="bi bi-fire text-danger me-1"></i> Mark as Trending Article
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" name="is_popular" id="is_popular_switch" value="1" {{ old('is_popular') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-info" for="is_popular_switch">
                                <i class="bi bi-graph-up-arrow text-info me-1"></i> Mark as Popular Article
                            </label>
                        </div>

                        <button type="submit" class="btn btn-glass-primary w-100 py-2.5">
                            <i class="bi bi-check-circle-fill me-2"></i> Save Blog Post
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <!-- jQuery & Summernote BS5 JS CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Summernote Editor
            $('#summernote').summernote({
                placeholder: 'Write your detailed blog post article content here...',
                tabsize: 2,
                height: 380,
                dialogsInBody: true,
                dialogsFade: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i]);
                        }
                    }
                }
            });

            // Fullscreen Body Portal Handler for Summernote
            const summernoteWrapper = document.getElementById('summernoteWrapper');
            const noteEditor = summernoteWrapper ? summernoteWrapper.querySelector('.note-editor') : null;

            if (noteEditor && summernoteWrapper) {
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            if (noteEditor.classList.contains('fullscreen')) {
                                if (noteEditor.parentElement !== document.body) {
                                    document.body.appendChild(noteEditor);
                                    document.body.classList.add('summernote-fullscreen-active');
                                }
                            } else {
                                if (noteEditor.parentElement === document.body) {
                                    summernoteWrapper.appendChild(noteEditor);
                                    document.body.classList.remove('summernote-fullscreen-active');
                                }
                            }
                        }
                    });
                });

                observer.observe(noteEditor, { attributes: true });
            }

            // Ensure editor returns to wrapper before form submit
            document.getElementById('blogPostForm').addEventListener('submit', function() {
                const editor = document.querySelector('.note-editor');
                const wrapper = document.getElementById('summernoteWrapper');
                if (editor && wrapper && editor.parentElement === document.body) {
                    wrapper.appendChild(editor);
                    document.body.classList.remove('summernote-fullscreen-active');
                }
            });

            function uploadSummernoteImage(file) {
                let data = new FormData();
                data.append('image', file);
                data.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('admin.posts.upload-image') }}",
                    method: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.url) {
                            $('#summernote').summernote('insertImage', response.url);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Image upload error:', textStatus, errorThrown);
                        alert('Failed to upload image. Please ensure the file is a valid image (max 5MB).');
                    }
                });
            }
             // Auto Slug & Live Google Preview Elements
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            const metaTitleInput = document.getElementById('meta_title');
            const metaDescInput = document.getElementById('meta_description');
            const excerptInput = document.getElementById('excerpt');
            const googleTitle = document.getElementById('googlePreviewTitle');
            const googleSlug = document.getElementById('googlePreviewSlug');
            const googleDesc = document.getElementById('googlePreviewDesc');
            const titleCounter = document.getElementById('seoTitleCounter');
            const descCounter = document.getElementById('metaDescCounter');
            let userTouchedSlug = false;

            slugInput.addEventListener('input', function() {
                userTouchedSlug = true;
                updateGooglePreview();
            });

            titleInput.addEventListener('input', function() {
                if (!userTouchedSlug) {
                    slugInput.value = slugify(titleInput.value);
                }
                if (!metaTitleInput.value) {
                    updateGooglePreview();
                }
            });

            metaTitleInput.addEventListener('input', updateGooglePreview);
            metaDescInput.addEventListener('input', updateGooglePreview);
            excerptInput.addEventListener('input', function() {
                if (!metaDescInput.value) {
                    updateGooglePreview();
                }
            });

            function slugify(text) {
                return text.toString().toLowerCase().trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-');
            }

            function updateGooglePreview() {
                const currentTitle = metaTitleInput.value || titleInput.value || 'Sample Article Title';
                const currentSlug = slugInput.value || 'sample-slug';
                const currentDesc = metaDescInput.value || excerptInput.value || 'Looking for custom software development in Lucknow? Explore software architecture insights, website costs, and mobile app guides...';

                googleTitle.textContent = currentTitle + ' | Software Company in Lucknow';
                googleSlug.textContent = '/blogs/' + currentSlug;
                googleDesc.textContent = currentDesc;

                // Character counters
                const tLen = currentTitle.length;
                titleCounter.textContent = `${tLen} / 60`;
                if (tLen > 60) {
                    titleCounter.className = 'counter-badge counter-warning';
                } else {
                    titleCounter.className = 'counter-badge counter-good';
                }

                const dLen = currentDesc.length;
                descCounter.textContent = `${dLen} / 160`;
                if (dLen > 160) {
                    descCounter.className = 'counter-badge counter-warning';
                } else {
                    descCounter.className = 'counter-badge counter-good';
                }
            }

            updateGooglePreview();
        });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removePreviewImage() {
            document.getElementById('image_file').value = '';
            document.getElementById('imagePreviewContainer').classList.add('d-none');
        }

        // Dynamic FAQ Builder Logic
        let faqCounter = {{ old('faqs') ? count(old('faqs')) : 0 }};

        function addFaqRow(q = '', a = '') {
            const container = document.getElementById('faqContainer');
            if (!container) return;

            const index = container.children.length + 1;
            const row = document.createElement('div');
            row.className = 'faq-item-row p-3 rounded-3 border bg-light-subtle position-relative';
            row.innerHTML = `
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-bold text-slate-800 small"><i class="bi bi-question-square me-1 text-primary"></i> FAQ #<span class="faq-index">${index}</span></span>
                    <button type="button" class="btn btn-sm btn-outline-danger border-0 p-1 remove-faq-btn" title="Remove FAQ"><i class="bi bi-trash fs-6"></i></button>
                </div>
                <div class="mb-2">
                    <input type="text" name="faqs[${faqCounter}][question]" class="form-control glass-input" placeholder="Question (e.g. What is custom software development?)" value="${escapeAttr(q)}">
                </div>
                <div>
                    <textarea name="faqs[${faqCounter}][answer]" rows="2" class="form-control glass-input" placeholder="Detailed answer response...">${escapeHtml(a)}</textarea>
                </div>
            `;
            container.appendChild(row);
            faqCounter++;
            updateFaqIndices();

            row.querySelector('.remove-faq-btn').addEventListener('click', function() {
                row.remove();
                updateFaqIndices();
            });
        }

        function updateFaqIndices() {
            const rows = document.querySelectorAll('#faqContainer .faq-item-row');
            rows.forEach((row, i) => {
                const badge = row.querySelector('.faq-index');
                if (badge) badge.textContent = i + 1;
            });
        }

        function escapeAttr(str) {
            return (str || '').replace(/"/g, '&quot;');
        }
        function escapeHtml(str) {
            return (str || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        const addFaqBtn = document.getElementById('addFaqBtn');
        if (addFaqBtn) {
            addFaqBtn.addEventListener('click', function() {
                addFaqRow();
            });
        }

        // Bind existing remove buttons
        document.querySelectorAll('#faqContainer .remove-faq-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.faq-item-row').remove();
                updateFaqIndices();
            });
        });
    </script>
    @endpush
</x-admin-layout>
