<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

return new class extends Migration
{
    public function up(): void
    {
        $mediaItems = Media::where('disk', 'local')->get();

        foreach ($mediaItems as $media) {
            $privatePath = storage_path("app/private/{$media->id}");
            $publicPath = storage_path("app/public/{$media->id}");

            if (File::isDirectory($privatePath)) {
                File::copyDirectory($privatePath, $publicPath);
                File::deleteDirectory($privatePath);
            }

            $media->update(['disk' => 'public']);
        }
    }

    public function down(): void
    {
        $mediaItems = Media::where('disk', 'public')->get();

        foreach ($mediaItems as $media) {
            $publicPath = storage_path("app/public/{$media->id}");
            $privatePath = storage_path("app/private/{$media->id}");

            if (File::isDirectory($publicPath)) {
                File::copyDirectory($publicPath, $privatePath);
                File::deleteDirectory($publicPath);
            }

            $media->update(['disk' => 'local']);
        }
    }
};
