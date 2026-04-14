<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <title>DASHMIN - Bootstrap Admin Template</title>
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
        @include('layouts.sidebar')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('layouts.header')
           
            <!-- Navbar End -->

            
  <h1 class="text-center">Modifier un eleve</h1>
    <br>
    <br>
     <br>
     @if (session('status'))
     <div class="alert alert-success">
      {{session('status')}}
    </div>       
     @endif
     
     <ul>
      @foreach ($errors->all() as $error)
       <li class="alert alert-danger">
        {{$error}}
       </li>
     @endforeach

     </ul>

    <form action="{{ route('eleve.update', ['id' => $eleve->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $eleve->id }}">
    <input type="hidden" name="classe_id" id="classe_id" value="{{ $eleve->classe_id }}">

    <div class="form-group">
      <label for="Nom">Nom</label>
      <input type="text" class="form-control" id="Nom" name="nom" value="{{$eleve->nom}}" required>
    </div>

    <div class="form-group">
      <label for="Prenom" class="form-label">Prenom</label>
      <input type="text" class="form-control" id="Prenom" name="prenom" value="{{$eleve->prenom}}" required>
    </div>

    <div class="mb-3">
        <label for="salleSelect" class="form-label">Choisir une salle</label>
        <select id="salleSelect" class="form-control">
            <option value="">-- Sélectionnez une salle --</option>
            @foreach($salles as $salle)
                <option value="{{ $salle->id }}" {{ $eleve->classe->salle_id == $salle->id ? 'selected' : '' }}>
                    {{ $salle->nom }}
                </option>
            @endforeach
        </select>
    </div>
    

    <div id="classesContainer" class="mb-3"></div>

    <button type="submit" class="btn btn-primary">Modifier son enfant</button>
    <a href="/parent/eleve/liste_inscription" class="btn btn-danger">Retour sur la liste</a>
</form>



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
<!-- Template Javascript -->
    <script src={{asset('admin/js/main.js')}}></script>
    <script>
    const salles = @json($salles);
const salleSelect = document.getElementById('salleSelect');
const classesContainer = document.getElementById('classesContainer');
const classeInput = document.getElementById('classe_id');

// Afficher automatiquement la classe actuelle de l'élève
document.addEventListener('DOMContentLoaded', function() {
    const currentSalleId = "{{ $eleve->classe->salle_id ?? '' }}";
    const currentClasseId = "{{ $eleve->id_classe ?? '' }}";

    if(currentSalleId) {
        salleSelect.value = currentSalleId;
        const event = new Event('change');
        salleSelect.dispatchEvent(event);

        // Sélectionner la classe actuelle
        if(currentClasseId) {
            const currentDiv = [...classesContainer.children].find(div => div.dataset.id == currentClasseId);
            if(currentDiv) currentDiv.click();
        }
    }
});

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
            const enseignant = classe.enseignants[0];
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
<script>
console.log(@json($salles));
</script>
</body>

</html>






