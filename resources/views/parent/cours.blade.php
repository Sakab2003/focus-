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

       <div class="container py-4">

<h2 class="text-center mb-4">📚 Cours par classe</h2>

@isset($message)
<div class="alert alert-warning">{{ $message }}</div>
@endisset

{{-- ===================== --}}
{{-- CLASSES EN CARDS --}}
{{-- ===================== --}}
@if($classes->isEmpty())
<p class="text-muted">Aucune classe disponible.</p>
@else

<div class="row mb-4">

@foreach($classes as $classe)
<div class="col-md-4 mb-4">

<a href="{{ route('parent.cours', ['classe_id' => $classe->id]) }}"
   style="text-decoration:none; color:inherit;">

<div class="card shadow-sm h-100 border-0">

<div class="card-body">

<h5 class="text-primary mb-2">
{{ $classe->name }}
</h5>

<p class="mb-1">
👨‍🏫 <strong>Enseignant :</strong>

{{ $classe->enseignants->isNotEmpty()
    ? $classe->enseignants
        ->map(fn($e) => $e->nom.' '.$e->prenom)
        ->join(', ')
    : '—'
}}
</p>


@if($classe->matieres && $classe->matieres->count())
<p class="mb-0">
📘 <strong>Matières :</strong>
{{ $classe->matieres->pluck('name')->join(', ') }}
</p>
@endif

</div>

<div class="card-footer text-center bg-light">
<small class="text-muted">
Cliquer pour voir les cours
</small>
</div>

</div>
</a>

</div>
@endforeach

</div>

@endif


{{-- ===================== --}}
{{-- TABLE DES COURS --}}
{{-- ===================== --}}
@if(request()->filled('classe_id'))

@if($cours->isEmpty())

<div class="alert alert-warning">
Aucun cours disponible pour cette classe.
</div>

@else

<table class="table table-bordered table-hover">
<thead class="table-primary">
<tr>
<th>#</th>
<th>Titre</th>
<th>Classe</th>
<th>Matière</th>
<th>Action</th>
</tr>
</thead>

<tbody>
@foreach($cours as $c)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $c->titre ?? '—' }}</td>

<td>
{{ $c->classe->name }}
</td>

<td>{{ $c->matiere->name ?? '—' }}</td>

<td>
<button class="btn btn-info btn-sm btn-consulter"
data-id="{{ $c->id }}">
Consulter
</button>
</td>
</tr>
@endforeach
</tbody>
</table>

<button onclick="window.history.back()" class="btn btn-primary">
Retour
</button>

@endif
@endif


{{-- ===================== --}}
{{-- DETAILS COURS --}}
{{-- ===================== --}}
@if(request()->filled('classe_id'))
@foreach($cours as $c)

<div id="cours-detail-{{ $c->id }}"
class="cours-detail"
style="display:none; margin-top:20px;">

<div class="card shadow-sm p-3 mb-4">

@if(!empty($c->titre))
<div class="d-flex align-items-start mb-2">
<span class="fw-bold text-primary me-2">Titre :</span>
<span>{{ $c->titre }}</span>
</div>
@endif

<div class="d-flex align-items-start mb-2">
<span class="fw-bold text-primary me-2">Classe :</span>
<span>{{ $c->classe->name }}</span>
</div>

<div class="d-flex align-items-start mb-2">
<span class="fw-bold text-primary me-2">Matière :</span>
<span>{{ $c->matiere->name ?? '—' }}</span>
</div>

@if(!empty($c->contenu))
<div class="mb-3 text-center">
<h5 class="fw-bold border-bottom pb-1 mb-3">
Contenu du cours
</h5>
</div>

<div class="p-3 rounded shadow-sm"
style="background:#f8f9fa;">
{!! $c->contenu !!}
</div>

<a href="{{ route('parent.cours.contenu', $c->id) }}"
class="btn btn-primary btn-sm mb-2">
📥 Télécharger le contenu (PDF)
</a>
@endif

@if(!empty($c->fichier))
<p>
📎 Fichier joint :
<a href="{{ asset('uploads/cours/' . $c->fichier) }}"
target="_blank"
download>
{{ $c->fichier }}
</a>
</p>
@endif

<div class="d-flex justify-content-between">
<button class="btn btn-danger btn-fermer">
Fermer
</button>

<button onclick="window.history.back()"
class="btn btn-primary">
Retour
</button>
</div>

</div>
</div>

@endforeach
@endif

</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

const buttons = document.querySelectorAll('.btn-consulter');
const fermerButtons = document.querySelectorAll('.btn-fermer');

buttons.forEach(btn => {
btn.addEventListener('click', function() {

const id = this.dataset.id;

document.querySelectorAll('.cours-detail')
.forEach(div => div.style.display = 'none');

const detail =
document.getElementById('cours-detail-' + id);

if(detail) detail.style.display = 'block';

detail.scrollIntoView({behavior:'smooth'});
});
});

fermerButtons.forEach(btn => {
btn.addEventListener('click', function() {
this.closest('.cours-detail').style.display = 'none';
});
});

});
</script>

            
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn-consulter');
        const fermerButtons = document.querySelectorAll('.btn-fermer');

        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;

                // cacher toutes les sections avant
                document.querySelectorAll('.cours-detail').forEach(div => div.style.display = 'none');

                // afficher la section correspondant au cours
                const detail = document.getElementById('cours-detail-' + id);
                if(detail) detail.style.display = 'block';

                // scroll vers le détail
                detail.scrollIntoView({behavior: 'smooth'});
            });
        });

        // bouton fermer
        fermerButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.cours-detail').style.display = 'none';
            });
        });
    });
</script>

</body>

</html>
