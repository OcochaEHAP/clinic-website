@extends('layouts.admin')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Optional Bootstrap JS (for modals, dropdowns, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('title', 'Publier un Image')

@section('content')
<div class="container mt-4">
    <h2>Publier Une Image</h2>

<!-- Formulaire Avant / Après -->
<div class="card shadow-sm mb-4">
  <div class="card-header bg-primary text-white">
    Téléverser Avant / Après
  </div>
  <div class="card-body">
    <form id="gallery-form" method="POST" action="{{ url('/admin/gallery/upload') }}" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="before" class="form-label">Photo Avant</label>
        <input type="file" id="before" name="before" class="form-control" accept="image/*" required>
      </div>

      <div class="mb-3">
        <label for="after" class="form-label">Photo Après</label>
        <input type="file" id="after" name="after" class="form-control" accept="image/*">
      </div>

      <!-- Aperçu -->
      <div class="mb-3 text-center">
        <canvas id="canvas" style="max-width:100%; border:1px solid #dee2e6; border-radius: .25rem;"></canvas>
      </div>

      <div class="d-flex justify-content-between">
        <button type="button" id="merge" class="btn btn-outline-primary">
          <i class="bi bi-eye"></i> Aperçu
        </button>
        <button type="submit" id="uploadButton" class="btn btn-success">
          <i class="bi bi-cloud-upload"></i> Enregistrer l’image
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Formulaire Téléversement Simple -->
<div class="card shadow-sm">
  <div class="card-header bg-secondary text-white">
    Téléverser une seule image
  </div>
  <div class="card-body">
    <form id="singleUploadForm" method="POST" action="{{ url('/admin/gallery/upload') }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="singleImage" class="form-label">Sélectionner l’image</label>
        <input id="singleImage" type="file" class="form-control" name="image" required>
      </div>
      <button type="submit" id="singleUploadButton" class="btn btn-success">
        <i class="bi bi-cloud-upload"></i> Téléverser
      </button>
    </form>
  </div>
</div>

    <div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="spinner-border text-primary mb-3" role="status"></div>
                <h5>Téléchargement en cours, veuillez patienter...</h5>
            </div>
        </div>
    </div>


<script>
document.getElementById("merge").addEventListener("click", async () => {
  const beforeFile = document.getElementById("before").files[0];
  const afterFile = document.getElementById("after").files[0];

  if (!beforeFile || !afterFile) {
    alert("Please select both images");
    return;
  }

  const beforeImg = await loadImage(beforeFile);
  const afterImg = await loadImage(afterFile);

  const width = 1600;
  const height = 900;
  const canvas = document.getElementById("canvas");
  const ctx = canvas.getContext("2d");

  canvas.width = width;
  canvas.height = height;

  // Draw both images side by side
  ctx.drawImage(beforeImg, 0, 0, width / 2, height);
  ctx.drawImage(afterImg, width / 2, 0, width / 2, height);



  // Load and draw the logo in the center
  const logo = await loadImage("/images/logo.png");
    const logoWidth = 420;  // smaller size
  const logoHeight = 420;
  const x = (width - logoWidth) / 2;
  const y = (height - logoHeight) / 2;

  ctx.globalAlpha = 0.8; // transparency if you want
  ctx.drawImage(logo, x, y, logoWidth, logoHeight);
  ctx.globalAlpha = 1.0; // reset transparency
  //
  function loadImage(fileOrUrl) {
  return new Promise((resolve, reject) => {
    const img = new Image();

    if (fileOrUrl instanceof File) {
      img.src = URL.createObjectURL(fileOrUrl);
    } else {
      img.src = fileOrUrl;
    }

    img.onload = () => {
    //   console.log("✅ Image loaded:", img.src);
      resolve(img);
    };

    img.onerror = (err) => {
    //   console.error("❌ Failed to load image:", img.src, err);
      reject(err);
    };
  });
}

});

// Helper to load images




// FORM 1: MERGED UPLOAD
document.getElementById("gallery-form").addEventListener("submit", function(e) {
  e.preventDefault();
  let uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
  uploadModal.show();

  const canvas = document.getElementById("canvas");

  canvas.toBlob((blob) => {
    const formData = new FormData();
    formData.append("_token", "{{ csrf_token() }}");
    formData.append("image", blob, "merged.jpg");

    fetch(this.action, {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      uploadModal.hide();
      console.log("Response:", data);
    })
    .catch(err => {
      console.error("Upload error:", err);
      alert("Upload failed!");
    });
  }, "image/jpeg", 0.9);
});


// FORM 2: SINGLE UPLOAD (FIXED)
document.getElementById("singleUploadForm").addEventListener("submit", function(e) {
  e.preventDefault();
  console.log('single form is working');
  let uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
  uploadModal.show();

  const singleFile = document.getElementById("singleImage").files[0]; // <--- get file input

  if (!singleFile) {
    alert("Please select an image");
    uploadModal.hide();
    return;
  }

  const formData = new FormData();
  formData.append("_token", "{{ csrf_token() }}");
  formData.append("image", singleFile, singleFile.name); // <--- send original file

  fetch(this.action, {
    method: "POST",
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    uploadModal.hide();
    console.log("Response:", data);
  })
  .catch(err => {
    console.error("Upload error:", err);
    alert("Upload failed!");
  });
});


// HELPER: Load image
function loadImage(file) {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = () => resolve(img);
    img.onerror = reject;
    img.src = URL.createObjectURL(file);
  });
}
</script>

@endsection
