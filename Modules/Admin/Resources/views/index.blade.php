@extends('admin::layouts.master')

@section('extra_css')

@stop
@section('content')
    @if(Session::has('product_report'))
        <script>
            swal("Great!", "{{session('product_report')}}", "success");
        </script>
    @endif

    @if(Session::has('orders_report'))
        <script>
            swal("Great!", "{{session('orders_report')}}", "success");
        </script>
    @endif
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Dashboard</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">

                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Google bar charts section start -->
                <section id="google-bar-charts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">View Products in XML
                                    </h4>
                                    <a href="" class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <div id="column-chart">
                                            <a href="{{ route('products.xml') }}"><button class="btn btn-primary">View Products XML Log</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Visitors Orders
                                        <span class="danger">Report</span>
                                    </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">

                                        <div id="pie-3d">
                                            <a href="{{ route('orders.xml') }}"><button class="btn btn-primary">View Orders XML Log</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3d Pie Exploded Chart -->
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Visitors Sessions
                                        <span class="danger">by Browser (Last Month)</span>
                                    </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <p class="card-text">

                                        </p>
                                        <div id="pie-3d-exploded"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Visitors Sessions
                                        <span class="danger">Sessions by Devices</span>
                                    </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">

                                        <div id="pie-3ds"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3d Pie Exploded Chart -->
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Most Visited Pages
                                        <span class="danger">Sessions by Browser</span>
                                    </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div id="pie-3d-explodeds"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Google bar charts section end -->
            </div>
        </div>
    </div>


@stop


