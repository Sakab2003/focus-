<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

    @php
        use Illuminate\Support\Facades\Auth;

        $user = Auth::user();
        $enseignant = $user?->enseignant;
    @endphp

    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto">

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2"
                     width="38"
                     height="38"
                     src="{{ ($enseignant && $enseignant->photo)
                        ? asset('storage/enseignants/' . $enseignant->photo)
                        : asset('admin/img/user.jpg') }}">
                <span class="d-none d-lg-inline-flex">
                    {{ $user?->nom ?? 'Utilisateur' }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="/profile" class="dropdown-item">Mon profil</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>
