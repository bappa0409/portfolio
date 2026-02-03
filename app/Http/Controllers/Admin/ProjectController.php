<?php

namespace App\Http\Controllers\Admin;

use App\Services\GitHubService;
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
            'title'      => ['required', 'string', 'max:255'],
            'subtitle'   => ['nullable', 'string', 'max:255'],

            'status'     => ['required', 'in:Live,Private,In Progress'],

            'overview'   => ['nullable', 'string'],
            'features'   => ['nullable', 'string'],

            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery'    => ['nullable', 'array'],
            'gallery.*'  => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        // ✅ Backend slug from title (unique)
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $i = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        // ✅ Features: one per line -> array
        $features = collect(preg_split("/\r\n|\n|\r/", $request->input('features', '')))
            ->map(fn ($x) => trim($x))
            ->filter()
            ->values()
            ->all();

        // ✅ Checkboxes (unchecked হলে request এ আসে না)
        $visibility = $request->boolean('visibility', true);
        $isFeatured = $request->boolean('is_featured', false);

        // ✅ Upload folder (matches your frontend: asset('images/projects/...'))
        $dir = public_path('images/projects');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        // ✅ Main image upload
        $mainFilename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mainFilename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $mainFilename);
        }

        // ✅ Gallery upload (multiple)
        $galleryFiles = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $g) {
                if (!$g || !$g->isValid()) continue;

                $name = time() . '_' . Str::random(8) . '.' . $g->getClientOriginalExtension();
                $g->move($dir, $name);
                $galleryFiles[] = $name;
            }
        }

        // ✅ INSERT
        Project::create([
            'title'       => $validated['title'],
            'slug'        => $slug,
            'subtitle'    => $validated['subtitle'] ?? null,
            'status'      => $validated['status'],
            'visibility'  => $visibility,
            'is_featured' => $isFeatured,
            'overview'    => $validated['overview'] ?? null,
            'features'    => $features,
            'image'       => $mainFilename,
            'gallery'     => $galleryFiles,
        ]);

        return redirect()
            ->route('admin.project.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('backend.pages.project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'subtitle'   => ['nullable', 'string', 'max:255'],
            'status'     => ['required', 'in:Live,Private,In Progress'],

            'overview'   => ['nullable', 'string'],
            'features'   => ['nullable', 'string'],

            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery'    => ['nullable', 'array'],
            'gallery.*'  => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            // optional switches
            'regenerate_slug' => ['nullable'], // checkbox
            'replace_gallery' => ['nullable'], // checkbox
        ]);

        $dir = public_path('images/projects');
        if (!is_dir($dir)) @mkdir($dir, 0755, true);

        // ✅ slug: default keep old, regenerate only if checkbox checked
        if ($request->boolean('regenerate_slug')) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $i = 1;
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }
            $project->slug = $slug;
        }

        // ✅ features lines -> array
        $features = collect(preg_split("/\r\n|\n|\r/", $request->input('features', '')))
            ->map(fn ($x) => trim($x))
            ->filter()
            ->values()
            ->all();

        // ✅ checkboxes
        $project->visibility  = $request->boolean('visibility', false);
        $project->is_featured = $request->boolean('is_featured', false);

        // ✅ main image replace
        if ($request->hasFile('image')) {
            // delete old
            if (!empty($project->image)) {
                $old = $dir . '/' . $project->image;
                if (is_file($old)) @unlink($old);
            }

            $file = $request->file('image');
            $mainFilename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $mainFilename);
            $project->image = $mainFilename;
        }

        // ✅ gallery: append OR replace (based on checkbox)
        $existingGallery = is_array($project->gallery) ? $project->gallery : [];

        if ($request->boolean('replace_gallery')) {
            // delete old gallery files
            foreach ($existingGallery as $g) {
                $p = $dir . '/' . $g;
                if (is_file($p)) @unlink($p);
            }
            $existingGallery = [];
        }

        $newGalleryFiles = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $g) {
                if (!$g || !$g->isValid()) continue;

                $name = time() . '_' . Str::random(8) . '.' . $g->getClientOriginalExtension();
                $g->move($dir, $name);
                $newGalleryFiles[] = $name;
            }
        }

        // merge + unique
        $project->gallery = array_values(array_unique(array_merge($existingGallery, $newGalleryFiles)));

        // ✅ simple fields
        $project->title      = $validated['title'];
        $project->subtitle   = $validated['subtitle'] ?? null;
        $project->status     = $validated['status'];
        $project->overview   = $validated['overview'] ?? null;
        $project->features   = $features;

        $project->save();

        return redirect()
            ->route('admin.project.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project deleted successfully!');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'slug'       => ['nullable', 'string', 'max:255'],
            'subtitle'   => ['nullable', 'string', 'max:255'],
            'image'      => ['nullable', 'string', 'max:255'], 
            'overview'   => ['nullable', 'string'],
            'status'     => ['required', 'string', 'max:50'],
        ]);
    }

    private function linesToArray($value): array
    {
        if (is_array($value)) return array_values(array_filter($value));

        $lines = preg_split("/\r\n|\n|\r/", (string) $value);
        $lines = array_map(fn($x) => trim($x), $lines);
        return array_values(array_filter($lines, fn($x) => $x !== ''));
    }

    public function multiDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || count($ids) === 0) {
            return response()->json(['status' => false, 'message' => 'No items selected.'], 422);
        }

        Project::whereIn('id', $ids)->delete();

        return response()->json(['status' => true, 'message' => 'Selected projects deleted successfully.']);
    }

    public function visibilityChange(Project $id) // route: /visibility-change/{id:id}
    {
        $id->visibility = !$id->visibility;
        $id->save();

        return response()->json([
            'status' => true,
            'message' => 'Visibility updated.',
            'visibility' => (bool) $id->visibility
        ]);
    }
}
