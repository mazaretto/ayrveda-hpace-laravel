<!-- Footer -->
<footer class="footer">

  <!-- Footer Top -->
  <div class="footer-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6">

          <!-- Footer Widget -->
          <div class="footer-widget footer-about">
            <div class="footer-logo">
              <img src="{{asset('logo.png')}}" alt="" style="height: 100%">
            </div>
            <div class="footer-about-content">
              <div class="social-icon">
                <ul>
                  <?php
                  $facebook = \App\SiteSettings::where('key', 'facebook')->first()->value;
                  $twitter = \App\SiteSettings::where('key', 'twitter')->first()->value;
                  $linkedin = \App\SiteSettings::where('key', 'linkedin')->first()->value;
                  $instagram = \App\SiteSettings::where('key', 'instagram')->first()->value;
                  $dribble = \App\SiteSettings::where('key', 'dribble')->first()->value;
                  ?>
                  @if($facebook)
                    <li>
                      <a href="{!! $facebook !!}" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                    </li>
                  @endif
                  @if($twitter)
                    <li>
                      <a href="{!! $twitter !!}" target="_blank"><i class="fab fa-twitter"></i> </a>
                    </li>
                  @endif
                  @if($linkedin)
                    <li>
                      <a href="{!! $linkedin !!}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                  @endif
                  @if($instagram)
                    <li>
                      <a href="{!! $instagram !!}" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                  @endif
                  @if($dribble)
                    <li>
                      <a href="{!! $dribble !!}" target="_blank"><i class="fab fa-dribbble"></i> </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
          <!-- /Footer Widget -->

        </div>

        <div class="col-lg-3 col-md-6">

          <!-- Footer Widget -->
          <div class="footer-widget footer-menu">
            <h2 class="footer-title">{{__('footer.for_patient')}}</h2>
            <ul>
              {{--<li><a href="{{route('search-doctor')}}">Search for Doctors</a></li>--}}
              <li><a href="{{route('login')}}">{{__('footer.for_patient_login')}}</a></li>
              <li><a href="{{route('register')}}">{{__('footer.for_patient_reg')}}</a></li>
              <li><a href="{{route('store')}}">{{__('footer.for_patient_store')}}</a></li>
              <li><a href="{{route('doctors-list')}}">{{__('footer.for_patient_docs')}}</a></li>
            </ul>
          </div>
          <!-- /Footer Widget -->

        </div>

        <div class="col-lg-3 col-md-6">

          <!-- Footer Widget -->
          <div class="footer-widget footer-menu">
            <h2 class="footer-title">{{__('footer.for_docs')}}</h2>
            <ul>
              <li><a href="{{route('login.doctor')}}">{{__('footer.for_docs_login')}}</a></li>
              <li><a href="{{route('register.doctor')}}">{{__('footer.for_docs_reg')}}</a></li>
            </ul>
          </div>
          <!-- /Footer Widget -->

        </div>

        <div class="col-lg-3 col-md-6">

          <!-- Footer Widget -->
          <div class="footer-widget footer-contact">
            <h2 class="footer-title">{{__('footer.contact')}}</h2>
            <div class="footer-contact-info">
              <div class="footer-address">
                <span><i class="fas fa-map-marker-alt"></i></span>
                <p>{!! \App\SiteSettings::where('key', 'address')->first()->value !!}</p>
              </div>
              <p>
                <i class="fas fa-phone-alt"></i>
                {!! \App\SiteSettings::where('key', 'contact_phone')->first()->value !!}
              </p>
              <p class="mb-0">
                <i class="fas fa-envelope"></i>
                {!! \App\SiteSettings::where('key', 'email')->first()->value !!}
              </p>
            </div>
          </div>
          <!-- /Footer Widget -->

        </div>

      </div>
    </div>
  </div>
  <!-- /Footer Top -->

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="container-fluid">

      <!-- Copyright -->
      <div class="copyright">
        <div class="row">
          <div class="col-md-6 col-lg-6">
            <div class="copyright-text">
              <p class="mb-0">&copy; 2020 {{env('APP_NAME')}}. All rights reserved.</p>
            </div>
          </div>
          {{--
          <div class="col-md-6 col-lg-6">

            <!-- Copyright Menu -->
            <div class="copyright-menu">
              <ul class="policy-menu">
                <li><a href="term-condition">Terms and Conditions</a></li>
                <li><a href="privacy-policy">Policy</a></li>
              </ul>
            </div>
            <!-- /Copyright Menu -->
          --}}
        </div>
      </div>
    </div>
    <!-- /Copyright -->

  </div>
  </div>
  <!-- /Footer Bottom -->

</footer>
<!-- /Footer -->
