@extends('layout.app')

@section('title', 'Manage Testimonials')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0">Testimonials</h2>
        <span class="badge bg-white text-dark shadow-sm border px-3 py-2 rounded-pill">
            Total: {{ $testimonials->count() }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-none d-md-block card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-muted border-0">User</th>
                            <th class="px-4 py-3 text-muted border-0" style="width: 40%;">Content</th>
                            <th class="px-4 py-3 text-muted border-0 text-center">Rating</th>
                            <th class="px-4 py-3 text-muted border-0 text-center">Status</th>
                            <th class="px-4 py-3 text-muted border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $t)
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $t->user->avatar ?? 'https://via.placeholder.com/30' }}" 
                                         class="rounded-circle me-2" width="30" height="30" style="object-fit:cover;">
                                    <span class="fw-bold text-dark">{{ $t->user->name }}</span>
                                </div>
                                <small class="text-muted">{{ $t->created_at->format('M d, Y') }}</small>
                            </td>
                            <td class="px-4">
                                <div class="text-muted small text-truncate" style="max-width: 300px;">
                                    "{{ $t->content }}"
                                </div>
                            </td>
                            <td class="px-4 text-center">
                                <span class="text-warning fw-bold">{{ $t->rating }} <i class="bi bi-star-fill"></i></span>
                            </td>
                            <td class="px-4 text-center">
                                @if($t->is_approved)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Approved</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Pending</span>
                                @endif
                            </td>
                            <td class="px-4 text-end">
                                @if(!$t->is_approved)
                                    <button onclick="confirmApprove({{ $t->id }}, '{{ addslashes($t->content) }}')" class="btn btn-sm btn-outline-success rounded-pill me-1">
                                        <i class="bi bi-check-lg"></i> Approve
                                    </button>
                                @endif
                                <button onclick="confirmDelete({{ $t->id }})" class="btn btn-sm btn-light text-danger rounded-circle">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-5 text-muted">No testimonials found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-md-none d-flex flex-column gap-3">
        @forelse($testimonials as $t)
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ $t->user->avatar ?? 'https://via.placeholder.com/40' }}" 
                             class="rounded-circle me-2" width="40" height="40" style="object-fit:cover;">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $t->user->name }}</h6>
                            <small class="text-muted" style="font-size:0.75rem;">{{ $t->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                    @if($t->is_approved)
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill"><i class="bi bi-check-circle me-1"></i>Approved</span>
                    @else
                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill"><i class="bi bi-hourglass-split me-1"></i>Pending</span>
                    @endif
                </div>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <div class="mb-2 text-warning small">
                        @for($i=0; $i<$t->rating; $i++) <i class="bi bi-star-fill"></i> @endfor
                        @for($i=$t->rating; $i<5; $i++) <i class="bi bi-star"></i> @endfor
                    </div>
                    <p class="text-secondary mb-0 small fst-italic">"{{ $t->content }}"</p>
                </div>

                <div class="d-flex gap-2">
                    @if(!$t->is_approved)
                        <button onclick="confirmApprove({{ $t->id }}, '{{ addslashes($t->content) }}')" class="btn btn-success btn-sm flex-grow-1 rounded-pill">
                            Approve
                        </button>
                    @endif
                    <button onclick="confirmDelete({{ $t->id }})" class="btn btn-outline-danger btn-sm flex-grow-1 rounded-pill">
                        Delete
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">No testimonials found.</div>
        @endforelse
    </div>
</div>

<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="approveForm" method="POST" class="modal-content border-0 rounded-4">
            @csrf
            <div class="modal-body text-center p-4">
                <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-check-lg fs-2"></i>
                </div>
                <h5 class="fw-bold mb-2">Approve Testimonial?</h5>
                <p class="text-muted small mb-3">Please review the content before approving.</p>
                
                <div class="bg-light p-3 rounded-3 text-start mb-4 shadow-sm border-start border-success border-4">
                    <i class="bi bi-quote text-success fs-5"></i>
                    <p class="mb-0 text-dark fst-italic" id="approve-content-text" style="font-size: 0.95rem;"></p>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Yes, Approve</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="deleteForm" method="POST" class="modal-content border-0 rounded-4">
            @csrf
            @method('DELETE')
            <div class="modal-body text-center p-4">
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-trash-fill fs-2"></i>
                </div>
                <h5 class="fw-bold mb-2">Delete Testimonial?</h5>
                <p class="text-muted small">This action cannot be undone.</p>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // UPDATED: Function accepts 'content' parameter
    function confirmApprove(id, content) {
        // Set the form action
        document.getElementById('approveForm').action = `/admin/testimonials/${id}/approve`;
        
        // Insert the content into the preview box
        document.getElementById('approve-content-text').innerText = content;
        
        // Show modal
        new bootstrap.Modal(document.getElementById('approveModal')).show();
    }

    function confirmDelete(id) {
        document.getElementById('deleteForm').action = `/admin/testimonials/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endsection