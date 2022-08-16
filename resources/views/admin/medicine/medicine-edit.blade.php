@extends('layout.mainlayout_admin')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Edit Medicine</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.medicine-list')}}">Medicine
                                    List</a></li>
                            <li class="breadcrumb-item active">Edit Medicine</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="card" action="{{route('admin.medicine-edit-submit')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$medicine->id}}">
                        <div class="card-header">
                            <h2><input name="name" class="form-control title-medicine" type="text"
                                       value="{{$medicine->name}}"></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img class="avatar avatar-medicine" style="cursor: pointer" onclick="$('#fileUpload').click()" src="{{Storage::url($medicine->image)}}" alt="">
                                    <input type="file" id="fileUpload" name="image" class="d-none">
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <h4>Price</h4>
                                        <input name="price" type="number" class="form-control" step="0.01" min="0" placeholder="10.50"
                                               value="{{$medicine->price}}">
                                    </div>
                                    <div class="form-group">
                                        <h4>Description</h4>
                                        <textarea class="form-control" name="description"
                                                  rows="5">{{$medicine->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <h4>Gallery</h4>
                                <div class="dropzone form-control"></div>
                            </div>
                            <div class="row my-2 multiline-input__js">
                                <h4>Composition</h4>
                                @if($medicine->sostav??false and $medicine->sostav!='')
                                    @foreach(explode('\,/', $medicine->sostav) as $item)
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="sostav[]" class="form-control new-line__js"
                                                   value="{{$item}}">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="sostav[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                @endif
                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="sostav[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>

                            <div class="row my-2 multiline-input__js">
                                <h4>Dosage</h4>
                                @if($medicine->doz??false and $medicine->doz!='')
                                    @foreach(explode('\,/', $medicine->doz) as $item)
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="doz[]" class="form-control new-line__js"
                                                   value="{{$item}}">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="doz[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                @endif

                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="doz[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>

                            <div class="row my-2 multiline-input__js">
                                <h4>Contraindications</h4>
                                @if($medicine->protiv??false and $medicine->protiv!='')
                                    @foreach(explode('\,/', $medicine->protiv) as $item)
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="protiv[]" class="form-control new-line__js"
                                                   value="{{$item}}">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="protiv[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                @endif

                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="protiv[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>

                            <div class="row my-2">
                                <h4>Name of Firm</h4>
                                <div class="mb-1 col-12 d-flex">
                                    <input type="text" name="manufacter" class="form-control" placeholder="" value="{{$medicine->manufacter??null}}">
                                </div>

                                <h4>Address</h4>
                                <div class="mb-1 col-12 d-flex">
                                    <input type="text" name="manufacter_address" class="form-control" placeholder="" value="{{$medicine->manufacter_address??null}}">
                                </div>

                                <h4>Phone Number of Firm</h4>
                                <div class="mb-1 col-12 d-flex">
                                    <input type="text" name="manufacter_phone" class="form-control" placeholder="" value="{{$medicine->manufacter_phone??null}}">
                                </div>
                            </div>

                            <div class="row my-2 multiline-input__js">
                                <h4>Diseases</h4>
                                @if($medicine->diseases??false and $medicine->diseases!='')
                                    @foreach(explode('\,/', $medicine->diseases) as $item)
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="diseases[]" class="form-control new-line__js"
                                                   value="{{$item}}">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="diseases[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                @endif

                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="diseases[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                                <button class="btn btn-warning text-light" onclick="window.location.reload();">Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
@endsection

@section('header-css')
    <link rel="stylesheet" href="{{asset('/js/dropzone/basic.min.css')}}">
    <link rel="stylesheet" href="{{asset('/js/dropzone/dropzone.min.css')}}">
@endsection

@section('footer-script')
    <script src="{{asset('/js/dropzone/dropzone.min.js')}}"></script>

    <script>
        Dropzone.autoDiscover = false;
        let gallery = $(".dropzone").dropzone({
            url: "{{route('admin.medicine-image-upload', ['id' => $medicine->id])}}",
            init: function () {
                this.on("addedfile", function (file) {
                    // Create the remove button
                    let removeButton = Dropzone.createElement(`<a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove image</a>`);
                    // Capture the Dropzone instance as closure.
                    let _this = this;
                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _this.removeFile(file);
                        $.ajax({
                            method: 'POST',
                            url: '{{route('admin.medicine-image-delete', ['id' => $medicine->id])}}',
                            data: {
                                file: file.dataURL,
                            }
                        })
                    });
                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });


                let images = '{{$medicine->gallery}}'.split(',');
                images.forEach((value, index) => {
                    if (value === '') return;

                    let mockFile = {name: "image", size: 0};
                    this.displayExistingFile(mockFile, "/storage/" + value);
                })
            }
        });
    </script>
@endsection
