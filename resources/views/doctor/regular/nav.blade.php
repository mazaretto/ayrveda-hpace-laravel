<div class="dashboard-widget">
  <nav class="dashboard-menu">
    <ul>
      <li class="{{(request()->is('doctor/profile'))?'active':null}}">
        <a href="{{route('doctor.dashboard')}}">
          <i class="fas fa-columns"></i>
          <span>{{__('doctor_nav.dashboard')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('doctor/my-patients'))?'active':null}}">
        <a href="{{route('doctor.my-patients')}}">
          <i class="fas fa-user-injured"></i>
          <span>{{__('doctor_nav.my_patients')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('chat'))?'active':null}}">
        <a href="{{route('chat')}}">
          <i class="fas fa-comments"></i>
          <span>{{__('doctor_nav.message')}}</span>
          <?php
          $unread = \App\ChatMessage::where([
            ['user_to_id', auth()->user()->id],
            ['read', false],
          ])->count()
          ?>
          @if ($unread)
          <small class="unread-msg">{{$unread}}</small>
          @endif
        </a>
      </li>
      <li class="{{(request()->is('doctor/social'))?'active':null}}">
        <a href="{{route('doctor.social')}}">
          <i class="fas fa-share-alt"></i>
          <span>{{__('doctor_nav.social_media')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('doctor/settings'))?'active':null}}">
        <a href="{{route('doctor.settings')}}">
          <i class="fas fa-user-cog"></i>
          <span>{{__('doctor_nav.profile_settings')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('doctor/logout'))?'active':null}}">
        <a href="{{route('logout')}}">
          <i class="fas fa-sign-out-alt"></i>
          <span>{{__('auth.Logout')}}</span>
        </a>
      </li>
    </ul>
  </nav>
</div>
