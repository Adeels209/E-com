@extends('admin::layouts.master')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <form id="myForm" class="form" action="{{ route('admin.sitesettings.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="form-section"><i class="la la-info"></i>Site Settings</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="{{$siteSettings[0]->id}}"/>
                                                    <label for="facebook_link">Facebook Link *</label>
                                                    <input type="text" id="facebook_link" class="form-control" value="{{$siteSettings[0]->facebook_link}}" name="facebook_link" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="twitter_link">Twitter Link *</label>
                                                    <input type="text" id="twitter_link" class="form-control" value="{{$siteSettings[0]->twitter_link}}" name="twitter_link" required>
                                                </div>
                                            </div>
                                        </div>
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <label for="instagram_link">Instagram Link *</label>
                                                       <input type="text" id="instagram_link" class="form-control" value="{{$siteSettings[0]->instagram_link}}" name="instagram_link" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <input type="hidden" name="id" value="{{$siteSettings[0]->id}}"/>
                                                       <label for="email">Email *</label>
                                                       <input type="text" id="email" class="form-control" value="{{$siteSettings[0]->email}}" name="email" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="form-group">
                                                       <input type="hidden" name="id" value="{{$siteSettings[0]->id}}"/>
                                                       <label for="email">Phone Number *</label>
                                                       <input type="text" id="email" class="form-control" value="{{$siteSettings[0]->phonenumber}}" name="phonenumber" required>
                                                   </div>
                                               </div>
                                           </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="logo_header">Logo Header *</label>
                                                <input type="file" class="dropify" data-height="300"  name="logo_header" data-default-file="{{URL::to($siteSettings[0]->logo_header)}}"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group col-md-6" style="margin-top: 10px;">
                                            <label for="select">Choose Footer On Sale Product First</label>
                                            <select class="form-control" name="sale_one">
                                                @foreach($productSale as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" style="margin-top: 10px;">
                                            <label for="select">Choose Footer On Sale Product Second</label>
                                            <select class="form-control " name="sale_two" >
                                                @foreach($productSale as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6" style="margin-top: 10px;">
                                                <label for="select">Choose Footer Featured Product First</label>
                                                <select class="form-control " name="is_featured_one" >
                                                    @foreach($productFeatured as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" style="margin-top: 10px;">
                                                <label for="select">Choose Footer Featured Product Second</label>
                                                <select class="form-control " name="is_featured_two" >
                                                    @foreach($productFeatured as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('extra_js')
    <script src="{{URL::to('app-assets/css/pages/dropify/js/dropify.min.js')}}"></script>
    <script src="{{URL::to('app-assets/css/pages/dropify/dropify.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
            $('.sale_product1').select2();
            $('.sale_product2').select2();
            $('.featured_product1').select2();
            $('.featured_product2').select2();
        });
    </script>

    <script>
    
    </script>
@endsection