<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Ranking Sekolah | rankingsekolah.com</title>
    <link rel="shortcut icon" type="image/png" href="assets/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- css files -->
    <link href="{{ asset('frontend/web/css/bootstrap.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('frontend/web/css/font-awesome.css') }}" rel="stylesheet" media="all" />
    <link rel="stylesheet" href="{{ asset('frontend/web/css/set2.css') }}" />
    <link href="{{ asset('frontend/web/css/imagelightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/web/css/style.css') }}" rel="stylesheet" media="all" />
    <link href="{{ asset('frontend/web/css/responsive.css') }}" rel="stylesheet" media="all" />
    <!-- /css files -->

    <script src="{{ asset('frontend/web/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/web/js/bootstrap.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-fixed w-100">
        <div class="container">
            <a class="navbar-brand" href="#">PPDB SMP Islam Thoriqul Huda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link active" aria-current="page" href="{{ route('frontend.dashboard') }}">Beranda</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('frontend.ranking') }}">Rangking</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('frontend.galeri') }}">Galeri</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('frontend.detail') }}">Kontak</a>
                    </li>
                </ul>

                <div>

                    <a href="{{ route('register') }}"><button class="button-primary">{{ __('Daftar') }}</button></a>
                    <a href="{{ route('login') }}"><button class="button-secondary">{{ __('Masuk') }}</button></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- //navigation -->

    <!--//banner section starts here-->
    <!-- Slider  -->
    <section class="jarallax callbacks_container w3-layouts">
        <ul class="rslides callbacks callbacks1 agileits" id="slider4">
            <li id="callbacks1_s1" class="" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out;">
                <img src="{{ asset('frontend/web/images/header/bg1.png') }}" alt="home" />
                <div class="caption text-center">
                    <h3>Mari Bersama Membangun Mutu Pendidikan</h3>
                    <p>Pendidikan bukan persiapan untuk hidup. Pendidikan adalah hidup itu sendiri (John Dewey)</p>
                </div>
            </li>
            <li id="callbacks1_s2" class="" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out;">
                <img src="{{ asset('frontend/web/images/header/bg3.png') }}" alt="home" />
                <div class="caption text-center">
                    <h3>Mari Bersama Membangun Mutu Pendidikan</h3>
                    <p>Arah yang diberikan pendidikan untuk mengawali hidup seseorang akan menentukan masa depannya (Plato)</p>
                </div>
            </li>
            <li id="callbacks1_s3" class="callbacks1_on" style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out;">
                <img src="{{ asset('frontend/web/images/header/bg2.png') }}" alt="home" />
                <div class="caption text-center">
                    <h3>Mari Bersama Membangun Mutu Pendidikan</h3>
                    <p>Seorang Guru menggandeng tangan, membuka pikiran, menyentuh hati, dan membentuk masa depan. Seorang Guru berpengaruh selamanya. Dia tidak pernah tahu kapan pengaruhnya berakhir (Henry Adam)</p>
                </div>
            </li>
            <li id="callbacks1_s6" class="callbacks1_on" style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out;">
                <img src="{{ asset('frontend/web/images/header/bg4.png') }}" alt="home" />
                <div class="caption text-center">
                    <h3>Mari Bersama Membangun Mutu Pendidikan</h3>
                    <p> Salah satu tanda seorang pendidik yang hebat yakni mampu memimpin murid-murid menjelajahi tempat-tempat baru yang bahkan belum pernah didatangi sang pendidik itu sendiri (Thomas Groome)</p>
                </div>
            </li>
        </ul>
        <a href="#" class="callbacks_nav callbacks1_nav prev">Previous</a><a href="#" class="callbacks_nav callbacks1_nav next">Next</a>
    </section>
    <!-- /Slider  -->
    <!--//banner-->

    <div id="content">
        @yield('content')
    </div>

    <!-- footer -->
    <div class="agileits_w3layouts-footer">
        <div class="container">
            <div class="agileinfo-footer">
                <div class="col-md-6 col-sm-6 social-icons">
                    <ul>
                        <li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
                        <li><a href="#" class="fa fa-twitter  icon-border twitter"> </a></li>
                        <li><a href="#" class="fa fa-google-plus  icon-border googleplus"> </a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 w3_agile-copyright text-center">
                    <font color="white">Copyright &#169;
                        <script type='text/javascript'>
                            var creditsyear = new Date();
                            document.write(creditsyear.getFullYear());
                        </script> <a expr:href='data:blog.homepageUrl'>
                            <data:blog.title />
                        </a>. All rights reserved.
                    </font>
                </div>
            </div>
        </div>
    </div>
    <!-- //footer -->
    <script src="{{ asset('frontend/web/js/script.js') }}"></script>
    <script src="{{ asset('frontend/web/js/imagelightbox.js') }}"></script>
    <script>
        $('a[data-imagelightbox="g"]').imageLightbox({
            activity: true,
            arrows: true,
            button: true,
            caption: true,
            navigation: true,
            overlay: true,
            quitOnDocClick: false,
            selector: 'a[data-imagelightbox="f"]'
        });
    </script>
    <!-- Banner-plugin -->
    <script src="{{ asset('frontend/web/js/responsiveslides.min.js') }}"></script>
    <script>
        // You can also use "$(window).load(function() {"
        $(function() {
            // Slider
            $("#slider4").responsiveSlides({
                auto: true,
                pager: false,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                before: function() {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
    </script>
    <!-- //Banner-plugin -->
    <script src="{{ asset('frontend/web/js/jarallax.js') }}"></script>
    <script src="{{ asset('frontend/web/js/SmoothScroll.min.js') }}"></script>
    <script type="text/javascript">
        /* init Jarallax */
        $('.jarallax').jarallax({
            speed: 0.5,
            imgWidth: 1366,
            imgHeight: 768
        })
    </script>
    <!-- here starts scrolling icon -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            	var defaults = {
            	containerID: 'toTop', // fading element id
            	containerHoverID: 'toTopHover', // fading element hover id
            	scrollSpeed: 1200,
            	easingType: 'linear'
            	};
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>

    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{ asset('frontend/web/js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/web/js/easing.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- /ends-smoth-scrolling -->

    <!-- //here ends scrolling icon -->
</body>

</html>
