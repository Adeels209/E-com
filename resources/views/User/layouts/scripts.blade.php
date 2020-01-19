<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>

<script src="{{ URL::to('user_ui/js/jquery-1.12.0.min.js') }}"></script>
<!-- Bootstrap framework js -->
<script src="{{ URL::to('user_ui/js/bootstrap.min.js') }}"></script>
<!-- Slider js -->
<script src="{{ URL::to('user_ui/js/jquery.nivo.slider.pack.js') }}"></script>
<script src="{{ URL::to('user_ui/js/nivo-active.js') }}"></script>
<!-- counterUp-->
<script src="{{ URL::to('user_ui/js/jquery.countdown.min.js') }}"></script>
<!-- All js plugins included in this file. -->
<script src="{{ URL::to('user_ui/js/plugins.js') }}"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="{{ URL::to('user_ui/js/main.js') }}"></script>
<script src="{{ URL::to('user_ui/js/toastr.js') }}"></script>
<script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') }}"></script>
<script src="{{URL::to('admin_ui/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<script src="{{URL::to('admin_ui/vendors/js/tables/datatable/datatables.min.js')}}"></script>

<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=1972304119547727&ev=PageView&noscript=1"
    /></noscript>
<script src="https://code.createjs.com/easeljs-0.6.0.min.js"></script>



{{--custome functions open modal--}}

<script>
    function openModal(id){
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(".loading").show();
        $.ajax({
            url: "{{ route('all.images') }}",
            type: 'get',
            data: {
                id: id,
                _token: CSRF_TOKEN,
            },
            dataType: 'JSON',
            success: function (data) {
                // console.log(data.product.sizes);
                $(".quan-empty").attr("max", '');
                $(".numbers-row").html("");
                $(".numbers-row").append(`<input type="number" id="french-hens" class="quan-empty" name="quantity" value="1" min="1"  max="`+data.product.stock.quantity+`" >`);
                // console.log(data.product.stock);
                var html = ``;
                html =
                    `   <label>Size: </label>
                                <select  id="input-sort-size-modal" style=" margin-left:32px!important" >
                                    <option value="0">Chose Your Size</option>`;
                $.each(data.product.sizes, function (index, value) {
                    // console.log(value.id)
                    html +=  `<option  class="allsize" name="size_id" value="` + value.id + `">` + value.size + `</option>`;
                });
                html += `</select>`;
                $(".sizes").html("");
                $('.sizes').html(html);
                var colors = ``;
                colors =
                    `<label>Colors: </label>
                            <select  id="input-sort-color-modal" >
                                <option value="0">Chose Your Color</option>`;
                $.each(data.product.colors, function (index, value) {
                    // console.log(value.id);
                    colors +=  `<option  class="all" name="color_id" value="` + value.id + `">` + value.color + `</option>`;
                });
                colors += `</select>`;
                $(".colors").html("");
                $('.colors').html(colors);
                if(data.product.stock.quantity > 0) {
                    var some = ``;
                    some =
                        `<label>Stock :</label><span><strong> ` + data.product.stock.quantity + `</span>`;
                    some += `</select>`;
                    $('.quantity').html(some);
                } else {
                    var some = ``;
                    some =
                        `<label>Stock :</label><span><strong>Out of Stock</strong></span>`;
                    some += `</select>`;
                    $('.quantity').html(some);
                }
                // console.log(window.location.origin);
                var base_url = window.location.origin;
                var route =base_url+'/product/'+data.product.slug;
                console.log(route);
                $(".myid").val(data.product.id);
                $("#productModal .product-name ").html(" ");
                $("#productModal .product-name ").html(data.product.name);
                // console.log(data.discount);
                if(data.discount) {
                    if(data.product.selling_price > 99999 && data.discount > 99999) {
                        $("#productModal .new-price").html('RS ' + format('XXX,XXX', data.discount));
                        $("#productModal .old-price").html('RS ' + format('XXX,XXX', data.product.selling_price));
                    } else {
                        if (data.product.selling_price > 99999 && data.discount < 99999) {
                            $("#productModal .new-price").html('RS ' + format('XX,XXX', data.discount));
                            $("#productModal .old-price").html('RS ' + format('XXX,XXX', data.product.selling_price));
                        } else {
                            if (data.product.selling_price < 99999 && data.disocunt < 99999) {
                                $("#productModal .new-price").html('RS ' + format('XX,XXX', data.discount));
                                $("#productModal .old-price").html('RS ' + format('XX,XXX', data.product.selling_price));
                            } else {
                                    if(data.product.selling_price > 999 && data.dicount < 999){
                                        $("#productModal .new-price").html('RS ' + format('X,XXX', data.discount));
                                        $("#productModal .old-price").html('RS ' + format('XX,XXX', data.product.selling_price));
                                    }
                            }
                        }
                    }
                } else {
                    if(data.product.selling_price > 99999 && data.product.cost_price > 99999) {
                        $("#productModal .new-price").html('RS ' + format('XXX,XXX', data.product.selling_price));
                        $("#productModal .old-price").html('RS ' + format('XXX,XXX', data.product.cost_price));
                    } else {
                        if(data.product.selling_price < 99999 && data.product.cost_price < 99999) {
                            $("#productModal .new-price").html('RS ' + format('XX,XXX', data.product.selling_price));
                            $("#productModal .old-price").html('RS ' + format('XX,XXX', data.product.cost_price));
                        } else {
                            if(data.product.selling_price < 10000 && data.product.cost_price > 99999){
                                $("#productModal .new-price").html('RS ' + format('XX,XXX', data.product.selling_price));
                                $("#productModal .old-price").html('RS ' + format('XXX,XXX', data.product.cost_price));
                            } else {
                                if(data.product.selling_price < 999 && data.product.cost_price > 999 ){
                                    $("#productModal .new-price").html('RS ' + format('X,XXX', data.selling_price));
                                    $("#productModal .old-price").html('RS ' + format('XX,XXX', data.product.cost_price));
                                }
                            }
                        }
                    }
                }
                $("#productModal .see-all").attr(" ");
                $("#productModal .see-all").attr('href',route);
                $("#productModal #large_view").html(" ");
                $("#productModal .thumbnail-carousel-modal-2").html("");
                $("#productModal .quick-desc").html();
                $("#productModal .quick-desc").html(data.product.short_description);
                // console.log(data);
                var active = "";
                for( var i = 0; i < data.product.images.length; i++){
                    // console.log(data.product_Image);
                    active = (i == 0 ? " active" : "");
                    $("#view").html("");
                    $("#productModal #large_view").append(`
                        <div role="tabpanel" class="tab-pane ${active}" id="view${i+1}">
                        <div class="product-img">
                        <a href="#">
                        <img style="object-fit: cover; object-position: center" height="392" width="272" class="active-image" src="/${data.product.images[i].large_image}" alt="Single portfolio" /></a></div></div>`);
                    $("#productModal .thumbnail-carousel-modal-2").append(`
                        <div class="product-more-views-2">
                        <a href="#view${i+1}" aria-controls="view${i+1}" data-toggle="tab">
                        <img style="object-fit: cover; object-position: center" height="109.033" width="76.05" class="thumb1" src="/${data.product.images[i].medium_image}" alt="" /></a></div>`);
                }
                $(".loading").hide();
                $(".modal").modal("show");

            }
        });
    }
