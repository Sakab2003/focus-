<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">
    <title>Focus+ - Mon site d'etude en ligne</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+226 05531199</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>samuelkabore23@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <body id="top">

<section id="hero">
    <h1>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Focus+</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link active">Accueil</a>
                    <a href="{{ route('register') }}"></a>
                    <a href="{{ route('register') }}" class="nav-item nav-link">
    Cours
</a>


                    <a href="/apropos" class="nav-item nav-link">A propos</a>
                </div>
                <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 d-none d-lg-block">Se connecter</a>
                <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4 d-none d-lg-block">S'inscrire </a>
            </div>
        </nav>
    </div>
    </h1>
</section>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">Bienvenue sur la plateforme</h1>
            <h1 class="text-white display-1 mb-5">Focus+</h1>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                <div class="input-group">
                    <div class="input-group-prepend">
    <a href="{{ route('register') }}" 
       class="btn btn-outline-light bg-white text-body px-4">
        Cours
    </a>
</div>

                    <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Mot-clé">
                    <div class="input-group-append">
                        <button class="btn btn-secondary px-4 px-lg-5">Rechercher</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


<!-- About Start -->
    <section id="apropos">
    <h2>À propos</h2>
    <p>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about1.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">A propos de nous</h6>
                        <h1 class="display-4">Pourquoi devons nous etre votre premier choix pour etudier en ligne?</h1>
                    </div>
                    <p>Vous souhaitez offrir à vos enfants un meilleur suivi scolaire ? Avec Focus+, notre plateforme éducative en ligne, les parents et enseignants travaillent ensemble pour accompagner chaque élève vers la réussite.

 Cours, exercices, suivis personnalisés, et communication directe : tout est réuni pour créer un environnement d’apprentissage simple, interactif et motivant.

 Rejoignez Focus+, et transformons l’éducation de notre pays tout en instruisant et rendant nos enfants plus competant.</p>
                    <div class="row pt-3 mx-0">
                        <div class="col-3 px-0">
                            <div class="bg-success text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">{{ $total_classes }}</h1>
                                <h6 class="text-uppercase text-white">Classes<span class="d-block">Virtuelles</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-primary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">{{ $total_cours }}</h1>
                                <h6 class="text-uppercase text-white">Cours<span class="d-block">Disponibles</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-secondary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">{{ $total_enseignants }}</h1>
                                <h6 class="text-uppercase text-white">Enseignants<span class="d-block">Disponibles</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-warning text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">{{ $total_eleves }}</h1>
                                <h6 class="text-uppercase text-white">Total<span class="d-block">d'eleves</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </p>
 </section>
<!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-image" style="margin: 90px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 my-5 pt-5 pb-lg-5">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Pourquoi nous choisir?</h6>
                        <h1 class="display-4">Pourquoi utiliser cette plateforme d'apprentissage?</h1>
                    </div>
                    <p class="mb-4 pb-2"></p>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-primary mr-4">
                            <i class="fa fa-2x fa-graduation-cap text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Enseignants spécialisés</h4>
                            <p>Les enseignants présents sur la plateforme Focus+ sont qualifiés, bien formés et sélectionnés avec soin. Ils sont disponibles pour offrir un enseignement de qualité et un accompagnement personnalisé  à chaque élève.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-secondary mr-4">
                            <i class="fa fa-2x fa-certificate text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Pédagogie structurée</h4>
                            <p>Focus+ adopte la même pédagogie que les écoles classiques, avec un programme conforme et un encadrement sérieux. Chaque élève inscrit reçoit une formation complète, équivalente à celle d’une classe physique.

</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="btn-icon bg-warning mr-4">
                            <i class="fa fa-2x fa-book-reader text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Classes virtuelles</h4>
                            <p class="m-0">La classe virtuelle offre une nouvelle manière d’apprendre, plus flexible, interactive et accessible à tous. Grâce à cet espace numérique, les élèves peuvent suivre leurs cours à distance, à leur rythme, tout en restant encadrés par leurs enseignants.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/feature.jpg" style="object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->


