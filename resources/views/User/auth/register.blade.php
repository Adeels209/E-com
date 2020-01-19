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
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="login-reg">
                            <h3>Register</h3>
                            <div class="input-box mb-20">
                                <label class="control-label">First Name</label>
                                <input type="text" class="info{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="First Name" value="" name="firstname">
                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-box mb-20">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="info{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="Last Name" value="" name="lastname">
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-box mb-20">
                                <label class="control-label">E-Mail</label>
                                <input type="email" class="info{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-Mail" value="" name="email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-box mb-20">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" class="info{{ $errors->has('number') ? ' is-invalid' : '' }}" placeholder="Mobile Number" value="" name="number">
                                @if ($errors->has('number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-box">
                                <label class="control-label">Password</label>
                                <input type="password" class="info{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" value="" name="password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-box">
                                <label class="control-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="info" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="frm-action">
                            <div class="input-box tci-box">
                                <button type="submit" class="btn btn-info">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection