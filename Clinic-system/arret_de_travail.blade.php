<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificat Médical — Arrêt de Travail</title>

<style>
    @page {
        size: A4;
        margin: 0;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #eee;
        font-family: Georgia, "Times New Roman", serif;
        color: #222;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        margin: 20px auto;
        padding: 13mm 13mm 15mm;
        background: #fff;
    }

    /* Header */
    .header {
        display: grid;
        grid-template-columns: 1fr 150px 1fr;
        align-items: start;
        min-height: 43mm;
        border-bottom: 1.2px solid #193f80;
        padding-bottom: 5mm;
    }

    .doctor,
    .cabinet {
        padding-top: 2mm;
    }

    .doctor {
        text-align: left;
    }

    .cabinet {
        text-align: right;
    }

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

    .logo {
        text-align: center;
    }

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

    /* Title */
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

    /* Content */
    .content {
        margin: 13mm 12mm 0;
        font-size: 16px;
        line-height: 1.55;
    }

    .intro {
        margin-bottom: 8px;
    }

    .patient-line {
        margin: 3px 0;
    }

    .label {
        font-weight: 400;
    }

    .value {
        color: #173e7c;
        font-weight: 700;
    }

    .paragraph {
        margin: 12px 0;
        text-align: left;
    }

    /* Footer */
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

    .signature-space {
        height: 15mm;
    }

    .stamp {
        text-align: center;
    }

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

    /* Screen-only form helper */
    .form-panel {
        width: 210mm;
        margin: 20px auto 0;
        padding: 20px;
        background: #fff;
        font-family: Arial, sans-serif;
        border-radius: 8px;
    }

    .form-panel h2 {
        margin-top: 0;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .form-field label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .form-field input {
        width: 100%;
        padding: 9px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    @media print {
        body {
            background: #fff;
        }

        .page {
            margin: 0;
            box-shadow: none;
        }

        .form-panel {
            display: none;
        }
    }
</style>
</head>

<body>

<!--
    Laravel variables expected:
    $patientName
    $patientAge
    $interventionDate
    $duration
    $durationInWords
    $startDate
    $endDate
    $issuedDate

    Doctor/clinic information can remain fixed or be converted to variables later.
-->

<div class="page">

    <header class="header">

        <div class="doctor">
            <div class="doctor-name">Dr AKKOUCHE Lamia</div>
            <div class="header-subtitle">Chirurgien Général</div>
            <div class="registration">
                N° d’enregistrement :
                <strong>16.22695</strong>
            </div>
        </div>

        <div class="logo">
            <img src="{{ asset('images/khalil-clinic-logo-crop.png') }}" alt="Khalil Clinic">
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

    <section class="title-block">
        <h1 class="title">CERTIFICAT MÉDICAL</h1>
        <div class="subtitle">ARRÊT DE TRAVAIL</div>
    </section>

    <main class="content">

        <div class="intro">
            Je soussignée, Dr Akkouche Lamia, certifie que :
        </div>

        <div class="patient-line">
            Nom et prénom :
            <span class="value">{{ $patientName }}</span>
        </div>

        <div class="patient-line">
            Âge :
            <span class="value">{{ $patientAge }} ans</span>
        </div>

        <p class="paragraph">
            La patiente est programmée pour une intervention chirurgicale
            le <span class="value">{{ $interventionDate }}</span>.
        </p>

        <p class="paragraph">
            En raison de cette intervention chirurgicale et des suites
            postopératoires qu’elle implique, son état de santé nécessite
            un arrêt de travail de
            <span class="value">{{ $duration }} ({{ $durationInWords }}) jours</span>,
            à compter du <span class="value">{{ $startDate }}</span>
            jusqu’au <span class="value">{{ $endDate }}</span> inclus.
        </p>

        <p class="paragraph">
            Le présent certificat est délivré à l’intéressée pour servir
            et valoir ce que de droit.
        </p>

    </main>

    <footer class="footer">

        <div class="issued-date">
            Fait le :
            <span class="value">{{ $issuedDate }}</span>
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
