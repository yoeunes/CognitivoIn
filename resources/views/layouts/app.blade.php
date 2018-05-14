
<!doctype html>
<!--[if lte IE 9]>
<html lang="en" class="lt-ie10 lt-ie10-msg no-focus"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" class="no-focus">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Cognitivo | The Social Network for Businesses</title>

    <meta name="description" content="The Social Network for Businesses">
    <meta name="author" content="Cognitivo">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="The Social Network for Businesses">
    <meta property="og:site_name" content="Cognitivo">
    <meta property="og:description" content="The Social Network for Businesses">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:image" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="/img/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Codebase framework -->
    <link rel="stylesheet" href="{{ mix('/css/main.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>

<body>

    <div id="app" class="main-content-boxed">
        <main id="main-container">
            <div>

                    <div>
                        @yield('main')
                    </div>
              
            </div>
        </main>
    </div>

    <!-- Codebase Core JS -->
     <script src="/js/jquery.min.js"></script>
     <script src="/js/core/bootstrap.bundle.min.js"></script>
     <script src="/js/core/jquery.slimscroll.min.js"></script>
     <script src="/js/core/jquery.scrollLock.min.js"></script>
     <script src="/js/core/jquery.appear.min.js"></script>
     <script src="/js/core/jquery.countTo.min.js"></script>
     <script src="/js/core/js.cookie.min.js"></script>
    <script src="/js/codebase.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

</body>

</html>
