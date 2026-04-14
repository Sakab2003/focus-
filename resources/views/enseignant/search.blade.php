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
    <div class="container-xxl p-0">
        @include('layouts.sidebar_enseignant')
        <div class="content">
            @include('layouts.header')
<div class="container-fluid pt-4 px-4">
    <h4>Résultats pour : "<strong>{{ $q }}</strong>"</h4>

    <hr>

    {{-- Cours --}}
    <h5>Cours</h5>
    @forelse($cours as $coursItem)
        <p>📘 {{ $coursItem->titre }}</p>
    @empty
        <p class="text-muted">Aucun cours trouvé</p>
    @endforelse

    <hr>

    {{-- Classes --}}
    <h5>Classes virtuelles</h5>
    @forelse($classes as $classe)
        <p>🏫 {{ $classe->nom }}</p>
    @empty
        <p class="text-muted">Aucune classe trouvée</p>
    @endforelse

    <hr>

    

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
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('contenu');
</script>
<script>
$(document).ready(function() {
    $('#classe-select').change(function() {
        var classeId = $(this).val();
        if(classeId) {
            $.ajax({
    url: '/enseignant/matieres-ajax/' + classeId,
    type: 'GET',
    success: function(data) {
        $('#matiere-select').empty();
        $('#matiere-select').append('<option value="">-- Choisir une matière --</option>');
        $.each(data, function(key, value) {
            $('#matiere-select').append('<option value="'+ value.id +'">'+ value.name +'</option>');
        });
    }
});

        } else {
            $('#matiere-select').empty();
            $('#matiere-select').append('<option value="">-- Choisir une matière --</option>');
        }
    });
});
</script>


</body>

</html>






