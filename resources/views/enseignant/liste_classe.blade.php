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

            <h1>Mes classes virtuelles</h1>

<a href="{{ route('enseignant.ajout_classe') }}" class="btn btn-success mb-3">
    + Nouvelle classe virtuelle
</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Classe</th>
            <th>Matière(s)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($enseignant->classes as $classe)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $classe->salle?->nom ?? 'Salle non définie' }}
                </td>

                <td>
                    @forelse($classe->matieres as $matiere)
                        <span>{{ $matiere->name }}</span>
                    @empty
                        <span class="text-muted">Aucune matière</span>
                    @endforelse
                </td>

                <td>
                    <a href="{{ route('enseignant.classe.edit', $classe->id) }}"
                       class="btn btn-info btn-sm">Modifier</a>
                    <!-- Bouton ouvrir modal -->
<button type="button"
        class="btn btn-danger btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $classe->id }}">
    Supprimer
</button>

<!-- Modal suppression -->
<div class="modal fade"
     id="deleteModal{{ $classe->id }}"
     tabindex="-1"
     aria-labelledby="deleteModalLabel{{ $classe->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger"
                    id="deleteModalLabel{{ $classe->id }}">
                    Confirmation de suppression
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                <p>
                    Voulez-vous vraiment supprimer la classe
                    <strong>{{ $classe->salle?->nom }}</strong> ?
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

                <form action="{{ route('enseignant.classe.destroy', $classe->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger">
                        Oui, supprimer
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>
                    <a href="{{ route('enseignant.classe.show', $classe->id) }}"
                       class="btn btn-info btn-sm">Voir</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Aucune classe virtuelle créée.</td>
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

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js')  }}"></script>
</body>

</html>












    
