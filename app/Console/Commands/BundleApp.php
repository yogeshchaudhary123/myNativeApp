<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class BundleApp extends Command
{
    protected $signature = 'app:bundle {--prod : Whether to build for production (no-dev)}';
    protected $description = 'Automate the zipping and bundling of the application for mobile assets';

    public function handle()
    {
        $this->info('🚀 Starting App Bundle Process...');

        $tempPath = storage_path('app/temp-bundle');
        $zipPath = storage_path('app/native-build/laravel_bundle.zip');
        $androidAssetPath = base_path('nativephp/android/app/src/main/assets/laravel_bundle.zip');

        // 1. Cleanup old temp files
        if (File::exists($tempPath)) {
            $this->comment('Cleaning up old temp files...');
            File::deleteDirectory($tempPath);
        }
        File::makeDirectory($tempPath, 0755, true);

        // 2. Sync files to temp folder (excluding heavy/unnecessary folders)
        $this->comment('Syncing files to temporary bundle...');
        $exclude = [
            'node_modules',
            '.git',
            'nativephp/android',
            'storage/app/native-build',
            'storage/app/temp-bundle',
            'tests',
        ];

        $rsyncCmd = ['rsync', '-av'];
        foreach ($exclude as $dir) {
            $rsyncCmd[] = "--exclude={$dir}";
        }
        $rsyncCmd[] = './';
        $rsyncCmd[] = $tempPath . '/';

        $process = new Process($rsyncCmd, base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            $this->error('Failed to sync files: ' . $process->getErrorOutput());
            return 1;
        }

        // 3. Optimize dependencies if requested
        if ($this->option('prod')) {
            $this->comment('Optimizing production dependencies...');
            $composer = new Process(['composer', 'install', '--no-dev', '--optimize-autoloader'], $tempPath);
            $composer->setTimeout(300);
            $composer->run();
        }

        // 4. Create ZIP
        $this->comment('Creating laravel_bundle.zip...');
        if (File::exists($zipPath)) {
            File::delete($zipPath);
        }

        $zipCmd = ['zip', '-r', $zipPath, '.'];
        $zipProcess = new Process($zipCmd, $tempPath);
        $zipProcess->setTimeout(300);
        $zipProcess->run();

        if (!$zipProcess->isSuccessful()) {
            $this->error('Failed to create ZIP: ' . $zipProcess->getErrorOutput());
            return 1;
        }

        // 5. Copy to Android assets
        $this->comment('Syncing to Android assets...');
        File::ensureDirectoryExists(dirname($androidAssetPath));
        File::copy($zipPath, $androidAssetPath);

        // 6. Final Cleanup
        File::deleteDirectory($tempPath);

        $size = round(File::size($androidAssetPath) / 1024 / 1024, 2);
        $this->info("✅ Success! Bundle created: {$size}MB");
        $this->info("📍 Location: {$androidAssetPath}");

        return 0;
    }
}
