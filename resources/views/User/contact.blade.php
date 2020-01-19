@extends('User.layouts.master')

@section('content')
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <script>
                swal("AH OH!", "{{ $error }}", "error");
            </script>
        @endforeach
    @endif
    @if(Session::has('mail_sent'))
        <script>
            swal('Great', '{{session('mail_sent')}}', 'success');
        </script>
    @endif
    <div class="breadcumb-area breadcumb-3 overlay pos-rltv">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Contact Details</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">Contact Us</li>
            </ol>
        </div>
    </div>

    <!--contact info are start-->
    <div class="contact-info ptb-70">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="row">
                        <form id="contact-form" action="{{ route('contact.save') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-box mb-20">
                                    <input name="name" class="info" placeholder="Name*" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-box mb-20">
                                    <input name="email" class="info" placeholder="Email" type="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-box mb-20">
                                    <input name="subject" class="info" placeholder="Subject" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-box mb-20">
                                    <textarea name="message" class="area-tex" placeholder="Your Message*"></textarea>
                                </div>
                            </div>
                            <p class="form-messege"></p>
                            <div class="col-xs-12">
                                <div class="input-box">
                                    <input name="submit" class="sbumit-btn" value="Submit" type="submit">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="single-footer contact-us contact-us-2">
                        <div class="heading-title text-center mb-50">
                            <h5 class="uppercase">Contact Info</h5>
                        </div>
                        <ul class="contact-info">
                            <li>
                                <div class="contact-icon"> <i class="zmdi zmdi-phone-paused"></i> </div>
                                <div class="contact-text">
                                    <p><span>{{ $siteSettings[0]->phonenumber }}</span> </p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon"> <i class="zmdi zmdi-email-open"></i> </div>
                                <div class="contact-text">
                                    <p><span><a href="#">{{ $siteSettings[0]->email }}</a></span> </p>
                                </div>
                            </li>
                        </ul>
                        <div class="social-icon-wraper mt-25">
                            <div class="social-icon socile-icon-style-1">
                                <ul>
                                    <li><a href="{{ $siteSettings[0]->facebook_link }}" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="https://api.whatsapp.com/send?phone=923144101344" target="_black"><i class="zmdi zmdi-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="pos-rltv">
                        <div class="contact-des">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stop