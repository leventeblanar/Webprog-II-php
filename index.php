<?php
include_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Mindentudás Egyeteme</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">


<?php include 'header.php'; ?> <!-- Fejléc beillesztése -->

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>A tudomány mindenkié</h1>
            <p>A Mindentudás Egyeteme egy 2002. szeptember 16-án elindult ismeretterjesztő vállalkozás. A 10. szemeszter befejezése után három évvel, 2011. január 15-én Mindentudás Egyeteme 2.0 néven folytatódott a népszerű sorozat.</p>
            <div class="d-flex">
              <a href="#about" class="btn-get-started">Tudj meg többet</a>
              <a href="https://www.youtube.com/watch?v=5gzBparGnX4&list=PL8sMmWbSuCoNT_d5FcOj5JFKSdwOa_2YE" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Lejátszási listánk</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/eloadas1.jpg" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Rólunk</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
              A francia Yves Michaud műtörténész, médiakutató 1998-ban hozta létre a l'Université de tous les savoirs című programot. A vállalkozásnak nagy sikere volt. Eszmeiségében a felvilágosodáskori francia nagy Enciklopédiához kapcsolódott: "hogyan lehetne áttekinteni és az érdeklődő közönség számára is hozzáférhetővé tenni korunk legmagasabb szintű tudományos ismereteit, a kortárs tudomány legfőbb dilemmáit?"[1]
            </p>
            <ul>
              <p>Alapítók</p>
              <li><i class="bi bi-check2-circle"></i> <span>Magyar Tudományos Akadémia</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Matáv, Axelero-Internet</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Duna TV</span></li>
            </ul>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p>A tudományos élet hazai kiválóságai mellett előadást tartottak külföldön tevékenykedő magyar tudósok. Két alkalommal külföldi előadót hallhattak az érdeklődők. Előadást tartottak a történelmi egyházak vezető személyiségei: Erdő Péter, Gáncs Péter, Schweitzer József és Szabó István. A művészvilágot Esterházy Péter, Spiró György és Vásáry Tamás előadásai reprezentálták.

              A fő programokat kiegészítették nyilvános klubfoglalkozások, ahol egyes témák szakemberei cserélhették ki – sokszor eltérő – véleményüket.
              
              Az előadások moderátorai a Duna Televízió és az MTV bemondói voltak. Egy-egy szemeszterben kommunikációs szakember, illetve Fábri György is ellátta ezt a feladatot. </p>
            <a target="_blank" href="https://hu.wikipedia.org/wiki/Mindentud%C3%A1s_Egyeteme" class="read-more"><span>Tudj meg többet</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="section why-us light-background" data-builder="section">

      <div class="container-fluid">

        <div class="row gy-4">

          <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

            <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
              <h3><span>Nézzen körül </span><strong>a jelelegi programkínálatunkban</strong></h3>
              <p>
                Hétről hétre frissülő előadáslistánkat az alábbi linkeken tudja megtekinteni. 
              </p>
            </div>

            <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

              <div class="faq-item faq-active">

                <h3><span>01</span> Előadások</h3>
                <div class="faq-content">
                  <p>Merüljön el a tudomány izgalmas világában a Mindentudás Egyeteme által szervezett előadásokon! Neves kutatók, szakértők és oktatók osztják meg legfrissebb felfedezéseiket és gondolataikat közérthető és lebilincselő módon. Legyen szó természettudományokról, társadalomtudományokról vagy technológiai újdonságokról, itt garantáltan új ismeretekkel és inspirációval gazdagodik.</p>
                  <a href="eloadasok.php">Előadás lista</a>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>02</span> Tudósok</h3>
                <div class="faq-content">
                  <p>A Mindentudás Egyetemének tudósai a tudományos világ kiemelkedő alakjai, akik szenvedéllyel, elhivatottsággal és mély szakértelemmel osztják meg tudásukat. Megismerve munkásságukat, nemcsak a legújabb kutatási eredményekről kaphat átfogó képet, hanem bepillantást nyerhet abba is, milyen inspiráló emberek állnak a tudomány csodálatos felfedezései mögött. Ismerje meg azokat, akik a jövő tudását formálják!</p>
                  <a href="tudosok.php">Tudósaink</a>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>03</span> PDF kivonatkészítő</h3>
                <div class="faq-content">
                  <p>Készítsen pillanatok alatt letölthető PDF formátumú kivonatokat a Mindentudás Egyetemének előadásairól és tudósairól! Az eszköz egyszerűen használható, és egyetlen kattintással átlátható listát generál az összes programról és előadóról, így könnyedén megtervezheti, mely eseményeket szeretné követni, vagy mely tudósok munkásságával kíván részletesebben megismerkedni.</p>
                  <a href="pdf.php">PDF kivonat készítő</a>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

          <div class="col-lg-5 order-1 order-lg-2 why-us-img">
            <img src="assets/img/neni1.jpg" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>

      </div>

    </section><!-- /Why Us Section -->



    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tudományterületek</h2>
        <p>Ismerje meg, milyen sokféle tudományterületet ölelnek fel előadásaink, és fedezze fel a tudás végtelen dimenzióit a természettudományoktól a műszaki tudományokig!</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-activity icon"></i></div>
              <h4><a href="" class="stretched-link">Természettudományok</a></h4>
              <p>Fedezze fel az univerzum törvényeit, a természet rejtelmeit és a legújabb tudományos felfedezéseket a fizika, kémia, biológia és más természettudományok világában!</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
              <h4><a href="" class="stretched-link">Bölcsésztudományok</a></h4>
              <p>Merüljön el az emberi kultúra, történelem, nyelv és művészet gazdagságában, amely megvilágítja a múltat és irányt mutat a jövő számára!</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
              <h4><a href="" class="stretched-link">Társadalomtudományok</a></h4>
              <p>Ismerje meg, hogyan működik a társadalom, milyen hatások formálják közösségeinket, és hogyan hozhatunk fenntartható változásokat a világban!</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-broadcast icon"></i></div>
              <h4><a href="" class="stretched-link">Műszaki tudományok</a></h4>
              <p>Lépjen be az innováció és technológiai fejlődés izgalmas világába, ahol az ötletek találkoznak a mérnöki precizitással és a jövő megoldásaival!</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Tudósok</li>
            <li data-filter=".filter-product">Előadás</li>
            <li data-filter=".filter-branding">Egyéb</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/eloadas2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Előadás</h4>
                <p>Előadás terem</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/bacsi1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Tudós 1</h4>
                <p>Kovács János</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/bacsi2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Tudós 2</h4>
                <p>Tátrai Béla</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-3.jpg" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/bacsi3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Tudós 3</h4>
                <p>Antal Árpád</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-4.jpg" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/eloadas1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Előadás 2</h4>
                <p>Előadás terem 2</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-5.jpg" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/eloadas4.JPG" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Előadás 3</h4>
                <p>Előadás terem</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-6.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/bacsi4.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Tudós 4</h4>
                <p>Köntös Zoltán</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-7.jpg" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/neni2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Tudós nő 2</h4>
                <p>Kollár Erzsébet</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-8.jpg" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/bacsi5.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Tudós 5</h4>
                <p>James Watson</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-9.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Faq 2 Section -->
    <section id="faq-2" class="faq-2 section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gyakran feltett kérdések</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10">

            <div class="faq-container">

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Hogyan tudok jelentkezni az előadásokra?</h3>
                <div class="faq-content">
                  <p>Az előadásokra a weboldalunkon keresztül tud regisztrálni. Kattintson a kiválasztott esemény mellett található „Regisztráció” gombra, és kövesse az utasításokat.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Az előadások online is elérhetők?</h3>
                <div class="faq-content">
                  <p>Igen, az előadások többsége élőben követhető online, és bizonyos események felvételeit később is megtekintheti a weboldalunkon.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Van-e belépődíj az előadásokra?</h3>
                <div class="faq-content">
                  <p>Az előadások többsége ingyenesen látogatható, azonban egyes kiemelt események esetében előfordulhat belépődíj. Erről az adott előadás információs oldalán talál részleteket.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Milyen tudományos szintet képviselnek az előadások?</h3>
                <div class="faq-content">
                  <p>Az előadásokat úgy terveztük, hogy közérthetőek legyenek minden érdeklődő számára, de a mélyebb tudományos érdeklődésű résztvevők számára is értékes információkat nyújtsanak.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Hol találom meg az előadások és tudósok listáját?</h3>
                <div class="faq-content">
                  <p>Az összes előadás és az előadó tudósok listája elérhető a weboldalunkon. Ezenkívül lehetősége van PDF kivonatok letöltésére is, amelyben rendszerezett formában találja meg a szükséges információkat.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Faq 2 Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kapcsolat</h2>
        <p>Írjon nekünk, vagy látogasson meg minket</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Cím</h3>
                  <p>1107 Budapest, Kékvirág u. 1-3.</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Telefonszám</h3>
                  <p>+36-1-431-1731</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email</h3>
                  <p>info@mindentudas.hu</p>
                </div>
              </div><!-- End Info Item -->

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-7">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Név</label>
                  <input type="text" name="name" id="name-field" class="form-control" required="">
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Tárgy</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Üzenet</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Kis türelemet</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Üzenete elküldve. Köszönjük!</div>

                  <button type="submit">Üzenet küldése</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <?php include 'footer.php'; ?>

</body>
</html>