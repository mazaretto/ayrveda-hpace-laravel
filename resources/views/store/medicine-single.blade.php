@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('header.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('store')}}">{{__('header.online-store')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$medicine->name}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{$medicine->name}}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container">
      <!-- Medicine Widget -->
      <div class="card">
        <div class="card-body d-flex flex-wrap">
          <div class="row">
            <div class="col-12 col-md-4">
              <a href="{{Storage::url($medicine->image)}}" data-fancybox="gallery">
                <img class="img-fluid" src="{{Storage::url($medicine->image)}}" alt="">
              </a>
              <div class="clinic-details my-2">
                <ul class="clinic-gallery">
                  @foreach(explode(',', $medicine->gallery) as $image)
                    @if ($image)
                      <li>
                        <a href="{{Storage::url($image)}}" class="avatar avatar-lg" data-fancybox="gallery">
                          <img src="{{Storage::url($image)}}" class="avatar-img rounded" alt="">
                        </a>
                      </li>
                    @else
                      <?php
                      $medicine->gallery = mb_substr($medicine->gallery, 1);
                      $medicine->save();
                      ?>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-12 col-md-8 mt-5 mt-md-0">
              <h2>{{$medicine->name}}</h2>

              <p>{{$medicine->description}}</p>

              @if($medicine->manufacter)
                <p><b>{{__('regular.manufacturer')}}:</b> {{$medicine->manufacter}}</p>
              @endif
              @if($medicine->manufacter_address)
                <p><b>{{__('regular.manufacturer_address')}}:</b> {{$medicine->manufacter_address}}</p>
              @endif
              @if($medicine->manufacter_phone)
                <p><b>{{__('regular.manufacturer_phone')}}:</b> {{$medicine->manufacter_phone}}</p>
              @endif
              <p><b>{{__('cart.price')}}:</b> {{$medicine->price}}$</p>

              @guest
                <button class="btn btn-primary">You have to be Patient to buy</button>
              @endguest
              @auth
                @if(auth()->user()->hasRole('Patient'))
                  <form action="{{route('cart.add')}}" method="Post" class="d-flex">
                    @csrf
                    <input type="hidden" name="type" value="medicine">
                    <input type="hidden" name="id" value="{{$medicine->id}}">
                    <div class="d-flex">
                      <div class="product-quantity-minus">-</div>
                      <input type="number" name="quantity" class="product-quantity form-control" value="1" min="1" max="999">
                      <div class="product-quantity-plus">+</div>
                    </div>
                    <button class="btn btn-primary">{{__('cart.add_to_cart')}}</button>
                  </form>
                @endif
              @endauth
            </div>
          </div>

          <div class="row mt-5 w-100">
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4>{{__('regular.composition')}}</h4>
                <ul>
                  @foreach(explode('\,/',$medicine->sostav) as $item)
                    <li>{{$item}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4>{{__('regular.dosage')}}</h4>
                <ul>
                  @foreach(explode('\,/',$medicine->doz) as $item)
                    <li>{{$item}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4>{{__('regular.contraindications')}}</h4>
                <ul>
                  @foreach(explode('\,/',$medicine->protiv) as $item)
                    <li>{{$item}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4>{{__('regular.diseases')}}</h4>
                <ul>
                  @foreach(explode('\,/',$medicine->diseases) as $item)
                    <li>{{$item}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Medicine Widget -->
    </div>
  </div>
  <!-- /Page Content -->
  </div>
@endsection
