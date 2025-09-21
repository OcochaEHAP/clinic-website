@extends('layouts.admin')
@section('title','Tout les patients')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('patients.index') }}" method="GET" class="d-flex" style="max-width: 400px;">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control me-2" placeholder="Rechercher un patient...">
        <button type="submit" class="btn btn-primary">
            Rechercher
        </button>
    </form>


</div>

    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Liste des Patients</h4>
            <a href="{{ route('patients.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-person-plus"></i> Nouveau Patient
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Âge</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $patient->first_name}}</td>
                            <td class="fw-semibold">{{ $patient->last_name}}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>
                                <form action="{{ route('patients.show', $patient->id) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="btn btn-info btn-sm">
                                        Voir
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-patient-id="{{ $patient->id }}">
                                    Supprimer
                                </button>
                                </form>
</td>
<td>
<form action="{{ route('patients.edit', $patient->id) }}" method="GET" style="display:inline;">
    <button type="submit" class="btn btn-sm btn-warning">
        Modifier
    </button>
</form>

</td>
</tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">Aucun patient enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="patientModalLabel">Détails du patient</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><strong>Nom:</strong> <span id="modal-nom"></span></li>
          <li class="list-group-item"><strong>Prenom:</strong> <span id="modal-prenom"></span></li>
          <li class="list-group-item"><strong>Âge:</strong> <span id="modal-age"></span></li>
          <li class="list-group-item"><strong>Adresse:</strong> <span id="modal-address"></span></li>
          <li class="list-group-item"><strong>Téléphone:</strong> <span id="modal-phone"></span></li>
          <li class="list-group-item"><strong>N. de Carte Nationale:</strong> <span id="modal-card-number"></span></li>
          <li class="list-group-item"><strong>Taille:</strong> <span id="modal-tall"></span></li>
          <li class="list-group-item"><strong>Poids:</strong> <span id="modal-weight"></span></li>
          <li class="list-group-item"><strong>BMI:</strong> <span id="modal-bmi"></span></li>
          <li class="list-group-item"><strong>Morphologie:</strong> <span id="modal-morphologie"></span></li>
          <li class="list-group-item"><strong>Peau:</strong> <span id="modal-peau"></span></li>
          <li class="list-group-item"><strong>Graisse:</strong> <span id="modal-graisse"></span></li>
          <li class="list-group-item"><strong>Zones:</strong> <span id="modal-zones"></span></li>
          <li class="list-group-item"><strong>Hypertrophie:</strong> <span id="modal-hypertrophie"></span></li>
          <li class="list-group-item"><strong>Ptose:</strong> <span id="modal-ptose"></span></li>
          <li class="list-group-item"><strong>Asymetrie:</strong> <span id="modal-asymetrie"></span></li>
          <li class="list-group-item"><strong>ALcool:</strong> <span id="modal-alcool"></span></li>
          <li class="list-group-item"><strong>Tabac:</strong> <span id="modal-tabac"></span></li>
          <li class="list-group-item"><strong>Autres Habitudes:</strong> <span id="modal-habitudes"></span></li>
          <li class="list-group-item"><strong>Operations Precedents:</strong> <span id="modal-OP"></span></li>
          <li class="list-group-item"><strong>Complications:</strong> <span id="modal-complications"></span></li>
          <li class="list-group-item"><strong>Interventions:</strong> <span id="modal-interventions"></span></li>
        </ul>
      </div>
    </div>
  </div>
</div>

