@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@600&family=Epilogue:wght@400;600&display=swap" rel="stylesheet">
@endsection

@section('content')
    <div class="hero-wrapper">
        <div class="hero-background"></div>
        @include('layouts.header')

        <section class="hero">
            <h1><span class="highlight">Contacter</span> nous</h1>
        </section>
    </div>

    <section class="contact-section">
        <div class="contact-left">
            <p>
                Pour toute question ou information supplémentaire,<br>
                veuillez remplir le formulaire ci-dessous.<br><br>
                Nous vous répondrons dans les plus brefs délais.<br><br>
                Vous pouvez directement nous contacter au :<br>
                <span class="phone-number">04 56 78 90 12</span>
            </p>
        </div>

        <div class="contact-right">
            @if(session('success'))
                <p class="success-msg">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('contact.envoyer') }}">
                @csrf
                <div class="form-row">
                    <input type="text" name="prenom" placeholder="Prénom" required>
                    <input type="text" name="nom" placeholder="Nom" required>
                </div>
                <div class="form-row">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="tel" name="telephone" placeholder="Téléphone" required>
                </div>
                <div class="form-row full">
                    <textarea name="message" placeholder="Messages" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Envoyer</button>
            </form>
        </div>
    </section>

    @include('layouts.footer')
@endsection