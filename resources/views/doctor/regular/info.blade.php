<?php
$user = auth()->user();
$profile = $user->doctorProfile()->first();
?>
<div class="widget-profile pro-widget-content">
  <div class="profile-info-widget">
    <div class="booking-doc-img">
      <img
        src="{{(($profile->photo ?? null) !== null) ? Storage::url($profile->photo) : '/assets/img/doctors/doctor-thumb-02.jpg'}}"
        alt="User Image">
    </div>
    <div class="profile-det-info">
      <h3>{{\App\User::userNameFormat($user)}}</h3>

      <div class="patient-details">
        <h5 class="mb-0">{{$profile->clinic_name??''}}</h5>
      </div>
    </div>
  </div>
</div>
