<x-admin-layout pageTitle="Enquiry Details">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-outline-secondary rounded-3 mb-2">
                <i class="bi bi-arrow-left me-1"></i> Back to Enquiries
            </a>
            <h3 class="fw-bold text-slate-900 mb-1">Enquiry Details #{{ $enquiry->id }}</h3>
            <p class="text-muted small mb-0">Submitted on {{ $enquiry->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="tel:91{{ $enquiry->mobile }}" class="btn btn-success fw-bold rounded-3 px-3 py-2">
                <i class="bi bi-telephone-fill me-1.5"></i> Call: +91 {{ $enquiry->mobile }}
            </a>
            <a href="https://wa.me/91{{ $enquiry->mobile }}?text=Hello%20{{ urlencode($enquiry->name) }},%20thank%20you%20for%20your%20enquiry." target="_blank" class="btn text-white fw-bold rounded-3 px-3 py-2" style="background-color: #25D366;">
                <i class="bi bi-whatsapp me-1.5"></i> WhatsApp
            </a>
            <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" onsubmit="return confirm('Delete this enquiry record?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger fw-bold rounded-3 px-3 py-2">
                    <i class="bi bi-trash me-1"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-person-badge text-primary me-2"></i> Client Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <span class="text-muted extra-small uppercase tracking-wide fw-bold">Full Name</span>
                            <strong class="d-block text-dark fs-6">{{ $enquiry->name }}</strong>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted extra-small uppercase tracking-wide fw-bold">Mobile Number</span>
                            <strong class="d-block text-dark fs-6">+91 {{ $enquiry->mobile }}</strong>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted extra-small uppercase tracking-wide fw-bold">Email Address</span>
                            <strong class="d-block text-dark fs-6">{{ $enquiry->email ?? 'Not Provided' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted extra-small uppercase tracking-wide fw-bold">Source Page</span>
                            <strong class="d-block text-dark fs-6"><span class="badge px-2.5 py-1.5 fw-semibold" style="font-size: 0.82rem; background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;"><i class="bi bi-globe me-1" style="color: #2563eb;"></i>{{ $enquiry->source_page ?? 'general' }}</span></strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-chat-left-text text-primary me-2"></i> Project Requirement / Message</h5>
                    @if($enquiry->requirement)
                        <div class="p-3 bg-light rounded-3 text-slate-800" style="line-height: 1.7; font-size: 0.95rem;">
                            {!! nl2br(e($enquiry->requirement)) !!}
                        </div>
                    @else
                        <p class="text-muted italic mb-0">No specific requirement details were provided during submission.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-shield-check text-primary me-2"></i> Metadata &amp; Technical Log</h5>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2 small">
                        <li class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Enquiry Status:</span>
                            <span class="badge bg-success-subtle text-success border">Read / Processed</span>
                        </li>
                        <li class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">IP Address:</span>
                            <strong class="text-dark">{{ $enquiry->ip_address ?? 'N/A' }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Submission Date:</span>
                            <strong class="text-dark">{{ $enquiry->created_at->format('d M Y, h:i:s A') }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-1">
                            <span class="text-muted">Last Updated:</span>
                            <strong class="text-dark">{{ $enquiry->updated_at->diffForHumans() }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
