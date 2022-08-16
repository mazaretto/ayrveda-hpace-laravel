<div class="dashboard-widget">
  <nav class="dashboard-menu">
    <ul>
      <li class="{{(request()->is('patient/profile'))?'active':null}}">
        <a href="{{route('patient.dashboard')}}">
          <i class="fas fa-columns"></i>
          <span>{{__('patient_nav.dashboard')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('patient/my-diseases'))?'active':null}}">
        <a href="{{route('patient.diseases')}}">
          <i class="fas fa-book-medical"></i>
          <span>{{__('patient_nav.diseases')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('chat'))?'active':null}}">
        <a href="{{route('chat')}}">
          <i class="fas fa-comments"></i>
          <span>{{__('patient_nav.message')}}</span>
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
      <li class="{{(request()->is('patient/uploaded-files'))?'active':null}}">
        <a href="{{route('patient.files')}}">
          <i class="fas fa-file-medical"></i>
          <span>{{__('patient_nav.uploaded_files')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('store'))?'active':null}}">
        <a target="_blank" href="{{route('store')}}">
          <i class="fas fa-store"></i>
          <span>{{__('patient_nav.shop')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('patient/cart'))?'active':null}}">
        <a href="{{route('patient.cart')}}">
          <i class="fas fa-shopping-cart"></i>
          <span>{{__('patient_nav.cart')}}</span>
          <small class="unread-msg cart-quantity-total">{{\App\Http\Controllers\Store\CartController::total()}}</small>
        </a>
      </li>
      <li class="{{(request()->is('patient/purchase-history'))?'active':null}}">
        <a href="{{route('patient.purchase-history')}}">
          <i class="fas fa-dolly-flatbed"></i>
          <span>{{__('patient_nav.purchase_history')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('patient/settings'))?'active':null}}">
        <a href="{{route('patient.settings')}}">
          <i class="fas fa-user-cog"></i>
          <span>{{__('patient_nav.profile_settings')}}</span>
        </a>
      </li>
      <li class="{{(request()->is('patient/logout'))?'active':null}}">
        <a href="{{route('logout')}}">
          <i class="fas fa-sign-out-alt"></i>
          <span>{{__('auth.Logout')}}</span>
        </a>
      </li>
    </ul>
  </nav>
</div>
