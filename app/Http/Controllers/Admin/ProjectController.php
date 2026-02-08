<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(12);
        return view('backend.pages.project.index', compact('projects'));
    }

    public function create()
    {
        return view('backend.pages.project.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => ['required','string','max:255'],
            'subtitle'   => ['nullable','string','max:255'],
            'status'     => ['required','in:Live,Private,In Progress'],

            'type'       => ['nullable','in:professional,personal,challenge'],
            'url'        => ['nullable','url'],

            'stack'      => ['required','array','min:1'],
            'stack.*'    => ['string','max:50'],

            'overview'   => ['nullable','string'],

            'features'   => ['nullable','array'],
            'features.*' => ['nullable','string','max:255'],

            'image'      => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'gallery'    => ['nullable','array'],
            'gallery.*'  => ['image','mimes:jpg,jpeg,png,webp','max:4096'],

            'process'         => ['nullable','array'],
            'process.*.title' => ['nullable','string','max:100'],
            'process.*.desc'  => ['nullable','string','max:200'],
        ]);

        // unique slug
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $i = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        // sanitize features + process (your existing approach)
        $features = collect($request->input('features', []))
            ->map(fn($x) => trim((string)$x))
            ->filter()
            ->values()
            ->all();

        $process = collect($request->input('process', []))
            ->map(function ($row) {
                $title = trim((string)($row['title'] ?? ''));
                $desc  = trim((string)($row['desc'] ?? ''));
                if ($title === '' && $desc === '') return null;
                return ['title' => $title, 'desc' => $desc];
            })
            ->filter()
            ->values()
            ->all();

        $visibility = $request->boolean('visibility', true);
        $isFeatured = $request->boolean('is_featured', false);

        $mainImagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext  = $file->getClientOriginalExtension();

            $fileName = "{$slug}.{$ext}";
            $mainImagePath = upload_image(
                $file,
                dir: 'upload/images/projects',
                disk: 'public',
                deleteOldPath: null,
                keepOriginalName: false,
                storeAsName: $fileName
            );
        }

        $galleryPaths  = upload_images($request->file('gallery'), 'upload/images/projects', 'public');

        Project::create([
            'title'       => $validated['title'],
            'slug'        => $slug,
            'subtitle'    => $validated['subtitle'] ?? null,
            'status'      => $validated['status'],
            'type'        => $validated['type'] ?? 'personal',
            'url'         => $validated['url'] ?? null,

            'stack'       => array_values(array_unique($validated['stack'])),

            'visibility'  => $visibility,
            'is_featured' => $isFeatured,

            'overview'    => $validated['overview'] ?? null,
            'features'    => $features ?: null,
            'process'     => $process ?: null,

            'image'       => $mainImagePath,
            'gallery'     => $galleryPaths, 
        ]);

        return response()->json([
            'message'  => 'Project created successfully..!!',
            'redirect' => route('admin.projects.index'),
        ]);
    }



   public function edit(Project $project)
{
    return view('backend.pages.project.edit', [
        'project'     => $project,
        'stackOld'    => $project->stack ?? [],
        'featuresArr' => $project->features ?? [],
        'processArr'  => $project->process ?? [],
        'gal'         => $project->gallery ?? [],
    ]);
}


    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'subtitle'   => ['nullable', 'string', 'max:255'],
            'status'     => ['required', 'in:Live,Private,In Progress'],

            'stack'      => ['required', 'array', 'min:1'],
            'stack.*'    => ['string', 'max:50'],

            'overview'   => ['nullable', 'string'],

            'features'   => ['nullable', 'array'],
            'features.*' => ['nullable', 'string', 'max:255'],

            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery'    => ['nullable', 'array'],
            'gallery.*'  => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'process'         => ['nullable', 'array'],
            'process.*.title' => ['nullable', 'string', 'max:100'],
            'process.*.desc'  => ['nullable', 'string', 'max:200'],

            'regenerate_slug' => ['nullable'],
            'replace_gallery' => ['nullable'],
        ]);

        // slug regenerate optional
        if ($request->boolean('regenerate_slug')) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $i = 1;

            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $project->slug = $slug;
        }

        // ✅ features sanitize
        $features = collect($request->input('features', []))
            ->map(fn($x) => trim((string)$x))
            ->filter()
            ->values()
            ->all();

        // ✅ process sanitize
        $process = collect($request->input('process', []))
            ->map(function ($row) {
                $title = trim((string)($row['title'] ?? ''));
                $desc  = trim((string)($row['desc'] ?? ''));
                if ($title === '' && $desc === '') return null;
                return ['title' => $title, 'desc' => $desc];
            })
            ->filter()
            ->values()
            ->all();

        // checkboxes
        $project->visibility  = $request->boolean('visibility', false);
        $project->is_featured = $request->boolean('is_featured', false);

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $ext  = $file->getClientOriginalExtension();

            // Keep same name per project
            $fileName = "{$project->slug}.{$ext}";

            $project->image = upload_image(
                $file,
                dir: 'upload/images/projects',
                disk: 'public',
                deleteOldPath: $project->image,
                keepOriginalName: false,
                storeAsName: $fileName
            );
        }

        // -----------------------------
        // ✅ GALLERY (Storage)
        // -----------------------------
        $existingGallery = $project->gallery ?? [];

        // replace gallery optional (delete old gallery + reset)
        if ($request->boolean('replace_gallery')) {
            delete_files($existingGallery, 'public');
            $existingGallery = [];
        }

        // append new gallery uploads
        $newGalleryFiles = [];
        if ($request->hasFile('gallery')) {
            $newGalleryFiles = upload_images(
                $request->file('gallery'),
                dir: 'upload/images/projects',
                disk: 'public'
            );
        }

        $project->gallery = array_values(array_unique(array_merge($existingGallery, $newGalleryFiles)));

        // fields
        $project->title    = $validated['title'];
        $project->subtitle = $validated['subtitle'] ?? null;
        $project->status   = $validated['status'];

        $project->stack    = array_values(array_unique($validated['stack']));
        $project->overview = $validated['overview'] ?? null;

        $project->features = $features ?: null;
        $project->process  = $process ?: null;

        $project->save();

        return response()->json([
            'message'  => 'Project updated successfully!',
            'redirect' => route('admin.projects.index'),
        ]);
    }


    public function destroy(Project $project)
    {
        // delete main + gallery from disk
        delete_files($project->image, 'public');
        delete_files($project->gallery ?? [], 'public');

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully!',
        ]);
    }

    public function multiDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || count($ids) === 0) {
            return response()->json(['message' => 'No project selected.'], 422);
        }

        $projects = Project::whereIn('id', $ids)->get();

        foreach ($projects as $project) {
            delete_files($project->image, 'public');
            delete_files($project->gallery ?? [], 'public');
            $project->delete();
        }

        return response()->json([
            'message' => 'Selected projects deleted successfully!',
        ]);
    }

    // ✅ VISIBILITY TOGGLE (axios)
    public function toggleVisibility($id)
    {
        $project = Project::findOrFail($id);
        $project->visibility = !$project->visibility;
        $project->save();

        return response()->json([
            'status'     => true,
            'visibility' => (bool) $project->visibility,
            'message'    => 'Visibility updated',
        ]);
    }
}
