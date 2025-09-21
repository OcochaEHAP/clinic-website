@extends('layouts.admin')
@section('title', 'Creer un patient')
@section('content')
<div class="container mb-4">
    <h2 class="mb-4">Dossier Patient</h2>
    {{-- <form action="{{ route('patients.store') }}" method="POST"> --}}
    <form action="{{route('patient.store')}}" method="POST">
        @csrf

        <!-- Section 1: Infos Patient -->
        <div class="card mb-4 ">
            <div class="card-header bg-primary text-white">Informations du patient</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="first_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom</label>
                    <input type="text" name="last_name" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Âge</label>
                    <input type="number" name="age" min="0" class="form-control">
                </div>
                <div class="col-md-9">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">N° Carte Nationale</label>
                    <input type="text" maxlength="22" name="card_number" id="cardID" class="form-control">
                </div>
            </div>
        </div>

        <!-- Section 2: Intervention Prévue -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Type d’intervention prévue</div>
            <div class="card-body row g-3">

                <div class="col-md-6">
    <label class="form-label fw-bold">Chirurgie Esthétique</label>

                    @php
                        $chirurgies = [
                            'Liposuccion',
                            'Lipofilling',
                            'BBL',
                            'Abdominoplastie',
                            'Réduction mammaire',
                            'Augmentation mammaire (Prothèse)',
                            'Augmentation mammaire (Lipofilling)'
                        ];
                    @endphp
                    @foreach($chirurgies as $c)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interventions[]" value="{{ $c }}">
                            <label class="form-check-label">{{ $c }}</label>
                        </div>
                    @endforeach
                </div>

     <div class="col-md-6">

    <div class="mb-3">
        <label class="form-label fw-bold">Esthétique sans chirurgie</label>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="interventions[]" value="Filler / Botox" id="fillerBotox">
        <label class="form-check-label" for="fillerBotox">
            Filler / Botox
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="interventions[]" value="Hydrafacial" id="hydrafacial">
        <label class="form-check-label" for="hydrafacial">
            Hydrafacial
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="interventions[]" value="Épilation laser" id="laser">
        <label class="form-check-label" for="laser">
            Épilation laser
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="interventions[]" value="HIFU visage" id="hifuVisage">
        <label class="form-check-label" for="hifuVisage">
            HIFU visage
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="interventions[]" value="HIFU vaginal" id="hifuVaginal">
        <label class="form-check-label" for="hifuVaginal">
            HIFU vaginal
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="interventions[]" value="Drainage" id="Drainage">
        <label class="form-check-label" for="Drainage">
            Drainage
        </label>
    </div>
    {{-- add :
        Drainage
        Controle
        Laser Epilasion
            botox
            filler
            hydrafacial
            HIFU visage & vaginal
            Drainage lymphatique
            cavitation
            radio frequence

            reclamation
     --}}
</div>


                </div>
<div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Chirurgie générale</label>

    <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="chirurgieGenerale" name="chirurgie_generale" value="1">
        <label class="form-check-label" for="chirurgieGenerale">
            Oui, le patient a subi une chirurgie générale
        </label>
    </div>

    <input type="text" class="form-control" id="chirurgieGeneraleDetails"
           name="chirurgie_generale" placeholder="Préciser le type de chirurgie" disabled>
</div>
            </div>
        </div>
