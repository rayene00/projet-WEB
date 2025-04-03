<header>
    <div class="header-container">
        <div class="logo-section">
            <a href="{{ auth()->check() ? route('apresconnexion') : route('firstpage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="CRYF Logo" class="logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>

        <nav>
            @auth
                {{-- Lien vers le bon profil selon le rôle --}}
                @php
                    $role = auth()->user()->role ?? 'etudiant'; // Ajuste si tu as un champ différent
                @endphp

                @if ($role === 'etudiant')
                    <a href="{{ route('profile.etudiant') }}" class="btn inscription">Mon Profil</a>
                @elseif ($role === 'pilote')
                    <a href="{{ route('profil.pilote') }}" class="btn inscription">Mon Profil</a>
                @else
                    <a href="#" class="btn inscription">Profil</a>
                @endif

                {{-- Déconnexion --}}
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn connexion">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('signup') }}" class="btn inscription">Inscription</a>
                <a href="{{ route('signin') }}" class="btn connexion">Se connecter</a>
            @endauth
        </nav>
    </div>
</header>