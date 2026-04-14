<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
    </style>
</head>
<body>

<h2>Réponse de l’élève</h2>

<p><strong>Élève :</strong>
    {{ $reponse->eleve->nom ?? '' }} {{ $reponse->eleve->prenom ?? '' }}
</p>

<hr>

<p>
    {!! nl2br(($reponse->reponse)) !!}
</p>

</body>
</html>