<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="section-title text-center position-relative mb-5">
            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Enseignants</h6>
            <h1 class="display-4">Voir nos enseignants</h1>
        </div>

        <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">

            @forelse($enseignants as $enseignant)
                <div class="team-item">

                    <!-- Photo -->
                    {{--<img class="img-fluid w-100"
                         src="{{ asset($enseignant->photo ?? 'images/default-teacher.jpg') }}"
                         alt="{{ $enseignant->nom }} {{ $enseignant->prenom }}">--}}

                    <div class="bg-light text-center p-4">

                        <!-- Nom -->
                        <h5 class="mb-3">
                            {{ $enseignant->nom }} {{ $enseignant->prenom }}
                        </h5>

                        <!-- Classes -->
                        <p class="mb-2">
                            <strong>Classes :</strong><br>
                            {{ $enseignant->classes->pluck('name')->join(', ') ?: 'Aucune classe' }}
                        </p>

                        <!-- Matières -->
                        <p class="mb-2">
    <strong>Matières :</strong><br>

    @php
        $matieres = $enseignant->classes
            ->flatMap(fn($classe) => $classe->matieres)
            ->unique('id')
            ->pluck('name'); // ✅ BON champ
    @endphp

    {{ $matieres->count() ? $matieres->join(', ') : 'Aucune matière' }}
</p>


                        <!-- Réseaux -->
                        <div class="d-flex justify-content-center">
                            <a class="mx-1 p-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="mx-1 p-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="mx-1 p-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>

                    </div>
                </div>
            @empty
                <p class="text-center">Aucun enseignant trouvé.</p>
            @endforelse

        </div>
    </div>
</div>
<!-- Team End -->






    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="bg-light d-flex flex-column justify-content-center px-5" style="height: 450px;">
                        <div class="d-flex align-items-center mb-5">
                            <div class="btn-icon bg-primary mr-4">
                                <i class="fa fa-2x fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Locaitée</h4>
                                <p class="m-0">Secteur 42, Ouagadougou, BURKINA FASO</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="btn-icon bg-secondary mr-4">
                                <i class="fa fa-2x fa-phone-alt text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Appeler nous</h4>
                                <p class="m-0">+226 05531199</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="btn-icon bg-warning mr-4">
                                <i class="fa fa-2x fa-envelope text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Email </h4>
                                <p class="m-0">kabores622@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Besoin d'aide?</h6>
                        <h1 class="display-4">Envoyer un message</h1>
                    </div>
                    <div class="contact-form">
                        <form>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <input type="text" class="form-control border-top-0 border-right-0 border-left-0 p-0" placeholder="Votre Nom" required="required">
                                </div>
                                <div class="col-6 form-group">
                                    <input type="email" class="form-control border-top-0 border-right-0 border-left-0 p-0" placeholder="Votre Email" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control border-top-0 border-right-0 border-left-0 p-0" placeholder="Object" required="required">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control border-top-0 border-right-0 border-left-0 p-0" rows="5" placeholder="Message" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-5" type="submit">Envoyer message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>Focus+</h1>
                    </a>
                    <p class="m-0">Focus+ est une plateforme éducative interactive conçue pour faciliter le suivi et l’accompagnement scolaire des élèves par leurs parents et enseignants. Elle vise à renforcer et optimiser les competences de l'eleve </p>
                </div>
                <div class="col-md-6 mb-5">
                    <h3 class="text-white mb-4">Lettre d'information</h3>
                    <div class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-4">S'inscrire</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Nous contactez</h3>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>Secteur 42, Ouagagougou, BURKINA FASO</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+226 05531199</p>
                    <p><i class="fa fa-envelope mr-2"></i>Kabores622@gmail.com</p>
                    <div class="d-flex justify-content-start mt-4">
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-twitter"></i></a>
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-facebook-f"></i></a>
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-linkedin-in"></i></a>
                        <a class="text-white" href="#"><i class="fab fa-2x fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Nos Cours</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Mathematiques</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Anglais</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Francais</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Histoire</a>
                        <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Education-Civique</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Liens rapides</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Gestion des écoles : Impliquer davantage les parents d’élèves - leFaso.net.</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>https://www.fasoeducation.bf/</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Regular FAQs</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Help & Support</a>
                        <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 border-top py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">Focus+</a>. Tous les droits sont reserves.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0">Designed by <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>