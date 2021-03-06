<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#32374f"/>
    <title>{{ ($snipeSettings) && ($snipeSettings->site_name) ? $snipeSettings->site_name : 'Snipe-IT' }}</title>
    <meta name="Description" content="asset tracking,
        free asset tracking">

    <!-- Select2 -->
    <link rel="manifest" href="manifest.json" />

    <link rel="stylesheet" href="{{ url(asset('js/plugins/select2/select2.min.css')) }}">

    <link rel="stylesheet" href="{{ url(mix('css/dist/all.css')) }}">
    <link rel="shortcut icon" type="image/ico" href="{{ url(asset('favicon.ico')) }}">
    <link rel="apple-touch-icon" type="image/ico" href="{{ url(asset('favicon.ico')) }}">

    @if (($snipeSettings) && ($snipeSettings->header_color))
        <style>
        .main-header .navbar, .main-header .logo {
        background-color: {{ $snipeSettings->header_color }};
        background: -webkit-linear-gradient(top,  {{ $snipeSettings->header_color }} 0%,{{ $snipeSettings->header_color }} 100%);
        background: linear-gradient(to bottom, {{ $snipeSettings->header_color }} 0%,{{ $snipeSettings->header_color }} 100%);
        border-color: {{ $snipeSettings->header_color }};
        }
        .skin-blue .sidebar-menu > li:hover > a, .skin-blue .sidebar-menu > li.active > a {
        border-left-color: {{ $snipeSettings->header_color }};
        }

        .btn-primary {
        background-color: {{ $snipeSettings->header_color }};
        border-color: {{ $snipeSettings->header_color }};
        }

        </style>

    @endif

    @if (($snipeSettings) && ($snipeSettings->custom_css))
        <style>
            {!! $snipeSettings->show_custom_css() !!}
        </style>
    @endif

</head>

<body class="hold-transition login-page">

    @if (($snipeSettings) && ($snipeSettings->logo!=''))
        <center>
            <img id="login-logo" alt="asset tracking" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
        </center>
    @endif
  <!-- Content -->
  @yield('content')



    <div class="text-center" style="padding-top: 100px;">
        @if (($snipeSettings) && ($snipeSettings->privacy_policy_link!=''))
        <a target="_blank" rel="noopener" href="{{  $snipeSettings->privacy_policy_link }}" target="_new">{{ trans('admin/settings/general.privacy_policy') }}</a>
    @endif
    </div>

    <script>
    // ServiceWorker is a progressive technology. Ignore unsupported browsers
    if ('serviceWorker' in navigator) {
      console.log('CLIENT: service worker registration in progress.');
      navigator.serviceWorker.register('/sw.js').then(function() {
        console.log('CLIENT: service worker registration complete.');
      }, function() {
        console.log('CLIENT: service worker registration failure.');
      });
    } else {
      console.log('CLIENT: service worker is not supported. v2');
    }
</script>

</body>

</html>
