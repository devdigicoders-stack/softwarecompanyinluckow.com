<x-admin-layout pageTitle="Add New Page FAQ">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-bold text-slate-900 mb-1" style="color: #0f172a;">Add New Page FAQ</h3>
            <p class="text-secondary small mb-0">Create a dynamic FAQ item assigned to a specific website page.</p>
        </div>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-glass-outline">
            <i class="bi bi-arrow-left me-1"></i> Back to FAQs List
        </a>
    </div>

    <div class="glass-card p-4 p-md-5" style="max-width: 900px;">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <!-- Page Name Assignment -->
                <div class="col-md-6">
                    <label for="page_name" class="form-label fw-bold text-slate-800 small mb-1">
                        Target Page <span class="text-danger">*</span>
                    </label>
                    <select name="page_name" id="pageNameSelect" class="form-select @error('page_name') is-invalid @enderror" required>
                        <option value="">Select Target Page...</option>
                        @foreach($pages as $p)
                            <option value="{{ $p }}" {{ old('page_name') == $p ? 'selected' : '' }}>Page: {{ ucfirst($p) }}</option>
                        @endforeach
                        <option value="other" {{ old('page_name') == 'other' ? 'selected' : '' }}>Other / Custom Page Slug...</option>
                    </select>
                    @error('page_name')<div class="invalid-feedback">{{ $message }}</div>@enderror

                    <!-- Custom Page Input -->
                    <div id="customPageContainer" class="mt-2 {{ old('page_name') == 'other' ? '' : 'd-none' }}">
                        <input type="text" name="custom_page_name" id="custom_page_name" class="form-control @error('custom_page_name') is-invalid @enderror" value="{{ old('custom_page_name') }}" placeholder="Type custom page slug (e.g. landing-page-slug)...">
                        @error('custom_page_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Display Order Index -->
                <div class="col-md-6">
                    <label for="order_index" class="form-label fw-bold text-slate-800 small mb-1">
                        Display Order Index <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="order_index" id="order_index" class="form-control @error('order_index') is-invalid @enderror" value="{{ old('order_index', 1) }}" min="1" required>
                    <div class="form-text text-muted small">Lower numbers display first in the accordion.</div>
                    @error('order_index')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Question -->
                <div class="col-12">
                    <label for="question" class="form-label fw-bold text-slate-800 small mb-1">
                        FAQ Question <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="question" id="question" class="form-control form-control-lg @error('question') is-invalid @enderror" value="{{ old('question') }}" placeholder="e.g. Do you sign Non-Disclosure Agreements (NDAs)?" required>
                    @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Answer -->
                <div class="col-12">
                    <label for="answer" class="form-label fw-bold text-slate-800 small mb-1">
                        FAQ Answer <span class="text-danger">*</span>
                    </label>
                    <textarea name="answer" id="answer" rows="5" class="form-control @error('answer') is-invalid @enderror" placeholder="Write clear, comprehensive answer for clients..." required>{{ old('answer') }}</textarea>
                    @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Active Status Toggle -->
                <div class="col-12 mt-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold text-slate-800" for="is_active">
                            Active (Visible on Page)
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-glass-primary px-4 py-2.5 fw-bold">
                        <i class="bi bi-check-lg me-1"></i> Save FAQ Item
                    </button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-glass-outline ms-2 px-4 py-2.5">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pageSelect = document.getElementById('pageNameSelect');
            const customContainer = document.getElementById('customPageContainer');
            const customInput = document.getElementById('custom_page_name');

            if (pageSelect && customContainer) {
                pageSelect.addEventListener('change', function() {
                    if (this.value === 'other') {
                        customContainer.classList.remove('d-none');
                        if (customInput) customInput.focus();
                    } else {
                        customContainer.classList.add('d-none');
                        if (customInput) customInput.value = '';
                    }
                });
            }
        });
    </script>
    @endpush
</x-admin-layout>
