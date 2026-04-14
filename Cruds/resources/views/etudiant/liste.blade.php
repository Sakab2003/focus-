<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cruds en laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
            <h1>Les differents cruds en laravel</h1>
            @if (session('status'))
            <div class="alert alert-success">
            {{ session('status') }} 
            </div>
            @endif
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Noms</th>
      <th scope="col">Prenoms</th>
      <th scope="col">Classe</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php
    $ide =1;
    @endphp
    @foreach($etudiants as $etudiant)
    <tr>
      <td>{{ $ide }}</td>
      <td>{{ $etudiant->nom }}</td>
      <td>{{ $etudiant->prenom }}</td>
      <td>{{ $etudiant->classe }}</td>
      <td>
        <a href="/update-etudiant/{{ $etudiant->id }}" class="btn btn-info">Update</a>
        <a href="/delete-etudiant/{{ $etudiant->id }}" class="btn btn-danger">Delete</a>
    </td>
    </tr>
    @php
    $ide += 1;
    @endphp
    @endforeach
  </tbody>
</table>
{{$etudiants->links()}}
            <a href="/ajouter" class="btn btn-primary">Ajouter un etudiant</a>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>