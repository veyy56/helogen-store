@extends('layouts.layout')

@section('title')
    Produk
@endsection

@section('produk')
active
@endsection

@section('main')
<section class="blog-banner-area" id="category">
    <div class="container h-500">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Produk</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

  <section class="section-margin--small mb-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head">Browse Categories</div>
            <ul class="main-categories">
              <li class="common-filter">
                <ul>
                    @foreach ($categories as $category)
                        <li class="filter-list">
                            <strong><a href="{{ url('/category/' . $category->slug) }}">{{ $category->name }}</a></strong>

                            @foreach ($category->child as $child)
                                <ul class="list" style="display: block">
                                    <li>
                                        <a href="{{ url('/category/' . $child->slug) }}">{{ $child->name }}</a>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          
          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
            <div class="row">
                @forelse ($products as $row)
                  <div class="col-md-6 col-lg-4">
                    <div class="card text-center card-product">
                      <div class="card-product__img">
                        <img class="card-img" src="{{ asset('storage/products/' . $row->image) }}" alt="{{ $row->name }}">
                        <ul class="card-product__imgOverlay">
                         <li><a href="{{ url('/product/' . $row->slug) }}"><button><i class="ti-search"></i></button></a></li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <p>{{ $row->category->name}}</p>
                        @if(Auth::guard('costumer')->check())
                            <h4 class="card-product__title"><a href="{{ url('/costumer/product/' . $row->slug) }}">{{ $row->name }}</a></h4>
                        @else
                            <h4 class="card-product__title"><a href="{{ url('/product/' . $row->slug) }}">{{ $row->name }}</a></h4>
                        @endif
                        <p class="card-product__price">Rp. {{ number_format($row->price) }}</p>
                      </div>
                    </div>
                  </div>

                @empty
                    <div class="col-md-12">
                        <h3 class="text-center">Tidak ada produk</h3>
                    </div>
                @endforelse
            </div>
          </section>
          <!-- End Best Seller -->
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js')
    <script src="{{asset('assets/vendors/nice-select/jquery.nice-select.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
@endsection
