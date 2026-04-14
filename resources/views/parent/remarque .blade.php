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
    <link href={{asset('img/favicon.ico" rel="icon')}}>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href={{asset('admin/lib/owlcarousel/assets/owl.carousel.min.css')}} rel="stylesheet">
    <link href={{asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}} rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href={{asset('admin/css/bootstrap.min.css')}} rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href={{asset('admin/css/style.css')}} rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Espace parent</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src={{asset('admin/img/user.jpg')}} alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->nom }}</h6>
                        <span>Parent</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="/parent/dashboard" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashbord</a>
                    <a href="/coursgenerales/index_parent" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Voir tous les cours</a>
                    <a href="/parent/eleve/liste_inscription" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Inscriptions</a>
                    <a href="/parent/cours" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Cours</a>
<div class="nav-item dropdown">                     <a href="/parent/eleve/liste" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Devoirs</a>
                    <a href="/parent/suivi" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Suivi de l'eleve</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Parametres</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/profile" class="dropdown-item">Profile</a>
                            <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Se deconnecter') }}
                            </x-dropdown-link>
                        </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src={{asset('admin/img/user.jpg')}} alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src={{asset('admin/img/user.jpg')}} alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src={{asset('admin/img/user.jpg')}} alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src={{asset('admin/img/user.jpg')}} alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->nom }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <h3 class="mb-4">📘 Remarque des enfants</h3>

<form method="GET" action="{{ route('parent.remarque') }}" class="mb-4">
    <div class="row">
        <div class="col-md-6">
            <select name="classe_id" class="form-select" required>
                <option value="">🏫 Choisir une classe</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}"
                        @selected(request('classe_id') == $classe->id)>
                        {{ $classe->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Afficher</button>
        </div>
    </div>
</form>
@if(request()->filled('classe_id'))

    @if($eleves->isEmpty())
        <div class="alert alert-warning">
            Aucun élève trouvé dans cette classe.
        </div>
    @else

        @foreach($eleves as $eleve)
            <h5 class="mt-4">
                👦 {{ $eleve->nom }} {{ $eleve->prenom }}
            </h5>

            @if($eleve->notes->isEmpty())
                <p class="text-muted">Aucune note disponible</p>
            @else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Élève</th>
            <th>Classe</th>
            <th>Matière</th>
            <th>Devoir</th>
            <th>Note</th>
            <th>Remarque</th>
            <th>Enseignant</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eleves as $eleve)
            @forelse($eleve->notes as $note)
                <tr>
                    <td>{{ $eleve->nom }} {{ $eleve->prenom }}</td>
                    <td>{{ $eleve->classe->name ?? '-' }}</td>
                    <td>{{ $note->devoir->cours->matiere->name ?? '-' }}</td>
                    <td>{{ $note->devoir->cours->titre ?? '-' }}</td>
                    <td>{{ $note->valeur ?? '-' }}</td>
                    <td>{{ $note->remarque ?? '-' }}</td>
                    <td>{{ $note->devoir->cours->enseignant->nom ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td>{{ $eleve->nom }} {{ $eleve->prenom }}</td>
                    <td>{{ $eleve->classe->name ?? '-' }}</td>
                    <td colspan="4" class="text-center">Aucune note</td>
                </tr>
            @endforelse
        @endforeach
    </tbody>
</table>



            @endif
        @endforeach

    @endif
@endif

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Focus+</a>, Tous les droits sont reserves. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">SAMUEL</a>
                        </br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">DSI MEBAPLN</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src={{asset('admin/lib/chart/chart.min.js')}}></script>
    <script src={{asset('admin/lib/easing/easing.min.js')}}></script>
    <script src={{asset('admin/lib/waypoints/waypoints.min.js')}}></script>
    <script src={{asset('admin/lib/owlcarousel/owl.carousel.min.js')}}></script>
    <script src={{asset('admin/lib/tempusdominus/js/moment.min.js')}}></script>
    <script src={{asset('admin/lib/tempusdominus/js/moment-timezone.min.js')}}></script>
    <script src={{asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}></script>

    <!-- Template Javascript -->
    <script src={{asset('admin/js/main.js')}}></script>
</body>

</html>
