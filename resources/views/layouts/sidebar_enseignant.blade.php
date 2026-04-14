
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Espace enseignant</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        @php
    $enseignant = Auth::user()->enseignant;
@endphp

<img class="rounded-circle"
     width="38"
     height="38"
     src="{{ $enseignant && $enseignant->photo
        ? asset('storage/enseignants/' . $enseignant->photo)
        : asset('admin/img/user.jpg') }}">

                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->nom }}</h6>
                        <span>Enseignant</span>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <a href="/enseignant/dashboard" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Mon tableau de bord</a>
                    {{--<a href="/coursgenerales/index_enseignant" class="nav-item nav-link"><i class="bi bi-bar-chart-fill me-2"></i>Voir tous les cours</a>--}}

                    <a href="/enseignant/liste_classe" class="nav-item nav-link"><i
                                class="fa fa-th me-2"></i>Creer classes</a>
                    <div class="nav-item dropdown">
                        <a href="/enseignant/listecours" class="nav-item nav-link"><i
                            class="fa fa-th me-2"></i>Mes cours</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            
                        </div>
                    </div>

                    

                    <a href="{{ route('enseignant.devoir.selectCours') }}" class="nav-item nav-link"><i class="bi bi-bar-chart-fill me-2"></i>Devoirs</a>

                    {{--<a href="/enseignant/gestion_eleve" class="nav-item nav-link"><i
                            class="fa fa-chart-bar me-2"></i>Gerer les eleves</a>--}}
                            <a href="{{ route('enseignant.gestion_eleve') }}" class="nav-item nav-link">
    <i class="fa fa-chart-bar me-2"></i>Corriger devoirs
</a>
<a href="{{ route('enseignant.notes.index') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Gestion des notes</a>
<a href="{{ route('enseignant.liste_eleves') }}" class="nav-item nav-link"><i class="bi bi-bar-chart-fill me-2"></i>Mes eleves</a>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-file-alt me-2"></i>Parametres
                        </a>

                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/profile" class="dropdown-item">Profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Se deconnecter') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                </div>

            </nav>
        </div>