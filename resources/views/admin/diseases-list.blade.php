@extends('layout.mainlayout_admin')

@section('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"
            integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg=="
            crossorigin="anonymous"></script>
    <script>
        function collapse(element) {
            let el = $(element)
            if (el.hasClass('fa-sort-up')) {
                el.removeClass('fa-sort-up')
                el.addClass('fa-sort-down')
                el.closest('.diseases-main').find('.diseases-list').addClass('active')
            } else if (el.hasClass('fa-sort-down')) {
                el.removeClass('fa-sort-down')
                el.addClass('fa-sort-up')
                el.closest('.diseases-main').find('.diseases-list').removeClass('active')
            }
        }

        function addDisease(element) {
            $(element).before('<li class="pb-1 d-flex flex-nowrap"><input type="text" class="form-control" placeholder="Disease"><i class="fa fa-trash text-danger mt-auto mb-auto pl-1" onclick="deleteDisease(this)"></i></li>')
        }

        function deleteDisease(element) {
            $(element).closest('li').remove()
        }

        function addDiseaseCategory(element) {
            let dis = $('#disease-new-category').clone().removeAttr('id')
            $(element).before(dis)
        }

        function deleteDiseaseCategory(element) {
            $(element).closest('.diseases-main').remove()
        }

        function getDiseases(element) {
            let diseaseCategory = $('.diseases-main').not('#disease-new-category')
            let all = []
            diseaseCategory.each(function () {
                let categoryName = $(this).find('.diseases-title').val()
                let diseases = []
                $(this).find('.diseases-list>li>input').each(function () {
                    diseases.push($(this).val())
                })
                all.push({
                    'title': categoryName,
                    'diseases': diseases
                })
            })
            let allData = JSON.stringify(all)
            console.log(allData)
            axios.post('{{route('admin.diseases-set')}}', {
                data: allData
            }).then(r => {
                if (r.data === 'ok') {
                    clearDiseases()
                }
            })
        }

        function clearDiseases() {
            window.location.reload()
        }
    </script>
@endsection
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Diseases List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Diseases List</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="row mb-3">
                        <button class="btn btn-success" onclick="getDiseases(this)">Submit</button>
                        <button class="btn btn-warning text-light ml-2" onclick="clearDiseases(this)">Roll back</button>
                    </div>

                    <small><b>Example:</b> Сердечные||Cardio <em class="font-weight-bold">RU||EN</em></small>
                    @if($diseases)
                        @foreach($diseases as $disease)
                            <div class="diseases-main col-12">
                                <div class="row flex-nowrap">
                                    <i class="fa fa-sort-up mt-auto mb-auto pr-1 collapse-dis" style="font-size: 20px;"
                                       onclick="collapse(this)"></i>
                                    <input type="text" class="form-control diseases-title" placeholder="Disease category"
                                           value="{{$disease->title}}">
                                    <i class="fa fa-trash text-danger mt-auto mb-auto pl-1"
                                       onclick="deleteDiseaseCategory(this)"></i>
                                </div>
                                <ul class="diseases-list">
                                    @foreach($disease->diseases as $row)
                                        <li class="pb-1 d-flex flex-nowrap">
                                            <input type="text" class="form-control" placeholder="Disease" value="{{$row}}">
                                            <i class="fa fa-trash text-danger mt-auto mb-auto pl-1"
                                               onclick="deleteDisease(this)"></i>
                                        </li>
                                    @endforeach
                                    <a href="javascript:void(0)" class="mt-1" onclick="addDisease(this)">Add Disease</a>
                                </ul>
                            </div>
                        @endforeach
                    @endif
                    <a href="javascript:void(0)" class="d-block my-2" onclick="addDiseaseCategory(this)">Add Disease
                        Category</a>
                </div>
            </div>

            <div style="display: none">
                <div class="diseases-main col-12" id="disease-new-category">
                    <div class="row flex-nowrap">
                        <i class="fa fa-sort-up mt-auto mb-auto pr-1 collapse-dis" style="font-size: 20px;"
                           onclick="collapse(this)"></i>
                        <input type="text" class="form-control diseases-title" placeholder="Disease category">
                        <i class="fa fa-trash text-danger mt-auto mb-auto pl-1"
                           onclick="deleteDiseaseCategory(this)"></i>
                    </div>
                    <ul class="diseases-list">
                        <li class="pb-1 d-flex flex-nowrap">
                            <input type="text" class="form-control" placeholder="Disease"><i
                                class="fa fa-trash text-danger mt-auto mb-auto pl-1" onclick="deleteDisease(this)"></i>
                        </li>
                        <a href="javascript:void(0)" class="mt-1" onclick="addDisease(this)">Add Disease</a>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
@endsection
