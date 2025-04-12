<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>My Website</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontAwesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hero-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>

</head>

<body>

    <div class="wrap">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <button id="primary-nav-button" type="button">Menu</button>
                        <a href="index.html">
                            <div class="logo">
                                <img src="{{ asset('images/logo.png') }}" alt="Venue Logo">
                            </div>
                        </a>
                        <nav id="primary-nav" class="dropdown cf">
                            <ul class="dropdown menu">
                                <li class='active'><a href="index.html">Home</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="team.html">Authors</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </nav><!-- / #primary-nav -->
                    </div>
                </div>
            </div>
        </header>
    </div>

    <section class="banner" id="top"
        style="background-image: url('{{ asset('images/homepage-banner-image-1920x700.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <div class="line-dec"></div>
                        <h2>Selamat Datang Di Halaman Website Andi Muhammad Riffal</h2>
                        <div class="blue-button">
                            <a href="contact.html">Hubungi Saya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="our-services">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="left-content">
                            <br>
                            <h4>Tentang Saya</h4>
                            <p>Aenean hendrerit metus leo, quis viverra purus condimentum nec. Pellentesque a sem
                                semper, lobortis mauris non, varius urna. Quisque sodales purus eu tellus
                                fringilla.<br><br>Mauris sit amet quam congue, pulvinar urna et, congue diam.
                                Suspendisse eu lorem massa. Integer sit amet posuere tellus, id efficitur leo. In hac
                                habitasse platea dictumst. Vel sequi odit similique repudiandae ipsum iste, quidem
                                tenetur id impedit, eaque et, aliquam quod.</p>
                            <div class="blue-button">
                                <a href="about-us.html">Temukan Saya</a>
                            </div>

                            <br>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="{{ asset('images/about-1-720x480.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-places">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <span>Latest blog posts</span>
                            <h2>Lorem ipsum dolor sit amet ctetur.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="{{ asset('images/blog-1-720x480.jpg') }}" alt="">
                                </div>

                                <div class=" overlay-content">
                                    <strong title="Author"><i class="fa fa-user"></i> John Doe</strong>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong>
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit hic</h4>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim consectetur assumenda
                                    nam facere voluptatibus totam veritatis. </p>

                                <div class="text-button">
                                    <a href="blog-details.html">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="{{ asset('images/blog-2-720x480.jpg') }}" alt="">
                                </div>

                                <div class="overlay-content">
                                    <strong title="Author"><i class="fa fa-user"></i> John Doe</strong>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong>
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit hic</h4>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim consectetur assumenda
                                    nam facere voluptatibus totam veritatis. </p>

                                <div class="text-button">
                                    <a href="blog-details.html">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="{{ asset('images/blog-3-720x480.jpg') }}" alt="">
                                </div>

                                <div class="overlay-content">
                                    <strong title="Author"><i class="fa fa-user"></i> John Doe</strong>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong>
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit hic</h4>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim consectetur assumenda
                                    nam facere voluptatibus totam veritatis. </p>

                                <div class="text-button">
                                    <a href="blog-details.html">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="banner" id="top"
            style="background-image: url('{{ asset('images/contact-image-1-1920x700.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="banner-caption">
                            <div class="line-dec"></div>
                            <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h2>
                            <div class="blue-button">
                                <a href="contact.html">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-5">
                    <div class="about-veno">
                        <div class="logo">
                            <img src="{{ asset('images/footer_logo.png') }}" alt="Venue Logo">
                        </div>
                        <p>Mauris sit amet quam congue, pulvinar urna et, congue diam. Suspendisse eu lorem massa.
                            Integer sit amet posuere tellustea dictumst.</p>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Useful Links -->
                <div class="col-md-4">
                    <div class="useful-links">
                        <div class="footer-heading">
                            <h4>Useful Links</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="about.html"><i class="fa fa-user"></i> About</a></li>
                                    <li><a href="contact.html"><i class="fa fa-envelope"></i> Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="team.html"><i class="fa fa-users"></i> Authors</a></li>
                                    <li><a href="blog.html"><i class="fa fa-blog"></i> Blog</a></li>
                                    <li><a href="terms.html"><i class="fa fa-file-alt"></i> Terms</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="footer-heading">
                            <h4>Contact Information</h4>
                        </div>
                        <p><i class="fa fa-map-marker-alt"></i> Padang Sumatra Barat</p>
                        <ul>
                            <li><i class="fa fa-phone"></i> <span>Phone:</span> <a href="#">+6232323232323232</a></li>
                            <li><i class="fa fa-envelope"></i> <span>Email:</span> <a href="#">riffal@company.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <div class="sub-footer">
        <p>Copyright © 2020 Andi Muhammad Riffal</a></p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
    window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>