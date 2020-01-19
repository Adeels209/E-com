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
            swal('Great','{{ session('updated')}}','success' )
        </script>
        @endif

    <!--service idea area are start -->
    <div class="idea-area  ptb-80">
        <div class="container">
            <div class="row">
                @include('user::layouts.dashboard-siderbar')
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="idea-tab-content">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <form action="{{ route('address.update') }}" method="post">
                                @csrf
                            <div role="tabpanel" class="tab-pane fade in active" id="creativity">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Phone Number<em>*</em></label>
                                        <input type="text" name="phone" class="info" placeholder="Phone Number" value="@if(isset($user->address->phone_number)){{ $user->address->phone_number }}@endif">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Town/City <em>*</em></label>
                                        <input type="text" name="city" class="info" placeholder="Town/City" value="@if(isset($user->address->city)){{ $user->address->city }}@endif">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Post Code/Zip Code<em>*</em></label>
                                        <input type="text" name="zipcode" class="info" placeholder="Zip Code" value="@if(isset($user->address->zip_code)){{ $user->address->zip_code }}@endif">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Address <em>*</em></label>
                                        <input type="text" name="address" class="info mb-10" placeholder="Street Address" value="@if(isset($user->address->address)){{ $user->address->address }}@endif">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-box mb-20">
                                        <label>Appartment <em>*</em></label>
                                        <input type="text" name="appartment" class="info mt10" placeholder="Apartment, suite, unit etc. (optional)" value="@if(isset($user->address->address_appartment)){{ $user->address->address_appartment }}@endif">
                                    </div>
                                </div>
                                <div class="col-xs-12 text-right">
                                    <button type="submit" class="btn btn-primary" >Save</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection