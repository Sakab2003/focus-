<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
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
        </div> 
        --}}
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        @include('layouts.sidebar_enseignant')
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('layouts.header')
            <!-- Navbar End -->

            <!-- Alert Success -->
            @if(session('status'))
            <div class="alert alert-success text-center mt-2">
                {{ session('status') }}
            </div>
            @endif

            <!-- Erreurs Globales -->
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h2>Liste des élèves</h2>
            <table class="table table-bordered" >
    <thead>
        <tr>
            <th>#</th>
            <th>Élève</th>
            <th>Classe(s)</th>
            <th>Matière(s)</th>
            <th>Cours suivis</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eleves as $data)
            <tr>
                <td>{{ $loop->iteration }}</td> {{-- Numérotation automatique --}}
                <td>
                    {{ $data['eleve']->nom }} {{ $data['eleve']->prenom }}
                </td>

                <td>
                    {{ implode(', ', $data['classes'] ?? []) }}
                </td>

                <td>
                    {{ implode(', ', $data['matieres'] ?? []) }}
                </td>

                <td>
                    <ul>
                        @foreach ($data['cours'] ?? [] as $cours)
                            <li>{{ $cours }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('enseignant.voir_parent', $data['eleve']->id) }}" 
   class="btn btn-info btn-sm">
   Voir infos du parent
</a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<button onclick="window.history.back()" class="btn btn-primary">
    Retour
</button>

            {{--<h2>Liste des élèves</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Classe</th>
        </tr>
    </thead>
    <tbody>
        @forelse($eleves as $eleve)
            <tr>
                <td>{{ $eleve->nom }}</td>
                <td>{{ $eleve->prenom }}</td>
                <td>{{ $eleve->classe->name ?? '—' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Aucun élève trouvé</td>
            </tr>
        @endforelse
    </tbody>
</table>--}}

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
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>






