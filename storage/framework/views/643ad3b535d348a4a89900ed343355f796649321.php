<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - CRYF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/signin.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="container">
        <h2>Connexion</h2>

        <?php if(session('message')): ?>
            <p class="form-message"><?php echo e(session('message')); ?></p>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('signin.login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" placeholder="Votre email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" placeholder="Votre mot de passe" required>
            </div>

            <a href="<?php echo e(route('forgetpassword')); ?>" class="forgot-password">Mot de passe oublié ?</a>

            <button type="submit" class="btn submit">Se connecter</button>
        </form>

        <p class="register-link">
            Pas encore de compte ?
            <a href="<?php echo e(route('signup')); ?>">S'inscrire ici</a>
        </p>
    </div>

    
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH /mnt/c/wamp64/www/projetWEBDéplacé/laravel-cryf/resources/views/signin.blade.php ENDPATH**/ ?>