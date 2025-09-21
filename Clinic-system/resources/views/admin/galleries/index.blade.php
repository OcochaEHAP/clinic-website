@extends('layouts.admin')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('title', 'Toutes les photos')

@section('content')
<div class="container my-5">

    <!-- Header Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Avant & Après Gallery</h2>
        <form method="GET" action="{{ route('galleries.index') }}">
            <div class="input-group" style="width:220px;">
                <label class="input-group-text">Trier</label>
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Le plus récent</option>
                    <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Le plus ancien</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4">
        @forelse($galleries as $gallery)
            <div class="col-md-4 col-sm-6">
                <div class="card shadow-sm h-100 gallery-item" data-id="{{ $gallery->id }}">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                         class="card-img-top rounded-top"
                         alt="Avant & Après">

                    <div class="card-body d-flex justify-content-center">
                        <form method="POST" action="{{ route('galleries.destroy', $gallery->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $gallery->id }}">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Aucune image trouvée dans la galerie.</div>
            </div>
        @endforelse
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment supprimer cette image ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<script>
    let deleteId = null;

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            deleteId = this.getAttribute('data-id');
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        });
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteId) {
            fetch(`/admin/galleries/${deleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`.gallery-item[data-id="${deleteId}"]`).remove();
                        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                    }
                });
        }
    });
</script>
@endsection
