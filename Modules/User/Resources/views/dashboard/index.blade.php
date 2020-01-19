@extends('User.layouts.master')


@section('content')
    <div class="breadcumb-area overlay pos-rltv">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>My Account</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">Account</li>
            </ol>
        </div>
    </div>
    <!--breadcumb area end -->
    @if(Session::has('updated'))
        <script>
            swal('Great','{{ session('updated'), 'success' }}')
        </script>
    @endif
    <!--service idea area are start -->
    <div class="idea-area  ptb-80">
        <div class="container">
            <div class="row">
                @include('user::layouts.dashboard-siderbar')
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="idea-tab-content">
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="creativity">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>First Name <em>*</em></label>
                                        <input type="text" name="fname" class="info" placeholder="First Name" value="{{ $user->fname }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Last Name<em>*</em></label>
                                        <input type="text" name="lname" class="info" placeholder="Last Name" value="{{ $user->lname }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Email Address<em>*</em></label>
                                        <input type="email" name="email" class="info" placeholder="Your Email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Phone Number<em>*</em></label>
                                        <input type="text" name="phone_number" class="info" placeholder="Phone Number" value="{{ $user->phone_number }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Password<em>*</em></label>
                                        <input type="password" name="password" class="info" placeholder="Your Password" value="{{ $user->password }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Confirm Password<em>*</em></label>
                                        <input type="password" name="remember_token" class="info" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class=" col-md-6 col-sm-8 col-xs-12">
                                    <div class="checkbox checkbox-2">
                                        <label> <small>
                                                <input name="signup" type="checkbox">I wish to subscribe to the The clothing newsletter.
                                            </small> </label>
                                        <br>
                                        <label> <small>
                                                <input name="signup" type="checkbox">I have read and agree to the <a href="#">Privacy Policy</a>
                                            </small> </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-4 col-xs-12 text-right">
                                    <button type="submit" class="btn btn-primary" href="#">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection