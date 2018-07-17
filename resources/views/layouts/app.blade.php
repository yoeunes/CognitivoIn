
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
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">

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
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>

<body>
  <script>
          window.trans = <?php
          // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
          $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());

          $trans = [];
          foreach ($lang_files as $f) {
              $filename = pathinfo($f)['filename'];
              $trans[$filename] = trans($filename);
          }
          echo json_encode($trans);
          ?>;
      </script>
    <div id="app" class="main-content-boxed">
        <main id="main-container">
            <div>
                @yield('main')
            </div>
        </main>
    </div>

    <!-- Codebase Core JS -->
    <script src="/js/jquery.min.js"></script>
    {{-- <script src="/js/lang-{{ \App::getLocale() }}.js"></script> --}}
    <script src="/js/codebase.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('scripts')
    {{-- <script type="text/javascript" src="libs/jquery.slimscroll.min.js"></script> --}}
</body>

</html>
