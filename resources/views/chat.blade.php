@extends('layout.mainlayout')

@section('footer-script')
  <script src="{{asset('js/chat.js')}}"></script>
@endsection

@section('head-data')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="content" id="app" style="padding:0;">
    <div class="container-fluid" style="padding:0;">
      <div class="row">
        <div class="col-xl-12">
          <div class="chat-window">

            <!-- Chat Left -->
            <div class="chat-cont-left">
              <div class="chat-header">
                @if ($user->hasRole('Doctor'))
                  <a href="{{route('doctor.dashboard')}}">{{__('chat.back')}}</a>
                @elseif($user->hasRole('Patient'))
                  <a href="{{route('patient.dashboard')}}">{{__('chat.back')}}</a>
                @endif
                {{--
                <a href="javascript:void(0)" class="chat-compose">
                  <i class="material-icons">control_point</i>
                </a>
                --}}
                <div class="chat-add">
                  <form action="{{route('chat.add')}}">
                    <div class="form-group">
                      <label>
                        Введите ID пользователя<br>
                        <small class="text-danger"></small>
                        <small class="text-primary"></small>
                        <input type="text" class="form-control">
                      </label>
                    </div>
                    <button class="btn btn-primary" type="submit">Добавить</button>
                  </form>
                </div>
              </div>
{{--              <form class="chat-search">--}}
{{--                <div class="input-group">--}}
{{--                  <div class="input-group-prepend">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                  </div>--}}
{{--                  <input type="text" class="form-control" placeholder="Search">--}}
{{--                </div>--}}
{{--              </form>--}}
              <div class="chat-users-list">
                <div class="chat-scroll">
                  <chat-list :chat-lists="{{$chats}}"></chat-list>
                </div>
              </div>
            </div>
            <!-- /Chat Left -->


            <!-- Chat Right -->
            <div class="chat-cont-right">
              <chat-messages ref="chatMessages" v-if="chatInfo" :messages="messages" :chat-info="chatInfo" :user-info="userInfo"></chat-messages>
              <chat-form ref="chatForm" v-if="chatInfo" @message-sent="addMessage" csrf="{{csrf_token()}}" form-upload="{{route('chat.upload-single')}}" :chat-info="chatInfo" :user-info="userInfo"></chat-form>
            </div>
            <!-- /Chat Right -->
          </div>

        </div>
      </div>
    </div>
    <!-- /Row -->
  </div>

  </div>
  <!-- /Page Content -->
  </div>
@endsection
