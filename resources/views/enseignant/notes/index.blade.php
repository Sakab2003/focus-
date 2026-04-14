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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

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
     src="{{ Auth::user()->enseignant?->photo
        ? asset('storage/enseignants/' . Auth::user()->enseignant === null)
        : asset('admin/img/user.jpg') }}">

                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->nom }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                    <!-- FIN PROFIL -->

                </div>
            </nav>
            <!-- Navbar End -->
            <div class="container mt-4">
                <h2>Listes des notes</h2>
            <table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <td>#</td>
            <th>Élève</th>
            <th>Classe</th>
            <th>Matière</th>
            <th>Devoir</th>
            <th>Note</th>
            <th>Enseignant</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($notes as $note)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $note->eleve?->nom ?? '-' }} {{ $note->eleve?->prenom ?? '' }}
                </td>

                <td>
                    {{ $note->eleve->classe->name ?? '-' }}
                </td>

                <td>
                    {{ $note->devoir->cours->matiere->name ?? '-' }}
                </td>

                <td>
                    {{ $note->devoir->cours->titre ?? '-' }}
                </td>

                <td>
                    {{ $note->valeur }}
                </td>

                <td>
                    {{ $note->devoir->cours->enseignant->nom ?? '-' }}
                </td>

<td class="text-end">

    <!-- Modifier -->
    <a href="{{ route('enseignant.notes.edit', $note->id) }}"
       class="btn btn-sm btn-primary">
        <i class="fa fa-edit"></i>
    </a>
                    
<!-- Supprimer -->
    <button type="button"
            class="btn btn-sm btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#deleteModal{{ $note->id }}">
        <i class="fa fa-trash"></i>
    </button>

    <!-- Modal suppression -->
    <div class="modal fade"
         id="deleteModal{{ $note->id }}"
         tabindex="-1"
         aria-labelledby="deleteModalLabel{{ $note->id }}"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-danger"
                        id="deleteModalLabel{{ $note->id }}">
                        Confirmation de suppression
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>
                        Voulez-vous vraiment supprimer la note de
                        <strong>{{ $note->eleve?->nom ?? '-' }} {{ $note->eleve?->prenom ?? '' }}</strong>
                        pour le devoir <strong>{{ $note->devoir->cours->titre ?? '-' }}</strong> ?
                    </p>
                    <p class="text-muted mb-0">
                        Cette action est irréversible.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Annuler
                    </button>

                    <form action="{{ route('enseignant.notes.destroy', $note->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
</td>

            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">
                    Aucune note enregistrée
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<button onclick="window.history.back()" class="btn btn-primary">
    Retour
</button>

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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js')  }}"></script>
    <script>
$(document).ready(function () {
    $('.select-matieres').select2({
        placeholder: "Sélectionner les matières",
        closeOnSelect: false,   // 🔥 permet de cliquer plusieurs fois sans fermer
        width: '1045'
    });
});
</script>

</body>

</html>






