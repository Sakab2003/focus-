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
            <h2 class="mb-4">📘 {{ $devoir->cours->titre ?? 'Devoir' }}</h2>

<div class="mb-3">
    <label class="form-label fw-bold">Description :</label>
    <div class="border p-3">
        {!! $devoir->cours->contenu ?? '' !!}
    </div>
</div>

@if($devoir->fichier)
    <div class="mb-3">
        <label class="form-label fw-bold">Fichier(s) joint(s) :</label>
        <br>
        <a href="{{ route('parent.devoir.telecharger', $devoir->fichier) }}" class="btn btn-success btn-sm" download>
    Télécharger le devoir (PDF)
</a>


    </div>
@endif

<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
    🔙 Retour
</a>

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
    <script>
    const salles = @json($salles);
    const salleSelect = document.getElementById('salleSelect');
    const classesContainer = document.getElementById('classesContainer');
    const classeInput = document.getElementById('classe_id');

    salleSelect.addEventListener('change', function () {
        classesContainer.innerHTML = '';
        classeInput.value = '';

        const salle = salles.find(s => s.id == this.value);
        if (!salle || !salle.classes_virtuelles) return;

        salle.classes_virtuelles.forEach(classe => {
            const matieres = classe.matieres.map(m => m.name).join(', ');

            const div = document.createElement('div');
            div.classList.add('card', 'p-3', 'mb-2');
            div.style.cursor = 'pointer';
            div.dataset.id = classe.id;

            if (classe.enseignants && classe.enseignants.length > 0) {
    const enseignant = classe.enseignants[0]; // le premier enseignant
    div.innerHTML = `
        <h5>${classe.name}</h5>
        <p><strong>Enseignant :</strong> ${enseignant.nom} ${enseignant.prenom}
            <a href="/parent/enseignant/${enseignant.id}/profil" target="_blank" class="ms-2">Voir profil</a>
        </p>
        <p><strong>Matières :</strong> ${matieres}</p>
    `;
} else {
    div.innerHTML = `
        <h5>${classe.name}</h5>
        <p><strong>Enseignant :</strong> Aucun</p>
        <p><strong>Matières :</strong> ${matieres}</p>
    `;
}


            classesContainer.appendChild(div);

            div.addEventListener('click', function () {
                document.querySelectorAll('#classesContainer .card').forEach(c =>
                    c.classList.remove('border', 'border-primary')
                );
                div.classList.add('border', 'border-primary');
                classeInput.value = classe.id;
            });
        });
    });
</script>
</body>

</html>
