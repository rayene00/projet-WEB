<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRYF - Trouver un Stage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/firstpage.css')); ?>">
</head>
<body>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- SECTION HERO -->
    <section class="hero">
        <h1>Trouver le <span class="highlight">stage</span> de vos rêves, en toute simplicité</h1>
        
        <div class="search-container">
            <form action="#" method="GET" class="search-bar">
                <input type="text" name="keywords" placeholder="Catégories, mots clés...">
                <input type="text" name="location" placeholder="Ville, code postal...">
                <button type="submit" class="rechercher">Rechercher</button>
            </form>
        </div>

        <div class="search-container">
            <form action="#" method="GET" class="search-bar-student">
                <button type="submit" class="rechercher">Rechercher un Pilote/Etudiant</button>
            </form>
        </div>
    </section>

    <!-- PARTENAIRES -->
    <section class="partenaires">
        <p>Entreprises avec lesquelles nous travaillons :</p>
        <div class="logos">
            <a href="https://www.airbus.com" target="_blank">
                <img src="<?php echo e(asset('assets/images/airbus.png')); ?>" alt="Airbus">
            </a>
            <a href="https://www.vinci.com" target="_blank">
                <img src="<?php echo e(asset('assets/images/vinci.png')); ?>" alt="Vinci">
            </a>
            <a href="https://www.orange.fr" target="_blank">
                <img src="<?php echo e(asset('assets/images/orange.png')); ?>" alt="Orange">
            </a>
            <a href="https://totalenergies.com" target="_blank">
                <img src="<?php echo e(asset('assets/images/total.png')); ?>" alt="TotalEnergies">
            </a>
        </div>
    </section>

    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH /mnt/c/wamp64/www/projetWEBDéplacé/laravel-cryf/resources/views/firstpage.blade.php ENDPATH**/ ?>