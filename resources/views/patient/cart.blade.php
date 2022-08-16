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
              <li class="breadcrumb-item active" aria-current="page">{{__('patient_nav.cart')}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('patient_nav.cart')}}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">

        <!-- Profile Sidebar -->
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
          <div class="profile-sidebar">
            @include('patient.regular.profile-info')
            @include('patient.regular.nav')
          </div>
        </div>
        <!-- / Profile Sidebar -->
        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="card">
            <div class="card-body">
              @if($cart['medicine']??false)
                <div class="card card-table mb-0">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr>
                          <th class="avatar-xl"></th>
                          <th>{{__('cart.name')}}</th>
                          <th>{{__('cart.price')}}</th>
                          <th>{{__('cart.quantity')}}</th>
                          <th>{{__('cart.total_price')}}</th>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart['medicine']??[] as $cart_item)
                          <?php
                          $medicine = \App\MedicineList::find($cart_item['id']);
                          ?>
                          @if(!$medicine)
                            @continue
                          @endif
                          <tr>
                            <td>
                              <a target="_blank" href="{{route('store.medicine', ['id' => $medicine->id])}}">
                                <div class="avatar avatar-xl">
                                  <img class="" src="{{Storage::url($medicine->image)}}"
                                       alt="">
                                </div>
                              </a>
                            </td>
                            <td>
                              <a target="_blank" href="{{route('store.medicine', ['id' => $medicine->id])}}">
                                {{$medicine->name}}
                              </a>
                            </td>
                            <td>
                              <span class="cart-price">{{$medicine->price}}$</span>
                            </td>
                            <td>
                              <form action="{{route('cart.quantity')}}" method="Post"
                                    class="d-flex cart-form-quantity">
                                @csrf
                                <input type="hidden" name="type" value="medicine">
                                <input type="hidden" name="id" value="{{$medicine->id}}">
                                <input type="hidden" name="get-quantity" value="{{route('cart.total')}}">
                                <div class="product-quantity-minus">-</div>
                                <input type="number" name="quantity"
                                       class="product-quantity form-control"
                                       value="{{$cart_item['quantity']}}" min="1" max="999">
                                <div class="product-quantity-plus">+</div>
                              </form>
                            </td>
                            <td>
                              <span class="total-price cart-total-price"></span>
                            </td>
                            <td>
                              <form action="{{route('cart.remove')}}" method="Post"
                                    class="cart-form-remove">
                                @csrf
                                <input type="hidden" name="type" value="medicine">
                                <input type="hidden" name="id" value="{{$medicine->id}}">
                                <button type="submit" class="btn btn-danger"><i
                                    class="fas fa-times"></i></button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                        <tr>
                          <td></td>
                          <td><h3>{{__('cart.total')}}:</h3></td>
                          <td></td>
                          <td>
                            <h3 class="cart-quantity-total">{{\App\Http\Controllers\Store\CartController::total()}}</h3>
                          </td>
                          <td><h3 class="cart-price-total"></h3></td>
                          <td></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row mt-4 justify-content-end m-0">
                  <a class="btn btn-primary" href="{{route('patient.cart.details')}}">{{__('cart.proceed')}}</a>
                </div>
              @else
                <h4>{{__('cart.no_data')}}</h4>
              @endif
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
@endsection
