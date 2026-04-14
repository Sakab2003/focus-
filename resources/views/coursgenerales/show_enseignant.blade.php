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
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Espace enseignant</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        @php
    $enseignant = Auth::user()->enseignant;
@endphp

<img class="rounded-circle"
     width="38"
     height="38"
     src="{{ $enseignant && $enseignant->photo
        ? asset('storage/enseignants/' . $enseignant->photo)
        : asset('admin/img/user.jpg') }}">

                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->nom }}</h6>
                        <span>Enseignant</span>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <a href="/enseignant/dashboard" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Mon tableau de bord</a>
                    <a href="/coursgenerales/index_enseignant" class="nav-item nav-link"><i class="bi bi-bar-chart-fill me-2"></i>Voir tous les cours</a>

                    <a href="/enseignant/liste_classe" class="nav-item nav-link"><i
                                class="fa fa-th me-2"></i>Creer classes</a>
                    <div class="nav-item dropdown">
                        <a href="/enseignant/listecours" class="nav-item nav-link"><i
                            class="fa fa-th me-2"></i>Mes cours</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            
                        </div>
                    </div>

                    

                    <a href="{{ route('enseignant.devoir.selectCours') }}" class="nav-item nav-link"><i class="bi bi-bar-chart-fill me-2"></i>Devoirs</a>

                    {{--<a href="/enseignant/gestion_eleve" class="nav-item nav-link"><i
                            class="fa fa-chart-bar me-2"></i>Gerer les eleves</a>--}}
                            <a href="{{ route('enseignant.gestion_eleve') }}" class="nav-item nav-link">
    <i class="fa fa-chart-bar me-2"></i>Corriger devoirs
</a>
<a href="{{ route('enseignant.notes.index') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Gestion des notes</a>
<a href="{{ route('enseignant.liste_eleves') }}" class="nav-item nav-link"><i class="bi bi-bar-chart-fill me-2"></i>Mes eleves</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-file-alt me-2"></i>Parametres
                        </a>

                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/profile" class="dropdown-item">Profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
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

                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>

                <div class="navbar-nav align-items-center ms-auto">

                    

                    <!-- PROFIL -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle"
     width="38"
     height="38"
     src="{{ Auth::user()->enseignant && Auth::user()->enseignant->photo
        ? asset('storage/enseignants/' . Auth::user()->enseignant->photo)
        : asset('admin/img/user.jpg') }}">


                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->nom }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="/enseignant/profile" class="dropdown-item">Mon profile</a>
                            <!--<a href="#" class="dropdown-item">Settings</a>-->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Se deconnecter') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                    <!-- FIN PROFIL -->

                </div>
            </nav>
            <!-- Navbar End -->
            <div class="container mt-5">
    <h2 class="mb-3">{{ $cours->titre }}</h2>

    <p><strong>Enseignant:</strong> {{ $cours->enseignant->nom ?? '—' }} {{ $cours->enseignant->prenom ?? '' }}</p>

    <p><strong>Classe(s):</strong>
    @if($cours->classe && $cours->classe->isNotEmpty())
        @foreach($cours->classe as $cl)
            {{ $cl->name }}@if(!$loop->last), @endif
        @endforeach
    @else
        —
    @endif
    </p>

    <p><strong>Matière:</strong> {{ $cours->matiere->name ?? '—' }}</p>

    <hr>

{{-- Contenu textuel --}}
@if(!empty($cours->contenu))
    <h5>Contenu du cours :</h5>
    <div style="border:1px solid #ccc; padding:15px; max-width:100%; word-wrap: break-word; overflow-x:auto;">
    {!! nl2br(($cours->contenu)) !!}</div>
    
    {{-- Lien de téléchargement pour le contenu --}}
    <a href="{{ route('cours.download_contenu', $cours->id) }}" class="btn btn-success mb-3">
        Télécharger le contenu
    </a>
@endif

{{-- Fichier --}}
@if(!empty($cours->fichier))
    <h5>Fichier du cours :</h5>
    <a href="{{ route('cours.download_fichier', $cours->id) }}" class="btn btn-primary mb-3">
        Télécharger le fichier
    </a>
@endif


{{-- Si les deux sont vides --}}
@if(empty($cours->contenu) && empty($cours->fichier))
    <div class="alert alert-warning">Aucun contenu disponible pour ce cours.</div>
@endif


    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Retour</a>
</div>
            <!-- FOOTER -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Focus+</a>, Tous les droits sont reserves.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="#">SAMUEL</a><br>
                            Distributed By <a class="border-bottom" href="#" target="_blank">DSI MEBAPLN</a>
                        </div>
                    </div>
                </div>
            </div>

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
