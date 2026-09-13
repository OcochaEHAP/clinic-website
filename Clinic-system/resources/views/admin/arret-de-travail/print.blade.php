<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Certificat Médical — Arrêt de Travail</title>

<style>
    @page {
        size: A4;
        margin: 0;
    }

    * { box-sizing: border-box; }

    html, body { margin: 0; padding: 0; }

    body {
        background: #e9e9e9;
        font-family: Georgia, "Times New Roman", serif;
        color: #222;
    }

    .print-hint {
    font-family: Arial, sans-serif;
    font-size: 12px;
    color: #666;
    margin-right: auto;   /* push buttons to the right */
    align-self: center;
    }
    /* ---------- On-screen toolbar (hidden on print) ---------- */
    .toolbar {
        width: 210mm;
        margin: 16px auto 0;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        font-family: Arial, sans-serif;
    }

    .toolbar button,
    .toolbar a {
        padding: 9px 20px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        line-height: 1.2;
    }

    .toolbar button {
        background: #173e7c;
        color: #fff;
        border: none;
    }

    .toolbar a {
        background: #fff;
        color: #173e7c;
        border: 1px solid #173e7c;
    }

    /* ---------- A4 page ---------- */
    .page {
        width: 210mm;
        min-height: 297mm;
        margin: 16px auto;
        padding: 13mm 13mm 15mm;
        background: #fff;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .15);
    }

    /* ---------- Header (three columns) ---------- */
    .header {
        display: grid;
        grid-template-columns: 1fr 150px 1fr;
        align-items: start;
        min-height: 43mm;
        border-bottom: 1.2px solid #193f80;
        padding-bottom: 5mm;
    }

    .doctor  { text-align: left;  padding-top: 2mm; }
    .cabinet { text-align: right; padding-top: 2mm; }

    .doctor-name,
    .cabinet-title {
        color: #123b78;
        font-weight: 700;
        font-size: 21px;
    }

    .header-subtitle {
        font-size: 15px;
        margin-top: 4px;
    }

    .registration {
        font-size: 14px;
        margin-top: 8px;
    }

    .registration strong {
        color: #123b78;
        font-weight: 400;
    }

    .logo { text-align: center; }

    .logo img {
        width: 110px;
        height: auto;
        object-fit: contain;
        display: block;
        margin: 0 auto 2px;
    }

    .logo-name {
        font-size: 18px;
        letter-spacing: 2px;
        font-weight: 700;
    }

    .logo-doctor {
        font-size: 13px;
        font-style: italic;
        margin-top: 2px;
    }

    /* ---------- Title block ---------- */
    .title-block {
        text-align: center;
        margin-top: 7mm;
    }

    .title {
        margin: 0;
        color: #153e7d;
        font-size: 29px;
        letter-spacing: 2.5px;
        font-weight: 700;
    }

    .subtitle {
        display: inline-block;
        color: #a47c25;
        font-size: 17px;
        letter-spacing: 1.5px;
        margin-top: 2px;
        padding: 0 70px 5px;
        border-bottom: 1px solid #b08a38;
        position: relative;
    }

    .subtitle::after {
        content: "";
        position: absolute;
        width: 7px;
        height: 7px;
        background: #b08a38;
        transform: rotate(45deg);
        bottom: -4px;
        left: calc(50% - 3px);
    }

    /* ---------- Body ---------- */
    .content {
        margin: 13mm 12mm 0;
        font-size: 16px;
        line-height: 1.55;
    }

    .intro        { margin-bottom: 8px; }
    .patient-line { margin: 3px 0; }
    .paragraph    { margin: 12px 0; text-align: left; }

    .value {
        color: #173e7c;
        font-weight: 700;
    }

    /* ---------- Footer ---------- */
    .footer {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        align-items: end;
        margin-top: 25mm;
        min-height: 42mm;
    }

    .issued-date {
        align-self: start;
        padding-top: 3mm;
        font-size: 16px;
    }

    .signature {
        text-align: center;
        color: #173e7c;
    }

    .signature-name {
        font-size: 17px;
        font-weight: 700;
    }

    .signature-title {
        color: #222;
        font-size: 14px;
        margin-top: 2px;
    }

    .signature-reg {
        color: #222;
        font-size: 13px;
        margin-top: 3px;
    }

    .signature-space { height: 15mm; }

    .stamp { text-align: center; }

    .stamp-box {
        display: inline-flex;
        min-width: 48mm;
        min-height: 24mm;
        border: 2px solid #173e7c;
        border-radius: 4px;
        align-items: center;
        justify-content: center;
        padding: 4mm;
        color: #173e7c;
        font-family: Arial, sans-serif;
        font-size: 11px;
        line-height: 1.4;
        font-weight: 700;
    }

    /* ---------- Print rules ---------- */
    @media print {
        body    { background: #fff; }
        .toolbar { display: none !important; }

        .page {
            margin: 0;
            box-shadow: none;
        }
    }
</style>
</head>

<body>

<div class="toolbar">
    <a href="{{ route('arret-de-travail.create') }}">← Retour</a>
    <button type="button" onclick="window.print()">Télécharger / Imprimer</button>
    <span class="print-hint">
    Astuce : choisissez « Enregistrer au format PDF » dans la fenêtre d’impression.
</span>
</div>

<div class="page">

    {{-- ============ HEADER ============ --}}
    <header class="header">

        <div class="doctor">
            <div class="doctor-name">Dr AKKOUCHE Lamia</div>
            <div class="header-subtitle">Chirurgien Général</div>
            <div class="registration">
                N° d’enregistrement : <strong>16.22695</strong>
            </div>
        </div>

        <div class="logo">
            <img src="{{ asset('images/khalil-clinic-logo.png') }}" alt="Khalil Clinic">
            <div class="logo-name">KHALIL CLINIC</div>
            <div class="logo-doctor">Dr Akkouche Lamia</div>
        </div>

        <div class="cabinet">
            <div class="cabinet-title">Cabinet de Chirurgie</div>
            <div class="header-subtitle">Sur rendez-vous uniquement</div>
            <div class="registration">
                Tél : <strong>0662 77 09 67</strong>
            </div>
        </div>

    </header>

    {{-- ============ TITLE ============ --}}
    <section class="title-block">
        <h1 class="title">CERTIFICAT MÉDICAL</h1>
        <div class="subtitle">ARRÊT DE TRAVAIL</div>
    </section>

    {{-- ============ BODY ============ --}}
    <main class="content">

        <div class="intro">
            Je soussignée, Dr Akkouche Lamia, certifie que :
        </div>

        <div class="patient-line">
            Nom et prénom : <span class="value">{{ $patientName }}</span>
        </div>

        <div class="patient-line">
            Âge : <span class="value">{{ $patientAge }} ans</span>
        </div>

        <p class="paragraph">
            La patiente est programmée pour une intervention chirurgicale
            le <span class="value">{{ $interventionDate }}</span>.
        </p>

        <p class="paragraph">
            En raison de cette intervention chirurgicale et des suites
            postopératoires qu’elle implique, son état de santé nécessite
            un arrêt de travail de
            <span class="value">{{ $durationInWords }} ({{ $duration }}) jours</span>,
            à compter du <span class="value">{{ $startDate }}</span>
            jusqu’au <span class="value">{{ $endDate }}</span> inclus.
        </p>

        <p class="paragraph">
            Le présent certificat est délivré à l’intéressée pour servir
            et valoir ce que de droit.
        </p>

    </main>

    {{-- ============ FOOTER ============ --}}
    <footer class="footer">

        <div class="issued-date">
            Fait le : <span class="value">{{ $issuedDate }}</span>
        </div>

        <div class="signature">
            <div class="signature-name">Dr Akkouche Lamia</div>
            <div class="signature-title">Chirurgien Général</div>
            <div class="signature-reg">N° d’enregistrement : 16.22695</div>
            <div class="signature-space"></div>
        </div>

        <div class="stamp">
            <div class="stamp-box">
                <div>
                    Dr AKKOUCHE Lamia<br>
                    <span style="font-weight:400">Chirurgien Général</span><br>
                    <span style="font-weight:400">N° d’enregistrement : 16.22695</span>
                </div>
            </div>
        </div>

    </footer>

</div>

</body>
</html>
