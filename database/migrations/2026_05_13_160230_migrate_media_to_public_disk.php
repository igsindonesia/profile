<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

return new class extends Migration
{
    public function up(): void
    {
        $mediaItems = Media::where('disk', 'local')->get();

        foreach ($mediaItems as $media) {
            $privateDisk = Storage::disk('local');
            $publicDisk = Storage::disk('public');

            $privateDir = "{$media->id}";

            if (! $privateDisk->exists($privateDir)) {
                $media->update(['disk' => 'public']);

                continue;
            }

            $files = $privateDisk->allFiles($privateDir);

            foreach ($files as $file) {
                $publicDisk->put($file, $privateDisk->get($file));
                $privateDisk->delete($file);
            }

            $privateDisk->deleteDirectory($privateDir);
            $media->update(['disk' => 'public']);
        }
    }

    public function down(): void
    {
        $mediaItems = Media::where('disk', 'public')->get();

        foreach ($mediaItems as $media) {
            $publicDisk = Storage::disk('public');
            $privateDisk = Storage::disk('local');

            $publicDir = "{$media->id}";

            if (! $publicDisk->exists($publicDir)) {
                continue;
            }

            $files = $publicDisk->allFiles($publicDir);

            foreach ($files as $file) {
                $privateDisk->put($file, $publicDisk->get($file));
                $publicDisk->delete($file);
            }

            $publicDisk->deleteDirectory($publicDir);
            $media->update(['disk' => 'local']);
        }
    }
};
