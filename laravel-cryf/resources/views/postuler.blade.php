@extends('layouts.base')

@section('title', 'Postuler à une offre')

@section('styles')
<link rel="stylesheet" href="{{ asset('CSS/postuler.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 15px 20px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        margin-bottom: 20px;
        font-weight: bold;
        opacity: 0;
        transition: opacity 0.5s;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px 20px;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1>Postuler à l'offre</h1>

    {{-- Message de succès --}}
    @if(request()->has('success'))
        <div class="success-message" id="success-alert">
            Votre candidature a été envoyée avec succès !
        </div>
    @endif

    {{-- Message d’erreur global (exception, etc.) --}}
    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    {{-- Erreurs de validation --}}
    @if($errors->any())
        <div class="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('postuler.submit', $offre_id) }}" enctype="multipart/form-data" class="candidature-form">
        @csrf

        <div class="form-group">
            <label for="cv">CV (PDF uniquement)</label>
            <input type="file" name="cv" id="cv" accept=".pdf" required>
        </div>

        <div class="form-group">
            <label for="lettre_motivation">Lettre de motivation (PDF uniquement)</label>
            <input type="file" name="lettre_motivation" id="lettre_motivation" accept=".pdf" required>
        </div>

        <button type="submit" class="btn submit">Envoyer ma candidature</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.opacity = 1;
            setTimeout(() => {
                alert.style.transition = "opacity 1s";
                alert.style.opacity = 0;
            }, 4000);
        }
    });
</script>
@endsection