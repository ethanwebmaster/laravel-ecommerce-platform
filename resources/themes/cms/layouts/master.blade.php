<!DOCTYPE html>
<html lang="en">
<head>
    {!! \SEO::generate() !!}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ \Settings::get('site_favicon') }}" type="image/png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap -->
    {!! Theme::css('css/bootstrap.min.css') !!}
    {!! Theme::css('css/font-awesome.min.css') !!}
    {!! Theme::css('css/animate.min.css') !!}
    {!! Theme::css('css/prettyPhoto.css') !!}
    {!! Theme::css('css/pricingTable.min.css') !!}
    {!! Theme::css('css/main.css') !!}
    {!! Theme::css('css/responsive.css') !!}

    <!--[if lt IE 9]>
    {!! Theme::js('js/html5shiv.js') !!}
    {!! Theme::js('js/respond.min.js') !!}

    <![endif]-->
    <script type="text/javascript">
        window.base_url = '{!! url('/') !!}';
    </script>

    {!! \Assets::css() !!}

    @if(\Settings::get('google_analytics_id'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id={{ \Settings::get('google_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', "{{ \Settings::get('google_analytics_id') }}");
        </script>
    @endif
    <style type="text/css">
        {!! \Settings::get('custom_css', '') !!}
    </style>
</head>
<body class="homepage">

@include('partials.header')

@yield('before_content')

<div id="editable_content">
    @yield('editable_content')
</div>

@yield('after_content')

<div>@include('partials.footer')</div>
<!--/#footer-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{!! Theme::js('js/jquery.js') !!}
{!! Theme::js('js/bootstrap.min.js') !!}
{!! Theme::js('js/jquery.prettyPhoto.js') !!}
{!! Theme::js('js/jquery.isotope.min.js') !!}
{!! Theme::js('js/wow.min.js') !!}
{!! Theme::js('js/functions.js') !!}
{!! Theme::js('js/main.js') !!}

{!! Assets::js() !!}

@php  \Actions::do_action('footer_js') @endphp

@yield('js')

<script type="text/javascript">
    {!! \Settings::get('custom_js', '') !!}
</script>

</body>
</html>