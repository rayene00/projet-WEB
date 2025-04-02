<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mentions Légales - CRYF</title>
  <link rel="stylesheet" href="{{ asset('css/cgu.css') }}" />
</head>
<body>

<header>
  <div class="header-container">
    <div class="logo-section">
      <a href="{{ route('firstpage') }}">
        <img src="{{ asset('assets/images/logo.png') }}" alt="CRYF Logo" class="logo">
      </a>
      <span class="brand-name">CRYF</span>
    </div>
    <nav>
      <a href="{{ url('/recruteur') }}" class="access-recruteur">Accès Recruteur ></a>
      <a href="{{ url('/signup') }}" class="btn inscription">Inscription</a>
      <a href="{{ url('/signin') }}" class="btn connexion">Se connecter</a>
    </nav>
  </div>
</header>

<!-- Ton contenu ici (les textes de mentions légales) -->
<div class="frame-conditions">
  <div class="content">
    <div class="text-wrapper-4">Mentions Légales</div>
    <div class="ces-conditions-d">
    <h2>Éditeur du Site</h2>
        <p>
          Le présent site, accessible à l'adresse www.cryf.com, est édité par CRYF, dont le siège social est situé au La Canopée, 390 Rue Claude Nicolas Ledoux, 13290 Aix-en-Provence, immatriculée au RCS de Aix-en-Provence sous le numéro 847 291 365.
        </p>

        <h2>Directeur de la Publication</h2>
        <p>
          Rayene Bendehane, en qualité de Faycal Medjtoh.
        </p>

        <h2>Contact</h2>
        <p>
          Pour toute question ou demande d'information concernant le site, ou pour signaler un contenu ou une activité illicite, l'utilisateur peut contacter l'éditeur à l'adresse e-mail suivante : cryf@gmail.com.
        </p>

        <h2>Hébergement</h2>
        <p>
          Le site est hébergé par ntr13, situé au 227 allés des tennis, 13130 Berre l’Étang, France.
        </p>

        <h2>Responsabilité</h2>
        <p>
          L'éditeur du site met tout en œuvre pour assurer l'exactitude et la mise à jour des informations diffusées sur ce site...
        </p>

        <h2>Propriété Intellectuelle</h2>
        <p>
          Tous les éléments du site (structure, textes, images, logos, etc.) sont protégés par le droit d’auteur et appartiennent à CRYF ou à ses partenaires...
        </p>

        <h2>Liens Hypertextes</h2>
        <p>
          Le site peut contenir des liens vers d'autres sites. CRYF n’est pas responsable du contenu de ces sites...
        </p>

        <h2>Protection des Données Personnelles</h2>
        <p>
          Les données personnelles collectées via les formulaires sont traitées par CRYF en qualité de responsable de traitement...
        </p>

        <h2>Déclaration CNIL</h2>
        <p>
          Ce site respecte les dispositions de la loi « Informatique et Libertés » du 6 janvier 1978 modifiée. Conformément à la réglementation en vigueur, aucune déclaration préalable n’est nécessaire auprès de la CNIL, sauf cas particuliers.
        </p>

        <h2>Cookies</h2>
        <p>
          Des cookies peuvent s’installer automatiquement sur le logiciel de navigation de l’utilisateur...
        </p>

        <h2>Droits d'accès, de rectification et de suppression</h2>
        <p>
          Conformément au RGPD, vous pouvez exercer vos droits en écrivant à cryf@gmail.com.
        </p>

        <h2>Conditions d'utilisation des services</h2>
        <p>
          L’accès aux fonctionnalités du site (alertes, candidatures, etc.) peut nécessiter la création d’un compte utilisateur...
        </p>

        <h2>Crédits</h2>
        <p>
          Conception graphique et développement : CRYF<br>
          Icônes : Font Awesome<br>
          Images : Partenaires ou libres de droits
        </p>

        <h2>Loi Applicable</h2>
        <p>
          Les présentes mentions légales sont régies par la loi française. Tout litige sera soumis à la compétence des tribunaux français.
        </p>

      </div>
    </div>
  </div>

<footer>
  <div class="footer-container">
    <div class="footer-logo">
      <a href="{{ route('firstpage') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="CRYF Logo"></a>
      <span class="brand-name">CRYF</span>
    </div>

    <div class="footer-section">
      <h3>A propos</h3>
      <ul>
        <li><a href="{{ url('/quisommesnous') }}">Qui sommes-nous ?</a></li>
        <li><a href="{{ route('avis') }}">Avis</a></li>
        <li><a href="{{ route('mentions') }}">Mentions légales</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Liens utiles</h3>
      <ul>
        <li><a href="{{ route('cgu') }}">Conditions d'Utilisation</a></li>
        <li><a href="{{ url('/offres') }}">Offre de stage</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
      </ul>
    </div>

    <div class="footer-alertes">
      <form action="{{ url('/newsletter') }}" method="POST" class="newsletter">
        @csrf
        <input type="email" name="email" placeholder="exemple@xxx.com" required>
        <button type="submit" class="btn">Inscription</button>
      </form>
    </div>
  </div>

  <div class="footer-bottom">
    <p>2025 @ CRYF. All rights reserved.</p>
    <div class="social-icons">
      <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
      <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
      <a href="https://x.com/home?lang=en" target="_blank"><i class="fa-brands fa-twitter"></i></a>
    </div>
  </div>
</footer>

</body>
</html>