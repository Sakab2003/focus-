<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <title>Tableau de bord - Focus+</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('admin/lib/owlcarousel/assets/owl.carousel.min.css') }}"   rel="stylesheet">
    <link href="{{ asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"   rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}"   rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('admin/css/style.css') }}"   rel="stylesheet">
</head>
<body>
<div class="container-xxl position-relative bg-white d-flex p-0">

    @include('layouts.sidebar_enseignant')

    <div class="content">
        @include('layouts.header')

        <div class="container mt-4">
            <h2>Modifier l'exercice : {{ $exercice->titre }}</h2>

            <form action="{{ route('exercice.update', $exercice->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Titre --}}
                <div class="mb-3">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $exercice->titre) }}" required>
                </div>

                <div class="mb-3">
  <label class="form-label">Niveau</label>
  <input type="text" class="form-control" value="{{ $exercice->classe->niveau }}" readonly>
</div>

<div class="mb-3">
  <label class="form-label">Classe disponible</label>
  <div id="classes-container" class="row g-3">
    @if($exercice->classe)
      <div class="col-md-4">
        <div class="card p-3 shadow-sm class-card border border-primary"
             data-id="{{ $exercice->classe->id_classe }}"
             style="cursor:pointer">
          <h5>{{ $exercice->classe->niveau }}</h5>
          @php
    $matieres = $exercice->classe->matieres;

    // Si c'est une chaîne JSON ou CSV, on convertit
    if(is_string($matieres)) {
        $decoded = json_decode($matieres, true);
        $matieres = $decoded ?? explode(',', $matieres);
    }
@endphp

<p><strong>Matières :</strong>
    @if(!empty($matieres) && is_array($matieres))
        {{ implode(', ', $matieres) }}
    @else
        <span class="text-muted">Aucune matière</span>
    @endif
</p>

        </div>
      </div>
    @endif
  </div>
</div>

<input type="hidden" name="id_classe" id="id_classe" value="{{ $exercice->classe->id_classe }}">


                {{-- Contenu --}}
                <div class="mb-3">
                    <label for="contenu">Contenu</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="8">{!! old('contenu', $exercice->contenu) !!}</textarea>
                </div>

                {{-- PDF principal --}}
                <div class="mb-3">
                    <label>Fichier PDF principal</label>
                    @if($exercice->fichier)
                        <p>Fichier actuel : <strong>{{ basename($exercice->fichier) }}</strong></p>
                        <a href="{{ asset('storage/'.$exercice->fichier) }}" target="_blank" class="btn btn-primary btn-sm me-2">Ouvrir</a>
                        <label>Remplacer le PDF</label>
                    @endif
                    <input type="file" name="fichier" class="form-control" accept="application/pdf">
                </div>

                {{-- Autres fichiers --}}
                <div class="mb-3">
                    <label>Autres fichiers</label>
                    @if(!empty($exercice->fichiers))
                        <ul class="list-group mb-2">
                            @foreach($exercice->fichiers as $index => $file)
                                @php $filePath = is_array($file) ? ($file[0] ?? null) : $file; @endphp
                                @if($filePath)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ basename($filePath) }}
                                        <div>
                                            <a href="{{ asset('storage/'.$filePath) }}" target="_blank" class="btn btn-sm btn-primary me-2">Ouvrir</a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="removeFile({{ $index }})">Supprimer</button>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    <input type="file" name="fichiers[]" class="form-control" multiple>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
        
        <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('contenu', { height: 300 });
    function removeFile(index) {
        if(confirm("Voulez-vous vraiment supprimer ce fichier ?")) {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_files[]';
            input.value = index;
            document.querySelector('form').appendChild(input);
            event.target.closest('li').remove();
        }
    }
</script>


        @include('layouts.footer')
    </div>
</div>


<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/style.js') }}"></script>
</body>
</html>
