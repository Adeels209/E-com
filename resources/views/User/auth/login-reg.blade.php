@extends('User.layouts.master')


@section('content')
    <div class="breadcumb-area overlay pos-rltv">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Login Register</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">Login</li>
            </ol>
        </div>
    </div>
    <!--breadcumb area end -->

    <!-- Account Area Start -->
    <div class="account-area ptb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 col-xs-12 lr2">
                    <form method="POST" action="{{ route('login') }}" class="login-side">
                        @csrf
                        <div class="login-reg">
                            <h3>Login</h3>
                            <div class="input-box mb-20">
                                <label class="control-label">E-Mail</label>
                                <input type="email" placeholder="E-Mail" value="" name="email" class="info{{ $errors->has('name') ? ' is-invalid' : '' }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-box">
                                <label class="control-label">Password</label>
                                <input type="password" placeholder="Password" value="" name="password" class="info{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="frm-action">
                            <div class="input-box tci-box">
                                <button class="btn btn-info" > login</button>
                            </div>
                            <span>
                             <input class="remr" type="checkbox"> Remember me
                         </span>
                            <a href="#" class="forgotten forg">Forgotten Password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection