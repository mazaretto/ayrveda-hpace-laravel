@extends('layout.mainlayout')

@section('footer-script')
  <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}"></script>

  <script>
      $(document).ready(function () {
          paypal.Buttons({
              createOrder: async function (data, actions) {
                  return actions.order.create({
                      purchase_units: [{
                          amount: {
                              value: await axios.get("{{route('cart.get-price')}}").then(r => {
                                  return r.data
                              })
                          }
                      }],
                      application_context: {
                          shipping_preference: 'NO_SHIPPING',
                      },
                  });
              },
              onApprove: function (data, actions) {
                  return actions.order.capture().then(function (details) {
                      console.log('Transaction completed by ' + details.payer.name.given_name)
                      $('.tab-content .tab-pane.show.active form').submit()
                  });
              }
          }).render('.paypal-button-container');
      })
  </script>
@endsection

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
            <?php
            $profile = auth()->user()->patientProfile()->first();
            $address = [];
            $set = false;
            if (isset($profile->country) or isset($profile->state) or isset($profile->city) or isset($profile->zip_code) or isset($profile->address)) {
              $set = true;
            }
            if ($profile) {
              $address['country'] = $profile->country ?? null;
              $address['state'] = $profile->state ?? null;
              $address['city'] = $profile->city ?? null;
              $address['zip_code'] = $profile->zip_code ?? null;
              $address['address'] = $profile->address ?? null;
            }
            ?>

            <!-- Tab Menu -->
              <nav class="user-tabs mb-4">
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                  @if($set)
                    <li class="nav-item">
                      <a class="nav-link {{($set)?'active':null}}" href="#address_my"
                         data-toggle="tab">{{__('cart.address_my')}}</a>
                    </li>
                  @endif
                  <li class="nav-item">
                    <a class="nav-link {{(!$set)?'show active':null}}" href="#address_new"
                       data-toggle="tab">{{__('cart.address_new')}}</a>
                  </li>
                </ul>
              </nav>
              <!-- /Tab Menu -->

              <!-- Tab Content -->
              <div class="tab-content pt-0">
                @if($set)
                  <div role="tabpanel" id="address_my" class="tab-pane fade {{($set)?'show active':null}}">
                    <div class="row">
                      <div class="col-12">
                        <form action="{{route('cart.proceed')}}" class="d-flex flex-wrap order-details-form" method="Post">
                          @csrf
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label>{{__('forms.country')}}</label>
                              <input class="form-control" type="text" name="country" value="{{$address['country']??''}}">
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label>{{__('forms.state')}}</label>
                              <input class="form-control" type="text" name="state" value="{{$address['state']??''}}">
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label>{{__('forms.city')}}</label>
                              <input class="form-control" type="text" name="city" value="{{$address['city']??''}}">
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label>{{__('forms.postal-code')}}</label>
                              <input class="form-control" type="text" name="zip_code" value="{{$address['zip_code']??''}}">
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label>{{__('forms.address')}}</label>
                              <input class="form-control" type="text" name="address" value="{{$address['address']??''}}">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endif

                <div role="tabpanel" id="address_new" class="tab-pane fade {{(!$set)?'show active':null}}">
                  <div class="row">
                    <div class="col-12">
                      <form action="{{route('cart.proceed')}}" class="d-flex flex-wrap order-details-form" method="Post">
                        @csrf
                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label>{{__('forms.country')}}</label>
                            <input class="form-control" type="text" name="country">
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label>{{__('forms.state')}}</label>
                            <input class="form-control" type="text" name="state">
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label>{{__('forms.city')}}</label>
                            <input class="form-control" type="text" name="city">
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label>{{__('forms.postal-code')}}</label>
                            <input class="form-control" type="text" name="zip_code">
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <label>{{__('forms.address')}}</label>
                            <input class="form-control" type="text" name="address">
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end col-12">
                  <div class="paypal-button-container"></div>
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
