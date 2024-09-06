{{-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Northeastern College</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>
<style>
    #header {
        transition: all 0.5s;
        z-index: 997;
        padding: 15px 0;
    }

    #header.header-scrolled,
    #header.header-inner-pages {
        background: rgba(0, 0, 0, 0.9);
    }

    #header .logo {
        font-size: 30px;
        margin: 0;
        padding: 0;
        line-height: 1;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        position: relative;
        display: flex;
        align-items: center;
    }

    #header .logo .logo-text {
        color: #fff;
        text-align: left;
        margin-right: 20px;
    }

    #header .logo .logo-text .main-title {
        margin-left: 5px;
        font-size: 27px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: max-height 0.5s;
    }

    #header .logo .logo-text .sub-title {
        margin-left: 5px;
        font-size: 18px;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    #header .logo a {
        color: #fff;
        display: flex;
        align-items: center;
    }

    #header .logo img {
        max-height: 90px;
        transition: max-height 0.5s;
    }

    #header .logo img,
    #header .logo .logo-text .main-title,
    #header .logo .logo-text .sub-title {
        transition: all 0.5s ease;
    }

    @media (max-width: 768px) {
        #header .logo .logo-text .main-title {
            font-size: 18px !important;
        }

        #header .logo .logo-text .sub-title {
            font-size: 13px !important;
            white-space: nowrap;
        }
    }
</style>

<body>

    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <a href="{{ url('/') }}" class="logo me-auto">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid mb-3">
                <div class="logo-text">
                    <h2 class="main-title">Northeastern College</h2>
                    <p class="sub-title">Villasis, Santiago CIty</p>
                </div>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="nav-link" href="{{ url('login') }}">Login</a></li>
                    <li>
                        <a class="getstarted scrollto" href="{{ route('register') }}">Create an Account</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <style>
        #hero {
            position: relative;
            background-image: url('bgg.png');
            background-size: cover;
            background-position: center;
        }

        #hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.5;
        }


        #hero .col-lg-6 {
            position: relative;
            z-index: 1;
        }
    </style>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>Northeastern College</h1>
                    <h2>Northeastern College advocates for accessible education regardless of economic circumstances, aiming to empower students to reach their full potential and navigate life's challenges with resilience and social responsibility.</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ route('register') }}" class="btn-get-started scrollto">Create an Account</a>
                    </div>
                    
                </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                        <img src="haha.png" class="img-fluid animated" style="width: 500px;" alt="">
                    </div>
                </div>
            </div>
    </section>

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About Us</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-12 pt-4 pt-lg-0 text-center">
                        <p>
                            The Northeastern College Institute, now the Northeastern College was founded in 1941 by educationally-minded citizens, Atty. Francisco E. Pascual, his wife, Doña Emeteria Bautista Pascual, and Mr. Leon Cadaoas who were all residents of Santiago, Isabela.
                            <br>
                            <br>
                            The Institute, the first to offer secondary education in the province, originally started with first and second year levels with Doña Emeteria B. Pascual serving as the classroom teacher and principal in one.
                        </p>
                        <a href="https://www.northeasterncollege.edu.ph/history/" class="btn-learn-more"
                            target="_blank">Learn More</a>

                    </div>

                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">
                <div class="row">
                    <div
                        class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content">
                            <h3><strong>Institutional Statement of Purpose</strong></h3>
                            <p>
                                Northeastern College believes that  quality education is affordable not only to those who are economically capable but also to those who are  economically insufficient.
              <br>It believes that though quality education its educands could break the economic barrier, develop their God-given potentials attain maximum growth, assume diversified social duties and responsibilities and withstand the challenges that come along life’s varied avenues.
                            </p>
                        </div>

                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse"
                                        data-bs-target="#accordion-list-1"><span>01</span>  Vision  <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                        <p>
                                            Northeastern College was envisioned to stand as one “True Mint of  Wisdom ” this part of the region be proud of.</p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2"
                                        class="collapsed"><span>02</span> Mission <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Northeastern College  was founded with mission to:

                                            <br>1. Contribute to the literacy uplift of the valley;
                                          
                                            <br>2. Build-up the social ,moral and spiritual values of its educands; 
                                          
                                            <br>3. Produce well-prepared individuals for economic responsibilities;
                                          
                                            <br>4. Assists the community discover its potentials towards the enjoyment of progressive and
                                          
                                          peaceful life of its member.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3"
                                        class="collapsed"><span>03</span> Core Values <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                        <p>• Nurtured

                                            <br>• Competitive
                                        </p>
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                        style='background-image: url("off.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>We're passionate about agriculture and fostering connections within the farming community. Let's
                        cultivate new ideas together! Whether you're exploring innovative techniques, sustainability, or
                        simply want to chat about farming, we're here. Reach out to us - let's plant the seeds for a
                        thriving conversation!</p>
                </div>

                <div class="row">

                    <div class="col-lg-12 d-flex align-items-stretch">

                        <div class="info">
                            <div class="row">
                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="address">
                                        <i class="bi bi-geo-alt"></i>
                                        <h4>Location:</h4>
                                        <p>Gomez, Santiago</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="email">
                                        <i class="bi bi-envelope"></i>
                                        <h4>Email:</h4>
                                        <p>nc@northeasterncollege.edu.ph</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="phone">
                                        <i class="bi bi-phone"></i>
                                        <h4>Call:</h4>
                                        <p>(078) 682 8256</p>
                                    </div>
                                </div>
                            </div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d30573.879874821716!2d121.552471!3d16.69014!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3390061c751ec201%3A0x8822abda269b9473!2sNortheastern%20College!5e0!3m2!1sen!2sph!4v1706840513255!5m2!1sen!2sph"
                                frameborder="0" style="border:0; width: 100%; height: 290px;"
                                allowfullscreen></iframe>
                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 footer-contact">
                        <h3>Northeastern College</h3>
                        <p>
                            Villasis <br>
                            Santiago City<br>
                            3311 <br><br>
                            <strong>Phone:</strong> (078) 682 8256<br>
                            <strong>Email:</strong> nc@northeasterncollege.edu.ph<br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#services">Programs</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Stay connected! Follow us for the latest updates, tips, and insights. Join the conversation
                            and explore more!</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix bg-dark">

            <div class="copyright">
                Copyright &copy; 2023-2024<strong><span> Northeastern College</span></strong>.
                All rights researved.
            </div>
            <div class="credits">
                <b>Version</b> 2.2.0
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function adjustHeader() {
                if ($(window).scrollTop() > 50 || $(window).width() < 768) {
                    $('#header .logo img').css('max-height', '50px');
                    $('#header .logo .logo-text .main-title').css('font-size', '23px');
                    $('#header .logo .logo-text .sub-title').css('font-size', '16px');
                } else {
                    $('#header .logo img').css('max-height', '90px');
                    $('#header .logo .logo-text .main-title').css('font-size', '27px');
                    $('#header .logo .logo-text .sub-title').css('font-size', '18px');
                }
            }

            // Initial adjustment on page load
            adjustHeader();

            // Adjustments on scroll and window resize
            $(window).on('scroll resize', function() {
                adjustHeader();
            });
        });
    </script>


</body>

</html> --}}
