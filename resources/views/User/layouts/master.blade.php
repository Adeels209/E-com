<!doctype html>
<html class="no-js" lang="en">

@include('User.layouts.head')
<body>
<div class="wrapper home-one">

   @include('User.layouts.header')

    @yield('content')

   @include('User.layouts.footer')

</div>
@include('User.layouts.scripts')
</body>

</html>