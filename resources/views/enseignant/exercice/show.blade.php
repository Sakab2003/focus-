<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <title>DASHMIN - Visualisation de l'exercice</title>
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

    <style>
        /* Affichage "type dossier" pour les fichiers */
        .file-list {
            list-style: none;
            padding-left: 0;
        }
        .file-list li {
            display: flex;
            align-items: center;
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 6px;
            background-color: #f8f9fa;
        }
        .file-list li i {
            font-size: 20px;
            margin-right: 10px;
        }
        .file-list li a {
            text-decoration: none;
            color: #333;
            flex-grow: 1;
        }
        .field-label {
            font-weight: bold;
            margin-top: 15px;
        }
        .field-content {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #fefefe;
        }
    </style>
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">

    @include('layouts.sidebar_enseignant')

    <div class="content">
        @include('layouts.header')

        <div class="container mt-4">
            <h1 class="mb-4">Visualisation de l'exercice</h1>

            {{-- Titre --}}
            @if(!empty($exerice->titre))
                <div class="mb-3">
                    <div class="field-label">Titre :</div>
                    <div class="field-content">{{ $exercice->titre }}</div>
                </div>
            @endif

            {{-- Classe --}}
@if($exercice->classe)
    <div class="mb-3">
        <div class="field-label">Classe :</div>
        <div class="field-content">
            {{ $exercice->classe->niveau ?? '' }} {{ $exercice->classe->nom ?? '' }}
        </div>
    </div>
@else
    <div class="mb-3">
        <div class="field-label">Classe :</div>
        <div class="field-content text-muted">Classe supprimée</div>
    </div>
@endif

{{-- Matière --}}
@if($exercice->classe && $exercice->classe->matieres)
    <div class="mb-3">
        <div class="field-label">Matière :</div>
        <div class="field-content">
            {{ implode(', ', json_decode($exercice->classe->matieres)) }}
        </div>
    </div>
@else
    <div class="mb-3">
        <div class="field-label">Matière :</div>
        <div class="field-content text-muted">N/A</div>
    </div>
@endif

            {{-- Contenu --}}
            @if(!empty($exercice->contenu))
                <div class="mb-3">
                    <div class="field-label">Contenu :</div>
                    <div class="field-content">{!! $exercice->contenu !!}</div>
                </div>
            @endif

            {{-- Fichier principal --}}
            @if(!empty($exercice->fichier))
                <div class="mb-3">
                    <ul class="file-list">
                        <li>
                            <i class="fas fa-file-pdf"></i>
                            <a href="{{ asset('storage/'.$exercice->fichier) }}" target="_blank">{{ basename($exercice->fichier) }}</a>
                        </li>
                    </ul>
                </div>
            @endif

            {{-- Autres fichiers --}}
            @if(!empty($exercice->fichiers))
                <div class="mb-3">
                    <ul class="file-list">
                        @foreach($exercice->fichiers as $file)
                            @php
                                $filePath = is_array($file) ? ($file[0] ?? null) : $file;
                                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                switch(strtolower($extension)){
                                    case 'pdf': $icon='fas fa-file-pdf'; break;
                                    case 'jpg': case 'jpeg': case 'png': case 'gif': $icon='fas fa-file-image'; break;
                                    case 'doc': case 'docx': $icon='fas fa-file-word'; break;
                                    case 'xls': case 'xlsx': $icon='fas fa-file-excel'; break;
                                    default: $icon='fas fa-file'; break;
                                }
                            @endphp
                            @if($filePath)
                                <li>
                                    <i class="{{ $icon }}"></i>
                                    <a href="{{ asset('storage/'.$filePath) }}" target="_blank">{{ basename($filePath) }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ url()->previous() }}" class="btn btn-danger mt-3">Retour</a>
        </div>

        @include('layouts.footer')
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
