<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('layout.partials.head')
</head>
<body>
@include('layout.partials.header')
@yield('content')
@if(!Route::is(['chat-doctor','map-grid','map-list','chat','voice-call','video-call']))
  @include('layout.partials.footer')
@endif
@include('layout.partials.footer-scripts')

<div id="image-instant-zoom" style="display:none;position: fixed;bottom: 0; left: 50%;transform: translateX(-50%);z-index: 99993;width: 250px;">
  <input type="range" min="0.1" max="3" step="0.01" value="1" style="width: 100%;">
  <button class="btn btn-secondary btn-sm ml-1"><i class="fa fa-redo"></i></button>
</div>
</body>
</html>