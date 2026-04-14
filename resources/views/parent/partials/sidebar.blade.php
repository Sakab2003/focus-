<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Espace parent</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src={{asset('admin/img/user.jpg')}} alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->nom }}</h6>
                        <span>Parent</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="/parent/dashboard" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Mon tableau de bord</a>
                    <a href="/parent/eleve/inscription" class="dropdown-item"><h1>Inscriptions</h1></a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Cours et Execices</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('parent.cours') }}" class="dropdown-item">Cours</a>
                            <a href="{{ route('parent.exercice') }}" class="dropdown-item">Exercices</a>
                        </div>
                    </div>
                    <a href="/parent/eleve/liste" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Mes enfants</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Progressions</a>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <div class="nav-item dropdown">
                    <a href="/parent/suivi" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Suivi de l'eleve</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Parametres</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/profile" class="dropdown-item">Profile</a>
                            <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Se deconnecter') }}
                            </x-dropdown-link>
                        </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
