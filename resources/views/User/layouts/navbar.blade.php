<nav id="primary-menu">
    <ul class="main-menu">
        <li class="{{ Request::path() == '/'?'current':  ''}}"><a class="{{ Request::path() == '/'?'current':  ''}}" href="{{ route('home') }}">Home</a>
        </li>
        @foreach($categories as $category)
        <li class="mega-parent pos-rltv {{ Request::path() == 'product/extra/{slug}/ssaqas/wqcv'?'current':  ''}}"><a href="{{ route('cat.products', $category->slug) }}">{{ $category->name }}</a>
            <div class="mega-menu-area mma-800">
                @foreach($category->childCategory as $child)
                <ul class="single-mega-item">
                    <li class="menu-title uppercase  ">{{ $category->name }}</li>
                    <li><a href="{{ route('subcat.products', $child->slug) }}">{{ $child->name }}</a></li>
                </ul>
                @endforeach
                <div class="mega-banner-img">
                    <a href="single-product.html"><img style="object-fit: contain; object-position: center" width="730" height="100" src="{{ URL::to($category->image) }}" alt=""></a>
                </div>
            </div>
        </li>
        @endforeach
        <li class="{{ Request::path() == 'product/shop/all'?'current':  ''}}"><a href="{{ route('shop') }}">Shop</a></li>
        <li class="{{ Request::path() == 'about'?'current':  ''}}"><a href="{{ route('about') }}">ABOUT</a></li>
        <li class=" {{ Request::path() == 'contact'?'current':  ''}}" ><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
</nav>