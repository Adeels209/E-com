@extends('User.layouts.master')
@section('extra_css')
    <style>
        .input-number {
            width: 80px;
            padding: 0 12px;
            vertical-align: top;
            text-align: center;
            outline: none;
        }

        .input-number,
        .input-number-decrement,
        .input-number-increment {
            border: 1px solid #ccc;
            height: 40px;
            user-select: none;
        }

        .input-number-decrement,
        .input-number-increment {
            display: inline-block;
            width: 30px;
            line-height: 38px;
            background: #f1f1f1;
            color: #444;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
        }
        .input-number-decrement:active,
        .input-number-increment:active {
            background: #ddd;
        }

        .input-number-decrement {
            border-right: none;
            border-radius: 4px 0 0 4px;
        }

        .input-number-increment {
            border-left: none;
            border-radius: 0 4px 4px 0;
        }

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
    <div class="breadcumb-area overlay pos-rltv" style="background-image: url({{ URL::to(str_replace('\\', '/', $product->category->image)) }})!important; object-fit: cover; object-position: center; background-size: cover; background-position: center">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Prodcut Details</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">product-details</li>
            </ol>
        </div>
    </div>
    <!--breadcumb area end -->
    <div class="loading" style="display: none;">Loading&#8230;</div>
    <!--single-protfolio-area are start-->
    <div class="single-protfolio-area ptb-70">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <div class="portfolio-thumbnil-area">
                        <div class="product-more-views">
                            <div class="tab_thumbnail" data-tabs="tabs">
                                <div class="thumbnail-carousel">
                                    <ul>
                                        <li class="active">
                                            <a href="#view11" class="shadow-box" aria-controls="view11" data-toggle="tab"><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[0])){{URL::to($product->images[0]->medium_image)}}@endif" alt="" /></a></li>
                                        <li>
                                            <a href="#view22" class="shadow-box" aria-controls="view22" data-toggle="tab"><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[1])){{URL::to($product->images[1]->medium_image)}}@endif" alt="" /></a></li>
                                        <li>
                                            <a href="#view33" class="shadow-box" aria-controls="view33" data-toggle="tab"><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[2])){{URL::to($product->images[2]->medium_image)}}@endif" alt="" /></a></li>
                                        <li>
                                            <a href="#view44" class="shadow-box" aria-controls="view44" data-toggle="tab"><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[3])){{URL::to($product->images[3]->medium_image)}}@endif" alt="" /></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content active-portfolio-area pos-rltv">
                            <div class="social-tag">
                                <a href="#"><i class="zmdi zmdi-share"></i></a>
                            </div>
                            <div role="tabpanel" class="tab-pane active" id="view11">
                                <div class="product-img">
                                    <a class="fancybox" data-fancybox-group="group" href="@if(isset($product->images[0])){{URL::to($product->images[0]->large_image)}}@endif" style="object-fit: cover; object-position: center" ><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[0])){{URL::to($product->images[0]->original_image)}}@endif" alt="Single portfolio" /></a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="view22">
                                <div class="product-img">
                                    <a class="fancybox" data-fancybox-group="group" href="@if(isset($product->images[1])){{URL::to($product->images[1]->large_image)}}@endif" style="object-fit: cover; object-position: center" ><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[1])){{URL::to($product->images[1]->original_image)}}@endif" alt="Single portfolio" /></a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="view33">
                                <div class="product-img">
                                    <a class="fancybox" data-fancybox-group="group" href="@if(isset($product->images[2])){{URL::to($product->images[2]->large_image)}}@endif" style="object-fit: cover; object-position: center" ><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[2])){{URL::to($product->images[2]->original_image)}}@endif" alt="Single portfolio" /></a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="view44">
                                <div class="product-img">
                                    <a class="fancybox" data-fancybox-group="group" href="@if(isset($product->images[3])){{URL::to($product->images[3]->large_image)}}@endif" style="object-fit: cover; object-position: center" ><img style="object-fit: cover; object-position: center" src="@if(isset($product->images[3])){{URL::to($product->images[3]->original_image)}}@endif" alt="Single portfolio" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="single-product-description">
                        <div class="sp-top-des">
                            <h3>{{ $product->name }}<span>({{ $product->brand->name }})</span></h3>
                            <div class="prodcut-ratting-price">
                                <div class="prodcut-price">
                                    <div class="new-price">RS @if(isset($product->discount)){{ number_format($product->selling_price - ($product->discount->discount->discount / 100 * $product->selling_price)) }} @else {{ number_format($product->selling_price) }}@endif</div>
                                    <div class="old-price"> <del> RS @if(isset($product->discount)){{ number_format($product->selling_price) }} @else {{ number_format($product->cost_price) }}@endif</del> </div>
                                </div>
                            </div>
                        </div>

                        <div class="sp-des">
                            <p>{{ $product->short_description }}</p>
                        </div>
                        <div class="sp-bottom-des">
                            <div class="single-product-option">
                                <div class="sort product-type">
                                    <label>Color: </label>
                                    <select id="input-sort-color" >
                                        @foreach($product->colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sort product-type">
                                    <label>Size: </label>
                                    <select id="input-sort-size">
                                        @foreach($product->sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="quantity-area">
                                <label>Qty :</label>
                                <div class="cart-quantity">
                                    <form action="#" method="POST" id="myform">
                                        <div class="product-qty">
                                            <div class="cart-quantity">
                                                <div class="cart-plus-minus">
                                                    <span class="input-number-decrement">–</span><input class="input-number" type="text" value="1" min="0" max="{{ $product->stock->quantity }}" name="qty"><span class="input-number-increment">+</span>
                                                    <input type="hidden" class="helper-slug" value="{{ $product->slug }}">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="">
                                <p>@if($product->stock->quantity > 0) In-Stock @else Out Of Stock @endif</p>
                            </div>
                            <div class="social-icon socile-icon-style-1">
                                <ul id="">

                                    <li id="first-react-component" style="cursor: pointer"></li>
                                    @if(count($product->panoramaImages) > 0)
                                            <li style="cursor: pointer"><a onclick="viewPanorama()" data-tooltip="View 360 Image" class="add-cart add-cart-text" data-placement="left" tabindex="0">View 360 image</a></li>
                                        @endif
                                    <input type="hidden" value="{{ $product->id }}" name="product__id" class="myid">
                                    @if(Auth::check())
                                        <li><a data-id="{{ $product->id }}" onclick="addToWishList(this)" data-tooltip="Wishlist" class="w-list" tabindex="0"><i class="fa fa-heart-o"></i></a></li>
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--single-protfolio-area are start-->

    <!--descripton-area start -->
    <div class="descripton-area">
        <div class="container">
            <div class="row">
                <div class="product-area tab-cars-style">
                    <div class="title-tab-product-category">
                        <div class="col-md-12 text-center">
                            <ul class="nav mb-40 heading-style-2" role="tablist">
                                <li role="presentation" class="active"><a href="#newarrival" aria-controls="newarrival" role="tab" data-toggle="tab">Description</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="content-tab-product-category active">
                            <!-- Tab panes -->
                            <div class="tab-content active">
                                <div role="tabpanel" class="tab-pane fix fade in active" id="newarrival">
                                    <div class="review-wraper">
                                        <h5>Summary</h5>
                                        <p>{{ $product->short_description }}</p>
                                        <h5>Details</h5>
                                        <p>{{ strip_tags($product->long_description) }}.</p>
                                    </div>
                                </div>
                                {{--<div role="tabpanel" class="tab-pane fix fade in active" id="bestsellr">--}}
                                    {{--<div class="review-wraper">--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim <br> veniam, quis nostrud exercitation.</p>--}}
                                        {{--<h5>SIZE & FIT</h5>--}}
                                        {{--<ul>--}}
                                            {{--<li>Model wears: Style Photoliya U2980</li>--}}
                                            {{--<li>Model's height: 185”66</li>--}}
                                        {{--</ul>--}}
                                        {{--<h5>ABOUT ME</h5>--}}
                                        {{--<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>--}}
                                        {{--<h5>Overview</h5>--}}
                                        {{--<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div role="tabpanel" class="tab-pane fix fade in" id="specialoffer">
                                    <ul class="tag-filter">
                                        <li><a href="#">Fashion</a></li>
                                        <li><a href="#">Women</a></li>
                                        <li><a href="#">Winter</a></li>
                                        <li><a href="#">Street Style</a></li>
                                        <li><a href="#">Style</a></li>
                                        <li><a href="#">Shop</a></li>
                                        <li><a href="#">Collection</a></li>
                                        <li><a href="#">Spring 2016</a></li>
                                        <li><a href="#">Street Style</a></li>
                                        <li><a href="#">Style</a></li>
                                        <li><a href="#">Shop</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--descripton-area end-->

    <!--new arrival area start-->
    <div class="new-arrival-area ptb-70">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="heading-title heading-style pos-rltv mb-50 text-center">
                        <h5 class="uppercase">Related Product</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="total-new-arrival new-arrival-slider-active carsoule-btn">
                    @foreach($products as $product)
                    <div class="col-md-3">
                        <!-- single product start-->
                        <div class="single-product">
                            <div class="product-img">
                                <div class="product-label">
                                    <div class="new">New</div>
                                </div>
                                <div class="single-prodcut-img  product-overlay pos-rltv">
                                    <a href="{{ route('specific.product', $product->slug) }}"> <img alt="" width="272" height="390" style="object-fit: cover; object-position: center"  src="@if(isset($product->images[0])){{URL::to($product->images[0]->medium_image)}}@endif" class="primary-image"> </a>
                                </div>
                                <div class="product-icon socile-icon-tooltip text-center">
                                    <ul>
                                        @if(Auth::check())
                                            <li class="hidden-xs"><a onclick="addToWishList(this)" data-id="{{ $product->id }}" data-tooltip="Wishlist" class="w-list"><i class="fa fa-heart-o"></i></a></li>
                                        @endif
                                        <li class="hidden-xs"><a  data-id="{{ $product->id }}" data-route="{{ route('specific.product', $product->slug) }}" onclick="openModal({{$product->id}});" data-tooltip="Quick View" class="q-view"   ><i class="fa fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-text">
                                <div class="prodcut-name"> <a href="{{ route('specific.product', $product->slug) }}">{{ $product->name }}</a> </div>
                                <div class="prodcut-ratting-price">
                                    <div class="prodcut-price">
                                        <div class="new-price"> {{ number_format($product->selling_price) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end-->
                    </div>
                        @endforeach
                </div>
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
                                            <a href="#view1" aria-controls="view1" data-toggle="tab"><img src="" alt="" /></a>
                                            <a href="#view2" aria-controls="view2" data-toggle="tab"><img src="" alt="" /></a>
                                            <a href="#view3" aria-controls="view3" data-toggle="tab"><img src="" alt="" /></a>
                                            <a href="#view4" aria-controls="view4" data-toggle="tab"><img src="" alt="" /></a>
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
                                            <select id="input-sort-color-modal">
                                                <option class="all" name="color_id" value="">Red</option>

                                            </select>
                                        </div>
                                        <div class="sort product-type sizes">
                                            <label>Size: </label>
                                            <select id="input-sort-size-modal" style="margin-left: 32px!important">
                                                <option  class="allsize" name="size_id" value=""></option>
                                            </select>
                                        </div>

                                        <div class="sort product-type quantity ">
                                            <label>Stock Left:</label><span>1</span>
                                        </div>
                                    </div>
                                    <div class="numbers-row">
                                        <input type="number" id="french-hens" class="quan-empty" name="quantity" disabled value="1" min="1" max="" >
                                    </div>
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

    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade product-panorama-image" id="product-panorama-image" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="margin-top:159px!important">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product-360">
                            <div class="product-images-360">
                                <!--modal tab start-->
                                <div class="portfolio-thumbnil-area-2" >
                                    <div class="tab-content active-portfolio-area-2" id="large_view">
                                        <div role="tabpanel" class="tab-pane active" id="view1">

                                        </div>

                                        <div class="container text-center" style="">
                                            <canvas style="margin-right:598px; object-fit: cover; object-position: center" id="360viewer" width="458" height="458"></canvas>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--modal tab end-->
                            <!-- .product-images -->

                                <!-- .product-info -->
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
@endsection


@section('extra_js')
    <script>
        function addToCartSpecific() {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var id = $('input[name=product__id]').val();
            console.log(id);
            var cid = $('select[id=input-sort-color]').val();
            // console.log(cid);
            var sid = $('select[id=input-sort-size]').val();
            // console.log(sid);
            var quan = $('input[name=qty]').val();
            if(quan<=0){
                toastr.error("Quantity Must Be Greater Then Zero");
                return false;
            }

            if(cid<=0){
                toastr.error("Color Must be selected");
                return false;
            }
            if(sid<=0){
                toastr.error("Size Must Be Selected");
                return false;
            }
            $.ajax({
                url: "{{ route('my.cart') }}",
                type: 'post',
                data: {
                    color_id: cid,
                    size_id: sid,
                    quantity: quan,
                    product_id: id,
                    _token: CSRF_TOKEN,
                },
                dataType: 'JSON',
                success: function (data) {
                    base_url = window.location.origin;
                    if(data.status == 600){
                        toastr.error("Requested Quantity exceeds the Product stock please lower your requested Quantity")
                    }
                    if(data.status == 500){
                        toastr.error("Sorry, this item can't be added because you have maximum quantity of the Product in your cart")
                    }
                    if(data.status == 300){
                        toastr.error("Size is not valid");
                    }
                    if (data.response == -1) {
                        toastr.error("Quantity cannot be more then Ten");
                    } else {
                        if (data.status == 200) {
                            $('#productModal').modal("hide");
                            $('#total').text('RS ' + data.cart_total);
                            $('.cart-price' + data.cart.id).text(data.cart.price);
                            $('#product_quantity' + data.cart.id).text(data.cart.qty);
                            $('#quantity').text(data.count);
                            var route = window.location.origin;
                            console.log(route);
                            var html = `<div class="cart-single-wraper" data-id="` + data.cart.id + `">
                            <div class="cart-img">
                                <a href="#">
                                    <img src="/` + data.cart_images[0].large_image + `" alt=""/>
                                    </a>
                            </div>
                           <div class="cart-content">
                                <div class="cart-name"> <a href="#"> Product Name: ` + data.cart_product.name + `</a> </div>
                                     <div class="cart-price` + data.cart.id + `">Price: RS ` + data.cart_product.selling_price + `</div>
                                     <div class="cart-qty>   <span id="product_quantity" data-id="` + data.cart.id + `"> Quantity: ` + data.cart.quantity + `</span> </div>
                                     <form action="`+route+`/remove/from/cart/` + data.cart.id + `" method="POST">
                                    @csrf
                                <div class="">
                                    <button type="submit"  class="remove" style="width: 25px!important; height: 25px!important"><i class="zmdi zmdi-close"></i></button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    `;
                $('.cart-content-wraper').prepend(html);
                $('#total').text("");
                $('#total').text("RS "+data.cart_total);
                $('#quantity').text(data.count);
                toastr.success("Product Added To Cart");
                var elem = document.getElementById("header");
                elem.scrollIntoView({behavior: 'smooth'});
            } else {
                if (data.status == -21) {
                    toastr.error('Product is out of stock');
                    // console.log(data);
                } else {
                    if(data.status == 400) {
                        toastr.success('Product quantity updated');
                        $("#product_quantity[data-id="+data.cart_product.id+"]").html("");
                        $("#product_quantity[data-id="+data.cart_product.id+"]").html('RS ' + data.cart.quantity)
                    }
                }
            }
        }
    }
});
}
</script>

    <script>
        (function() {

            window.inputNumber = function(el) {

                var min = el.attr('min') || false;
                var max = el.attr('max') || false;

                var els = {};

                els.dec = el.prev();
                els.inc = el.next();

                el.each(function() {
                    init($(this));
                });

                function init(el) {

                    els.dec.on('click', decrement);
                    els.inc.on('click', increment);

                    function decrement() {
                        var value = el[0].value;
                        value--;
                        if(!min || value >= min) {
                            el[0].value = value;
                        }
                    }

                    function increment() {
                        var value = el[0].value;
                        value++;
                        if(!max || value <= max) {
                            el[0].value = value++;
                        }
                    }
                }
            }
        })();

        inputNumber($('.input-number'));
    </script>
    <script>
        jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
        jQuery('.quantity').each(function() {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

            btnDown.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

        });
    </script>
    @stop