

<?php $__env->startSection('title', 'Profil Étudiant'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('CSS/profiletudiant.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="main">
    
    <aside class="sidebar">
        <div class="sidebar-title">
            <i class="fas fa-user"></i> Mon espace
        </div>

        <div class="sidebar-menu">
            <a href="<?php echo e(route('profile.etudiant')); ?>" class="active"><i class="fas fa-id-card"></i> Mon profil</a>
        </div>

        <div class="sidebar-section">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Déconnexion
</a>
            <a href="#" onclick="openDeleteModal()" class="delete-account">
                <i class="fas fa-user-times"></i> Supprimer mon compte
            </a>
        </div>
    </aside>

    
    <section class="profile">
        <h2>Mon Profil Étudiant</h2>

        <div class="profile-card">
            
            <form action="<?php echo e(route('profile.photo.upload')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="avatar-container">
                    <img src="<?php echo e(Auth::user()->photo_profil ? asset(Auth::user()->photo_profil) : asset('images/avatar-default.png')); ?>" alt="Photo de profil" class="avatar">

                    <div class="photo-upload">
                        <label for="upload-photo">Changer la photo</label>
                        <input type="file" id="upload-photo" name="photo" required>
                    </div>

                    <button type="submit" class="btn">Mettre à jour</button>
                </div>
            </form>

            <div class="profile-info">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('profile.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" value="<?php echo e(Auth::user()->nom); ?>">
                        <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" value="<?php echo e(Auth::user()->prenom); ?>">
                        <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo e(Auth::user()->email); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe actuel (requis pour confirmer les modifications)</label>
                        <input type="password" name="password" required>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn">Sauvegarder les modifications</button>
                </form>
            </div>
        </div>

        
        <div class="historique-candidatures" style="margin-top: 40px;">
            <h2>Mes candidatures</h2>

            <?php
                $candidatures = DB::table('candidature')
                    ->join('offre_de_stage', 'offre_de_stage.id', '=', 'candidature.offre_id')
                    ->where('utilisateur_id', Auth::id())
                    ->orderByDesc('candidature.date_candidature')
                    ->select('offre_de_stage.titre', 'offre_de_stage.ville', 'candidature.date_candidature')
                    ->get();
            ?>

            <?php if($candidatures->isEmpty()): ?>
                <p>Vous n'avez encore postulé à aucune offre.</p>
            <?php else: ?>
                <div class="candidature-list">
                    <?php $__currentLoopData = $candidatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="candidature-item">
                            <div class="candidature-header">
                                <span class="candidature-company"><?php echo e($c->titre); ?></span>
                                <span class="candidature-date"><?php echo e(\Carbon\Carbon::parse($c->date_candidature)->format('d/m/Y')); ?></span>
                            </div>
                            <div class="candidature-role"><?php echo e($c->ville); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<!-- Modal de suppression -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h3>Supprimer votre compte</h3>
        <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible et supprimera toutes vos données, y compris vos candidatures.</p>
        
        <form action="<?php echo e(route('profile.delete')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label>Entrez votre mot de passe pour confirmer</label>
                <input type="password" name="password" required>
                <?php $__errorArgs = ['delete_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="modal-buttons">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-cancel">Annuler</button>
                <button type="submit" class="btn btn-delete">Supprimer définitivement</button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Fermer le modal si on clique en dehors
window.onclick = function(event) {
    if (event.target == document.getElementById('deleteModal')) {
        closeDeleteModal();
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/wamp64/www/projetWEBDéplacé/laravel-cryf/resources/views/profiletudiant.blade.php ENDPATH**/ ?>