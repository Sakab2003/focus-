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
            <div class="container">
            <h2>Liste des devoirs pour le cours : {{ $cours->titre }}</h2>
    <a href="{{ route('enseignant.devoir.create', $cours->id) }}" class="btn btn-success mb-3">
        + Nouveau devoir
    </a>

<p>Matière : {{ $cours->matiere->name ?? 'N/A' }}</p>
<p>Classe(s) : 
    @foreach($cours->matiere->classes as $classe)
        {{ $classe->name }}{{ !$loop->last ? ', ' : '' }}
    @endforeach
</p>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Matiere</th>
            <th>Classe</th>
            <th>Date limite</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($devoirs as $devoir)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $devoir->titre }}</td>
                <td>{{ $cours->matiere->name ?? 'N/A' }}</td>
                <td> 
    @foreach($cours->matiere->classes as $classe)
        {{ $classe->name }}{{ !$loop->last ? ', ' : '' }}
    @endforeach</td>
                <td>{{ \Carbon\Carbon::parse($devoir->date_limite)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('enseignant.devoir.show', $devoir->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('enseignant.devoir.edit', $devoir->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <!-- Bouton ouvrir modal -->
<button type="button"
        class="btn btn-danger btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#deleteModalDevoir{{ $devoir->id }}">
    Supprimer
</button>

<!-- Modal suppression -->
<div class="modal fade"
     id="deleteModalDevoir{{ $devoir->id }}"
     tabindex="-1"
     aria-labelledby="deleteModalLabelDevoir{{ $devoir->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger"
                    id="deleteModalLabelDevoir{{ $devoir->id }}">
                    Confirmation de suppression
                </h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                <p>
                    Voulez-vous vraiment supprimer le devoir
                    <strong>{{ $devoir->titre }}</strong> ?
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

                <form action="{{ route('enseignant.devoir.destroy', $devoir->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Oui, supprimer
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


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