</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment supprimer ce patient ?
      </div>
      <div class="modal-footer">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var patientId = button.getAttribute('data-patient-id');

        // Update the form action with the patient ID
        var form = document.getElementById('deleteForm');
        form.action = '/patients/' + patientId;
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const modalNom = document.getElementById("modal-nom");
    const modalPrenom = document.getElementById("modal-prenom");
    const modalAddress = document.getElementById("modal-address");
    const modalAge = document.getElementById("modal-age");
    const modalTelephone = document.getElementById("modal-phone");
    const modalcard = document.getElementById("modal-card-number");
    const modalTaille = document.getElementById("modal-tall");
    const modalPoids = document.getElementById("modal-weight");
    const modalBmi = document.getElementById("modal-bmi");
    const modalMorphologie = document.getElementById("modal-morphologie");
    const modalPeau = document.getElementById("modal-peau");
    const modalGraisse = document.getElementById("modal-graisse");
    const modalZones= document.getElementById("modal-zones");
    const modalPtose= document.getElementById("modal-ptose");
    const modalAsymetrie = document.getElementById("modal-asymetrie");
    const modalInterventions = document.getElementById("modal-interventions");
    const modalHyper = document.getElementById("modal-hypertrophie");
    const modalalcool = document.getElementById("modal-alcool");
    const modaltabac = document.getElementById("modal-tabac");
    const modalhabitudes = document.getElementById("modal-habitudes");
    const modaloperations = document.getElementById("modal-OP");
    const modalcomplications = document.getElementById("modal-complications");

    document.querySelectorAll(".view-details").forEach(button => {
        button.addEventListener("click", function () {
            let patient = JSON.parse(this.getAttribute("data-patient"));
            // console.log(patient);

            modalNom.textContent = patient.last_name ?? "—";
            modalPrenom.textContent = patient.first_name ?? "—";
            modalAge.textContent = patient.age ?? "—";
            modalTelephone.textContent = patient.phone ?? "—";
            modalAddress.textContent = patient.address ?? "—";
            modalTaille.textContent = patient.tall ? patient.tall + " cm" : "—";
            modalPoids.textContent = patient.weight ? patient.weight + " kg" : "—";
            modalBmi.textContent = patient.bmi ?? "—";
            modalMorphologie.textContent = patient.morphologie ?? "—";
            modalPeau.textContent = patient.peau ?? "—";
            modalGraisse.textContent = patient.graisse ?? "—";
            modalZones.textContent = patient.zones ?? "—";
            modalPtose.textContent = patient.ptose ?? "—";
            modalAsymetrie.textContent = patient.asymetrie ?? "—";
            // modalInterventions.textContent = patient.interventions ?? "—";
            modalHyper.textContent = patient.hypertrophie ?? "—";
            modalalcool.textContent = patient.alcool ?? "—";
            modaltabac.textContent = patient.tabac ?? "—";
            modalhabitudes.textContent = patient.autres_habitudes ?? "—";
            modaloperations.textContent = patient.operations_precedentes ?? "—";
            modalcomplications.textContent = patient.complications ?? "—";
            modalcard.textContent = patient.card_number ?? "—";
            if (Array.isArray(patient.interventions)) {
                modalInterventions.textContent = patient.interventions.join(", ");
            } else {
                try {
                    const parsed = JSON.parse(patient.interventions);
                    modalInterventions.textContent = parsed.join(", ");
                } catch (e) {
                    modalInterventions.textContent = patient.interventions ?? "-"
                }
            }
        });
    });
});
// function editPatient(patient) {
//     const form = document.getElementById("updatePatientForm");
//     form.action = `/patients/${patient.id}`; // dynamic route

//     document.getElementById("update-first-name").value = patient.first_name ?? "";
//     document.getElementById("update-last-name").value = patient.last_name ?? "";
//     document.getElementById("update-age").value = patient.age ?? "";
//     document.getElementById("update-address").value = patient.address ?? "";
//     document.getElementById("update-phone").value = patient.phone ?? "";
//     document.getElementById("update-card-number").value = patient.card_number ?? "";
//     document.getElementById("update-interventions").value = patient.interventions  ?? "";
//     document.getElementById("update-chirurgie-generale").value = patient.chirurgie_generale ?? "";
//     document.getElementById("update-weight").value = patient.weight ?? "";
//     document.getElementById("update-tall").value = patient.tall ?? "";
//     document.getElementById("update-bmi").value = patient.bmi ?? "";
//     document.getElementById("update-morphologie").value = patient.morphologie ?? "";
//     document.getElementById("update-peau").value = patient.peau ?? "";
//     document.getElementById("update-graisse").value = patient.graisse ?? "";
//     document.getElementById("update-zones").value = patient.zones ?? "";
//     document.getElementById("update-hypertrophie").value = patient.hypertrophie ?? "";
//     document.getElementById("update-ptose").value = patient.ptose ?? "";
//     document.getElementById("update-asymetrie").value = patient.asymetrie ?? "";
//     document.getElementById("update-tabac").value = patient.tabac ?? "non";
//     document.getElementById("update-alcool").value = patient.alcool ?? "non";
//     document.getElementById("update-habitudes").value = patient.autres_habitudes ?? "";
//     document.getElementById("update-operations").value = patient.operations_precedentes ?? "";
//     document.getElementById("update-complications").value = patient.complications ?? "";
//             if (Array.isArray(patient.interventions)) {
//                 document.getElementById("update-interventions").value = patient.interventions.join(", ");
//                 // modalInterventions.textContent = patient.interventions.join(", ");
//             } else {
//                 try {
//                     const parsed = JSON.parse(patient.interventions);
//                     document.getElementById("update-interventions").value = parsed.join(", ");
//                 } catch (e) {
//                     document.getElementById("update-interventions").value = patient.interventions ?? "-"
//                 }
//             }
//     // show modal
//     new bootstrap.Modal(document.getElementById('updatePatientModal')).show();
// }

</script>

@endsection

