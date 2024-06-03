<base href="http://localhost:8000/">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>INSPINIA | Dashboard</title>

<link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

<!-- Toastr style -->
<link href="{{ asset('backend/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

<!-- Gritter -->
<link href="{{ asset('backend/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

<link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@isset($config['css'])
    @foreach ($config['css'] as $css)
        <link href="{{ asset($css) }}" rel="stylesheet">
    @endforeach
@endisset
