<!--footer bottom area start-->


<div class="footer-area ptb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="single-footer contact-us">
                    <div class="footer-title uppercase">
                        <h5>Contact US</h5> </div>
                    <ul>
                        <li>
                            <div class="contact-icon"> <i class="zmdi zmdi-email-open"></i> </div>
                            <div class="contact-text">
                                <p><span><a href="#">@if(isset($siteSettings[0])){{ $siteSettings[0]->email }}@endif</a></span></p>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"> <i class="zmdi zmdi-phone-paused"></i> </div>
                            <div class="contact-text">
                                <p><span>@if(isset($siteSettings[0])){{ $siteSettings[0]->phonenumber }}@endif</span></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="single-footer informaton-area">
                    <div class="footer-title uppercase">
                        <h5>Information</h5> </div>
                    <div class="informatoin">
                        <ul>
                            @if(Auth::check())
                            <li><a href="{{ route('user.dashboard', Auth::user()->id) }}">My Account</a></li>
                            <li><a href="{{ route('user.order') }}">Order History</a></li>
                            <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-4 col-lg-offset-1 col-xs-12">
                <div class="single-footer newslatter-area">
                    <div class="newslatter">
                        <div class="social-icon socile-icon-style-3 mt-40">
                            <div class="footer-title uppercase">
                                <h5>Social Network</h5>
                            </div>
                            <ul>
                                <li><a href="@if(isset($siteSettings[0])){{ $siteSettings[0]->facebook_link }}@endif" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="@if(isset($siteSettings[0])){{ $siteSettings[0]->twitter_link }}@endif" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="footer-bottom global-table">
    <div class="global-row">
        <div class="global-cell">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="copyrigth"> Copyright @
                            <a href="devitems.com">Devitems</a> All right reserved
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ul class="payment-support text-right">
                            <li>
                                <a href="#"><img src="{{ URL::to('user_ui/images/icons/pay1.png') }}" alt="" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ URL::to('user_ui/images/icons/pay2.png') }}" alt="" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ URL::to('user_ui/images/icons/pay3.png') }}" alt="" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ URL::to('user_ui/images/icons/pay4.png') }}" alt="" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ URL::to('user_ui/images/icons/pay5.png') }}" alt="" /></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer bottom area end-->



<!-- QUICKVIEW PRODUCT -->
{{--<div id="quickview-wrapper">--}}
    {{--<!-- Modal -->--}}
    {{--<div class="modal fade" id="productModal" tabindex="-1" role="dialog">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="modal-product">--}}
                        {{--<div class="product-images">--}}
                            {{--<!--modal tab start-->--}}
                            {{--<div class="portfolio-thumbnil-area-2">--}}
                                {{--<div class="tab-content active-portfolio-area-2">--}}
                                    {{--<div role="tabpanel" class="tab-pane active" id="view1">--}}
                                        {{--<div class="product-img">--}}
                                            {{--<a href="#"><img src="{{ URL::to('user_ui/images/product/01.jpg') }}" alt="Single portfolio" /></a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div role="tabpanel" class="tab-pane" id="view2">--}}
                                        {{--<div class="product-img">--}}
                                            {{--<a href="#"><img src="{{ URL::to('user_ui/images/product/02.jpg') }}" alt="Single portfolio" /></a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div role="tabpanel" class="tab-pane" id="view3">--}}
                                        {{--<div class="product-img">--}}
                                            {{--<a href="#"><img src="{{ URL::to('user_ui/images/product/03.jpg') }}" alt="Single portfolio" /></a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div role="tabpanel" class="tab-pane" id="view4">--}}
                                        {{--<div class="product-img">--}}
                                            {{--<a href="#"><img src="{{ URL::to('user_ui/images/product/04.jpg') }}" alt="Single portfolio" /></a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="product-more-views-2">--}}
                                    {{--<div class="thumbnail-carousel-modal-2" data-tabs="tabs">--}}
                                        {{--<a href="#view1" aria-controls="view1" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/01.jpg') }}" alt="" /></a>--}}
                                        {{--<a href="#view2" aria-controls="view2" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/02.jpg') }}" alt="" /></a>--}}
                                        {{--<a href="#view3" aria-controls="view3" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/03.jpg') }}" alt="" /></a>--}}
                                        {{--<a href="#view4" aria-controls="view4" data-toggle="tab"><img src="{{ URL::to('user_ui/images/product/04.jpg') }}" alt="" /></a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!--modal tab end-->--}}
                        {{--<!-- .product-images -->--}}
                        {{--<div class="product-info">--}}
                            {{--<h1>Aenean eu tristique</h1>--}}
                            {{--<div class="price-box-3">--}}
                                {{--<div class="s-price-box"> <span class="new-price">$160.00</span> <span class="old-price">$190.00</span> </div>--}}
                            {{--</div> <a href="shop.html" class="see-all">See all features</a>--}}
                            {{--<div class="quick-add-to-cart">--}}
                                {{--<form method="post" class="cart">--}}
                                    {{--<div class="numbers-row">--}}
                                        {{--<input type="number" id="french-hens" value="3" min="1"> </div>--}}
                                    {{--<button class="single_add_to_cart_button" type="submit">Add to cart</button>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                            {{--<div class="quick-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.Nam fringilla tristique auctor. </div>--}}
                            {{--<div class="social-sharing-modal">--}}
                                {{--<div class="widget widget_socialsharing_widget">--}}
                                    {{--<h3 class="widget-title-modal">Share this product</h3>--}}
                                    {{--<ul class="social-icons-modal">--}}
                                        {{--<li><a target="_blank" title="Facebook" href="#" class="facebook m-single-icon"><i class="fa fa-facebook"></i></a></li>--}}
                                        {{--<li><a target="_blank" title="Twitter" href="#" class="twitter m-single-icon"><i class="fa fa-twitter"></i></a></li>--}}
                                        {{--<li><a target="_blank" title="Pinterest" href="#" class="pinterest m-single-icon"><i class="fa fa-pinterest"></i></a></li>--}}
                                        {{--<li><a target="_blank" title="Google +" href="#" class="gplus m-single-icon"><i class="fa fa-google-plus"></i></a></li>--}}
                                        {{--<li><a target="_blank" title="LinkedIn" href="#" class="linkedin m-single-icon"><i class="fa fa-linkedin"></i></a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- .product-info -->--}}
                    {{--</div>--}}
                    {{--<!-- .modal-product -->--}}
                {{--</div>--}}
                {{--<!-- .modal-body -->--}}
            {{--</div>--}}
            {{--<!-- .modal-content -->--}}
        {{--</div>--}}
        {{--<!-- .modal-dialog -->--}}
    {{--</div>--}}
    {{--<!-- END Modal -->--}}
{{--</div>--}}
{{--<!-- END QUICKVIEW PRODUCT -->--}}