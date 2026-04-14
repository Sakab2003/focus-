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
    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4>Profil de l’enseignant</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="text-center mb-3">
                <img class="rounded-circle"
     width="38"
     height="38"
     src="{{ $enseignant?->photo
        ? asset('storage/enseignants/' . $enseignant->photo)
        : asset('admin/img/user.jpg') }}">
            </div>

            <form method="POST"
                  action="{{ route('enseignant.profile.update') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Photo de profil</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control"
                           value="{{ $enseignant->nom }}">
                </div>

                <div class="mb-3">
                    <label>Prénom</label>
                    <input type="text" name="prenom" class="form-control"
                           value="{{ $enseignant->prenom }}">
                </div>

                <div class="mb-3">
                    <label>Téléphone</label>
                    <input type="text" name="telephone" class="form-control"
                           value="{{ $enseignant->telephone }}">
                </div>

                <div class="mb-3">
                    <label>Bibliographie</label>
                    <textarea name="bibliographie"
                              class="form-control"
                              rows="4">{{ $enseignant->bibliographie }}</textarea>
                </div>
                <div class="d-flex gap-2">
       <button class="btn btn-primary">
                    Mettre à jour
                </button>
      <a href="/enseignant/dashboard" class="btn btn-danger">Retour</a>
    </div>
            </form>

        </div>
    </div>
</div>
            
                            
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






