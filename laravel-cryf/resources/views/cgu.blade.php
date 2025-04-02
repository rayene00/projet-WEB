@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cgu.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
    @include('layouts.header')

    <div class="frame-conditions">
        <div class="content">
            <div class="text-wrapper-4">Conditions d'utilisation</div>
            <div class="ces-conditions-d">
                <p>Ces Conditions d'Utilisation (les "Conditions") régissent votre accès et votre utilisation de CRYF...</p>
                
                <!-- ...existing code avec les conditions d'utilisation... -->
                
                <h2>40. Politique de Confidentialité des Données</h2>
                <p>Nous nous engageons à protéger la confidentialité de vos données. Veuillez consulter notre Politique de Confidentialité des Données pour plus de détails sur la manière dont nous collectons, utilisons et protégeons vos informations personnelles.</p>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection