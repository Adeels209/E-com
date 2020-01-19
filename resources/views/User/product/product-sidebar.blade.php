
    <aside class="single-aside catagories-aside">
        <div class="heading-title aside-title pos-rltv">
            <h5 class="uppercase">categories</h5>
        </div>
        <div id="cat-treeview" class="product-cat">
            <ul>
                @foreach($categories as $category)
                <li class="closed"><a href="{{ route('cat.products', $category->slug) }}">{{ $category->name }}</a>
                    <ul>
                        @foreach($category->childCategory as $child)
                        <li><a href="{{ route('subcat.products', $child->slug) }}">{{ $child->name }}</a></li>
                            @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>
    <!--single aside end-->

    <!--single aside start-->
    <aside class="single-aside price-aside fix">
        <div class="heading-title aside-title pos-rltv">
            <h5 class="uppercase">price</h5>
        </div>
        <div class="price_filter">
            <div id="slider-range"></div>
            <div class="price_slider_amount">
            <form action="{{ route('range.price')}}" method="get">
                <input type="text" id="amount1" name="startprice" placeholder="Add Your Price" />
                <input type="text" id="amount" name="endprice" placeholder="Add Your Price" />
                <button class="btn btn-primary" id="range" type="submit" value="Filter" style="width:100%">Filer</button>
            </form>
            </div>
        </div>
    </aside>
    <!--single aside end-->

    <!--single aside start-->
    {{--<aside class="single-aside color-aside">--}}
        {{--<div class="heading-title aside-title pos-rltv">--}}
            {{--<h5 class="uppercase">Color</h5>--}}
        {{--</div>--}}
        {{--<ul class="color-filter mt-30">--}}
            {{--<li><a href="#" class="color-1"></a></li>--}}
            {{--<li><a href="#" class="color-2 active"></a></li>--}}
            {{--<li><a href="#" class="color-3"></a></li>--}}
            {{--<li><a href="#" class="color-4"></a></li>--}}
            {{--<li><a href="#" class="color-5"></a></li>--}}
            {{--<li><a href="#" class="color-6"></a></li>--}}
            {{--<li><a href="#" class="color-7"></a></li>--}}
            {{--<li><a href="#" class="color-8"></a></li>--}}
            {{--<li><a href="#" class="color-9"></a></li>--}}
        {{--</ul>--}}
    {{--</aside>--}}
    <!--single aside end-->

    <!--single aside start-->
    <aside class="single-aside size-aside">
        <div class="heading-title aside-title pos-rltv">
            <h5 class="uppercase">Size Option</h5>
        </div>
        <ul class="size-filter mt-30">
            @foreach($sizes as $size)
            <li><a href="{{ route('range.size', $size->id) }}" class="size-s">{{ $size->size }}</a></li>
                @endforeach
        </ul>
    </aside>

    <!--single aside start-->
    <!--single aside end-->