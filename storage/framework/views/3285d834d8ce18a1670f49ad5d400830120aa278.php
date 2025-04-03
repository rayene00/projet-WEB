<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CRYF - Trouver un Stage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/firstpage.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <section class="hero">
        <h1>Trouver le <span class="highlight">stage</span> de vos rêves, en toute simplicité</h1>
        <form action="<?php echo e(route('offres')); ?>" method="GET" class="search-bar">
            <input type="text" name="keyword" placeholder="Poste, mots clés...">
            <input type="text" name="location" placeholder="Ville, code postal...">
            <button type="submit" class="btn rechercher">Rechercher</button>
        </form>
    </section>

    
    <section class="partenaires">
        <p>Entreprises avec lesquelles nous travaillons :</p>
        <div class="logos">
            <?php
                $logos = [
                    'Airbus' => asset('assets/images/airbus.png'),
                    'Total' => asset('assets/images/total.png'),
                    'Vinci' => asset('assets/images/vinci.png'),
                    'Orange' => asset('assets/images/orange.png'),
                ];
            ?>

            <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nom => $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#" class="partenaire-logo">
                    <img src="<?php echo e($logo); ?>" alt="Logo <?php echo e($nom); ?>">
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH /mnt/c/wamp64/www/projetWEBDéplacé/laravel-cryf/resources/views/apresconnexion.blade.php ENDPATH**/ ?>