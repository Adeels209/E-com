<!--testimonial-area-start-->
<div class="testimonial-area overlay ptb-70 mt-70" style="background-image: url({{ $testimonial[0]->image }})">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="heading-title color-lightgrey mb-40 text-center">
                    <h5 class="uppercase">{{ $testimonial[0]->title }}</h5>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="total-testimonial active-slider carosule-pagi pagi-03">
                    @if(isset($testimonialReviews))
                    @foreach($testimonialReviews as $test)
                    <div class="single-testimonial">
                        <div class="testimonial-img">
                            <img height="120" width="120" style="object-fit: contain; object-position: center" src="{{ URL::to($test->image) }}" alt="">
                        </div>
                        <div class="testimonial-content color-lightgrey">
                            <div class="name-degi pos-rltv">
                                <h5>{{ $test->name }}</h5>
                            </div>
                            <div class="testi-text">
                                <p>{{ $test->review }}.</p>
                            </div>
                        </div>
                    </div>
                        @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!--testimonial-area-end-->