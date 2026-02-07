<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AboutSettingsController extends Controller
{
    private function settings(): AboutSetting
    {
        return AboutSetting::updateOrCreate(['id' => 1], []);
    }
    private function clearCache(): void
    {
        Cache::forget('about_settings');
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
        $this->clearCache();

        return response()->json(['message' => 'Header Saved Successfully..!!']);
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
        $this->clearCache();

        return response()->json(['message' => 'Terminal Saved Successfully..!!']);
    }

    public function tags(Request $request)
    {
        $data = $request->validate([
            'tags'   => ['nullable','array'],
            'tags.*' => ['nullable','string','max:50'],
        ]);

        $this->settings()->update(['tags' => $data['tags'] ?? []]);
        $this->clearCache();

        return response()->json(['message' => 'Tags Saved Successfully..!!']);
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
            'cv_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $name = data_get($validated, 'profile.name') ?? data_get($settings->profile, 'name') ?? 'profile';
        $slug = Str::slug($name);

        $profile = $settings->profile ?? [];

        $incoming = $validated['profile'] ?? [];
        $profile = array_replace_recursive($profile, $incoming);

        if ($request->hasFile('profile_image')) {
            $oldPath = data_get($profile, 'profile_image');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            $file = $request->file('profile_image');
            $ext  = $file->getClientOriginalExtension();

            $fileName = "{$slug}-profile.{$ext}";
            $path = $file->storeAs('upload/about', $fileName, 'public');

            $profile['profile_image'] = $path;
        }

        if ($request->hasFile('cv_file')) {
            $oldCvPath = data_get($profile, 'cv.path');
            if ($oldCvPath && Storage::disk('public')->exists($oldCvPath)) {
                Storage::disk('public')->delete($oldCvPath);
            }

            $file = $request->file('cv_file');
            $ext  = $file->getClientOriginalExtension();

            $fileName = "{$slug}-cv.{$ext}";
            $path = $file->storeAs('upload/cv', $fileName, 'public');

            $profile['cv'] = [
                'path'          => $path,
                'original_name' => $fileName, // or keep original if you want
                'size'          => $file->getSize(),
            ];
        }

        $settings->profile = $profile;
        $settings->save();
        $this->clearCache();

         return response()->json([
            'message' => 'Profile Updated Successfully..!!',
            'data' => [
                'profile' => $settings->profile,
                'profile_image' => data_get($settings->profile, 'profile_image'),
                'cv' => data_get($settings->profile, 'cv'),
            ],
        ]);
    }

    public function journey(Request $request)
    {
        $data = $request->validate([
            'journey' => ['nullable','string'],
        ]);

        $this->settings()->update(['journey' => $data['journey'] ?? null]);
        $this->clearCache();

        return response()->json(['message' => 'Journey Saved Uuccessfully..!!']);
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
        $this->clearCache();

        return response()->json(['message' => 'Education Saved Uuccessfully..!!']);
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
        $this->clearCache();

        return response()->json(['message' => 'Training Saved Successfully..!!']);
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
        $this->clearCache();

        return response()->json(['message' => 'Experience Saved Successfully..!!']);
    }

    public function skills(Request $request)
    {
        $data = $request->validate([
            'skills'              => ['nullable','array'],
            'skills.*.name'       => ['nullable','string','max:255'],
            'skills.*.percent'    => ['nullable','integer','min:0','max:100'],
        ]);

        $this->settings()->update(['skills' => $data['skills'] ?? []]);
        $this->clearCache();

        return response()->json(['message' => 'Skills Saved Successfully..!!']);
    }

    public function philosophy(Request $request)
    {
        $data = $request->validate([
            'philosophy'   => ['nullable','array'],
            'philosophy.*' => ['nullable','string','max:255'],
        ]);

        $this->settings()->update(['philosophy' => $data['philosophy'] ?? []]);
        $this->clearCache();

        return response()->json(['message' => 'Philosophy Saved Successfully..!!']);
    }

    public function passions(Request $request)
    {
        $data = $request->validate([
            'passions'            => ['nullable','array'],
            'passions.*.title'    => ['nullable','string','max:255'],
            'passions.*.desc'     => ['nullable','string','max:255'],
        ]);

        $this->settings()->update(['passions' => $data['passions'] ?? []]);
        $this->clearCache();

        return response()->json(['message' => 'Passions Saved Successfully..!!']);
    }

    public function footer(Request $request)
    {
        $data = $request->validate([
            'footer.brand_first' => ['nullable','string','max:50'],
            'footer.brand_last' => ['nullable','string','max:50'],
            'footer.tagline' => ['nullable','string','max:255'],
            'footer.availability' => ['nullable','string','max:255'],
            'footer.stack_text' => ['nullable','string','max:255'],
            'footer.build' => ['nullable','string','max:50'],
            'footer.system_status' => ['nullable','string','max:120'],
            'footer.copyright_name' => ['nullable','string','max:120'],
        ]);

        $this->settings()->update(['footer' => $data['footer'] ?? []]);
        $this->clearCache();
        return response()->json(['message' => 'Footer Updated Successfully..!!']);
    }
}
