@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/linericon/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/nouislider/nouislider.min.css')}}">

@endsection

@section('title')
    Kontak
@endsection

@section('kontak')
    active
@endsection

@section('main')
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="contact">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Contact Us</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
        </ol>
      </nav>
            </div>
        </div>
</div>
</section>
<!-- ================ end banner area ================= -->

<!-- ================ contact section start ================= -->
<section class="section-margin--small">
<div class="container">
  <div class="d-none d-sm-block mb-5 pb-4">
    <div id="map" style="height: 420px;"></div>
    <script>
                    function initMap() {
                        var sokaraja = {lat: -7.444965, lng: 109.309667};
                        var grayStyles = [
                            {
                                featureType: "all",
                                stylers: [
                                    { saturation: -90 },
                                    { lightness: 50 }
                                ]
                            },
                            {elementType: 'labels.text.fill', stylers: [{color: '#A3A3A3'}]}
                        ];
                        window.map = new google.maps.Map(document.getElementById('map'), {
                            center: sokaraja,
                            zoom: 21,
                            styles: grayStyles,
                            scrollwheel: false
                        });
                    }

                    function updateMap() {
                        var lat = parseFloat(document.getElementById('lat').value);
                        var lng = parseFloat(document.getElementById('lng').value);
                        var newCenter = {lat: lat, lng: lng};
                        window.map.setCenter(newCenter);
                    }
                </script>

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDXqfZiHrbQ7dGdTtJRTPDMzi19ksuGBY&loading=async&callback=initMap&libraries=map,marker"></script>

  </div>


  <div class="row">
    <div class="col-md-4 col-lg-5 mb-4 mb-md-0">
      <div class="media contact-info">
        <span class="contact-info__icon"><i class="ti-home"></i></span>
        <div class="media-body">
          <h3>Griya Karen Indah 3 Blok.G No.12</h3>
          <p>Desa Klahang, Kec. Sokaraja, Kab. Purwokerto</p>
        </div>
      </div>
      <div class="media contact-info">
        <span class="contact-info__icon"><i class="ti-headphone"></i></span>
        <div class="media-body">
          <h3><a href="tel:454545654">0895421946675</a></h3>
          <p>07.00 WIB - 21.00 WIB</p>
        </div>
      </div>
      <div class="media contact-info">
        <span class="contact-info__icon"><i class="ti-instagram"></i></span>
        <div class="media-body">
          <h3><a href="mailto:support@colorlib.com">@helogen.co</a></h3>
          <!-- <p>Send us your query anytime!</p> -->
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- ================ contact section end ================= -->
@endsection

@section('js')
    <script src="{{asset('assets/vendors/nice-select/jquery.nice-select.min.js')}}"></script>

@endsection

