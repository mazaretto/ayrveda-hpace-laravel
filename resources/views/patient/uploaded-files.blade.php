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
              <li class="breadcrumb-item active" aria-current="page">{{__('patient_nav.uploaded_files')}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('patient_nav.uploaded_files')}}</h2>
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

              <!-- Uploaded files -->
              <form action="{{route('patient.add-files')}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="row form-row">
                  <div class="col-12 col-md-12">
                    <div class="d-flex flex-wrap">
                      <style>
                        .change-avatar .profile-img img {
                          object-fit: initial;
                        }
                      </style>
                      <div class="change-avatar">
                        <div class="upload-img">
                          <div class="change-photo-btn">
                            <span><i class="fa fa-upload"></i> {{__('regular.choose-file')}}</span>
                            <input type="file" name="file"
                                   class="upload @error('file') is-invalid @enderror"
                                   required>
                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="submit-section ml-2">
                        <button type="submit"
                                class="upload_file-submit">{{__('regular.upload-file')}}</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <!-- /Uploaded files -->

              <div class="mt-4">
                <div class="card card-table mb-0">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr class="d-flex align-items-start">
                          <th class="col-2">{{__('regular.file-name')}}</th>
                          <th class="col-8">{{__('regular.file')}}</th>
                          <th class="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $file)
                          <tr class="d-flex align-items-start">
                            <td class="col-2 text-left uploaded-files__name">
                              <h2>{{$file->name}}</h2>
                            </td>
                            <td class="col-8">
                              <?php
                              $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                              $pdf = 'application/pdf';
                              $contentType = mime_content_type('storage/' . $file->file);
                              ?>
                              @if(in_array($contentType, $allowedMimeTypes))
                                <a href="{{Storage::url($file->file)}}" data-fancybox="gallery">
                                  <img class="uploaded-files__image-preview"
                                       src="{{Storage::url($file->file)}}"
                                       alt="">
                                </a>
                              @elseif($contentType==$pdf)
                                <div class="d-flex flex-wrap">
                                  <iframe src="{{Storage::url($file->file)}}"
                                          class="uploaded-files__pdf-preview"></iframe>
                                  <a href="{{Storage::url($file->file)}}" class="btn btn-outline-info mt-2" data-fancybox="pdf">
                                    <i class="fas fa-compress"></i> {{__('regular.fullscreen')}}
                                  </a>
                                </div>
                              @else
                                <a href="{{Storage::url($file->file)}}"
                                   class="btn btn-sm bg-info-light">
                                  <i class="far fa-eye"></i> {{__('regular.view')}}
                                </a>
                              @endif
                            </td>
                            <td class="col-2 d-flex flex-wrap">
                              <a href="{{Storage::url($file->file)}}"
                                 download="{{$file->name}}"
                                 class="btn btn-sm bg-success-light flex-basis-100">
                                <i class="fas fa-download"></i> {{__('regular.download')}}
                              </a>
                              <form action="{{route('patient.remove-files')}}" method="Post">
                                @csrf
                                <input type="hidden" name="id" value="{{$file->id}}">
                                <button class="btn bg-danger-light mt-2">
                                  <i class="fas fa-trash"></i>
                                </button>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->
  </div>
@endsection
