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
            <h1 class="text-white display-1 mb-5">A propos</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">A propos</p>
            </div>
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

<style>
.futuristic-wrapper {
    background: linear-gradient(135deg, #020617, #0f172a);
    color: #e5e7eb;
    padding: 80px 20px;
    font-family: 'Jost', sans-serif;
}

.futuristic-title {
    text-align: center;
    margin-bottom: 60px;
}

.futuristic-title h1 {
    font-size: 48px;
    font-weight: 700;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    transition: 0.4s ease;
    box-shadow: 0 0 40px rgba(56, 189, 248, 0.1);
}

.glass-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 0 60px rgba(129, 140, 248, 0.3);
}

.glass-icon {
    font-size: 40px;
    margin-bottom: 15px;
    color: #38bdf8;
}

.glass-card h3 {
    margin-bottom: 15px;
    color: #38bdf8;
}

.futuristic-footer {
    text-align: center;
    margin-top: 60px;
    color: #94a3b8;
    font-size: 14px;
}
</style>

<div class="futuristic-wrapper">

<div class="container">

<div class="futuristic-title">
<h1><i class="fa fa-book-reader"></i> Focus+ • Plateforme éducative intelligente</h1>
<p>Guide complet d'utilisation de la plateforme</p>
</div>

<div class="row">

<div class="col-md-6">
<div class="glass-card text-center">
<i class="fa fa-graduation-cap glass-icon"></i>
<h3>Présentation générale</h3>
<p>
Focus+ est une plateforme éducative moderne conçue pour connecter
administrateurs, enseignants et parents dans un environnement sécurisé.
Elle centralise la gestion scolaire et simplifie la communication entre
tous les acteurs de l’éducation.
</p>
</div>
</div>

<div class="col-md-6">
<div class="glass-card text-center">
<i class="fa fa-user-shield glass-icon"></i>
<h3>Espace Administrateur</h3>
<p>
Les administrateurs contrôlent entièrement la plateforme :
création d’utilisateurs, attribution automatique des rôles,
gestion des enseignants, parents et classes.
Chaque action garantit l’intégrité des données.
</p>
</div>
</div>

<div class="col-md-6">
<div class="glass-card text-center">
<i class="fa fa-chalkboard-teacher glass-icon"></i>
<h3>Espace Enseignant</h3>
<p>
Les enseignants gèrent leurs cours, classes virtuelles
et élèves. Ils peuvent organiser les contenus pédagogiques,
suivre la progression et encadrer chaque apprenant.
</p>
</div>
</div>

<div class="col-md-6">
<div class="glass-card text-center">
<i class="fa fa-users glass-icon"></i>
<h3>Espace Parent</h3>
<p>
Les parents suivent les performances scolaires
de leurs enfants, consultent les cours,
et reçoivent un aperçu clair de la progression académique.
</p>
</div>
</div>

<div class="col-md-12">
<div class="glass-card text-center">
<i class="fa fa-chart-line glass-icon"></i>
<h3>Dashboards intelligents</h3>
<p>
Chaque utilisateur possède un tableau de bord personnalisé.
Les données affichées sont filtrées selon le rôle
afin d’assurer sécurité, confidentialité et clarté.
</p>
</div>
</div>

<div class="col-md-12">
<div class="glass-card text-center">
<i class="fa fa-lock glass-icon"></i>
<h3>Sécurité & Fiabilité</h3>
<p>
Focus+ protège toutes les informations sensibles :
mots de passe chiffrés, validation anti-doublons,
contrôle d’accès par rôle et protection des comptes administrateurs.
La plateforme est pensée pour être robuste et fiable.
</p>
</div>
</div>

<div class="col-md-12">
<div class="glass-card text-center">
<i class="fa fa-lightbulb glass-icon"></i>
<h3>Vision éducative</h3>
<p>
Notre objectif est de moderniser l’éducation
grâce à une technologie simple, accessible
et performante. Focus+ favorise la réussite scolaire
et renforce la collaboration entre enseignants et parents.
</p>
</div>
</div>

</div>

<div class="futuristic-footer">
© 2026 Focus+ • L’éducation du futur commence ici
</div>

</div>
</div>

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