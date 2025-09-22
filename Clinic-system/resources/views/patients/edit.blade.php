@extends('layouts.admin')
@section('title','modifier le patient')
@section('content')
<div class="container">
    <h2 class="mb-4">Modifier Dossier Patient</h2>

    <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')

        <!-- Section 1: Infos Patient -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Informations du patient</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="first_name" class="form-control"
                           value="{{ old('first_name', $patient->first_name) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom</label>
                    <input type="text" name="last_name" class="form-control"
                           value="{{ old('last_name', $patient->last_name) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Âge</label>
                    <input type="number" name="age" min="0" class="form-control"
                           value="{{ old('age', $patient->age) }}">
                </div>
                <div class="col-md-9">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="address" class="form-control"
                           value="{{ old('address', $patient->address) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $patient->phone) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">N° Carte Nationale</label>
                    <input type="text" maxlength="22" name="card_number" id="cardID" class="form-control"
                           value="{{ old('card_number', $patient->card_number) }}">
                </div>
            </div>
        </div>

        <!-- Section 2: Intervention Prévue -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Type d’intervention prévue</div>
            <div class="card-body row g-3">

                @php
                    $selectedInterventions = is_array($patient->interventions)
                        ? $patient->interventions
                        : json_decode($patient->interventions, true);

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

                <div class="col-md-6">
                    <label class="form-label fw-bold">Chirurgie Esthétique</label>
                    @foreach($chirurgies as $c)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interventions[]" value="{{ $c }}"
                                {{ in_array($c, $selectedInterventions ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $c }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Esthétique sans chirurgie</label>

                    @foreach(['Filler / Botox','Hydrafacial','Épilation laser','HIFU visage','HIFU vaginal','Drainage','Consultation'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interventions[]" value="{{ $option }}"
                                {{ in_array($option, $selectedInterventions ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Chirurgie générale</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="chirurgieGenerale"
                               name="chirurgie_generale"
                               value="1"
                               {{ $patient->chirurgie_generale ? 'checked' : '' }}>
                        <label class="form-check-label" for="chirurgieGenerale">
                            Oui, le patient a subi une chirurgie générale
                        </label>
                    </div>

                    <input type="text" class="form-control" id="chirurgieGeneraleDetails"
                           name="chirurgie_generale"
                           placeholder="Préciser le type de chirurgie"
                           value="{{ old('chirurgie_generale', $patient->chirurgie_generale) }}">
                </div>
            </div>
        </div>

        <!-- Section 3: Antécédents Chirurgicaux -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Antécédents Chirurgicaux</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="operations_precedentes" class="form-label">Opérations précédentes</label>
                    <textarea name="operations_precedentes" id="operations_precedentes"
                              class="form-control" rows="2">{{ old('operations_precedentes', $patient->operations_precedentes) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="complications" class="form-label">Complications</label>
                    <textarea name="complications" id="complications"
                              class="form-control" rows="2">{{ old('complications', $patient->complications) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 4: Habitudes -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Habitudes</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="tabac" class="form-label">Tabac</label>
                    <select name="tabac" id="tabac" class="form-select">
                        <option value="non" {{ old('tabac', $patient->tabac) == 'non' ? 'selected' : '' }}>Non</option>
                        <option value="oui" {{ old('tabac', $patient->tabac) == 'oui' ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alcool" class="form-label">Alcool</label>
                    <select name="alcool" id="alcool" class="form-select">
                        <option value="non" {{ old('alcool', $patient->alcool) == 'non' ? 'selected' : '' }}>Non</option>
                        <option value="oui" {{ old('alcool', $patient->alcool) == 'oui' ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="autres_habitudes" class="form-label">Autres habitudes</label>
                    <input type="text" name="autres_habitudes" id="autres_habitudes"
                           class="form-control"
                           value="{{ old('autres_habitudes', $patient->autres_habitudes) }}">
                </div>
            </div>
        </div>

        <!-- Section 5: Examen Clinique -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Examen clinique</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label class="form-label">Poids (kg)</label>
                    <input id="weight" type="number" min="0" step="0.1" name="weight" class="form-control"
                           value="{{ old('weight', $patient->weight) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Taille (cm)</label>
                    <input id="tall" type="number" min="0" name="tall" class="form-control"
                           value="{{ old('tall', $patient->tall) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">IMC (BMI)</label>
                    <input id="bmi" type="number" min="0" name="bmi" class="form-control"
                           value="{{ old('bmi', $patient->bmi) }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Morphologie</label>
                    <select name="morphologie" class="form-select">
                        @foreach(['Triangle'=>'A -Triangle','V'=>'V -Pyramide Inversee','Rectangle'=>'H -Rectangle','O'=>'O -Ronde','X'=>'X -Sabilier','8'=>'8 -Huit'] as $val => $label)
                            <option value="{{ $val }}" {{ old('morphologie', $patient->morphologie) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Qualité de la peau</label>
                    <select name="peau" class="form-select">
                        @foreach(['Élastique','Laxiste','Autre'] as $opt)
                            <option value="{{ $opt }}" {{ old('peau', $patient->peau) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Accumulation de graisse</label>
                    <select name="graisse" class="form-select">
                        @foreach(['Viscérale','Sous-cutanée'] as $opt)
                            <option value="{{ $opt }}" {{ old('graisse', $patient->graisse) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Zones de dépression</label>
                    <input type="text" name="zones" class="form-control"
                           value="{{ old('zones', $patient->zones) }}">
                </div>
            </div>
        </div>

        <!-- Section 6: Examen mammaire -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">Examen mammaire</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Hypertrophie mammaire</label>
                    <select name="hypertrophie" class="form-select">
                        @foreach(['Grade 1'=>'Grade 1 (légère)','Grade 2'=>'Grade 2 (Modérée)','Grade 3'=>'Grade 3 (Sévère)'] as $val => $label)
                            <option value="{{ $val }}" {{ old('hypertrophie', $patient->hypertrophie) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ptose mammaire</label>
                    <select name="ptose" class="form-select">
                        @foreach(['Oui','Non'] as $opt)
                            <option value="{{ $opt }}" {{ old('ptose', $patient->ptose) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Asymétrie mammaire</label>
                    <select name="asymetrie" class="form-select">
                        @foreach(['Aucune','Sein droit','Sein gauche'] as $opt)
                            <option value="{{ $opt }}" {{ old('asymetrie', $patient->asymetrie) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary ms-2">Annuler</a>
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
