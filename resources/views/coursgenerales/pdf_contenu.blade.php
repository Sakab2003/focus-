<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <title>{{ $cours->titre }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>{{ $cours->titre }}</h1>
    <p>{!! nl2br(e($cours->contenu)) !!}</p>
</body>
</html>
