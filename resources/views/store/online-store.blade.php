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
              <li class="breadcrumb-item active" aria-current="page">{{__('header.online-store')}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('header.online-store')}}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

          <!-- Profile Sidebar -->
          <form class="profile-sidebar pro-widget-content text-left" method="Get">
            {{--
            <div class="filter-content">
              <h4>{{__('regular.price')}}</h4>
              <div class="form-group d-flex">
                <input type="text" class="form-control filter-price-range-min" name="price-min"
                       value="{{request()->get('price-min')??'0'}}">
                <input type="text" class="form-control filter-price-range-max" name="price-max"
                       value="{{request()->get('price-max')??($max_price??100)}}">
              </div>
              <div class="filter-price-range" data-init-min="{{request()->get('price-min')??0}}"
                   data-init-max="{{request()->get('price-max')??($max_price??100)}}"
                   data-max="{{$max_price??100}}"></div>
            </div>
            --}}
            <div class="filter-content">
              <h4>{{__('regular.search')}}</h4>
              <div class="form-group d-flex">
                <input type="text" class="form-control" name="name" value="{{request()->get('name')??null}}">
              </div>
            </div>
            <div class="filter-content">
              <h4>{{__('regular.manufacturer')}}</h4>
              <ul class="d-flex flex-column pl-2 m-0">
                @foreach($manufacters as $manufacter)
                  <label>
                    <input type="checkbox" name="manufacter[]"
                           value="{{$manufacter}}" {{(in_array($manufacter, request()->get('manufacter')??[]))?'checked':null}}>
                    {{$manufacter}}
                  </label>
                @endforeach
              </ul>
            </div>
            {{--
            <div class="filter-content">
              <h4>Diseases</h4>
              <ul class="d-flex flex-column pl-2 m-0">
                @foreach($diseases as $disease)
                  <label>
                    <input type="checkbox" name="disease[]"
                           value="{{$disease}}" {{(in_array($disease, request()->get('disease')??[]))?'checked':null}}>
                    {{$disease}}
                  </label>
                @endforeach
              </ul>
            </div>
            --}}

            <button class="btn btn-primary">{{__('regular.search')}}</button>
            <a href="{{route('store')}}" class="btn btn-primary">{{__('regular.reset_filters')}}</a>
          </form>
          <!-- /Profile Sidebar -->

        </div>

        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="row">
            <div class="col-12 d-flex flex-wrap">
              <?php
              if(auth()->check()){
                $prescriptions = auth()->user()->prescription()->pluck('medicine_id')->toArray();
              }
              ?>
              @foreach($medicines as $medicine)
                <div class="col-12 col-sm-6 col-md-12 col-lg-4 col-xl-3">
                  <div class="card store-card {{(in_array($medicine->id, $prescriptions ?? [])?'prescription':null)}}">
                    <a href="{{route('store.medicine', ['id' => $medicine->id])}}"><img
                        src="{{Storage::url($medicine->image??'')}}" class="card-img-top"
                        alt="Feature"></a>
                    <div class="card-body">
                      <a class="card-title font-weight-bold text-lg d-block mb-1"
                         href="{{route('store.medicine', ['id' => $medicine->id])}}">{{$medicine->name}}</a>
                      <p class="card-text card-text__medicine-description">{{$medicine->description}}</p>
                      <p class="card-text">{{$medicine->price}}$</p>
                      <div class="d-flex">
                        <a href="{{route('store.medicine', ['id' => $medicine->id])}}"
                           class="btn btn-primary mr-2">{{__('regular.view_more')}}</a>
                        @auth
                          @if(auth()->user()->hasrole('Patient'))
                            <form action="{{route('cart.add')}}" method="Post">
                              @csrf
                              <input type="hidden" name="type" value="medicine">
                              <input type="hidden" name="id" value="{{$medicine->id}}">
                              <input type="hidden" name="quantity" value="1">
                              <button type="submit" class="btn btn-secondary"><i
                                  class="fas fa-cart-plus"></i></button>
                            </form>
                          @endif
                        @endauth
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

  </div>
  <!-- /Page Content -->
  </div>
@endsection

