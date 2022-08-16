<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
@yield('meta')
@if(!Route::is(['appointment-list','specialities','doctor-list','patient-list','reviews','transactions-list','settings','invoice-report','profile','login','register','forgot-password','lock-screen','error-404','error-500','blank-page','components','form-basic','form-inputs','form-horizontal','form-vertical','form-mask','form-validation','tables-basic','data-tables','invoice','calendar']))
  <title>{{env('APP_NAME')}} - Dashboard</title>
@endif
@if(Route::is(['appointment-list']))
  <title>{{env('APP_NAME')}} - Appointment List Page</title>
@endif
@if(Route::is(['specialities']))
  <title>{{env('APP_NAME')}} - Specialities Page</title>
@endif
@if(Route::is(['doctor-list']))
  <title>{{env('APP_NAME')}} - Doctor List Page</title>
@endif
@if(Route::is(['patient-list']))
  <title>{{env('APP_NAME')}} - Patient List Page</title>
@endif
@if(Route::is(['reviews']))
  <title>{{env('APP_NAME')}} - Reviews Page</title>
@endif
@if(Route::is(['transactions-list']))
  <title>{{env('APP_NAME')}} - Transactions List Page</title>
@endif
@if(Route::is(['settings']))
  <title>{{env('APP_NAME')}} - Settings Page</title>
@endif
@if(Route::is(['invoice-report']))
  <title>{{env('APP_NAME')}} - Invoice Report Page</title>
@endif
@if(Route::is(['profile']))
  <title>{{env('APP_NAME')}} - Profile</title>
@endif
@if(Route::is(['login']))
  <title>{{env('APP_NAME')}} - Login</title>
@endif
@if(Route::is(['register']))
  <title>{{env('APP_NAME')}} - Register</title>
@endif
@if(Route::is(['forgot-password']))
  <title>{{env('APP_NAME')}} - Forgot Password</title>
@endif
@if(Route::is(['lock-screen']))
  <title>{{env('APP_NAME')}} - Lock Screen</title>
@endif
@if(Route::is(['error-404']))
  <title>{{env('APP_NAME')}} - Error 404</title>
@endif
@if(Route::is(['error-500']))
  <title>{{env('APP_NAME')}} - Error 500</title>
@endif
@if(Route::is(['blank-page']))
  <title>{{env('APP_NAME')}} - Blank Page</title>
@endif
@if(Route::is(['components']))
  <title>{{env('APP_NAME')}} - Components</title>
@endif
@if(Route::is(['form-basic']))
  <title>{{env('APP_NAME')}} - Basic Inputs</title>
@endif
@if(Route::is(['form-inputs']))
  <title>{{env('APP_NAME')}} - Form Input Groups</title>
@endif
@if(Route::is(['form-horizontal']))
  <title>{{env('APP_NAME')}} - Horizontal Form</title>
@endif
@if(Route::is(['form-vertical']))
  <title>{{env('APP_NAME')}} - Vertical Form</title>
@endif
@if(Route::is(['form-mask']))
  <title>{{env('APP_NAME')}} - Form Mask</title>
@endif
@if(Route::is(['form-validation']))
  <title>{{env('APP_NAME')}} - Form Validation</title>
@endif
@if(Route::is(['tables-basic']))
  <title>{{env('APP_NAME')}} - Tables Basic</title>
@endif
@if(Route::is(['data-tables']))
  <title>{{env('APP_NAME')}} - Data Tables</title>
@endif
@if(Route::is(['invoice']))
  <title>{{env('APP_NAME')}} - Invoice</title>
@endif
@if(Route::is(['calendar']))
  <title>{{env('APP_NAME')}} - Calendar</title>
@endif
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/css/bootstrap.min.css')}}">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/css/font-awesome.min.css')}}">

<!-- Feathericon CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/css/feathericon.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_admin/plugins/morris/morris.css')}}">
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/css/select2.min.css')}}">
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/css/bootstrap-datetimepicker.min.css')}}">

<!-- Full Calander CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/plugins/fullcalendar/fullcalendar.min.css')}}">
<!-- Datatables CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/plugins/datatables/datatables.min.css')}}">

@yield('header-css')

<!-- <link rel="stylesheet" href="assets/plugins/morris/morris.css"> -->

<!-- Main CSS -->
<link rel="stylesheet" href="{{asset('assets_admin/css/style.css')}}">
