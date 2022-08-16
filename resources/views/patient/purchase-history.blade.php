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
              <li class="breadcrumb-item active"
                  aria-current="page">{{__('patient_nav.purchase_history')}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('patient_nav.purchase_history')}}</h2>
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
              <div class="card card-table mb-0">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                      <thead>
                      <tr>
                        <th class="col-10">{{__('cart.order_details')}}</th>
                        <th class="col-1">{{__('cart.total_price')}}</th>
                        <th class="col-1">{{__('cart.order_status')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($purchases as $purchase)
                        @php($purchase->order_data = json_decode($purchase->order_data))
                        <tr>
                          <td>
                            @foreach($purchase->order_data as $key=>$order_item)
                              @if ($key == 'total_price')
                                @continue
                              @endif
                              <?php
                              if ($order_item->type == 'medicine') {
                                $medicine = \App\MedicineList::find($order_item->product_id);
                              }
                              ?>
                              <div class="row mb-3">
                                <div class="col-12 d-flex">
                                  <a href="{{route('store.medicine', ['id' => $order_item->product_id])}}">
                                    <div class="avatar">
                                      @if ($medicine??false)
                                        <img src="{{Storage::url($medicine->image)}}" alt="">
                                      @endif
                                    </div>
                                  </a>
                                  <h4 class="ml-2 d-flex align-items-center"><a
                                      href="{{route('store.medicine', ['id' => $order_item->product_id])}}">{{$order_item->product_name}}</a></h4>
                                  <div class="table-responsive mx-5">
                                    <table class="table table-hover table-center mb-0">
                                      <thead>
                                      <tr>
                                        <th class="py-0 px-2" style="width: 33.33333%">{{__('cart.price')}}</th>
                                        <th class="py-0 px-2" style="width: 33.33333%">{{__('cart.quantity')}}</th>
                                        <th class="py-0 px-2" style="width: 33.33333%">{{__('cart.total_price')}}</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                        <td class="py-0 px-2" style="width: 33.33333%">{{$order_item->product_price}}$</td>
                                        <td class="py-0 px-2" style="width: 33.33333%">{{$order_item->quantity}}</td>
                                        <td class="py-0 px-2" style="width: 33.33333%">{{$order_item->product_total}}$</td>
                                      </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          </td>
                          <td>
                            {{$purchase->order_data->total_price}}$
                          </td>
                          <td>{{\App\Http\Controllers\Store\StoreController::status($purchase->status)}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
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
