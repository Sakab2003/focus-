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
            <div class="container">
    <h2>Liste des enseignants disponibles</h2>
    <ul>
        @forelse ($enseignants as $enseignant)
            <li>
                {{ $enseignant->name }} 
                ({{ $enseignant->classes->count() }} classes)
            </li>
        @empty
            <li>Aucun enseignant disponible</li>
        @endforelse
    </ul>
</div>





            {{--
            <div class="container mt-4">
                <hr>
                <hr>

    <h2 class="mb-4 text-center">Liste des Professeurs</h2>
    <hr>
    <hr>

    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 1</h5>
                    <p class="card-text">Calcule, Histoire, Geographie</p>
                    <a href="cours1" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a></div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 2</h5>
                    <p class="card-text">Francais ,Anglais, Education civique</p>
                    <a href="cours2" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a></div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 3</h5>
                    <p class="card-text">SVT, Chimie, physique</p>
                    <a href="cours3" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a> </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 4</h5>
                    <p class="card-text">Français, Philosophie</p>
                    <a href="cours4" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 5</h5>
                    <p class="card-text">Anglais, Espagnol</p>
                    <a href="cours5" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a></div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 6</h5>
                    <p class="card-text">Informatique, Calcule</p>
                    <a href="cours6" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 7</h5>
                    <p class="card-text">Histoire, Geographie</p>
                    <a href="cours7" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Professeur 8</h5>
                    <p class="card-text">Art, Musique</p>
                    <a href="cours8" class="btn btn-danger w-100 mb-2">Consulter les cours</a>
                    <a href="#" class="btn btn-primary w-100">Ajouter un professeur</a>
                </div>
            </div>
        </div>
    </div>

</div>
--}}
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






