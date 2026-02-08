<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('upload_image')) {
    /**
     * Upload a single image and optionally delete old path.
     * Supports optional fixed filename via $storeAsName.
     */
    function upload_image(
        ?UploadedFile $file,
        string $dir = 'uploads',
        string $disk = 'public',
        ?string $deleteOldPath = null,
        bool $keepOriginalName = false,
        ?string $storeAsName = null // ✅ NEW
    ): ?string {
        if (!$file) return null;
        if (!$file->isValid()) return null;

        // Delete old (if any)
        if ($deleteOldPath) {
            Storage::disk($disk)->delete($deleteOldPath);
        }

        // ✅ Store with fixed filename (highest priority)
        if ($storeAsName) {
            return $file->storeAs($dir, $storeAsName, $disk);
        }

        // Store using original name (slugged)
        if ($keepOriginalName) {
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext  = $file->getClientOriginalExtension();
            $safe = Str::slug($name) ?: 'image';
            $filename = $safe . '-' . time() . '-' . Str::random(6) . '.' . $ext;

            return $file->storeAs($dir, $filename, $disk);
        }

        // Default random name
        return $file->store($dir, $disk);
    }
}

if (!function_exists('upload_images')) {
    /**
     * Upload multiple images and optionally delete old paths array.
     *
     * @param  array<int, UploadedFile>|null  $files
     * @param  string                        $dir
     * @param  string                        $disk
     * @param  array<int, string>|null        $deleteOldPaths
     * @param  bool                          $keepOriginalName
     * @return array<int, string>             stored paths
     */
    function upload_images(
        ?array $files,
        string $dir = 'uploads',
        string $disk = 'public',
        ?array $deleteOldPaths = null,
        bool $keepOriginalName = false
    ): array {
        if (!$files || !count($files)) return [];

        // Delete old gallery if provided
        if ($deleteOldPaths && count($deleteOldPaths)) {
            Storage::disk($disk)->delete($deleteOldPaths);
        }

        $paths = [];
        foreach ($files as $file) {
            if (!$file instanceof UploadedFile) continue;
            if (!$file->isValid()) continue;

            $p = upload_image($file, $dir, $disk, null, $keepOriginalName);
            if ($p) $paths[] = $p;
        }

        return array_values($paths);
    }
}

if (!function_exists('file_url')) {
    /**
     * Convert storage path to public URL (works for public disk).
     * Example: 'projects/a.webp' => '/storage/projects/a.webp'
     */
    function file_url(?string $path, string $disk = 'public'): ?string
    {
        if (!$path) return null;
        return Storage::disk($disk)->url($path);
    }
}

if (!function_exists('delete_files')) {
    /**
     * Delete one or many files from disk safely.
     *
     * @param string|array<int,string>|null $paths
     */
    function delete_files(string|array|null $paths, string $disk = 'public'): void
    {
        if (!$paths) return;

        $paths = is_array($paths) ? $paths : [$paths];
        $paths = array_values(array_filter($paths));

        if (!count($paths)) return;
        Storage::disk($disk)->delete($paths);
    }
}
