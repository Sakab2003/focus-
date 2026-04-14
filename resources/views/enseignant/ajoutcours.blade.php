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
    <div class="container-xxl p-0">
        @include('layouts.sidebar_enseignant')
        <div class="content">
            @include('layouts.header')

            <div class="container mt-4">
                <h2>Ajouter un cours</h2>

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

                <form method="POST" action="{{ route('cours.ajout_traitement') }}" enctype="multipart/form-data">
    @csrf

    {{-- Classe --}}
    <div class="mb-3">
    <label class="form-label">Classe</label>
    <select name="id_classe" id="classe-select" class="form-control" required>
        <option value="">-- Choisir une classe --</option>
        @foreach($classes as $classe)
            <option value="{{ $classe->id }}">{{ $classe->name }}</option>
        @endforeach
    </select>
</div>

    {{-- Matière --}}
    <div class="mb-3">
    <label class="form-label">Matière</label>
    <select name="id_matiere" id="matiere-select" class="form-control" required>
        <option value="">-- Choisir une matière --</option>
    </select>
</div>

    {{-- Année scolaire --}}
    <div class="mb-3">
    <label class="form-label">Année scolaire</label>
    <select name="annee_scolaire" class="form-select" required>
        <option value="">-- Choisir une année scolaire --</option>
        @foreach($annees as $ann)
            <option value="{{ $ann->libelle }}"
                {{ old('annee_scolaire') == $ann->libelle ? 'selected' : '' }}>
                {{ $ann->libelle }}
            </option>
        @endforeach
    </select>
</div>


    {{-- Titre --}}
    <div class="mb-3">
        <label class="form-label">Titre du cours</label>
        <input type="text" name="titre" class="form-control" value="{{ old('titre') }}" required>
    </div>

    {{-- Contenu --}}
    <div class="mb-3">
        <label class="form-label">Contenu du cours</label>
        <textarea name="contenu" class="form-control" rows="8">{{ old('contenu') }}</textarea>
    </div>
    {{-- Fichier --}}
                    <div class="mb-3">
                        <label class="form-label">Fichier (PDF, image, document)</label>
                        <input type="file" name="fichier" class="form-control">
                    </div>

    <button type="submit" class="btn btn-primary">Enregistrer le cours</button>
    <button onclick="window.history.back()" class="btn btn-primary">
    Retour
</button>
</form>

            </div>
  
            <!-- Footer Start -->
            @include('layouts.footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js')  }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js')  }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js')  }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')  }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js')  }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js')  }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')  }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js')  }}"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('contenu');
</script>
<script>
$(document).ready(function() {
    $('#classe-select').change(function() {
        var classeId = $(this).val();
        if(classeId) {
            $.ajax({
    url: '/enseignant/matieres-ajax/' + classeId,
    type: 'GET',
    success: function(data) {
        $('#matiere-select').empty();
        $('#matiere-select').append('<option value="">-- Choisir une matière --</option>');
        $.each(data, function(key, value) {
            $('#matiere-select').append('<option value="'+ value.id +'">'+ value.name +'</option>');
        });
    }
});

        } else {
            $('#matiere-select').empty();
            $('#matiere-select').append('<option value="">-- Choisir une matière --</option>');
        }
    });
});
</script>


</body>

</html>






