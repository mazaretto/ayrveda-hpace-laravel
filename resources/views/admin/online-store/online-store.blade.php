@extends('layout.mainlayout_admin')
@section('content')
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col">
            <h3 class="page-title">Online Store</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Online Store</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="datatable table table-stripped">
                  <thead>
                  <tr>
                    <th style="width: 5%">Order ID</th>
                    <th style="width: 5%">Patient</th>
                    <th>Order</th>
                    <th style="width: 5%">Total Price</th>
                    <th style="width: 75px">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($orders as $order)
                    <?php
                    $order->order_data = json_decode($order->order_data);
                    $order->order_delivery = json_decode($order->order_delivery);

                    $user = App\User::find($order->user_id);
                    $profile = $user->patientProfile()->first();

                    $name = \App\User::userNameFormat($user);
                    ?>
                    <tr>
                      <td>{{$order->id}}</td>
                      <td><a target="_blank" href="{{route('admin.patient-profile', ['id' => $user->id])}}">{{$name}}</a></td>
                      <td>
                        @foreach($order->order_data as $key=>$order_item)
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
                              <a target="_blank" href="{{route('store.medicine', ['id' => $order_item->product_id])}}">
                                <div class="avatar">
                                  @if ($medicine??false)
                                    <img src="{{Storage::url($medicine->image)}}" alt="">
                                  @endif
                                </div>
                              </a>
                              <a target="_blank" class="ml-2" href="{{route('store.medicine', ['id' => $order_item->product_id])}}">{{$order_item->product_name}}</a>
                              <div class="table-responsive mx-5">
                                <table class="table table-hover table-center mb-0">
                                  <thead>
                                  <tr>
                                    <th class="py-0 px-2" style="width: 33.33333%">Price</th>
                                    <th class="py-0 px-2" style="width: 33.33333%">Quantity</th>
                                    <th class="py-0 px-2" style="width: 33.33333%">Total</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td class="py-0 px-2" style="width: 33.33333%">{{$order_item->product_price}}</td>
                                    <td class="py-0 px-2" style="width: 33.33333%">{{$order_item->quantity}}</td>
                                    <td class="py-0 px-2" style="width: 33.33333%">{{$order_item->product_total}}</td>
                                  </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </td>
                      <td>
                        {{$order->order_data->total_price}}
                      </td>
                      <td>
                        <div class="d-flex flex-wrap">
                          <span class="mb-2">{{\App\Http\Controllers\Store\StoreController::status($order->status)}}</span>
                          <div class="flex-break"></div>
                          <button class="btn btn-info flex mr-1 order_delivery">
                            <i class="fa fa-list"></i>
                          </button>
                          <div class="order_delivery__info card border-info">
                            <div class="card-body">
                              <p>Counrty: <span>{{$order->order_delivery->country}}</span></p>
                              <p>State: <span>{{$order->order_delivery->state}}</span></p>
                              <p>City: <span>{{$order->order_delivery->city}}</span></p>
                              <p>Zip Code: <span>{{$order->order_delivery->zip_code}}</span></p>
                              <p>Address: <span>{{$order->order_delivery->address}}</span></p>
                            </div>
                          </div>
                          <a href="tel:{{$user->phone}}" class="btn btn-primary"><i class="fa fa-phone"></i></a>

                          <div class="flex-break mt-2"></div>
                          @if($order->status != -1 and $order->status != 1)
                            <form action="{{route('admin.online-store.next')}}" method="Post">
                              @csrf
                              <input type="hidden" name="dismiss" value="0">
                              <input type="hidden" name="id" value="{{$order->id}}">
                              <button class="btn btn-success mr-1"><i class="fa fa-check"></i></button>
                            </form>
                          @endif
                          @if($order->status != -1 and $order->status != 1)
                            <form action="{{route('admin.online-store.next')}}" method="Post">
                              @csrf
                              <input type="hidden" name="dismiss" value="1">
                              <input type="hidden" name="id" value="{{$order->id}}">
                              <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                          @endif
                        </div>
                      </td>
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
  <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->
@endsection
