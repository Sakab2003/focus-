<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <title>DASHMIN - Visualisation du Cours</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon & Fonts -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">

    @include('layouts.sidebar_enseignant')

    <div class="content">
        @include('layouts.header')

        <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded p-4">

                <h4 class="mb-4 text-primary">
                    <i class="fa fa-eye me-2"></i>Détails de la classe virtuelle
                </h4>

                {{-- INFORMATIONS PRINCIPALES --}}
                <div class="row mb-3">

                    <div class="col-md-6">
                        <strong>Nom du professeur :</strong>
                        <p>{{ $classe->nom_professeur }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Prénom du professeur :</strong>
                        <p>{{ $classe->prenom_professeur }}</p>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-6">
                        <strong>Niveau :</strong>
                        <p>
                            <span class="badge bg-primary">
                                {{ $classe->niveau }}
                            </span>
                        </p>
                    </div>

                    <div class="col-md-6">
                        <strong>Date de création :</strong>
                        <p>{{ $classe->created_at->format('d/m/Y') }}</p>
                    </div>

                </div>

                {{-- MATIERES --}}
                <div class="mb-4">

                    <strong>Matières :</strong>

                    <div class="mt-2">

                        @forelse($classe->matieres as $matiere)

                            <span class="badge bg-success me-1 mb-1">
                                {{ $matiere->name }}
                            </span>

                        @empty

                            <span class="text-muted">
                                Aucune matière associée
                            </span>

                        @endforelse

                    </div>

                </div>

                {{-- STATISTIQUES VISUELLES --}}
                <div class="alert alert-secondary">

                    <strong>Aperçu de la classe :</strong>

                    <div class="row mt-3">

                        <div class="col-md-3">
                            <i class="fa fa-user-graduate text-primary"></i>
                            Élèves : 0
                        </div>

                        <div class="col-md-3">
                            <i class="fa fa-book text-success"></i>
                            Matières : {{ $classe->matieres->count() }}
                        </div>

                        <div class="col-md-3">
                            <i class="fa fa-chalkboard-teacher text-warning"></i>
                            Enseignant : 1
                        </div>

                        <div class="col-md-3">
                            <i class="fa fa-clock text-danger"></i>
                            Cours : 0
                        </div>

                    </div>

                </div>

                {{-- ACTIONS --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('classe.liste') }}"
                       class="btn btn-secondary">

                        <i class="fa fa-arrow-left me-1"></i>
                        Retour à la liste

                    </a>

                    <a href="{{ route('enseignant.classe.edit',$classe->id) }}"
                       class="btn btn-warning">

                        <i class="fa fa-edit me-1"></i>
                        Modifier

                    </a>

                </div>

            </div>
        </div>
    </div>
</div>

        @include('layouts.footer')
    </div>
</div>

<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
{{--

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Détails de la classe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        .info-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
            background: #ffffff;
            padding: 20px;
            height: 100%;
        }
        .info-label {
            font-size: 13px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .info-value {
            font-size: 18px;
            font-weight: 600;
            margin-top: 6px;
            color: #212529;
        }
        .badge-matiere {
            background: #eef2ff;
            color: #4338ca;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
            margin: 4px;
            display: inline-block;
        }
        .page-title {
            font-weight: 700;
            letter-spacing: .5px;
        }
    </style>
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">

    @include('layouts.sidebar_enseignant')

    <div class="content">
        @include('layouts.header')

        <div class="container py-4">

            <h2 class="page-title mb-4 text-center">
                <i class="fas fa-school me-2 text-primary"></i>
                Détails de la classe
            </h2>

            <div class="row g-4">

                {{-- Nom professeur --
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-label">
                            <i class="fas fa-user-tie me-2"></i>Nom du professeur
                        </div>
                        <div class="info-value">
                            {{ $classe->nom_professeur }}
                        </div>
                    </div>
                </div>

                {{-- Prénom professeur --
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-label">
                            <i class="fas fa-user me-2"></i>Prénom du professeur
                        </div>
                        <div class="info-value">
                            {{ $classe->prenom_professeur }}
                        </div>
                    </div>
                </div>

                {{-- Niveau --
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-label">
                            <i class="fas fa-layer-group me-2"></i>Niveau
                        </div>
                        <div class="info-value">
                            {{ $classe->niveau }}
                        </div>
                    </div>
                </div>

                {{-- Matières --
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-label">
                            <i class="fas fa-book me-2"></i>Matières enseignées
                        </div>
                        <div class="info-value">
                            @if($classe->matieres)
                                @foreach(json_decode($classe->matieres) as $matiere)
                                    <span class="badge-matiere">{{ $matiere }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Aucune matière</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                <a href="{{ route('classe.liste') }}" class="btn btn-danger px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>

        </div>

        @include('layouts.footer')
    </div>
</div>

<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>--}}