<div class="card mt-4 shadow-sm">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Antécédents Chirurgicaux</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="operations_precedentes" class="form-label">Opérations précédentes</label>
            <textarea name="operations_precedentes" id="operations_precedentes"
                      class="form-control" rows="2">{{ old('operations_precedentes') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="complications" class="form-label">Complications</label>
            <textarea name="complications" id="complications"
                      class="form-control" rows="2">{{ old('complications') }}</textarea>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Habitudes</h5>
    </div>
    <div class="card-body">
<div class="mb-3">
  <label for="tabac" class="form-label">Tabac</label>
  <select name="tabac" id="tabac" class="form-select">
    <option value="non" selected>Non</option>
    <option value="oui">Oui</option>
  </select>
</div>

<div class="mb-3">
  <label for="alcool" class="form-label">Alcool</label>
  <select name="alcool" id="alcool" class="form-select">
    <option value="non" selected>Non</option>
    <option value="oui">Oui</option>
  </select>
</div>

        <div class="mb-3">
            <label for="autres_habitudes" class="form-label">Autres habitudes</label>
            <input type="text" name="autres_habitudes" id="autres_habitudes"
                   class="form-control" value="{{ old('autres_habitudes') }}">
        </div>
    </div>
</div>

        <!-- Section 3: Examen Clinique -->
        <div class="card mt-4 mb-4">
            <div class="card-header bg-info text-white">Examen clinique</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label class="form-label">Poids (kg)</label>
                    <input id="weight" type="number" min="0" step="0.1" name="weight" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Taille (cm)</label>
                    <input id="tall" type="number" min="0" name="tall" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">IMC (BMI)</label>
                    <input id="bmi" type="number" min="0" name="bmi" class="form-control" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Morphologie</label>
                    <select name="morphologie" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="Triangle">A -Triangle</option>
                        <option value="V">V -Pyramide Inversee</option>
                        <option value="Rectangle">H -Rectangle</option>
                        <option value="O">O -Ronde</option>
                        <option value="X">X -Sabilier</option>
                        <option value="8">8 -Huit</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Qualité de la peau</label>
                    <select name="peau" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="Élastique">Élastique</option>
                        <option value="Laxiste">Laxiste</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Accumulation de graisse</label>
                    <select name="graisse" class="form-select">
                        <option value="Viscérale">Viscérale</option>
                        <option value="Sous-cutanée">Sous-cutanée</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Zones de dépression</label>
                    <input type="text" name="zones" class="form-control">
                </div>
            </div>
        </div>

        <!-- Section 4: Examen mammaire -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">Examen mammaire</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Hypertrophie mammaire</label>
                    <select name="hypertrophie" class="form-select">
                        <option value="">-- Choisir --</option>
                        <option value="Grade 1">Grade 1  (legere)</option>
                        <option value="Grade 2">Grade 2 (Moderee)</option>
                        <option value="Grade 3">Grade 3 (Severe)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ptose mammaire</label>
                    <select name="ptose" class="form-select">
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Asymétrie mammaire</label>
                    <select name="asymetrie" class="form-select">
                        <option value="Aucune">Aucune</option>
                        <option value="Sein droit">Sein droit</option>
                        <option value="Sein gauche">Sein gauche</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkbox = document.getElementById("chirurgieGenerale");
        const detailsInput = document.getElementById("chirurgieGeneraleDetails");

        checkbox.addEventListener("change", function () {
            detailsInput.disabled = !this.checked;
            if (!this.checked) {
                detailsInput.value = "";
            }
        });

        const WeightInput = document.getElementById("weight");
        const tallInput = document.getElementById("tall");
        const bmiInput = document.getElementById("bmi");

        function calculateBMI() {
            const weight = parseFloat(WeightInput.value);
            const tailleCm = parseFloat(tallInput.value);
            // console.log('calculateBMI is working');

            if (weight > 0 && tailleCm > 0) {
                const tailleM = tailleCm / 100; // convert cm to meters
                const bmi = (weight / (tailleM * tailleM)).toFixed(2);
                bmiInput.value = bmi;
            } else {
                bmiInput.value = "";
            }
        }

        WeightInput.addEventListener("input", calculateBMI);
        tallInput.addEventListener("input", calculateBMI);
    });
    document.getElementById('cardID').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ""); // enlève tout sauf les chiffres
    let formattedValue = value.match(/.{1,4}/g);   // coupe tous les 4 chiffres
    if (formattedValue) {
        e.target.value = formattedValue.join("-"); // ajoute les tirets
    } else {
        e.target.value = "";
    }
});
</script>
@endsection
