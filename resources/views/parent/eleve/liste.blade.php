<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <title>DASHMIN - Bootstrap Admin Template</title>
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
        @include('layouts.sidebar')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('layouts.header')
           
            <!-- Navbar End -->
            <div class="container py-4">

<h2 class="text-center mb-4">Devoirs par classe</h2>

@isset($message)
<div class="alert alert-warning">{{ $message }}</div>
@endisset

{{-- ===================== --}}
{{-- CLASSES EN CARDS --}}
{{-- ===================== --}}
@if($classes->isEmpty())
<p class="text-muted">Aucune classe disponible pour vos élèves.</p>
@else

<div class="row mb-4">

@foreach($classes as $classe)
<div class="col-md-4 mb-4">

<a href="{{ route('parent.devoirs', ['classe_id' => $classe->id]) }}"
   style="text-decoration:none; color:inherit;">

<div class="card shadow-sm h-100 border-0">

<div class="card-body">

<h5 class="text-primary mb-2">
🏫 {{ $classe->name }}
</h5>

<p class="mb-0">
👨‍🏫 <strong>Enseignant(s) :</strong>

{{ $classe->enseignants->isNotEmpty()
    ? $classe->enseignants
        ->map(fn($e) => $e->nom.' '.$e->prenom)
        ->join(', ')
    : '—'
}}
</p>

</div>

<div class="card-footer text-center bg-light">
<small class="text-muted">
Cliquer pour voir les devoirs
</small>
</div>

</div>
</a>

</div>
@endforeach

</div>

@endif


{{-- ===================== --}}
{{-- AFFICHAGE DES DEVOIRS --}}
{{-- (CODE INCHANGÉ) --}}
{{-- ===================== --}}
@if(request()->filled('classe_id'))

@if($devoirs->isEmpty())

<div class="alert alert-warning">
Aucun devoir n'a encore été ajouté dans cette classe.
</div>

@else

<div class="row g-3">

@php
$devoirIndexParCours = [];
@endphp

@foreach($devoirs as $devoir)

<div class="card shadow-sm p-3 mb-4">

@php
$coursId = $devoir->id_cours;

if (!isset($devoirIndexParCours[$coursId])) {
    $devoirIndexParCours[$coursId] = 1;
} else {
    $devoirIndexParCours[$coursId]++;
}

$numeroDevoir = $devoirIndexParCours[$coursId];
@endphp

<div class="d-flex justify-content-between mt-3">

<h5 class="fw-bold text-primary">
📘 Devoir {{ $numeroDevoir }} de {{ $devoir->cours->titre ?? 'Titre indisponible' }}
</h5>

<span class="text-muted">
📅 Date de remise : {{ $devoir->date_limite }}
</span>

<form action="{{ route('parent.traiter_devoir') }}" method="POST" style="display:inline">
@csrf
<input type="hidden" name="devoir_id" value="{{ $devoir->id }}">

<button type="submit" class="btn btn-success">
Choisir un eleve
</button>

<a href="{{ route('parent.voir_devoir', $devoir->id) }}" class="btn btn-info">
👁️ Voir le devoir
</a>

</form>

</div>
</div>

@endforeach

</div>

<button onclick="window.history.back()" class="btn btn-primary">
Retour
</button>

@endif
@endif

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
</body>

</html>












    