</script>

{{--custom functions end open modal--}}




{{--custom functions  add to cart--}}

<script>
    function addToCart() {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var id = $('input[name=product_id]').val();
        var cid = $('select[id=input-sort-color-modal]').val();
        // console.log(cid);
        var sid = $('select[id=input-sort-size-modal]').val();
        // console.log(sid);
        var quan = $('input[name=quantity]').val();
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
        fbq('track', 'AddToCart');
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
                // console.log(data.cart.quantity);
                if(data.status == 500){
                    toastr.error("Sorry, this item can't be added because you have maximum quantity of the product in your cart")
                }
                if(data.status == -21){
                    toastr.warning("Product is Out Of Stock")
                }
                if(data.status == 300){
                    toastr.error("Size is not valid");
                }
                if(data.status == 900){
                    toastr.error("Color is not valid");
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
                        var route = window.location.origin;
                        // console.log(route);
                        var html = `<div class="cart-single-wraper" data-id="` + data.cart.id + `">
                            <div class="cart-img">
                                <a href="#">
                                    <img style="object-fit: cover; object-position: center" src="/` + data.cart_images[0].large_image + `" alt=""/>
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
                $('#total').text("RS " + data.cart_total);
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
                    if(data.status == 600){
                        toastr.error("Requested Quantity exceeds the Product stock please lower your requested Quantity")
                    }
                    if(data.status == 500){
                        toastr.error("Sorry, this item can't be added because you have maximum quantity of the Product in your cart")
                    }
                }
            }
        }
    }
});
}
</script>



{{--custom functions end  to cart--}}




{{--custom functions start product with price range --}}

<script>
    $( "#slider-range" ).slider({
        range: true,
        min: 1000,
        max: 500000,
        values: [ 40, 500000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "RS" + ui.values[ 0 ]);
            $( "#amount1" ).val( "RS" + ui.values[ 1 ]);

        }
    });
    $( "#amount" ).val( "RS" + $( "#slider-range" ).slider( "values", 0 ));
    $( "#amount1" ).val( "RS" + $( "#slider-range" ).slider( "values", 1 ));
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

    inputNumber($('#inputnumber'));
</script>

<script>
    function format(mask, number) {
        var s = ''+number, r = '';
        for (var im=0, is = 0; im<mask.length && is<s.length; im++) {
            r += mask[im]=='X' ? s.charAt(is++) : mask.charAt(im);
        }
        return r;
    }
</script>

<script>
    function addToWishList(myObj) {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var id = $(myObj).data("id");
        // console.log(id)
        $.ajax({
            url: "{{ route('add.to.wishlist') }}",
            type: 'post',
            data: {
                product_id: id,
                _token: CSRF_TOKEN,
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 200){
                    toastr.success('Product has been added to Your Wishlist');
                        $("#wishlist-icon").text("");
                        $("#wishlist-icon").text(data.count);
                    var elem = document.getElementById("header");
                    elem.scrollIntoView({behavior: 'smooth'});
                } else {
                    if(data.status == -200){
                        toastr.error('This Product Exists in Your Wishlist')

                    }
                }
            }
        });
    }
</script>


<script>
    $('#search').on('keyup',function(){
        $value=$(this).val();
        if ($value!=='')
        {
            $.ajax({
                type : 'get',
                url : '{{route("search")}}',
                data:{'search':$value},
                success:function(data){
                    // console.log(data)
                    $("#display").html(data).show();

                }
            });
        }
        else
            $("#display").empty();

    })
</script>

<script>
    var stage;

    function viewPanorama() {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var product_slug = $(".helper-slug").val();
        console.log('hello ' + product_slug );
        $.ajax({
            type:'get',
            url:'{{ route('360view') }}',
            data:{
                slug: product_slug,
                _token: CSRF_TOKEN
            },
            dataType: 'JSON',
            success:function(response){
        var canvas = document.getElementById("360viewer");
        if (!canvas || !canvas.getContext) return;

        stage = new createjs.Stage(canvas);
        stage.enableMouseOver(true);
        stage.mouseMoveOutside = true;
        createjs.Touch.enable(stage);

        var imgList = response.images;
        var images = [],
            loaded = 0,
            currentFrame = 0,
            totalFrames = imgList.length;
        var rotate360Interval, start_x;

        var bg = new createjs.Shape();
        stage.addChild(bg);

        var bmp = new createjs.Bitmap();
        stage.addChild(bmp);

        // var myTxt = new createjs.Text("360 prototype", '13px Roboto', "#E81280");
        // myTxt.x = myTxt.y =0;
        // myTxt.alpha = 0.5;
        // stage.addChild(myTxt);

        function load360Image() {
            var img = new Image();
            img.src = imgList[loaded];
            console.log(img);
            img.onload = img360Loaded;
            images[loaded] = img;
        }

        function img360Loaded(event) {
            loaded++;
            bg.graphics.clear()
            bg.graphics.beginFill("#fff").drawRect(0, 0, stage.canvas.width * loaded / totalFrames, stage.canvas.height);
            bg.graphics.endFill();

            if (loaded == totalFrames) start360();
            else load360Image();
        }

        $(".product-panorama-image").modal('show');
        // console.log('hello modal')

        function start360() {
            document.body.style.cursor = 'none';

            // 360 icon
            // var iconImage = new Image();
            // iconImage.src = "http://jsrun.it/assets/y/n/D/c/ynDcT.png";
            // iconImage.onload = iconLoaded;

            // update-draw
            update360(0);

            // first rotation
            rotate360Interval = setInterval(function() {
                if (currentFrame === totalFrames - 1) {
                    clearInterval(rotate360Interval);
                    addNavigation();
                }
                update360(1);
            }, 25);
        }

        function iconLoaded(event) {
            var iconBmp = new createjs.Bitmap();
            iconBmp.image = event.target;
            iconBmp.x = 20;
            iconBmp.y = canvas.height - iconBmp.image.height - 20;
            stage.addChild(iconBmp);
        }

        function update360(dir) {
            currentFrame += dir;
            if (currentFrame < 0) currentFrame = totalFrames - 1;
            else if (currentFrame > totalFrames - 1) currentFrame = 0;
            bmp.image = images[currentFrame];
        }

        //-------------------------------
        function addNavigation() {
            stage.onMouseOver = mouseOver;
            stage.onMouseDown = mousePressed;
            document.body.style.cursor = 'auto';
        }

        function mouseOver(event) {
            document.body.style.cursor = 'pointer';
        }

        function mousePressed(event) {
            start_x = event.rawX;
            stage.onMouseMove = mouseMoved;
            stage.onMouseUp = mouseUp;

            document.body.style.cursor = 'w-resize';
        }

        function mouseMoved(event) {
            var dx = event.rawX - start_x;
            var abs_dx = Math.abs(dx);

            if (abs_dx > 5) {
                update360(dx / abs_dx);
                start_x = event.rawX;
            }
        }

        function mouseUp(event) {
            stage.onMouseMove = null;
            stage.onMouseUp = null;
            document.body.style.cursor = 'pointer';
        }

        function handleTick() {
            stage.update();
        }

        document.body.style.cursor = 'progress';
        load360Image();

        // TICKER
        createjs.Ticker.addEventListener("tick", handleTick);
        createjs.Ticker.setFPS(24);
        createjs.Ticker.useRAF = true;
            }
        });
    }


</script>

@if(Session::has('empty'))
    <script>
        toastr.error('{{ session('empty') }}')
    </script>
@endif

@if(Session::has('cart_empty'))
    <script>
        toastr.error('{{ session('cart_empty') }}')
    </script>
@endif

@if(Session::has('nothing'))
    <script>
        toastr.error('{{ session('nothing') }}')
    </script>
@endif

<script>
    $(document).click(function(){
        $("#display").hide();
    });
</script>


{{--custom functions end product with price range --}}


@yield('extra_js')