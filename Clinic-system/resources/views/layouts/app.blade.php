<!DOCTYPE html>
<html lang="en">
<head>
    @yield('styles')

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <title>@yield('title','Khalil Clinique')</title>
</head>
<body>
    <style>
body {
  background: linear-gradient(90deg, rgb(230, 242, 255) 0%, rgb(247, 247, 247) 50%, rgba(0, 119, 204, 0.52) 100%);
  font-family: "DM Sans", sans-serif !important;

}
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 80px;
  background-color: #ffffff;
  color: #003366;
  background-color: transparent;
}
header a {
  font-size: 16px;
  color: #003366;
  padding: 1.5rem;
  transition-duration: 0.4ms;
}
header a:hover {
  color: #0077cc;
}
header a:last-child {
  background-color: #0077cc;
  color: #ffffff;
  border-radius: 0.4rem;
}
header .hamburger {
  display: none;
  cursor: pointer;
}
header .hamburger span {
  display: block;
  width: 25px;
  height: 5px;
  background-color: #003366;
  margin: 5px auto;
  transition: all 0.4ms ease;
  border-radius: 15%;
}
@media (max-width: 1067px) {
  .hamburger {
    display: block !important;
  }
  .hamburger.active span:nth-child(2) {
    opacity: 0;
  }
  .hamburger.active span:nth-child(1) {
    transform: translateY(10px) rotate(45deg);
  }
  .hamburger.active span:nth-child(3) {
    transform: translateY(-10px) rotate(-45deg);
  }
  .nav-links {
    z-index: 999;
    position: fixed;
    left: -100%;
    top: 70px;
    gap: 5px;
    display: flex;
    flex-direction: column;
    background-color: #ffffff;
    color: #003366;
    text-align: center;
    transition: 0.4ms;
    height: 100vh;
    width: 100%;
    max-width: 450px;
  }
  .nav-links a#contact-btn {
    background-color: #ffffff;
    color: #003366;
  }
  .nav-links a#contact-btn:hover {
    color: #0077cc;
  }
  .nav-links.active {
    left: 0;
  }
}/*# sourceMappingURL=style.css.map */

    </style>
<div class="container">
    <header>
        <a href="/"><h2>Khalil Clinique</h2></a>
      <div class="nav-links" style="transition-duration: .4s;">
        <a href="/#doctor">Docteur</a>
        <a href="/#services">Services</a>
        <a href="{{route('gallery')}}">Gallery</a>
        <a href="/#adress">localisaton</a>
        <a href="/#contact" id="contact-btn">Contactez-Nous</a>
      </div>
      <div class="hamburger" style="transition-duration: .4s;">
        <span style="transition-duration: .4s;"></span><span style="transition-duration: .4s;"></span><span style="transition-duration: .4s;"></span>
      </div>
    </header>
</div>

@yield('content')

<script>
          const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
      document.querySelectorAll('.nav-links a').forEach(link => link.addEventListener('click', () => {
                  hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
      }));

        hamburger.addEventListener('click', () => {
          hamburger.classList.toggle('active');
          navLinks.classList.toggle('active');
        });
</script>
</body>
</html>
