@extends('layout.mainlayout_admin')

@section('content')
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">General Settings</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">General Settings</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->

      <div class="row">
        <div class="col-12">
          <!-- General -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">General</h4>
            </div>
            <div class="card-body">
              <form action="{{route('admin.settings-set')}}" method="Post">
                @csrf
                <div class="form-group">
                  <label>Contact Phone</label>
                  <input type="text" name="contact_phone" class="form-control" value="{{$settings['contact_phone']??null}}">
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="address" class="form-control" value="{{$settings['address']??null}}">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" value="{{$settings['email']??null}}">
                </div>

                <button class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
          <!-- /General -->
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Media</h4>
            </div>
            <div class="card-body">
              <form action="{{route('admin.settings-set')}}" method="Post">
                @csrf
                <div class="d-flex flex-wrap">
                  <div class="form-group col-6">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{$settings['facebook']??null}}">
                  </div>

                  <div class="form-group col-6">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{$settings['twitter']??null}}">
                  </div>

                  <div class="form-group col-6">
                    <label>LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" value="{{$settings['linkedin']??null}}">
                  </div>

                  <div class="form-group col-6">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="{{$settings['instagram']??null}}">
                  </div>

                  <div class="form-group col-6">
                    <label>Dribble</label>
                    <input type="text" name="dribble" class="form-control" value="{{$settings['dribble']??null}}">
                  </div>
                </div>

                <button class="btn btn-primary">Submit</button>
              </form>
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
