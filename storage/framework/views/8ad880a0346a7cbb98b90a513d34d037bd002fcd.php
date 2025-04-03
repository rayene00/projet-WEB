<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('CSS/app.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

    
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH /mnt/c/wamp64/www/projetWEBDéplacé/laravel-cryf/resources/views/layouts/base.blade.php ENDPATH**/ ?>