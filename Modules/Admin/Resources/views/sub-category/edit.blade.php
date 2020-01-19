@extends('admin::layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add Category</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Category</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form id="myForm" class="form" action="{{ route('admin.sub-category.update', $categoryy->id)}}" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Category Info</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Category Name *</label>
                                                            <input type="text" id="name" class="form-control cat_name" placeholder="Category Name" name="name" value="{{ $categoryy->name }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top: 10px;">
                                                    <label for="select">Choose Service Type</label>
                                                    <select class="form-control js-example-basic-multiple" name="category[]" multiple="multiple" id="select">
                                                        <option selected value="{{ $categoryy->parentCategory->id }}" class="select">{{ $categoryy->parentCategory->name }}</option>
                                                        @foreach($categories as $categorys)
                                                            <option value="{{ $categorys->id }}" class="select">{{ $categorys->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="detail">Category Detail *</label>
                                                            <textarea class="summernote-code description" name="description" required>{{ $categoryy->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="bg_image">Image *</label>
                                                            <input type="file" class="dropify" id="file" required data-height="200" name="image" data-default-file="{{URL::to($categoryy->image)}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <textarea name="" id="" class="t_area" style="display: none" cols="30" rows="10"></textarea>

                                                <div class="app-content content" style="display: none;">
                                                    <div class="content-wrapper">
                                                        <div class="content-body">
                                                            <section id="summernote-edit-save">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="card">
                                                                            <div class="card-content collapse show">
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <button id="edit" class="btn btn-primary" type="button" style="display: none;" ><i class="la la-pencil" ></i> Edit</button>
                                                                                        <button id="save" class="btn btn-success" type="button"><i class="la la-save"></i> Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="cancelFunction()">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop

@section('extra_scripts')
    <script src="{{URL::to('app-assets/css/pages/dropify/js/dropify.min.js')}}"></script>
    <script src="{{URL::to('app-assets/css/pages/dropify/dropify.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
            $('.js-example-basic-multiple').select2();
        });

    </script>
@stop