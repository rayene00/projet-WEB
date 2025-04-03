<header>
    <div class="header-container">
        <div class="logo-section">
            <a href="<?php echo e(auth()->check() ? route('apresconnexion') : route('firstpage')); ?>">
                <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="CRYF Logo" class="logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>

        <nav>
            <?php if(auth()->guard()->check()): ?>
                
                <?php
                    $role = auth()->user()->role ?? 'etudiant'; // Ajuste si tu as un champ différent
                ?>

                <?php if($role === 'etudiant'): ?>
                    <a href="<?php echo e(route('profile.etudiant')); ?>" class="btn inscription">Mon Profil</a>
                <?php elseif($role === 'pilote'): ?>
                    <a href="<?php echo e(route('profil.pilote')); ?>" class="btn inscription">Mon Profil</a>
                <?php else: ?>
                    <a href="#" class="btn inscription">Profil</a>
                <?php endif; ?>

                
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn connexion">Déconnexion</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('signup')); ?>" class="btn inscription">Inscription</a>
                <a href="<?php echo e(route('signin')); ?>" class="btn connexion">Se connecter</a>
            <?php endif; ?>
        </nav>
    </div>
</header><?php /**PATH /mnt/c/wamp64/www/projetWEBDéplacé/laravel-cryf/resources/views/layouts/header.blade.php ENDPATH**/ ?>