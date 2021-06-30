<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="<?= $about->logo ?>" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/template') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/template') ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/template') ?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/template') ?>/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/template') ?>/assets/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="<?= base_url('assets/template') ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/template') ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/template') ?>/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eBusiness - v2.2.1
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <!-- <h1 class="text-light"><a href="index.html"><?= $about->logo ?></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.html"><img src="<?= $about->logo ?>" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#header">Home</a></li>
          <li><a href="#services">Kegiatan</a></li>
          <li><a href="#team">Pengurus</a></li>
          <li><a href="#blog">Berita</a></li>
          <li><a href="#contact">Hubungi Kami</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Slider Section ======= -->
  <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <?php foreach ($banner as $key => $item) { ?>
          <img src="<?= $item->image ?>" alt="" title="#slider-direction-<?= $key + 1 ?>" />
        <?php } ?>
      </div>


      <!-- direction -->

      <?php foreach ($banner as $key => $item) { ?>
        <div id="slider-direction-<?= $key + 1 ?>" class="slider-direction slider-one">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="slider-content">
                  <!-- layer 1 -->
                  <div class="layer-1-1 hidden-xs wow animate__slideInDown animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                    <h2 class="title1"><?= $item->title ?> </h2>
                  </div>
                  <!-- layer 2 -->
                  <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                    <h1 class="title2"><?= $item->tag_line ?></h1>
                  </div>
                  <!-- layer 3 -->
                  <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                    <a class="ready-btn right-btn page-scroll" href="#services">Kegiatan</a>
                    <a class="ready-btn page-scroll" href="#contact">Hubungi Kami</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div><!-- End Slider -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <div id="services" class="services-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center">
              <h2>Kegiatan</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <!-- Start Left services -->
          <?php foreach ($kegiatan as $key => $item) { ?>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="about-move">
                <div class="services-details">
                  <div class="single-services">
                    <a class="services-icon" href="#">
                      <i class="fa <?= $item->icon ?>"></i>
                    </a>
                    <h4><?= $item->name ?></h4>
                    <p>
                      <?= $item->desc ?>
                    </p>
                  </div>
                </div>
                <!-- end about-details -->
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div><!-- End Services Section -->

    <!-- ======= Skills Section ======= -->
    <div class="our-skill-area fix hidden-sm">
      <div class="test-overly"></div>
      <div class="skill-bg area-padding-2">
        <div class="container">
          <!-- section-heading end -->
          <div class="row">
            <!-- single-skill start -->
            <div class="col-xs-12 col-sm-3 col-md-3 text-center">
              <div class="single-skill">
                <div class="progress-circular">
                  <div class="progress-content">
                    <span>
                      <?= number_format($infaq->saldo) ?>
                    </span>
                  </div>
                  <h3 class="progress-h4">Infaq</h3>
                </div>
              </div>
            </div>
            <!-- single-skill end -->
            <!-- single-skill start -->
            <div class="col-xs-12 col-sm-3 col-md-3 text-center">
              <div class="single-skill">
                <div class="progress-circular">
                  <div class="progress-content">
                    <span>
                      <?= number_format($zakat_mal->saldo) ?>
                    </span>
                  </div>
                  <h3 class="progress-h4">Zakat Mal</h3>
                </div>
              </div>
            </div>
            <!-- single-skill end -->
            <!-- single-skill start -->
            <div class="col-xs-12 col-sm-3 col-md-3 text-center">
              <div class="single-skill">
                <div class="progress-circular">
                  <div class="progress-content">
                    <span>
                      <?= number_format($zakat_fitrah->saldo) ?>
                    </span>
                  </div>
                  <h3 class="progress-h4">Zakat Fitrah</h3>
                </div>
              </div>
            </div>
            <!-- single-skill end -->
            <!-- single-skill start -->
            <div class="col-xs-12 col-sm-3 col-md-3 text-center">
              <div class="single-skill">
                <div class="progress-circular">
                  <div class="progress-content">
                    <span>
                      <?= number_format($kas->saldo) ?>
                    </span>
                  </div>
                  <h3 class="progress-h4">Kas</h3>
                </div>
              </div>
            </div>
            <!-- single-skill end -->
          </div>
        </div>
      </div>
    </div><!-- End Skills Section -->

    <!-- ======= Team Section ======= -->
    <div id="team" class="our-team-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Pengurus</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <?php foreach ($pengurus as $key => $item) { ?>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="single-team-member">
                <div class="team-img">
                  <a href="#">
                    <img src="<?= $item->picture ?>" alt="">
                  </a>
                </div>
                <div class="team-content text-center">
                  <h4><?= $item->name ?></h4>
                  <p><?= $item->profession ?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div><!-- End Team Section -->

    <!-- ======= Testimonials Section ======= -->
    <div class="testimonials-area">
      <div class="testi-inner area-padding">
        <div class="testi-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <!-- Start testimonials Start -->
              <div class="testimonial-content text-center">
                <h3 class="text-white">Jadwal Solat <span id="now"></span></h3>
                <table class="table text-white">
                  <thead>
                    <tr>
                      <th>Subuh</th>
                      <th>Dzuhur</th>
                      <th>Ashar</th>
                      <th>Magrib</th>
                      <th>Isya</th>
                    </tr>
                  </thead>
                  <tbody id="jadwal-solat">

                  </tbody>
                </table>
                <!-- start testimonial carousel -->
                
              </div>
              <!-- End testimonials end -->
            </div>
            <!-- End Right Feature -->
          </div>
        </div>
      </div>
    </div><!-- End Testimonials Section -->

    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="blog-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Berita Terbaru</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start Left Blog -->
            <?php foreach ($berita as $key => $item) { ?>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="single-blog">
                  <div class="single-blog-img">
                    <a href="blog.html">
                      <img src="<?= $item->image ?>" alt="">
                    </a>
                  </div>
                  <div class="blog-meta">
                    <span class="date-type">
                      <i class="fa fa-calendar"></i> <?= date('Y-m-d / H:i:s', strtotime($item->posted_date)) ?>
                    </span>
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href="blog.html"><?= $item->name ?></a>
                    </h4>
                    <p>
                      <?= $item->desc ?>
                    </p>
                  </div>
                </div>
                <!-- Start single blog -->
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div><!-- End Blog Section -->

    <!-- ======= Suscribe Section ======= -->
    <div class="suscribe-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
            <div class="suscribe-text text-center">
              <h3>Selamat datang di <?= $about->name ?></h3>
              <a class="sus-btn" href="#contact">Contact</a>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Suscribe Section -->

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Hubungi Kami</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-mobile"></i>
                  <p>
                    Call: <?= $about->phone ?>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-envelope-o"></i>
                  <p>
                    Email: <?= $about->email ?>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-map-marker"></i>
                  <p>
                    Alamat: <?= $about->address ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- Start Google Map -->
            <div class="col-md-12">
              <!-- Start Map -->
              <iframe src="<?= $about->map ?>" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
              <!-- End Map -->
            </div>
            <!-- End Google Map -->
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="footer-content">
              <div class="footer-head">
                <div class="footer-logo">
                  <h2><?= $about->name ?></h2>
                </div>

                <p><?= $about->desc ?></p>
              </div>
            </div>
          </div>
          <!-- end single footer -->
          <div class="col-md-6">
            <div class="footer-content">
              <div class="footer-head">
                <h4>information</h4>
                <div class="footer-contacts">
                  <p><span>Tel:</span> <?= $about->phone ?></p>
                  <p><span>Email:</span> <?= $about->email ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright <strong><?= $about->name ?></strong>. All Rights Reserved
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/template') ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/appear/jquery.appear.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/knob/jquery.knob.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/parallax/parallax.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/wow/wow.min.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/template') ?>/assets/vendor/venobox/venobox.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/admin/vendor/daterangepicker/moment.min.js')?>"></script>

  <script>
    $(document).ready(function () {
      var now = moment().format('DD-MM-YYYY');
      var date = moment().format('YYYY-MM-DD');
      $('#now').text(now);
      $('#jadwal-solat').html('');
      $.ajax({
        type: "get",
        url: "https://api.pray.zone/v2/times/day.json?city=bogor&date=" + date,
        data: "data",
        dataType: "json",
        success: function (res) {
          if (res.code == 200) {
            var solat = res.results.datetime[0].times;
            var row = `<tr>
                        <td>`+solat.Fajr+`</td>
                        <td>`+solat.Dhuhr+`</td>
                        <td>`+solat.Asr+`</td>
                        <td>`+solat.Maghrib+`</td>
                        <td>`+solat.Isha+`</td>
                      </tr>`;
            $('#jadwal-solat').append(row);
          }
        }
      });
    });
  </script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/template') ?>/assets/js/main.js"></script>

</body>

</html>