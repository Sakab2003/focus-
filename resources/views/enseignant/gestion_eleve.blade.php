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
            <div class="container py-4">

            <h2 class="text-center mb-4">📚 Notes par classe</h2>

            {{-- CLASSES EN CARDS --}}
            <div class="row mb-4">
                @forelse($classes as $classe)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('enseignant.gestion_eleve', ['classe_id' => $classe->id]) }}"
                           class="text-decoration-none text-dark">

                            <div class="card classe-card shadow-sm h-100
                                {{ request('classe_id') == $classe->id ? 'border-primary border-3' : '' }}">

                                <div class="card-body text-center">
                                    <h5 class="card-title mb-1">
                                        🏫 {{ $classe->name }}
                                    </h5>
                                    <small class="text-muted">
                                        {{ $classe->eleves_count ?? '' }} élèves
                                    </small>
                                </div>

                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-muted text-center">
                        Aucune classe disponible.
                    </p>
                @endforelse
            </div>

            {{-- TABLE DES NOTES --}}
            @if(request()->filled('classe_id'))

                <hr>

                <h4 class="mb-3">
                    📘 Classe sélectionnée :
                    <strong>
                        {{ $classes->firstWhere('id', request('classe_id'))?->name }}
                    </strong>
                </h4>

                @if($devoirs->isEmpty())
                    <div class="alert alert-warning">
                        Aucun devoir trouvé pour cette classe.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <td>#</td>
                                    <th>Élève</th>
                                    <th>Devoir</th>
                                    <th>Date limite</th>
                                    <th>Réponse</th>
                                    <th>Note</th>
                                    <th>Remarque</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($devoirs as $devoir)
                                    @foreach($devoir->reponses as $reponse)
                                    @if($reponse->eleve)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $reponse->eleve?->nom ?? '-' }}
                                                {{ $reponse->eleve?->prenom ?? '' }}

                                            </td>

                                            <td>
                                                {{ $devoir->titre ?? $devoir->cours->titre }}
                                            </td>

                                            <td>{{ $devoir->date_limite }}</td>

                                            <td>
                                                @if($reponse->fichier)
                                                    <a href="{{ route('reponse.telecharger.fichier', $reponse->id) }}"
                                                       class="btn btn-sm btn-secondary mb-1">
                                                        📎 Fichier
                                                    </a>
                                                @endif

                                                @if($reponse->reponse)
                                                    <a href="{{ route('reponse.telecharger.contenu', $reponse->id) }}"
                                                       class="btn btn-sm btn-primary">
                                                        📄 Texte
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                <form method="POST" action="{{ route('enseignant.attribuer_note') }}">
                                                    @csrf
                                                    <input type="hidden" name="reponse_id" value="{{ $reponse->id }}">
                                                    <input type="number"
                                                           name="note"
                                                           class="form-control"
                                                           min="0"
                                                           max="20"
                                                           value="{{ $reponse->note }}">
                                                    <button type="submit"
                                                            class="btn btn-success btn-sm mt-1">
                                                        Attribuer
                                                    </button>
                                                </form>
                                            </td>

                                            <td>
                                                <form method="POST" action="{{ route('enseignant.envoyer_remarque') }}">
                                                    @csrf
                                                    <input type="hidden" name="eleve_id" value="{{ $reponse->eleve->id }}">
                                                    <input type="hidden" name="devoir_id" value="{{ $devoir->id }}">

                                                    <textarea name="remarque"
                                                              class="form-control"
                                                              rows="2">{{ $reponse->remarque }}</textarea>

                                                    <button type="submit"
                                                            class="btn btn-warning btn-sm mt-1">
                                                        Envoyer
                                                    </button>
                                                </form>
                                            </td>
                                            <input type="hidden" name="eleve_id" value="{{ $reponse->eleve->id }}">
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
            @endif

            <button onclick="window.history.back()" class="btn btn-primary mt-3">
                ⬅ Retour
            </button>

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

{{--<div class="container py-4"> <h2 class="text-center mb-4">📚 Notes par classe</h2> @if($classes->isEmpty()) <p class="text-muted">Aucune classe disponible avec des réponses.</p> @else <form method="GET" action="{{ route('enseignant.gestion_eleve') }}" class="mb-4"> <div class="row"> <div class="col-md-10"> <select name="classe_id" class="form-select shadow-sm" required> <option value="">🏫 Choisir une classe</option> @foreach($classes as $classe) <option value="{{ $classe->id }}" @selected(request('classe_id') == $classe->id)> {{ $classe->name }} </option> @endforeach </select> </div> <div class="col-md-2"> <button type="submit" class="btn btn-primary">Voir les élèves</button> </div> </div> </form> @if(request()->filled('classe_id')) @if($devoirs->isEmpty()) <div class="alert alert-warning"> Aucun devoir trouvé pour cette classe. </div> @else <table class="table table-bordered"> <thead> <tr> <th>Élève</th> <th>Devoir</th> <th>Date limite</th> <th>Réponse</th> <th>Note</th> <th>Remarque</th> </tr> </thead> <tbody> @foreach($devoirs as $devoir) @foreach($devoir->reponses as $reponse) <tr> <td>{{ $reponse->eleve->nom }} {{ $reponse->eleve->prenom }}</td> <td>{{ $devoir->titre ?? $devoir->cours->titre }}</td> <td>{{ $devoir->date_limite }}</td> <td> @if($reponse->fichier) <a href="{{ route('reponse.telecharger.fichier', $reponse->id) }}" class="btn btn-sm btn-secondary"> 📎 Fichier </a> @endif @if($reponse->reponse) <a href="{{ route('reponse.telecharger.contenu', $reponse->id) }}" class="btn btn-sm btn-primary"> 📄 Texte </a> @endif </td> <td> <form method="POST" action="{{ route('enseignant.attribuer_note') }}"> @csrf <input type="hidden" name="reponse_id" value="{{ $reponse->id }}"> <input type="number" name="note" class="form-control" min="0" max="20" value="{{ $reponse->note }}"> <button type="submit" class="btn btn-success btn-sm mt-1"> Attribuer </button> </form> </td> <td> <form action="{{ route('enseignant.envoyer_remarque') }}" method="POST"> @csrf <input type="hidden" name="eleve_id" value="{{ $reponse->eleve->id }}"> <input type="hidden" name="devoir_id" value="{{ $devoir->id }}"> <textarea name="remarque" class="form-control" rows="2">{{ $reponse->remarque ?? '' }}</textarea> <button type="submit" class="btn btn-warning btn-sm mt-1"> Envoyer </button> </form> </td> </tr> @endforeach @endforeach </tbody> </table> @endif @endif @endif </div><button onclick="window.history.back()" class="btn btn-primary"> Retour </button>--}}