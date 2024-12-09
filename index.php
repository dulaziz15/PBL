<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIBETA - Sistem Informasi Bebas Tanggungan</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
    <link rel="stylesheet" href="src/css/style.css" />
    <script defer src="scripts.js"></script>
  </head>
  <body>
    <header>
      <div class="container">
        <nav class="navbar">
          <div class="logo">
            <img
              src="src/images/logo.png"
              alt="Politeknik Negeri Malang Logo"
              width="356"
              height="74"
            />
          </div>
          <ul>
            <li>
              <a href="javascript:void(0);" onclick="scrollToSection('hero')"
                >Home</a
              >
            </li>
            <li>
              <a href="javascript:void(0);" onclick="scrollToSection('alur')"
                >Alur Bebas Tanggungan</a
              >
            </li>
            <li>
              <a href="javascript:void(0);" onclick="scrollToSection('contact')"
                >Kontak</a
              >
            </li>
          </ul>
          <a class="login-btn" href="View/login.php">Login</a>
        </nav>
      </div>
    </header>

    <main>
      <div class="hero" id="hero">
        <div class="hero-image">
          <img
            src="src/images/poltek2.png"
            alt="Gedung Politeknik Negeri Malang"
            width="1200"
            height="600"
          />
          <div class="overlay"></div>
        </div>
        <div class="hero-text">
          <h1><span>SI</span>BETA</h1>
          <h2>SISTEM INFORMASI</h2>
          <h2>BEBAS TANGGUNGAN</h2>
          <p>Sistem untuk menyelesaikan Bebas Tanggungan Tugas Akhir</p>
          <p>Jurusan Teknologi Informasi</p>
          <p>Politeknik Negeri Malang</p>
          <a class="login-btn2" href="../View/login.php">Login</a>
        </div>
      </div>

      <section class="alur" id="alur">
        <div class="alur-image">
          <img
            src="src/images/alurbebastanggungan.png"
            alt="Alur Bebas Tanggungan"
            style="width: 60%; height: auto"
          />
        </div>
      </section>
    </main>

    <footer>
      <div class="container" id="contact">
        <div class="logo2">
          <img
            src="src/images/logo2.png"
            alt="Logo Polinema"
            style="width: 100%; height: auto"
          />
        </div>
        <div class="info">
          <h3><strong>INFO</strong></h3>
          <p>Polinema</p>
          <p>Webmail</p>
          <p>Siakad</p>
        </div>
        <div class="contact">
          <h3><strong>CONTACT US</strong></h3>
          <p>JL. Soekarno Hatta No. 9 Malang</p>
          <p>Phone: (0341) 404424, 404425</p>
          <p>Email: lmspolinema@polinema.ac.id</p>
        </div>
        <div class="social">
          <h3><strong>GET SOCIAL</strong></h3>
          <a href="https://x.com/polinema_campus"
            ><img
              src="src/images/icon/twit.png"
              alt="Twitter"
              width="24"
              height="24"
          /></a>
          <a href="https://www.instagram.com/polinema_campus/?hl=en"
            ><img
              src="src/images/icon/ig.png"
              alt="Instagram"
              width="24"
              height="24"
          /></a>
          <a href="https://www.facebook.com/polinema/?locale=id_ID"
            ><img
              src="src/images/icon/fb.png"
              alt="Facebook"
              width="24"
              height="24"
          /></a>
          <a href="mailto:cs@polinema.ac.id"
            ><img
              src="src/images/icon/gmail.png"
              alt="Gmail"
              width="24"
              height="24"
          /></a>
        </div>
      </div>
    </footer>

    <script>
      function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
          section.scrollIntoView({ behavior: "smooth" });
        }
      }
    </script>
  </body>
</html>
