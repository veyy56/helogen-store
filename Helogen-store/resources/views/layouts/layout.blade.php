<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Helogen Store - @yield('title')</title>
    {{-- <link rel="icon" href="img/Fevicon.png" type="image/png"> --}}
  <link rel="stylesheet" href="{{asset("assets/vendors/bootstrap/bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{asset("assets/vendors/fontawesome/css/all.min.css")}}">
  <link rel="stylesheet" href="{{asset("assets/vendors/themify-icons/themify-icons.css")}}">
  <link rel="stylesheet" href="{{asset("assets/vendors/nice-select/nice-select.css")}}">
  <link rel="stylesheet" href="{{asset("assets/vendors/owl-carousel/owl.theme.default.min.css")}}">
  <link rel="stylesheet" href="{{asset("assets/vendors/owl-carousel/owl.carousel.min.css")}}">

  @yield('css')

  <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
</head>
<body>
  <!--================ Start Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
            @if(Auth::guard('costumer')->check())
              <li class="nav-item @yield('index')"><a class="nav-link" href="{{ route('home.index') }}">Home</a></li>
              <li class="nav-item @yield('produk')"><a class="nav-link" href="{{ route('home.product') }}">Produk</a></li>
              <li class="nav-item @yield('kontak')"><a class="nav-link" href="/contact">Contact</a></li>
            @else
                <li class="nav-item @yield('index')"><a class="nav-link" href="{{ route('front.index') }}">Home</a></li>
                <li class="nav-item @yield('produk')"><a class="nav-link" href="{{ route('front.product') }}">Produk</a></li>
                <li class="nav-item @yield('kontak')"><a class="nav-link" href="/contact">Contact</a></li>
            @endif
            </ul>

          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->
  @yield('section-login')

  @yield('main')


  <!--================ Start footer Area  =================-->
	<footer class="footer">
		<div class="footer-area">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title large_title">Helogen Store</h4>
							<p>
              Helogen Store Purwokerto - Destinasi utama untuk fashion urban kekinian. Temukan koleksi eksklusif kaos, hoodie, jaket, dan aksesoris berkualitas tinggi yang mencerminkan kreativitas Anda. Kunjungi kami dan temukan gaya yang sesuai dengan kepribadian Anda.
							</p>
							
						</div>
					</div>
					<div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Quick Links</h4>
							<ul class="list">
								<li><a href="{{ route('front.index') }}">Home</a></li>
								<li><a href="{{ route('front.product') }}">Produk</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget instafeed">
							<h4 class="footer_title">Gallery</h4>
							<ul class="list instafeed d-flex flex-wrap">
                                @foreach ($products as $row)
                                    <li><img src="{{ asset('storage/products/' . $row->image) }}" class="img-fluid" style="height: 70px;" alt=" {{$row->name}} "></li>
                                @endforeach
							</ul>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
            <div class="single-footer-widget tp_widgets">
              <h4 class="footer_title">Contact Us</h4>
              <div class="ml-20 contact-info">
                <span class="contact-info__icon"><i class="ti-headphone"></i></span>
                <p>+62 895421946675 </p> <br>
              </div>
              <div class="ml-20 contact-info"><br>
                <span class="contact-info__icon"><i class="ti-instagram"></i></span>
                <p>@helogen.co </p>
              </div>
            </div>
          </div>

					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <i class="fa fa-store" aria-hidden="true"></i> Helogen Store Purwokerto &copy;<script>document.write(new Date().getFullYear());</script></i>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->



  <script src="{{asset('assets/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('assets/vendors/skrollr.min.js')}}"></script>
  <script src="{{asset('assets/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/vendors/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{asset('assets/vendors/mail-script.js')}}"></script>
  <script src="{{asset('assets/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/js/main.js')}}"></script>

  @yield('js')
</body>
</html>
