<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
      <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <title>Rendez-vous enregistré </title>
</head>
<body>
    <style>
        body {
            width: 100%;
            height:  100vh;
	font-family: "DM Sans", sans-serif;
    	background: linear-gradient(
		90deg,
		rgba(230, 242, 255, 1) 0%,
		rgba(247, 247, 247, 1) 50%,
		rgba(0, 119, 204, 0.52) 100%
	);
    display: flex;
    justify-content: center;
    align-items: center;
    }
    h2,p{
        text-align: center;
        color:#003366;
    }
    button {
          padding: 1.5rem;
  border-radius: 0.4rem;
  display: block;
  margin: 2rem auto;
  font-weight: bold;
  color: #ffffff;
  background-color: #0077cc;
  outline: none;
  border: none;
  cursor: pointer;
    }
    a { color: #ffffff}
    </style>
<div class="confirmation">
    <h2>Merci pour votre confiance </h2>
    <p>Votre rendez-vous a été enregistré avec succès.</p>
    <p>Nous vous contacterons bientôt pour confirmer la date et l'heure.</p>
    <button>
    <a href="{{ url('/') }}" class="btn btn-primary">Retour à l’accueil</a>
    </button>
</div>
</body>
</html>
