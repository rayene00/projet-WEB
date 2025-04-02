@extends('layouts.app')

@section('content')
    @include('layouts.header-connected')

    <main class="main">
        <aside class="sidebar">
            <div class="sidebar-title"><i class="fa-solid fa-bars"></i> MENU</div>
            <div class="sidebar-menu">
                <a href="#profile" class="menu-item" onclick="showSection('profile')">
                    <i class="fa-solid fa-user-pen"></i> Mon Profil
                </a>
                <a href="#historique" class="menu-item" onclick="showSection('historique')">
                    <i class="fa-solid fa-clock-rotate-left"></i> Historique
                </a>
            </div>

            <div class="sidebar-section">
                <a href="{{ route('logout') }}"><i class="fa-solid fa-power-off"></i> Déconnexion</a>
            </div>
        </aside>

        <!-- Profile Section -->
        <section id="profile-section" class="profile">
            <div class="profile-card">
                <form method="POST" enctype="multipart/form-data" class="photo-form">
                    @csrf
                    <div class="avatar-container">
                        <img src="{{ $user->photo_profil ? asset('uploads/' . $user->photo_profil) : asset('assets/images/logoProfil.jpg') }}" 
                             class="avatar" alt="Photo de profil">
                        <div class="photo-upload">
                            <input type="file" name="photo_profil" id="photo_profil" accept="image/jpeg,image/png">
                            <button type="submit" class="btn update-photo">Mettre à jour la photo</button>
                        </div>
                    </div>
                </form>
                
                <div class="profile-info">
                    <h2>{{ $user->prenom }} {{ $user->nom }}</h2>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="{{ $user->nom }}" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" value="{{ $user->prenom }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Numéro de téléphone :</label>
                            <input type="text" id="telephone" name="telephone" value="{{ $user->telephone }}" required>
                        </div>
                        <button type="submit" class="btn">Mettre à jour les informations</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Historique Section -->
        <section id="historique-section" class="historique-candidatures" style="display: none;">
            <h2>Historique de mes candidatures</h2>
            <div class="candidature-list">
                @if($candidatures->isEmpty())
                    <p>Aucune candidature trouvée.</p>
                @else
                    @foreach($candidatures as $index => $candidature)
                        <div class="candidature-item">
                            <div class="candidature-header">
                                <span class="candidature-number">{{ $index + 1 }}</span>
                                <span class="candidature-company">{{ $candidature->entreprise }}</span>
                            </div>
                            <div class="candidature-role">{{ $candidature->titre }}</div>
                            <div class="candidature-date">{{ $candidature->date_candidature->format('d F Y') }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </main>

    @include('layouts.footer')

    @push('scripts')
    <script>
        function showSection(sectionName) {
            // Cacher toutes les sections
            document.getElementById('profile-section').style.display = 'none';
            document.getElementById('historique-section').style.display = 'none';
            
            // Afficher la section sélectionnée
            if (sectionName === 'profile') {
                document.getElementById('profile-section').style.display = 'block';
            } else if (sectionName === 'historique') {
                document.getElementById('historique-section').style.display = 'block';
            }
            
            // Mettre à jour les classes active dans le menu
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        // Afficher la section profil par défaut
        document.addEventListener('DOMContentLoaded', function() {
            showSection('profile');
        });
    </script>
    @endpush

    @push('styles')
    <style>
        /* Ajoutez ici vos styles CSS personnalisés si nécessaire */
    </style>
    @endpush
@endsection