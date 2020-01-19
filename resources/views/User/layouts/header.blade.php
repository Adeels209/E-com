<header class="header-area header-wrapper" id="header">


    <div class="header-top-bar black-bg clearfix">
        <div class="container">
            <div class="row">
                @if(Auth::check())
                    <div class="col-md-3 col-sm-3">
                        <div class="login-register-area">
                            <ul>
                                <li><a href="{{ route('user.dashboard', Auth::user()->id) }}">{{ ucfirst(Auth::user()->fname) }}</a></li>
                                <li><a href="{{ route('user.logout') }}">Logout</a></li>
                                <li style="position: absolute">
                                    <div class="cart-icon" id="">
                                        <a href="{{ route('wishlist') }}">Wishlist<i class=""></i></a>
                                        <span id="wishlist-icon" style="margin-left: 4px!important">
                                            @if(isset($wishlistCount)){{$wishlistCount}}@else 0 @endif
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                <div class="col-md-3 col-sm-3 ">
                    <div class="login-register-area">
                        <ul>
                            <li><a href="{{ route('user.login') }}">Login</a></li>
                            <li style="cursor: pointer!important;"><a style="cursor: pointer!important;" href="{{ route('register.view') }}">Register</a></li>
                        </ul>
                    </div>
                </div>
                @endif
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <div class="social-search-area text-center">
                        <div class="social-icon socile-icon-style-2">
                            <ul>
                                <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a> </li>
                                <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a> </li>
                                <li> <a href="#" title="dribble"><i class="fa fa-dribbble"></i></a></li>
                                <li> <a href="#" title="behance"><i class="fa fa-behance"></i></a> </li>
                                <li> <a href="#" title="rss"><i class="fa fa-rss"></i></a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="cart-currency-area login-register-area text-right">
                        <ul>
                            <li>
                                <div class="header-cart">
                                    <div class="cart-icon"> <a href="{{ route('view.cart') }}">Cart<i class="zmdi zmdi-shopping-cart"></i></a> <span id="quantity">@if(isset($productCount)) {{$productCount}}@else 0 @endif</span> </div>
                                    <div class="cart-content-wraper">
                                        @if(isset($cartProducts))
                                            @foreach($cartProducts as $cartProduct)
                                        <div class="cart-single-wraper del" id="cart_item" data-id="{{ $cartProduct->cart_id }}">
                                            <div class="cart-img">
                                                <a href="#"><img style="object-fit: cover; object-position: center" src="{{ URL::to($cartProduct->images[0]->small_image)}}" alt=""></a>
                                            </div>
                                            <div class="cart-content" data-id="{{ $cartProduct->id }}">
                                                <div class="cart-name"><a href="#">Product: {{$cartProduct->name}} </a> </div>
                                                <div class="cart-price">Price: {{ $cartProduct->selling_price }}  </div>
                                                <div class="cart-qty"  data-id="{{ $cartProduct->id }}"> Quantity: <span id="product_quantity" data-id="{{ $cartProduct->id }}"> {{ $cartProduct->quantity }} </span> </div>
                                                <form action="{{ route('remove.from.cart', $cartProduct->cart_id) }}" method="POST">
                                                    @csrf
                                                    <div class="">
                                                        <button type="submit" class="remove" style="width: 25px!important; height: 25px!important"><i class="zmdi zmdi-close"></i></button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                            @endforeach
                                        @endif
                                        <div class="cart-subtotal"> Total: <span id="total">RS @if(isset($total)){{ $total }} @else 0 @endif</span></div>
                                        <div class="cart-check-btn">
                                            <div class="view-cart"> <a class="btn-def" href="{{ route('view.cart') }}">View Cart</a> </div>
                                            <div class="check-btn"> <a class="btn-def" href="{{ route('checkout') }}">Checkout</a> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-header"  class="header-middle-area">
        <div class="container">
            <div class="full-width-mega-dropdown">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="logo ptb-20">@if(isset($siteSettings[0]))<a href="{{ route('home') }}">
                                <img src="{{ URL::to($siteSettings[0]->logo_header) }}" alt="main logo"></a>@endif
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-10 hidden-xs">
                       @include('User.layouts.navbar')
                    </div>

                    <div class="col-md-3 hidden-sm hidden-xs">
                        <div class="search-box global-table">
                            <div class="global-row">
                                <div class="global-cell">
                                        <div class="input-box dropdown-content" >
                                            <form action="{{ route('searched') }}" method="POST">
                                                @csrf
                                                <input class="single-input" name="product_name" placeholder="Search Any Product  :)" type="text" id="search">
                                                <div id="display" style="background-color: #f6f6f6; min-width: 270px; overflow: auto; border: 1px solid #ddd; z-index: 1; position: absolute; display:none">
                                                    <div id="no" style="display: none">Sorry No results were found</div>
                                                </div>
                                                @if(Request::path() == 'result')

                                                @else
                                                <button type="submit" class="src-btn"><i class="fa fa-search"></i></button>
                                                    @endif
                                            </form>

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mobile-menu-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <nav id="dropdown">
                                        <ul>
                                            <li><a href="{{ route('home') }}">Home</a>
                                            </li>
                                            @foreach($categories as $category)
                                            <li><a href="{{ route('cat.products', $category->slug) }}">{{ $category->name }}</a>
                                                <ul class="single-mega-item">
                                                    @foreach($category->childCategory as $child)
                                                        <li><a href="{{ route('subcat.products', $child->slug) }}">{{ $child->name }}</a></li>
                                                        @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                            <li><a href="{{ route('shop') }}">Shop</a>
                                            </li>
                                            <li><a href="{{ route('about') }}">about</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--mobile menu area end-->
                </div>
            </div>
        </div>
    </div>
</header>
