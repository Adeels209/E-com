

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{ route('admin.dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li>
        </ul>
{{--        @role('Super Admin')--}}
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-shopping-cart"></i><span class="menu-title" data-i18n="nav.dash.main">Product Configuration</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.product.index')) }}" data-i18n="nav.dash.sales">Product</a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.size.index')) }}" data-i18n="nav.dash.sales">Size</a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.colors.index')) }}" data-i18n="nav.dash.sales">Colors</a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.discount.all')) }}" data-i18n="nav.dash.sales">Apply Discount</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-settings"></i><span class="menu-title" data-i18n="nav.dash.main">Website Configuration</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.slider.create')) }}" data-i18n="nav.dash.sales">Home Slider</a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.testimonial.index')) }}" data-i18n="nav.dash.sales">Testimonial</a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.testimonialreviews.index')) }}" data-i18n="nav.dash.sales">Testimonial Reviews </a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.sidesetting.index')) }}" data-i18n="nav.dash.sales">Site Settings  </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-unlock"></i><span class="menu-title" data-i18n="nav.dash.main">Role</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('role.create') }}" data-i18n="nav.dash.ecommerce">Create Role</a>
                    </li>
                    <li><a class="menu-item" href="{{ route('role.index') }}" data-i18n="nav.dash.crypto">View Role</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-users"></i><span class="menu-title" data-i18n="nav.dash.main">User</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.users.create') }}" data-i18n="nav.dash.ecommerce">Create User</a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.users.index')) }}" data-i18n="nav.dash.sales">View User</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-tag"></i><span class="menu-title" data-i18n="nav.dash.main">Category</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.category.index')) }}" data-i18n="nav.dash.sales">View Category</a>
                    </li>
                    <li><a class="menu-item" href="{{ route(('admin.sub-category.index')) }}" data-i18n="nav.dash.sales">View Sub-Category</a>
                    </li>
                </ul>
            </li>
        </ul>
        {{--<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">--}}
            {{--<li class=" nav-item"><a href="#"><i class="ft-tag"></i><span class="menu-title" data-i18n="nav.dash.main">Sub-Category</span></a>--}}
                {{--<ul class="menu-content">--}}
                    {{--<li><a class="menu-item" href="{{ route('admin.sub-category.create') }}" data-i18n="nav.dash.ecommerce">Create Sub-Category</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="menu-item" href="{{ route(('admin.sub-category.index')) }}" data-i18n="nav.dash.sales">View Sub-Category</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-aperture"></i><span class="menu-title" data-i18n="nav.dash.main">Brands</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.brand.index')) }}" data-i18n="nav.dash.sales">View Brands</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-box"></i><span class="menu-title" data-i18n="nav.dash.main">Stock</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.stock.index')) }}" data-i18n="nav.dash.sales">View Stock</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-slack"></i><span class="menu-title" data-i18n="nav.dash.main">Orders</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.order.index')) }}" data-i18n="nav.dash.sales">View All</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="ft-zap"></i><span class="menu-title" data-i18n="nav.dash.main">Discount</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.discount.index')) }}" data-i18n="nav.dash.sales">View Discounts</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="fa fa-ticket"></i><span class="menu-title" data-i18n="nav.dash.main">Coupon</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route(('admin.coupon.index')) }}" data-i18n="nav.dash.sales">View Coupon</a>
                    </li>
                </ul>
            </li>
        </ul>

{{--        @endrole--}}
    </div>
</div>