<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <title>Supprimer la classe</title>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body class="p-4 d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="container text-center">
    <h2>Supprimer la classe : {{ $classe->niveau }}</h2>

    <p>Êtes-vous sûr de vouloir supprimer cette classe définitivement ?</p>

    <form action="{{ route('classe.destroy', $classe->id_classe) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">
            Oui, supprimer
        </button>

        <a href="{{ route('classe.liste') }}" class="btn btn-secondary">
            Annuler
        </a>
    </form>
</div>

<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
</body>
</html>
