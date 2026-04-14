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
        <!-- Spinner Start -->
{{--         
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @include('layouts.sidebar_enseignant')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('layouts.header')
           
            <!-- Navbar End -->

            


<div class="container mx-auto p-4">
  <h1 class="text-center mb-4">Ajout d'un cours</h1>

  {{-- Message de succès 
  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  {{-- Erreurs globales --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="/ajoutcours" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Titre --}}
    <div class="mb-3">
      <label for="titre" class="form-label">Titre du cours <span class="text-danger">*</span></label>
      <input type="text" id="titre" name="titre" class="form-control" value="{{ old('titre') }}" required>
      @error('titre') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    {{-- Classe --}}
    <div class="mb-3">
      <label for="classe" class="form-label">Classe <span class="text-danger">*</span></label>
      <select id="classe" name="classe" class="form-control" required>
        <option value="">-- Sélectionnez une classe --</option>
        @php
          $classes = ['CP1','CP2','CE1','CE2','CM1','CM2'];
        @endphp
        @foreach($classes as $c)
          <option value="{{ $c }}" {{ old('classe') === $c ? 'selected' : '' }}>{{ $c }}</option>
        @endforeach
      </select>
      @error('classe') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    {{-- Matière --}}
    <div class="mb-3">
      <label for="matiere" class="form-label">Matière <span class="text-danger">*</span></label>
      <select id="matiere" name="matiere" class="form-control" required>
        <option value="">-- Sélectionnez une matière --</option>
        @php
          $matieres = ['Calcul','Mathématiques','Histoire','Géographie','Art','Musique','Anglais','Français','Espagnol','Éducation Civique'];
        @endphp
        @foreach($matieres as $m)
          <option value="{{ $m }}" {{ old('matiere') === $m ? 'selected' : '' }}>{{ $m }}</option>
        @endforeach
      </select>
      @error('matiere') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    {{-- Contenu (CKEditor) --}}
    <div class="mb-3">
      <label for="contenu" class="form-label">Contenu du cours <small class="text-muted">(texte riche)</small></label>
      <textarea id="contenu" name="contenu" class="form-control" rows="8">{!! old('contenu') !!}</textarea>
      @error('contenu') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    {{-- Fichier PDF principal --}}
    <div class="mb-3">
      <label for="fichier" class="form-label">Fichier PDF (optionnel)</label>
      <input type="file" id="fichier" name="fichier" class="form-control" accept="application/pdf">
      @error('fichier') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    {{-- Uploader multiple (images, documents) --}}
    <div class="mb-3">
      <label for="fichiers" class="form-label">Autres fichiers (optionnel, vous pouvez en sélectionner plusieurs)</label>
      <input type="file" id="fichiers" name="fichiers[]" class="form-control" multiple>
      @error('fichiers') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    {{-- Boutons --}}
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">Ajouter le cours</button>
      <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
    </div>
  </form>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    if (typeof CKEDITOR !== 'undefined') {
      CKEDITOR.replace('contenu', {
        height: 300
      });
    }
  });
</script>


  
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
</body>

</html>






