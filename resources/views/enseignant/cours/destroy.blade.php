<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Supprimer le cours</title>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
</head>
<body class="p-4">

<div class="container text-center">
    <h2>Supprimer le cours : {{ $cours->titre }}</h2>
    <p>Êtes-vous sûr de vouloir supprimer ce cours définitivement ?</p>

    <form action="{{ route('cours.destroy', $cours->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
        <a href="{{ route('cours.show', $cours->id) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
</body>
</html>
