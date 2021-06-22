<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/button_asset/css/ionicons.min.css">
    <link rel="stylesheet" href="/button_asset/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('assets/js/sweetalert2.min.js')}}" /> 

    <link rel="stylesheet" href="{{asset('assets/js/sweetalert2.min.js')}}" /> 

        <title>{{ \Osiset\ShopifyApp\getShopifyConfig('app_name') }}</title>
        @yield('styles')



    </head>

    <body>



        <div class="app-wrapper">
            <div class="app-content">
                <main role="main">
                    @yield('content')
                    @yield('main-content')

                </main>
            </div>
        </div>

        @if(\Osiset\ShopifyApp\getShopifyConfig('appbridge_enabled'))
            <script src="https://unpkg.com/@shopify/app-bridge{{ \Osiset\ShopifyApp\getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
            <script>

                var AppBridge = window['app-bridge'];
                var createApp = AppBridge.default;
                var app = createApp({
                    apiKey: '{{ \Osiset\ShopifyApp\getShopifyConfig('api_key', Auth::user()->name ) }}',
                    shopOrigin: '{{ Auth::user()->name }}',
                    forceRedirect: true,
                });
            </script>
            

            @include('shopify-app::partials.flash_messages')
        @endif

        @yield('scripts')
        @yield('page-level-script')


        <script src=""></script>
<script src=""></script>
      
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	




    </body>
</html>
