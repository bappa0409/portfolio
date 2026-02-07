<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSettingsController extends Controller
{
    private function settings(): AboutSetting
    {
        return AboutSetting::updateOrCreate(['id' => 1], []);
    }

    public function edit()
    {
        $settings = AboutSetting::firstOrCreate([]);
        return view('backend.pages.about_us', compact('settings'));
    }
    
    public function header(Request $request)
    {
        $data = $request->validate([
            'header.kicker'   => ['nullable','string','max:255'],

            'header.title'    => ['nullable','string','max:255'],
            'header.subtitle' => ['nullable','string','max:500'],
        ]);

        $this->settings()->update(['header' => $data['header'] ?? []]);

        return response()->json(['message' => 'Header saved']);
    }

    public function terminal(Request $request)
    {
        $data = $request->validate([
            'terminal.whoami'        => ['nullable','string','max:255'],
            'terminal.stack'         => ['nullable','array'],
            'terminal.stack.*'       => ['nullable','string','max:50'],
            'terminal.current_role'  => ['nullable','string','max:1000'],
            'terminal.projects'      => ['nullable','array'],
            'terminal.projects.*'    => ['nullable','string','max:255'],
        ]);

        $this->settings()->update(['terminal' => $data['terminal'] ?? []]);

        return response()->json(['message' => 'Terminal saved']);
    }

    public function tags(Request $request)
    {
        $data = $request->validate([
            'tags'   => ['nullable','array'],
            'tags.*' => ['nullable','string','max:50'],
        ]);

        $this->settings()->update(['tags' => $data['tags'] ?? []]);

        return response()->json(['message' => 'Tags saved']);
    }

    public function profile(Request $request)
    {
        $settings = AboutSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'profile.name' => ['nullable', 'string', 'max:255'],
            'profile.title' => ['nullable', 'string', 'max:255'],
            'profile.status.available' => ['nullable', 'string', 'max:255'],
            'profile.status.response' => ['nullable', 'string', 'max:255'],
            'profile.status.collab' => ['nullable', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $profile = $settings->profile ?? [];

        $incoming = $validated['profile'] ?? [];
        $profile = array_replace_recursive($profile, $incoming);

        if ($request->hasFile('profile_image')) {
            $oldPath = data_get($profile, 'profile_image');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('profile_image')->store('about', 'public');
            $profile['profile_image'] = $path;
        }

        $settings->profile = $profile;
        $settings->save();


         return response()->json([
            'message' => 'Profile updated successfully.',
            'data' => [
                'profile' => $settings->profile,
                'profile_image' => data_get($settings->profile, 'profile_image'),
            ],
        ]);
    }

    public function journey(Request $request)
    {
        $data = $request->validate([
            'journey' => ['nullable','string'],
        ]);

        $this->settings()->update(['journey' => $data['journey'] ?? null]);

        return response()->json(['message' => 'Journey saved']);
    }

    public function education(Request $request)
    {
        $data = $request->validate([
            'education'            => ['nullable','array'],
            'education.*.title'    => ['nullable','string','max:255'],
            'education.*.year'     => ['nullable','string','max:50'],
            'education.*.note'     => ['nullable','string','max:255'],
        ]);

        $this->settings()->update(['education' => $data['education'] ?? []]);

        return response()->json(['message' => 'Education saved']);
    }

    public function training(Request $request)
    {
        $data = $request->validate([
            'training'               => ['nullable','array'],
            'training.*.title'       => ['nullable','string','max:255'],
            'training.*.institute'   => ['nullable','string','max:255'],
            'training.*.duration'    => ['nullable','string','max:50'],
        ]);

        $this->settings()->update(['training' => $data['training'] ?? []]);

        return response()->json(['message' => 'Training saved']);
    }

    public function experience(Request $request)
    {
        $data = $request->validate([
            'experience'                => ['nullable','array'],

            'experience.*.role'         => ['nullable','string','max:255'],
            'experience.*.company'      => ['nullable','string','max:255'],
            'experience.*.location'     => ['nullable','string','max:255'],
            'experience.*.period'       => ['nullable','string','max:100'],

            'experience.*.tasks'        => ['nullable','array'],
            'experience.*.tasks.*'      => ['nullable','string','max:255'],
        ]);

        $this->settings()->update(['experience' => $data['experience'] ?? []]);

        return response()->json(['message' => 'Experience saved']);
    }

    public function skills(Request $request)
    {
        $data = $request->validate([
            'skills'              => ['nullable','array'],
            'skills.*.name'       => ['nullable','string','max:255'],
            'skills.*.percent'    => ['nullable','integer','min:0','max:100'],
        ]);

        $this->settings()->update(['skills' => $data['skills'] ?? []]);

        return response()->json(['message' => 'Skills saved']);
    }

    public function philosophy(Request $request)
    {
        $data = $request->validate([
            'philosophy'   => ['nullable','array'],
            'philosophy.*' => ['nullable','string','max:255'],
        ]);

        $this->settings()->update(['philosophy' => $data['philosophy'] ?? []]);

        return response()->json(['message' => 'Philosophy saved']);
    }

    public function passions(Request $request)
    {
        $data = $request->validate([
            'passions'            => ['nullable','array'],
            'passions.*.title'    => ['nullable','string','max:255'],
            'passions.*.desc'     => ['nullable','string','max:255'],
        ]);

        $this->settings()->update(['passions' => $data['passions'] ?? []]);

        return response()->json(['message' => 'Passions saved']);
    }

}
