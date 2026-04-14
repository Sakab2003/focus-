<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <title>Admin Dashboard - DASHMIN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('admin/lib/owlcarousel/assets/owl.carousel.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="#" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Admin Dashboard</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('admin/img/user.jpg') }}" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()?->nom ?? 'Admin' }}</h6>
                        <span>Administrateur</span>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <!-- Dashboard -->
                    <a href="/admin/dashboard" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Tableau de bord</a>

                    <!-- Enseignant options -->
                    <a href="{{ route('admin.classes.index') }}" class="nav-item nav-link"><i
                            class="fa fa-plus me-2"></i>Créer salles de classes</a>
                    <a href="{{ route('admin.matieres.index') }}" class="nav-item nav-link"><i
                            class="fa fa-plus me-2"></i>Ajout de matieres</a>
                    <a href="{{ route('admin.annee.index') }}" class="nav-item nav-link"><i
                            class="fa fa-th me-2"></i>Annee scolaire</a>
                    <a href="{{ route('admin.roles.index') }}" class="nav-item nav-link"><i
                            class="fa fa-users me-2"></i>Gestion des utiliateurs</a>
                            
                            {{--
                             <a href="/admin/listecours" class="nav-item nav-link"><i
                            class="fa fa-book me-2"></i>Mes cours</a>
                    <a href="/admin/listeexercice" class="nav-item nav-link"><i
                            class="fa fa-pencil-alt me-2"></i>Mes exercices</a>
                    <a href="/admin/listenotes" class="nav-item nav-link"><i
                            class="bi bi-bar-chart-fill me-2"></i>Corriger l'élève</a>
                    

                    <!-- Parent options -->
                    <a href="/parent/eleve/inscription" class="nav-item nav-link"><i
                            class="fa fa-user-plus me-2"></i>Inscriptions</a>
                    <a href="{{ route('parent.cours') }}" class="nav-item nav-link"><i
                            class="fa fa-book-reader me-2"></i>Cours</a>
                    <a href="{{ route('parent.exercice') }}" class="nav-item nav-link"><i
                            class="fa fa-edit me-2"></i>Exercices</a>
                    <a href="/parent/eleve/liste" class="nav-item nav-link"><i
                            class="fa fa-child me-2"></i>Mes enfants</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Progressions</a>
                    <a href="/parent/eleve/enseignant" class="nav-item nav-link"><i class="fa fa-chalkboard-teacher me-2"></i>Choix d'enseignant</a>
                    <a href="/parent/suivi" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Suivi de l'élève</a>--}}

                    <!-- Paramètres -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-file-alt me-2"></i>Paramètres
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/profile" class="dropdown-item">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Se déconnecter') }}
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
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>

                <div class="navbar-nav align-items-center ms-auto">
                    <!-- Messages -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('admin/img/user.jpg') }}" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all messages</a>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notifications</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Profile updated</a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">New user added</a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">Password changed</a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>

                    <!-- User Profile -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('admin/img/user.jpg') }}" alt=""
                                style="width: 40px; height: 40px;">
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

            <!-- Statistics Cards -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Devoirs</p>
                                <h6 class="mb-0">{{ $total_devoirs ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Cours</p>
                                <h6 class="mb-0">{{ $total_cours ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total des parents</p>
                                <h6 class="mb-0">{{ $total_parents ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Élèves</p>
                                <h6 class="mb-0">{{ $total_eleves ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Parent stats -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Enseignants disponibles</p>
                                <h6 class="mb-0">{{ $total_enseignants ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-school fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Classes disponibles</p>
                                <h6 class="mb-0">{{ $total_classes ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Focus+</a>, Tous les droits sont réservés.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="#">SAMUEL</a><br>
                            Distributed By <a class="border-bottom" href="#">DSI MEBAPLN</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->

        </div>
        <!-- Content End -->
    </div>

    <!-- JS FILES -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('admin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('admin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="{{ asset('admin/js/main.js') }}"></script>
</body>

</html>
