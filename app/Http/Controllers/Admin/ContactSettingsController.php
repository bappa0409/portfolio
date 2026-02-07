<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactSettingsController extends Controller
{
   public function edit()
    {
        $settings = ContactSetting::firstOrCreate(['id' => 1]);
        return view('backend.pages.contact', compact('settings'));
    }

    private function settings(): ContactSetting
    {
        return ContactSetting::firstOrCreate(['id' => 1]);
    }

    private function clearCache(): void
    {
        Cache::forget('contact_settings');
    }

    private function mergeAndUpdate(ContactSetting $settings, string $key, array $incoming): array
    {
        $existing = (array) ($settings->{$key} ?? []);
        $merged   = array_replace_recursive($existing, $incoming);

        $settings->update([$key => $merged]);

        return $merged;
    }

    public function updatePageMeta(Request $request)
    {
        $validated = $request->validate([
            'page_meta.kicker'  => ['nullable','string','max:80'],
            'page_meta.heading' => ['nullable','string','max:120'],
        ]);

        $settings = $this->settings();
          $this->clearCache();
        $merged = $this->mergeAndUpdate($settings, 'page_meta', (array) ($validated['page_meta'] ?? []));

        return response()->json(['ok'=>true,'message'=>'Page meta updated.','page_meta'=>$merged]);
    }

    public function updateContactCards(Request $request)
    {
        $validated = $request->validate([
            'contact_cards.email'    => ['nullable','email','max:120'],
            'contact_cards.phone'    => ['nullable','string','max:40'],
            'contact_cards.location' => ['nullable','string','max:120'],
            'contact_cards.timezone' => ['nullable','string','max:40'],
        ]);

        $settings = $this->settings();
          $this->clearCache();
        $merged = $this->mergeAndUpdate($settings, 'contact_cards', (array) ($validated['contact_cards'] ?? []));

        return response()->json(['ok'=>true,'message'=>'Contact cards updated.','contact_cards'=>$merged]);
    }

    public function updateSocialLinks(Request $request)
    {
        $validated = $request->validate([
            'social_links.linkedin' => ['nullable','url','max:255'],
            'social_links.facebook' => ['nullable','url','max:255'],
            'social_links.whatsapp' => ['nullable','url','max:255'],
            'social_links.telegram' => ['nullable','url','max:255'],
        ]);

        $settings = $this->settings();
          $this->clearCache();
        $merged = $this->mergeAndUpdate($settings, 'social_links', (array) ($validated['social_links'] ?? []));

        return response()->json(['ok'=>true,'message'=>'Social links updated.','social_links'=>$merged]);
    }
}
