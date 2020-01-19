<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('admin::layouts.head')
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- fixed-top-->
@include('admin::layouts.navbar')

@include('admin::layouts.sidebar')

@yield('content')

@include('admin::layouts.footer')

@include('admin::layouts.scripts')
</body>
</html>