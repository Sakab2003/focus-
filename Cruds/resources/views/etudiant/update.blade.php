<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
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
            <h1>Modifier un etudiant -laravel</h1>
            <hr>
            @if (session('status'))
            <div class="alert alert-success">
            {{ session('status') }} 
            </div>
            @endif
            
            <ul>
            @foreach($errors->all() as $error)
            <li class="alert alert-danger"> {{ $error }}</li>
            @endforeach

            </ul>
            <form action="/update/traitement" method="POST">
                @csrf
                <input type="text" name="id" style="display: none;" value="{{ $etudiants->id }}">
  <div>
    <label for="Nom">Nom</label>
    <input type="text" class="form-control" id="Nom" name="nom" value="{{ $etudiants->nom }}">
  </div>
  <div>
    <label for="Nom">Prenom</label>
    <input type="text" class="form-control" id="Prenom" name="prenom" value="{{ $etudiants->prenom }}" >
  </div>
  <div>
    <label for="Nom">Classe</label>
    <input type="text" class="form-control" id="Classe" name="classe" value="{{ $etudiants->classe }}">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Modifier</button>
  <br>
  <br>
  <a href="{{ url('update-etudiant/'.$etudiants->id) }}" class="btn btn-danger">Revenir a la liste</a>

</form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>