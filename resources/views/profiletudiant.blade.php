@extends('layouts.base')

@section('title', 'Profil Étudiant')

@section('styles')
    <link rel="stylesheet" href="{{ asset('CSS/profiletudiant.css') }}">
@endsection

@section('content')
<div class="main">
    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-title">
            <i class="fas fa-user"></i> Mon espace
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('profile.etudiant') }}" class="active"><i class="fas fa-id-card"></i> Mon profil</a>
        </div>

        <div class="sidebar-section">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Déconnexion
</a>
            <a href="#" onclick="openDeleteModal()" class="delete-account">
                <i class="fas fa-user-times"></i> Supprimer mon compte
            </a>
        </div>
    </aside>

    {{-- Contenu Profil + Historique --}}
    <section class="profile">
        <h2>Mon Profil Étudiant</h2>

        <div class="profile-card">
            {{-- Formulaire d’upload de photo --}}
            <form action="{{ route('profile.photo.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="avatar-container">
                    <img src="{{ Auth::user()->photo_profil ? asset(Auth::user()->photo_profil) : asset('images/avatar-default.png') }}" alt="Photo de profil" class="avatar">

                    <div class="photo-upload">
                        <label for="upload-photo">Changer la photo</label>
                        <input type="file" id="upload-photo" name="photo" required>
                    </div>

                    <button type="submit" class="btn">Mettre à jour</button>
                </div>
            </form>

            <div class="profile-info">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" value="{{ Auth::user()->nom }}">
                        @error('nom')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" value="{{ Auth::user()->prenom }}">
                        @error('prenom')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mot de passe actuel (requis pour confirmer les modifications)</label>
                        <input type="password" name="password" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn">Sauvegarder les modifications</button>
                </form>
            </div>
        </div>

        {{-- Historique des candidatures --}}
        <div class="historique-candidatures" style="margin-top: 40px;">
            <h2>Mes candidatures</h2>

            @php
                $candidatures = DB::table('candidature')
                    ->join('offre_de_stage', 'offre_de_stage.id', '=', 'candidature.offre_id')
                    ->where('utilisateur_id', Auth::id())
                    ->orderByDesc('candidature.date_candidature')
                    ->select('offre_de_stage.titre', 'offre_de_stage.ville', 'candidature.date_candidature')
                    ->get();
            @endphp

            @if ($candidatures->isEmpty())
                <p>Vous n'avez encore postulé à aucune offre.</p>
            @else
                <div class="candidature-list">
                    @foreach ($candidatures as $index => $c)
                        <div class="candidature-item">
                            <div class="candidature-header">
                                <span class="candidature-company">{{ $c->titre }}</span>
                                <span class="candidature-date">{{ \Carbon\Carbon::parse($c->date_candidature)->format('d/m/Y') }}</span>
                            </div>
                            <div class="candidature-role">{{ $c->ville }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>

<!-- Modal de suppression -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h3>Supprimer votre compte</h3>
        <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible et supprimera toutes vos données, y compris vos candidatures.</p>
        
        <form action="{{ route('profile.delete') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Entrez votre mot de passe pour confirmer</label>
                <input type="password" name="password" required>
                @error('delete_password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="modal-buttons">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-cancel">Annuler</button>
                <button type="submit" class="btn btn-delete">Supprimer définitivement</button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Fermer le modal si on clique en dehors
window.onclick = function(event) {
    if (event.target == document.getElementById('deleteModal')) {
        closeDeleteModal();
    }
}
</script>
@endsection