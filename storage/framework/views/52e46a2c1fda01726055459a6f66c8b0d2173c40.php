<?php
$logos = [
    'Airbus' => 'assets/images/airbusavis.png',
    'Total' => 'assets/images/total.png',
    'Vinci' => 'assets/images/vinci.png',
    'Orange' => 'assets/images/orange.jpg',
    'Google' => 'assets/images/google.webp',
    'Microsoft' => 'assets/images/microsoft.png',
    'Apple' => 'assets/images/Apple_logo_black.png',
    'Amazon' => 'assets/images/amazon.jpg',
    'Facebook' => 'assets/images/facebook.png',
    'IBM' => 'assets/images/IBM_logo.svg.png',
    'Intel' => 'assets/images/Intel_logo_(2006-2020).svg.png',
    'Nvidia' => 'assets/images/nvidia.png',
    'Siemens' => 'assets/images/siemens.png',
    'Samsung' => 'assets/images/samsung.png',
    'CIC' => 'assets/images/CICavis.png',
    'Schneider' => 'assets/images/Schneideravis.jpg',
    'SFR' => 'assets/images/SFRavis.png',
    'Tesla' => 'assets/images/tesla.png'
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres de Stage - CRYF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/firstpage.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/offres.css')); ?>">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo-section">
            <a href="<?php echo e(route('firstpage')); ?>">
                <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="CRYF Logo" class="logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>
        <nav>
            <a href="#" class="btn inscription">Mon Profil</a>
        </nav>
    </div>
</header>

<section class="hero">
    <h1>Trouvez votre <span class="highlight">stage</span> idéal</h1>
    <div class="search-bar">
        <input type="text" placeholder="Poste, mots clés...">
        <input type="text" placeholder="Ville, code postal...">
        <button class="btn rechercher">Rechercher</button>
    </div>
</section>

<main class="offres-wrapper">
    <div class="offres-container">
        <!-- FILTRES -->
        <aside class="filtres">
            <form method="GET" action="<?php echo e(route('offres')); ?>" id="filtres-form">
                <!-- Catégories -->
                <div class="filtre-bloc">
                    <div class="filtre-header"><span>Catégories</span></div>
                    <?php $__currentLoopData = $categoriesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="categories[]" value="<?php echo e($cat); ?>" <?php echo e(in_array($cat, $selectedCategories) ? 'checked' : ''); ?>>
                            <span><?php echo e($cat); ?> (<?php echo e($categoryCounts[$cat] ?? 0); ?>)</span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Durée -->
                <div class="filtre-bloc">
                    <div class="filtre-header"><span>Durée du stage</span></div>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="duree[]" value="1-3" <?php echo e(in_array('1-3', $selectedDurees) ? 'checked' : ''); ?>>
                        <span>1 à 3 mois</span>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="duree[]" value="3-6" <?php echo e(in_array('3-6', $selectedDurees) ? 'checked' : ''); ?>>
                        <span>3 à 6 mois</span>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="duree[]" value="6+" <?php echo e(in_array('6+', $selectedDurees) ? 'checked' : ''); ?>>
                        <span>6 mois ou plus</span>
                    </label>
                </div>

                <button type="submit" class="btn filter-submit">Appliquer les filtres</button>
            </form>
        </aside>

        <!-- OFFRES -->
        <section class="liste-offres">
            <?php if($offres->count()): ?>
                <?php $__currentLoopData = $offres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $logo = $logos[$offre->nom_entreprise] ?? 'assets/images/logoProfil.jpg';
                    ?>
                    <div class="offre">
                        <div class="offre-logo">
                            <img src="<?php echo e(asset($logo)); ?>" alt="Logo <?php echo e($offre->nom_entreprise); ?>" class="entreprise-logo">
                        </div>
                        <div class="offre-details">
                            <h2><?php echo e($offre->titre); ?></h2>
                            <p><?php echo e($offre->nom_entreprise); ?> - <?php echo e($offre->ville); ?></p>
                            <div class="tags">
                                <span class="tag"><?php echo e($offre->categorie); ?></span>
                                <span class="tag"><?php echo e($offre->duree_du_stage); ?> mois</span>
                            </div>
                        </div>
                        <a href="#" class="btn postuler">Voir plus</a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p>Aucune offre trouvée.</p>
            <?php endif; ?>
        </section>
    </div>
</main>
<footer>
        <div class="footer-container">
            <div class="footer-logo">
                <a href="firstpage.php">
                    <img src="../assets/images/logo.png" alt="CRYF Logo">
                </a>
                <span class="brand-name">CRYF</span>
            </div>

            <div class="footer-section">
                <h3>A propos</h3>
                <ul>
                    <li><a href="quisommesnous.php">Qui sommes-nous ?</a></li>
                    <li><a href="avis.php">Avis</a></li>                    
                    <li><a href="mentions.php">Mentions légales</a></li>                   
                </ul>
            </div>

            <div class="footer-section">
                <h3>Liens utiles</h3>
                <ul>
                    <li><a href="offres.php">Offre de stage</a></li>
                    <li><a href="cgu.php">Conditions d'Utilisations</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-alertes">
                <h3>Alertes de stages</h3>
                <p>Les dernières offres de stages envoyées par mail chaque semaine.</p>
                <form action="newsletter.php" method="POST" class="newsletter">
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


<script>
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            document.getElementById('filtres-form').submit();
        });
    });
</script>

</body>
</html><?php /**PATH /mnt/c/wamp64/www/projetWEBDéplacé/laravel-cryf/resources/views/offres.blade.php ENDPATH**/ ?>