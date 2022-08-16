@extends('layout.mainlayout_admin')

@section('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
  <!-- Page Wrapper -->
  <div class="page-wrapper" id="app">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">Support</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Support</li>
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
                <table class="datatable table table-hover table-center mb-0">
                  <thead>
                  <tr>
                    <th style="width: 50px">Token</th>
                    <th>Last Message</th>
                    <th>Sent At</th>
                    <th style="width: 50px"></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($supports as $support)
                    <tr>
                      <td>{{$support->id}}</td>
                      <td>
                        @if ($support->last_message->send_to !== 'support')
                          <b>(Support)</b>
                        @endif
                        @if(strlen($support->last_message->data) > 50)
                          {{mb_substr($support->last_message->data, 0, 50)}}...
                        @else
                          {{$support->last_message->data}}
                        @endif
                      </td>
                      <td>{{date('j M Y, G:i:s', strtotime($support->created_at))}}</td>
                      <td class="d-flex">
                        <support-load :token="{{$support->id}}"></support-load>
                        <form action="{{route('admin.support.delete')}}" method="Post">
                          @csrf
                          <input type="hidden" name="id" value="{{$support->id}}">
                          <button type="submit" class="btn btn-danger"><i class="fe fe-close"></i></button>
                        </form>
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
    <support-chat-support ref="supportChat" active="false" url-get="{{route('admin.support.token')}}" url-post="{{route('admin.support.send')}}"></support-chat-support>
    </div>
  </div>
  <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->
@endsection
