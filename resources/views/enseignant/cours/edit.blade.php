<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tableau de bord - Focus+</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
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
            <h2>Modifier le cours : {{ $cours->titre }}</h2>

            {{-- Messages d’erreurs --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('cours.update', $cours->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Classe (verrouillée) --}}
<div class="mb-3">
    <label class="form-label">Classe</label>
    <input type="text" class="form-control" 
       value="{{ $cours->classe->name ?? 'Classe non définie' }}" 
       readonly>
</div>

{{-- Matière (verrouillée) --}}
<div class="mb-3">
    <label class="form-label">Matière</label>
    <select class="form-control" disabled>
        <option>{{ $cours->matiere->name ?? 'Non défini' }}</option>
    </select>
    <input type="hidden" name="id_matiere" value="{{ $cours->id_matiere }}">
</div>

                {{-- Année scolaire --}}
                <div class="mb-3">
                    <label class="form-label">Année scolaire</label>
                    <select name="id_annee_scolaire" class="form-select" required>
    <option value="">-- Choisir une année scolaire --</option>
    @foreach($annees as $ann)
        <option value="{{ $ann->id }}" {{ old('id_annee_scolaire', $cours->id_annee_scolaire) == $ann->id ? 'selected' : '' }}>
            {{ $ann->libelle }}
        </option>
    @endforeach
</select>
                </div>

                {{-- Titre --}}
                <div class="mb-3">
                    <label class="form-label">Titre du cours</label>
                    <input type="text" name="titre" class="form-control" value="{{ old('titre', $cours->titre) }}" required>
                </div>

                {{-- Contenu --}}
                <div class="mb-3">
                    <label class="form-label">Contenu du cours</label>
                    <textarea name="contenu" class="form-control" rows="8">{!! old('contenu', $cours->contenu) !!}</textarea>
                </div>

                {{-- Fichier --}}
                <div class="mb-3">
                    <label class="form-label">Fichier (PDF, image, document)</label>
                    @if($cours->fichier)
                        <p>Fichier actuel : <strong>{{ basename($cours->fichier) }}</strong></p>
                        <a href="{{ asset('storage/'.$cours->fichier) }}" target="_blank" class="btn btn-primary btn-sm me-2">Ouvrir</a>
                        <label>Remplacer le fichier</label>
                    @endif
                    <input type="file" name="fichier" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <button type="button" onclick="window.history.back()" class="btn btn-secondary">Retour</button>
            </form>
        </div>

        {{-- CKEditor --}}
        <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('contenu', { height: 300 });

            // Mettre à jour textarea avant submit
            document.addEventListener('DOMContentLoaded', function() {
    CKEDITOR.replace('contenu', { height: 300 });

    document.querySelector('form').addEventListener('submit', function(e) {
        for (let instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    });
});


            // Supprimer fichier
            function removeFile(index, event) {
                if(confirm("Voulez-vous vraiment supprimer ce fichier ?")) {
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'delete_files[]';
                    input.value = index;
                    document.querySelector('form').appendChild(input);
                    event.target.closest('li').remove();
                }
            }

            // Sélection de classe
            document.querySelectorAll('.class-card').forEach(card => {
                card.addEventListener('click', function() {
                    document.getElementById('id_classe').value = this.dataset.id;
                    document.querySelectorAll('.class-card').forEach(c => c.classList.remove('border-success'));
                    this.classList.add('border-success');
                });
            });
        </script>

        @include('layouts.footer')
    </div>
</div>

<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/style.js') }}"></script>
</body>

</html>
