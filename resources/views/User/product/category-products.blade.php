@extends('User.layouts.master')

@section('extra_css')
    <style>
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: visible;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.3);
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 1500ms infinite linear;
            -moz-animation: spinner 1500ms infinite linear;
            -ms-animation: spinner 1500ms infinite linear;
            -o-animation: spinner 1500ms infinite linear;
            animation: spinner 1500ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@stop

@section('content')

    <div class="breadcumb-area breadcumb-2 overlay pos-rltv" style="background-image: url({{ URL::to(str_replace('\\', '/', $category->image)) }})!important; object-fit: cover; object-position: center; background-size: cover; background-position: center">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Product Grid View</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">{{ $category->name }}</li>
            </ol>
        </div>
    </div>
    <!--breadcumb area end -->
    <div class="loading" style="display: none;">Loading&#8230;</div>
    <!--shop main area are start-->
    <div class="shop-main-area ptb-70">
        <div class="container">
            <div class="row">
                <!--shop sidebar start-->
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="shop-sidebar">
                            <!--single aside start-->
                            @include('User.product.product-sidebar')
                            <!--single aside end-->
                        </div>
                    </div>
                </div>
                <!--shop sidebar end-->

                <!--main-shop-product start-->
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="shop-wraper">
                        <div class="clearfix"></div>
                        <div class="shop-total-product-area clearfix mt-35">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--tab grid are start-->
                                <div role="tabpanel" class="tab-pane fade in active" id="grid">
                                    <div class="total-shop-product-grid">
                                        @foreach($products as $product)
                                            <div class="col-md-4 col-sm-6 item">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        @if(isset($product->is_new_arrival))
                                                            <div class="product-label red">
                                                                <div class="new">New</div>
                                                            </div>
                                                        @endif
                                                        @if(isset($product->discount))
                                                            <div class="product-label red">
                                                                <div class="new" style="margin-left: 144px">Sale</div>
                                                            </div>
                                                        @endif
                                                        <div class="single-prodcut-img  product-overlay pos-rltv">
                                                            <a href="{{ route('specific.product', $product->slug) }}"> <img alt="" @foreach($product->images as $image)src="{{ URL::to($image->large_image) }}" height="272" width="392"  class="primary-image" @endforeach style="object-fit: cover; object-position: center"> </a>
                                                        </div>
                                                        <div class="product-icon socile-icon-tooltip text-center">
                                                            <ul class="hidden-xs">
                                                                @if(Auth::check())
                                                                    <li class="hidden-xs"><a onclick="addToWishList(this)" data-id="{{ $product->id }}" data-tooltip="Wishlist" class="w-list"><i class="fa fa-heart-o"></i></a></li>
                                                                @endif
                                                                <li class="hidden-xs"><a  data-id="{{ $product->id }}" data-route="{{ route('specific.product', $product->slug) }}" onclick="openModal({{$product->id}});" data-tooltip="Quick View" class="q-view"   ><i class="fa fa-eye"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-text">
                                                        <div class="prodcut-name"> <a href="single-product.html">{{ $product->name }}</a> </div>
                                                        <div class="prodcut-ratting-price">
                                                            <div class="prodcut-price">
                                                                <div class="new-price">@if(isset($product->discount)){{ number_format($product->selling_price - ($product->discount->discount->discount / 100 * $product->selling_price)) }} @else {{ number_format($product->selling_price) }}@endif</div>
                                                                <div class="old-price"> <del>@if(isset($product->discount)){{ number_format($product->selling_price) }} @else {{ number_format($product->cost_price) }}@endif</del> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single product end-->
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!--shop grid are end-->

                                <!--shop product list start-->
                                <!--shop product list end-->
                                <!--pagination start-->
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="pagination-btn text-center">
                                        <ul class="page-numbers">
                                            {{ $products->render() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--pagination end-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--main-shop-product start-->
            </div>
        </div>
    </div>



    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade modals" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <div class="product-images">
                                <!--modal tab start-->
                                <div class="portfolio-thumbnil-area-2" >
                                    <div class="tab-content active-portfolio-area-2" id="large_view">
                                        <div role="tabpanel" class="tab-pane active" id="view1">
                                            <div class="product-img">
                                                <a href="#"><img src="{{ URL::to('user_ui/images/product/01.jpg') }}" alt="Single portfolio" /></a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="product-more-views-2" style="margin-top:196px!important">
                                        <div class="thumbnail-carousel-modal-2" data-tabs="tabs">
                                            <a href="#view1" aria-controls="view1" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/01.jpg') }}" alt="" /></a>
                                            <a href="#view2" aria-controls="view2" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/02.jpg') }}" alt="" /></a>
                                            <a href="#view3" aria-controls="view3" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/03.jpg') }}" alt="" /></a>
                                            <a href="#view4" aria-controls="view4" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/04.jpg') }}" alt="" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--modal tab end-->
                            <!-- .product-images -->
                            <div class="product-info">
                                <h1 class="product-name"></h1>
                                <div class="price-box-3">
                                    <div class="s-price-box"> <span class="new-price">$160.00</span> <span class="old-price">$190.00</span> </div>
                                </div> <a href="" class="see-all">See all features</a>
                                <div class="quick-add-to-cart">
                                    <div class="single-product-option">
                                        <div class="sort product-type colors">
                                            <label>Color: </label>
                                            <select id="input-sort-color">
                                                <option value="#" selected>Chose Your Color</option>
                                                <option class="all" name="color_id" value="#">Red</option>

                                            </select>
                                        </div>
                                        <div class="sort product-type sizes">
                                            <label>Size: </label>
                                            <select id="input-sort-size" style="margin-left: 32px!important">
                                                <option  class="allsize" name="size_id" value=""></option>
                                            </select>
                                        </div>

                                        <div class="sort product-type quantity ">
                                            <label>Stock Left:</label><span>1</span>
                                        </div>
                                    </div>
                                    <div class="numbers-row">
                                        <input type="number" id="french-hens" class="quan-empty" name="quantity" disabled value="1" min="1" max="10" > </div>
                                    <a style="cursor: pointer" class="single_add_to_cart_button" type="submit" onclick="addToCart()"  >Add to cart</a>
                                    <input type="hidden" value="" name="product_id" class="myid">

                                    <div class="quick-desc" style="margin-top: 51px !important;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.Nam fringilla tristique auctor. </div>
                                    <div class="social-sharing-modal">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
                                            <ul class="social-icons-modal">
                                                <li><a target="_blank" title="Facebook" href="#" class="facebook m-single-icon"><i class="fa fa-facebook"></i></a></li>
                                                <li><a target="_blank" title="Twitter" href="#" class="twitter m-single-icon"><i class="fa fa-twitter"></i></a></li>
                                                <li><a target="_blank" title="Pinterest" href="#" class="pinterest m-single-icon"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a target="_blank" title="Google +" href="#" class="gplus m-single-icon"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a target="_blank" title="LinkedIn" href="#" class="linkedin m-single-icon"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- .product-info -->
                            </div>
                            <!-- .modal-product -->
                        </div>
                        <!-- .modal-body -->
                    </div>
                    <!-- .modal-body -->
                </div>
                <!-- .modal-content -->
            </div>
            <!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>


@stop


@section('extra_js')


@stop