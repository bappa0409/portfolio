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
        $data = $this->validated($request);

        // slug auto generate if empty
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // unique slug fallback
        $base = $data['slug'];
        $i = 1;
        while (Project::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base.'-'.$i++;
        }

        // textarea lines to array
        $data['stack']    = $this->linesToArray($request->input('stack'));
        $data['features'] = $this->linesToArray($request->input('features'));
        $data['gallery']  = $this->linesToArray($request->input('gallery'));

        $data['visibility']  = $request->boolean('visibility');
        $data['is_featured'] = $request->boolean('is_featured');

        Project::create($data);

        return redirect()->route('admin.project.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('backend.pages.project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request, $project->id);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $base = $data['slug'];
        $i = 1;
        while (Project::where('slug', $data['slug'])->where('id', '!=', $project->id)->exists()) {
            $data['slug'] = $base.'-'.$i++;
        }

        $data['stack']    = $this->linesToArray($request->input('stack'));
        $data['features'] = $this->linesToArray($request->input('features'));
        $data['gallery']  = $this->linesToArray($request->input('gallery'));

        $data['visibility']  = $request->boolean('visibility');
        $data['is_featured'] = $request->boolean('is_featured');

        $project->update($data);

        return redirect()->route('admin.project.index')->with('success', 'Project updated successfully!');
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
            'image'      => ['nullable', 'string', 'max:255'], // filename only
            'impact'     => ['nullable', 'string'],
            'overview'   => ['nullable', 'string'],
            'status'     => ['required', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
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
