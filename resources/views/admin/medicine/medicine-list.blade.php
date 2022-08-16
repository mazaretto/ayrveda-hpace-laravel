@extends('layout.mainlayout_admin')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title d-flex justify-content-between">Medicine List
                            <a href="#" class="btn btn-primary text-light" data-toggle="modal"
                               data-target="#add_medicine">Add Medicine</a></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Medicine List</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-stripped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($medicines as $medicine)
                                        <tr>
                                            <td>{{$medicine->name}}</td>
                                            <td>{{$medicine->price}}</td>
                                            <td>
                                                <div class="avatar avatar-xl">
                                                    <img class="avatar-img rounded" src="{{Storage::url($medicine->image)}}" alt="">
                                                </div>
                                            </td>
                                            <td>
                                              @if(strlen($medicine->description) > 50)
                                                {{mb_substr($medicine->description, 0, 50).'...'}}
                                              @else
                                                {{$medicine->description}}
                                              @endif
                                            </td>
                                            <td>
                                                <a href="{{route('admin.medicine-edit', ['id'=>$medicine->id])}}" class="btn btn-success"><i class="fe fe-edit"></i> Edit</a>
                                                <form action="{{route('admin.medicine-delete')}}" method="Post">
                                                    @csrf
                                                    <input type="hidden" value="{{$medicine->id}}" name="id">
                                                    <button class="btn btn-danger mt-1" type="submit"><i class="fe fe-close"></i> Delete
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

            <!-- Add Medical Records Modal -->
            <div class="modal fade custom-modal" id="add_medicine">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">New Medicine</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{route('admin.medicine-add')}}" method="Post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="required">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name of Medicine" required>
                                </div>
                                <div class="form-group">
                                    <label class="required">Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="10.50" min="0" step="0.01" required>
                                </div>
                                <div class="form-group">
                                    <label class="required">Image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="required">Description</label>
                                    <textarea class="form-control" name="description" rows="5" required></textarea>
                                </div>
                                <div class="submit-section text-center">
                                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    <button type="button" class="btn btn-secondary submit-btn" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Add Medical Records Modal -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
@endsection
