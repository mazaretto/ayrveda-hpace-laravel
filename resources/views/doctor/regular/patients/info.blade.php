<div class="card widget-profile pat-widget-profile">
  <div class="card-body">
    <div class="pro-widget-content">
      <div class="profile-info-widget">
        <a href="#" class="booking-doc-img">
          <img
            src="{{($profile->photo??null) !== null ? Storage::url($profile->photo) : '/assets/img/patients/patient.jpg'}}"
            alt="User Image">
        </a>
        <div class="profile-det-info">
          <?php
          $name = \App\User::userNameFormat($user);
          if (($profile->country ?? null) !== null and ($profile->city ?? null) !== null) {
            $location = $profile->city . ', ' . $profile->country;
          }
          ?>
          <h3>{{$name}}</h3>

          <div class="patient-details">
            <h5><b>{{__('regular.patient-id')}} :</b> P{{$user->id}}</h5>
            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{$location??'Not set'}}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="patient-info">
      <?php
      if ($profile->birth ?? false) {
        $birth = date('F j Y', strtotime($profile->birth));

        $date = new DateTime($profile->birth);
        $now = new DateTime();
        $interval = $now->diff($date);
        $birth = $interval->y . ' years';
      }
      ?>
      <ul>
        <li>{{__('regular.phone')}} <span>{{$user->phone??'Not set'}}</span></li>
        <li>{{__('regular.age')}} <span>{{$birth??'Not set'}}, {{$profile->gender??'Not set'}}</span></li>
        <li>{{__('regular.blood-group')}} <span>{{$profile->blood_group??'Not set'}}</span></li>
      </ul>

      @php($diseases = $user->patientDiseases()->first())
      @if($diseases)
        @php($diseases = explode(',', $diseases->data))
        <ul class="mt-3 pt-3 border-top">
          @foreach($diseases as $disease)
            <li><b>{{\App\Http\Controllers\Patient\DiseasesController::getLocalName($disease)}}</b></li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</div>
