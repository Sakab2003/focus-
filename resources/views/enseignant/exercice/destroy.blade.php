<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <title>Supprimer l'exercice</title>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="p-4">

<div class="container text-center">
    <h2>Supprimer l'exercice : {{ $exercice->titre }}</h2>
    <p>Êtes-vous sûr de vouloir supprimer ce exercice définitivement ?</p>

    <form action="{{ route('exercice.destroy', $exercice->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
        <a href="{{ route('exercice.show', $exercice->id) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
</body>
</html>
