@extends('layout.app')

@section('title', 'Manage FAQs')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0">FAQ Management</h2>
        
        <div class="d-flex gap-2">
            <button class="btn btn-outline-success rounded-pill px-4" onclick="syncWithChatbot()" id="btn-sync">
                <i class="bi bi-arrow-repeat me-2"></i>Sync to Chatbot
            </button>
            
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createFaqModal">
                <i class="bi bi-plus-lg me-2"></i>Add FAQ
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0" style="width: 30%;">Question</th>
                            <th class="px-4 py-3 border-0" style="width: 50%;">Answer</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                        <tr>
                            <td class="px-4 fw-bold text-dark">{{ $faq->question }}</td>
                            <td class="px-4 text-muted small">{{ Str::limit($faq->answer, 100) }}</td>
                            <td class="px-4 text-end">
                                <button class="btn btn-sm btn-light text-primary me-2" 
                                    onclick="editFaq({{ $faq->id }}, '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}')">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this FAQ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">No FAQs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createFaqModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.faq.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Add New FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Question</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Answer</label>
                    <textarea name="answer" class="form-control" rows="4" required></textarea>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary px-4">Save FAQ</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editFaqModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editFaqForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Edit FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Question</label>
                    <input type="text" name="question" id="edit_question" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Answer</label>
                    <textarea name="answer" id="edit_answer" class="form-control" rows="4" required></textarea>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary px-4">Update FAQ</button>
            </div>
        </form>
    </div>
</div>

<script>
    // --- CONFIGURATION ---
    // REPLACE THIS with your deployed Cloudflare Worker URL
    // e.g., 'https://my-chatbot.username.workers.dev'
    const WORKER_URL = 'https://ai-chatbot-widget.senojuro.workers.dev'; 

    async function syncWithChatbot() {
        const btn = document.getElementById('btn-sync');
        const originalText = btn.innerHTML;
        
        // Confirmation
        if(!confirm("This will update the Chatbot's AI knowledge with the latest FAQs from this table. Proceed?")) return;

        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-arrow-repeat me-2 spinner-border spinner-border-sm"></i> Syncing...';

        try {
            // Call the Worker's /api/seed endpoint
            const res = await fetch(`${WORKER_URL}/api/seed`, {
                method: 'POST',
            });

            const data = await res.json();

            if(res.ok && data.success) {
                alert(`Success! Updated ${data.count} FAQs.`);
            } else {
                throw new Error(data.error || 'Unknown error');
            }
        } catch (err) {
            console.error(err);
            alert("Failed to sync: " + err.message + "\n\nCheck your Worker URL configuration.");
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    }

    function editFaq(id, question, answer) {
        document.getElementById('editFaqForm').action = `/admin/faq/${id}`;
        document.getElementById('edit_question').value = question;
        document.getElementById('edit_answer').value = answer;
        new bootstrap.Modal(document.getElementById('editFaqModal')).show();
    }
</script>
@endsection