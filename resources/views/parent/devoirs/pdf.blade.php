<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
<h1>{{ $devoir->cours->titre ?? 'Devoir' }}</h1>
<p><strong>Description :</strong></p>
<p>{!! $devoir->cours->contenu ?? '' !!}</p>

@if($devoir->fichier)
<p>Fichier joint : {{ $devoir->fichier }}</p>
@endif
</body>
</html>
