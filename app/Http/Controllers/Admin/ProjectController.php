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
            'title'      => ['required', 'string', 'max:255'],
            'subtitle'   => ['nullable', 'string', 'max:255'],
            'status'     => ['required', 'in:Live,Private,In Progress'],

            'stack'      => ['required', 'array', 'min:1'],
            'stack.*'    => ['string', 'max:50'],

            'overview'   => ['nullable', 'string'],
            'features'   => ['nullable', 'string'],

            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery'    => ['nullable', 'array'],
            'gallery.*'  => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        // unique slug
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $i = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        // features => array
        $features = collect(preg_split("/\r\n|\n|\r/", (string) $request->input('features', '')))
            ->map(fn ($x) => trim($x))
            ->filter()
            ->values()
            ->all();

        // checkboxes
        $visibility = $request->boolean('visibility', true);
        $isFeatured = $request->boolean('is_featured', false);

        // upload dir
        $dir = public_path('images/projects');
        if (!is_dir($dir)) @mkdir($dir, 0755, true);

        // main image
        $mainFilename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mainFilename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $mainFilename);
        }

        // gallery images
        $galleryFiles = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $g) {
                if (!$g || !$g->isValid()) continue;

                $name = time() . '_' . Str::random(8) . '.' . $g->getClientOriginalExtension();
                $g->move($dir, $name);
                $galleryFiles[] = $name;
            }
        }

        Project::create([
            'title'       => $validated['title'],
            'slug'        => $slug,
            'subtitle'    => $validated['subtitle'] ?? null,
            'status'      => $validated['status'],

            'stack'       => array_values(array_unique($validated['stack'])),

            'visibility'  => $visibility,
            'is_featured' => $isFeatured,

            'overview'    => $validated['overview'] ?? null,
            'features'    => $features,
            'image'       => $mainFilename,
            'gallery'     => $galleryFiles,
        ]);

        return response()->json([
            'message'  => 'Project created successfully..!!',
            'redirect' => route('admin.projects.index'),
        ]);
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

            'stack'      => ['required', 'array', 'min:1'],
            'stack.*'    => ['string', 'max:50'],

            'overview'   => ['nullable', 'string'],
            'features'   => ['nullable', 'string'],

            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery'    => ['nullable', 'array'],
            'gallery.*'  => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'regenerate_slug' => ['nullable'],
            'replace_gallery' => ['nullable'],
        ]);

        $dir = public_path('images/projects');
        if (!is_dir($dir)) @mkdir($dir, 0755, true);

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

        // features => array
        $features = collect(preg_split("/\r\n|\n|\r/", (string) $request->input('features', '')))
            ->map(fn ($x) => trim($x))
            ->filter()
            ->values()
            ->all();

        // checkboxes (unchecked হলে false হবে)
        $project->visibility  = $request->boolean('visibility', false);
        $project->is_featured = $request->boolean('is_featured', false);

        // main image replace
        if ($request->hasFile('image')) {
            if (!empty($project->image)) {
                $old = $dir . '/' . $project->image;
                if (is_file($old)) @unlink($old);
            }

            $file = $request->file('image');
            $mainFilename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $mainFilename);
            $project->image = $mainFilename;
        }

        // gallery existing
        $existingGallery = is_array($project->gallery) ? $project->gallery : (json_decode($project->gallery, true) ?: []);

        // replace gallery optional
        if ($request->boolean('replace_gallery')) {
            foreach ($existingGallery as $g) {
                $p = $dir . '/' . $g;
                if (is_file($p)) @unlink($p);
            }
            $existingGallery = [];
        }

        // new gallery upload
        $newGalleryFiles = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $g) {
                if (!$g || !$g->isValid()) continue;

                $name = time() . '_' . Str::random(8) . '.' . $g->getClientOriginalExtension();
                $g->move($dir, $name);
                $newGalleryFiles[] = $name;
            }
        }

        $project->gallery = array_values(array_unique(array_merge($existingGallery, $newGalleryFiles)));

        // fields
        $project->title    = $validated['title'];
        $project->subtitle = $validated['subtitle'] ?? null;
        $project->status   = $validated['status'];

        $project->stack    = array_values(array_unique($validated['stack']));

        $project->overview = $validated['overview'] ?? null;
        $project->features = $features;

        $project->save();

        // ✅ AJAX friendly response
        return response()->json([
            'message'  => 'Project updated successfully!',
            'redirect' => route('admin.projects.index'),
        ]);
    }

    public function destroy(Project $project)
    {
        $dir = public_path('images/projects');
        if (!is_dir($dir)) @mkdir($dir, 0755, true);

        // delete main image
        if (!empty($project->image)) {
            $old = $dir . '/' . $project->image;
            if (is_file($old)) @unlink($old);
        }

        // delete gallery images
        $gallery = is_array($project->gallery) ? $project->gallery : (json_decode($project->gallery, true) ?: []);
        foreach ($gallery as $g) {
            $p = $dir . '/' . $g;
            if (is_file($p)) @unlink($p);
        }

        $project->delete();

        // ✅ AJAX friendly response
        return response()->json([
            'message' => 'Project deleted successfully!',
        ]);
    }

    // ✅ MULTI DELETE
    public function multiDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || count($ids) === 0) {
            return response()->json(['message' => 'No project selected.'], 422);
        }

        $dir = public_path('images/projects');
        if (!is_dir($dir)) @mkdir($dir, 0755, true);

        $projects = Project::whereIn('id', $ids)->get();

        foreach ($projects as $project) {
            // delete main image
            if (!empty($project->image)) {
                $old = $dir . '/' . $project->image;
                if (is_file($old)) @unlink($old);
            }

            // delete gallery
            $gallery = is_array($project->gallery) ? $project->gallery : (json_decode($project->gallery, true) ?: []);
            foreach ($gallery as $g) {
                $p = $dir . '/' . $g;
                if (is_file($p)) @unlink($p);
            }

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
