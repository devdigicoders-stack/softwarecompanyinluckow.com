<div class="row g-4 align-items-stretch">
    @forelse($posts as $post)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <x-tech-news-card :post="$post" />
        </div>
    @empty
        <div class="col-12 text-center py-5 bg-white rounded-4 border shadow-sm">
            <i class="bi bi-journal-x display-3 text-muted"></i>
            <h4 class="mt-3 fw-bold text-slate-800">No articles found</h4>
            <p class="text-muted">Try selecting a different category or clearing search filters.</p>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-5">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
