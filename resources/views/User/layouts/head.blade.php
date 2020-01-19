<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home || Clothing</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/icons/favicon.ico">
    <!-- Place favicon.ico in the root directory -->

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/bootstrap.min.css') }}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/core.css') }}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/shortcodes.css') }}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/responsive.css') }}">
    <!-- User style -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <link rel="stylesheet" href="{{ URL::to('user_ui/css/custom.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/plugins/animate.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/plugins/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/plugins/custom-animation.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/default.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/nivo-slider.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/plugins/fancybox/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/slider.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/footer.css') }}">
    <link rel="stylesheet" href="{{ URL::to('user_ui/css/toastr.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        .dropdown-content a.mine {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {background-color: #ddd;}
    </style>
    <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('admin_ui/vendors/css/tables/datatable/datatables.min.css') }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138961333-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-138961333-1');
    </script>

    <!-- Facebook Pixel Code -->

    <!-- End Facebook Pixel Code -->
    <!-- Modernizr JS -->
    <script src="{{ URL::to('user_ui/css/modernizr-2.8.3.min.js') }}"></script>

    <script>

    </script>
    @yield('extra_css')

    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '411105586378491');
        fbq('track', 'AddToCart');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=411105586378491&ev=PageView&noscript=1"
        /></noscript>
</head>
