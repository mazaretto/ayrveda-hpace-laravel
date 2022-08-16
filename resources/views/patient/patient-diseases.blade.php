@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('header.home')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{__('patient_nav.diseases')}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('patient_nav.diseases')}}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">

        <!-- Profile Sidebar -->
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
          <div class="profile-sidebar">
            @include('patient.regular.profile-info')
            @include('patient.regular.nav')
          </div>
        </div>
        <!-- / Profile Sidebar -->
        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="card">
            <div class="card-body">
              <form action="{{route('patient.diseases-set')}}" method="Post">
                @csrf
                <?php
                $user_diseases = auth()->user()->patientDiseases()->first();
                $user_diseases = explode(',', $user_diseases->data ?? null);
                $end_list=[];
                ?>
                @if($diseases)
                  @foreach($diseases as $disease)
                    <div class="disease-category">
                      <h4 class="diseases-title" onclick="collapse(this)"><i
                          class="fa fa-sort-up collapse-disease"></i>
                        {{\App\Http\Controllers\Patient\DiseasesController::getLocalName($disease->title)}}
                      </h4>
                      <ul class="diseases-list">
                        @foreach($disease->diseases as $row)
                          <li>
                            <label>
                              @if(in_array($row, $user_diseases))
                              <input name="data[]" type="checkbox" value="{{$row}}" checked>
                              @php($end_list[] = \App\Http\Controllers\Patient\DiseasesController::getLocalName($row))
                                {{end($end_list)}}
                              @else
                                <input name="data[]" type="checkbox" value="{{$row}}">
                                {{\App\Http\Controllers\Patient\DiseasesController::getLocalName($row)}}
                              @endif
                            </label>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  @endforeach
                  <button type="submit" class="btn btn-primary">{{__('forms.submit')}}</button>

                  <div class="mt-3">
                    <p><b>{{__('patient_nav.diseases')}}:</b> {{implode(', ', $end_list)}}</p>
                  </div>
                @else
                  <h2>Not seted</h2>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
@endsection

@section('footer-script')
  <script>
    function collapse(element) {
      let el = $(element).find('i.collapse-disease')
      let list = el.closest('.disease-category').find('.diseases-list')
      if (el.hasClass('fa-sort-up')) {
        el.removeClass('fa-sort-up')
        el.addClass('fa-sort-down')
        list.addClass('active')
      } else if (el.hasClass('fa-sort-down')) {
        el.removeClass('fa-sort-down')
        el.addClass('fa-sort-up')
        list.removeClass('active')
      }
    }
  </script>
@endsection
