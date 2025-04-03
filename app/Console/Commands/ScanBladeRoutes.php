<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ScanBladeRoutes extends Command
{
    protected $signature = 'scan:blade-routes';
    protected $description = 'Scanne les fichiers Blade pour détecter les appels à des routes nommées spécifiques.';

    public function handle()
    {
        $this->info("🔍 Scan des fichiers Blade...");

        $files = File::allFiles(resource_path('views'));
        $target = "route('profile.etudiant')"; // << ici tu peux mettre ce que tu veux rechercher

        foreach ($files as $file) {
            $contents = File::get($file->getRealPath());
            if (str_contains($contents, $target)) {
                $this->warn("🟠 Trouvé dans : " . $file->getRelativePathname());
            }
        }

        $this->info("✅ Scan terminé !");
    }
}