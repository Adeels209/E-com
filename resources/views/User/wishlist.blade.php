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
    <div class="breadcumb-area overlay pos-rltv">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Cart Details</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">Cart</li>
            </ol>
        </div>
    </div>
    <!--breadcumb area end -->

    <!--cart-checkout-area start -->
    <div class="cart-checkout-area  pt-30">
        <div class="container">
            <div class="row">
                <div class="product-area">
                    <div class="title-tab-product-category">
                        <div class="col-md-12 text-center pb-60">
                            <ul class="nav heading-style-3" role="tablist">
                                <li role="presentation" class="active shadow-box"><a href="#cart" aria-controls="cart" role="tab" data-toggle="tab"><span></span> Shopping cart</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="content-tab-product-category pb-70">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="cart">
                                    <!-- cart are start-->
                                    <div class="cart-page-area">
                                        <div class="table-responsive mb-20">
                                            <table class="shop_table-2 cart table table-responsive">
                                                <thead>
                                                <tr>
                                                    <th class="product-thumbnail ">Image</th>
                                                    <th class="product-name ">Product Name</th>
                                                    <th class="product-price ">Unit Price</th>
                                                    <th class="product-subtotal ">Stock</th>
                                                    <th class="product-quantity">Add Item</th>
                                                    <th class="product-remove">Remove</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($wishlistProducts as $wishlist)
                                                <tr class="cart_item del" data-id="{{ $wishlist->id }}">
                                                    <td class="item-img">
                                                        <a href="#"><img style="object-position: center; object-fit: cover" src="@if(isset($wishlist->product->images)){{ URL::to($wishlist->product->images[0]->small_image) }}@endif" alt=""> </a>
                                                    </td>
                                                    <td class="item-title"> <a href="#">{{ $wishlist->product->name }}</a></td>
                                                    <td class="item-price"> {{ number_format($wishlist->product->selling_price) }} </td>
                                                    <td class="item-qty">
                                                       @if($wishlist->product->stock->quantity > 0)
                                                           In-Stock
                                                           @else
                                                            Out Of Stock
                                                           @endif
                                                    </td>
                                                    <td class="total-price"><a  onclick="openModal({{$wishlist->product->id}});" data-tooltip="Quick View" class="q-view"   ><i style="color: red; font-size: 20px; cursor: pointer" class="fa fa-eye"></i></a></td>
                                                    <td class="remove-item"><a style="cursor: pointer" onclick="deleteWishlist('{{ $wishlist->id }}')" ><i class="fa fa-trash-o"></i></a></td>
                                                </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="cart-bottom-area" style="display: none;">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-7 col-xs-12">
                                                    <div class="update-coupne-area">
                                                        <div class="coupn-area">
                                                            <div class="catagory-title cat-tit-5 mb-20">
                                                                <h3>Coupon</h3>
                                                                <p>Enter your coupon code if you have one.</p>
                                                            </div>
                                                            <div class="input-box input-box-2 mb-20">
                                                                <input type="text" placeholder="Coupon" id="coupon" class="info" name="subject">
                                                            </div>
                                                            <a  class="btn-def btn2" onclick="checkCoupon()">Apply Coupn</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-5 col-xs-12">
                                                    <div class="cart-total-area">
                                                        <div class="catagory-title cat-tit-5 mb-20 text-right">
                                                            <h3>Cart Totals</h3>
                                                        </div>
                                                        <div class="sub-shipping">
                                                            <p>Shipping <span>RS 300</span></p>
                                                        </div>
                                                        <div class="process-cart-total">
                                                            <p>Total:<span id="total">@if(isset($total))RS {{$total}}@endif</span></p>
                                                        </div>
                                                        <div class="process-checkout-btn text-right">
                                                            <a class="btn-def btn2" href="{{ route('checkout') }}">Proceed To Checkout</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- cart are end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
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
                                        <input type="number" id="french-hens" class="quan-empty" name="quantity" value="1" min="1" max="10" disabled> </div>
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
        <script>
            function addToCartWishlist() {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                var id = $('input[name=product_id]').val();

                var quan = 1;
                if(quan<=0){
                    toastr.error("Quantity Must Be Greater Then Zero");
                    return false;
                }

                if(cid<=0){
                    toastr.error("Color Must be selected");
                    return false;
                }
                if(sid<=0){
                    toastr.error("Size Myst Be Selected");
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
                        // console.log(data.cart.quantity);
                        if(data.status == 500){
                            toastr.error("Sorry, this item can't be added because you have maximum quantity of the product in your cart")
                        }
                        if(data.status == 300){
                            toastr.error("Size is not valid");
                        }
                        if (data.response == -1) {
                            toastr.error("Quantity cannot be more then Ten");
                        } else {
                            // console.log(data.cart_total);
                            if (data.status == 200) {
                                $('#productModal').modal("hide");
                                $('#total').text('RS ' + data.cart_total);
                                $('.cart-price' + data.cart.id).text(data.cart.price);
                                $('#product_quantity' + data.cart.id).text(data.cart.qty);
                                $('#quantity').text(data.count);
                                var route = window.origin.location;
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
                                $('#total').text(data.cart_total);
                                $('#quantity').text(data.count);
                                toastr.success("Product Added To Cart");
                                var elem = document.getElementById("header");
                                elem.scrollIntoView({behavior: 'smooth'});
                            } else {
                                if (data.status == -200) {
                                    toastr.error('Product is out of stock');
                                    // console.log(data);
                                } else {
                                    if(data.status == 400) {
                                        toastr.success('Product quantity updated');
                                        $("#product_quantity[data-id="+data.cart_product.product_id+"]").html('RS ' + data.cart.quantity)
                                    }
                                }
                            }
                        }
                    }
                });
            }
        </script>

        <script>
            function deleteWishlist(id) {
                // console.log(id);
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Cancel!",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: false,
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: false
                        }
                    }
                })
                    .then(isConfirm => {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ route('wishlist.remove') }}",
                                type: 'post',
                                data: {
                                    id: id,
                                    _token:CSRF_TOKEN,
                                },
                                dataType: 'JSON',
                                success: function (data) {
                                    console.log(data);
                                    if (data.status == 200) {
                                        swal(" Product has been removed from wishlist!", {
                                            icon: "success",
                                        });
                                        $(".del[data-id="+id+"]").remove();

                                        // console.log(id);
                                    }
                                    if (data.status == -1) {
                                        swal("Cancelled", "It's safe.", "error");
                                    }
                                },
                            });
                        } else {
                            swal("Cancelled", "It's safe.", "error");
                        }
                    });
            }
        </script>
        @stop