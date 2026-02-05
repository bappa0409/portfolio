<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageSettingsController extends Controller
{
    public function edit()
    {
        $settings = HomePageSetting::firstOrFail();
        return view('backend.pages.home_page_settings.edit', compact('settings'));
    }

    // public function update(Request $request)
    // {
    //     $settings = HomePageSetting::current();

    //     $request->validate([
    //         // SECTION META
    //         'sections_meta' => ['nullable','array'],

    //         'sections_meta.services.title' => ['nullable','string','max:255'],
    //         'sections_meta.services.subtitle' => ['nullable','string','max:255'],

    //         'sections_meta.why_choose.title' => ['nullable','string','max:255'],
    //         'sections_meta.why_choose.subtitle' => ['nullable','string','max:255'],

    //         'sections_meta.process.title' => ['nullable','string','max:255'],
    //         'sections_meta.process.subtitle' => ['nullable','string','max:255'],

    //         'sections_meta.tech_stack.title' => ['nullable','string','max:255'],
    //         'sections_meta.tech_stack.subtitle' => ['nullable','string','max:255'],

    //         'sections_meta.testimonials.title' => ['nullable','string','max:255'],
    //         'sections_meta.testimonials.subtitle' => ['nullable','string','max:255'],

    //         'sections_meta.faq.title' => ['nullable','string','max:255'],
    //         'sections_meta.faq.subtitle' => ['nullable','string','max:255'],

    //         'sections_meta.featured_projects.title' => ['nullable','string','max:255'],
    //         'sections_meta.featured_projects.button_text' => ['nullable','string','max:50'],

    //         // HERO
    //         'hero.kicker' => ['nullable','string','max:255'],
    //         'hero.headline' => ['nullable','string','max:255'],
    //         'hero.description' => ['nullable','string'],
    //         'hero.activate_title' => ['nullable','string','max:255'],
    //         'hero.activate_subtitle' => ['nullable','string','max:255'],

    //         'hero.status.label' => ['nullable','string','max:50'],
    //         'hero.status.value' => ['nullable','string','max:50'],
    //         'hero.status.badge' => ['nullable','string','max:50'],

    //         'hero.tags' => ['nullable','array'],
    //         'hero.tags.*' => ['nullable','string','max:50'],

    //         'hero.buttons' => ['nullable','array'],
    //         'hero.buttons.*.text' => ['nullable','string','max:50'],
    //         'hero.buttons.*.url' => ['nullable','string','max:255'],

    //         'hero.mini_stats' => ['nullable','array'],
    //         'hero.mini_stats.*.value' => ['nullable','string','max:20'],
    //         'hero.mini_stats.*.label' => ['nullable','string','max:50'],

    //         'hero_profile_image' => ['nullable','image','max:2048'],

    //         // SERVICES
    //         'services' => ['nullable','array'],
    //         'services.*.icon' => ['nullable','string','max:10'],
    //         'services.*.title' => ['nullable','string','max:255'],
    //         'services.*.desc' => ['nullable','string'],

    //         // CTA TOP
    //         'cta_top.title' => ['nullable','string','max:255'],
    //         'cta_top.subtitle' => ['nullable','string'],
    //         'cta_top.button_text' => ['nullable','string','max:50'],
    //         'cta_top.button_url' => ['nullable','string','max:255'],

    //         // WHY
    //         'why_choose_me' => ['nullable','array'],
    //         'why_choose_me.*.icon' => ['nullable','string','max:10'],
    //         'why_choose_me.*.title' => ['nullable','string','max:255'],
    //         'why_choose_me.*.desc' => ['nullable','string'],

    //         // PROCESS
    //         'process' => ['nullable','array'],
    //         'process.*.step' => ['nullable','string','max:10'],
    //         'process.*.title' => ['nullable','string','max:255'],
    //         'process.*.desc' => ['nullable','string'],

    //         // TECH STACK (ARRAY INPUTS from admin page)
    //         'tech_stack' => ['nullable','array'],

    //         'tech_stack.backend' => ['nullable','array'],
    //         'tech_stack.backend.*' => ['nullable','string','max:80'],

    //         'tech_stack.frontend' => ['nullable','array'],
    //         'tech_stack.frontend.*' => ['nullable','string','max:80'],

    //         'tech_stack.wordpress' => ['nullable','array'],
    //         'tech_stack.wordpress.*' => ['nullable','string','max:80'],

    //         'tech_stack.tools' => ['nullable','array'],
    //         'tech_stack.tools.*' => ['nullable','string','max:80'],

    //         'tech_stack.sqa' => ['nullable','array'],
    //         'tech_stack.sqa.*' => ['nullable','string','max:80'],

    //         // STATS
    //         'stats' => ['nullable','array'],
    //         'stats.*.value' => ['nullable','numeric','min:0'],
    //         'stats.*.suffix' => ['nullable','string','max:5'],
    //         'stats.*.label' => ['nullable','string','max:255'],

    //         // TESTIMONIALS
    //         'testimonials' => ['nullable','array'],
    //         'testimonials.*.text' => ['nullable','string'],
    //         'testimonials.*.name' => ['nullable','string','max:80'],
    //         'testimonials.*.role' => ['nullable','string','max:80'],

    //         // FAQ
    //         'faq' => ['nullable','array'],
    //         'faq.*.q' => ['nullable','string','max:255'],
    //         'faq.*.a' => ['nullable','string'],

    //         // CTA BOTTOM
    //         'cta_bottom.title' => ['nullable','string','max:255'],
    //         'cta_bottom.subtitle' => ['nullable','string'],
    //         'cta_bottom.button_text' => ['nullable','string','max:50'],
    //         'cta_bottom.button_url' => ['nullable','string','max:255'],

    //         // FEATURED PROJECTS CONFIG
    //         'featured_projects.title' => ['nullable','string','max:255'],
    //         'featured_projects.button_text' => ['nullable','string','max:50'],
    //         'featured_projects.limit' => ['nullable','integer','min:1','max:24'],
    //     ]);

    //     // HERO
    //     $hero = $request->input('hero', $settings->hero ?? []);

    //     // Clean empty hero tags/buttons/ministats (optional but good)
    //     $hero['tags'] = array_values(array_filter($hero['tags'] ?? [], fn($v) => is_string($v) && trim($v) !== ''));
    //     $hero['buttons'] = array_values(array_filter($hero['buttons'] ?? [], function($b){
    //         $text = trim((string)($b['text'] ?? ''));
    //         $url  = trim((string)($b['url'] ?? ''));
    //         return $text !== '' || $url !== '';
    //     }));
    //     $hero['mini_stats'] = array_values(array_filter($hero['mini_stats'] ?? [], function($m){
    //         $v = trim((string)($m['value'] ?? ''));
    //         $l = trim((string)($m['label'] ?? ''));
    //         return $v !== '' || $l !== '';
    //     }));

    //     if ($request->hasFile('hero_profile_image')) {
    //         $path = $request->file('hero_profile_image')->store('homepage', 'public');

    //         $old = data_get($hero, 'profile_image');
    //         if ($old && Storage::disk('public')->exists($old)) {
    //             Storage::disk('public')->delete($old);
    //         }

    //         $hero['profile_image'] = $path;
    //     }

    //     // TECH STACK (array input)
    //     $ts = $request->input('tech_stack', []);
    //     $cleanList = fn($arr) => array_values(array_filter((array)$arr, fn($v) => is_string($v) && trim($v) !== ''));

    //     $techStack = [
    //         'backend'   => $cleanList($ts['backend'] ?? []),
    //         'frontend'  => $cleanList($ts['frontend'] ?? []),
    //         'wordpress' => $cleanList($ts['wordpress'] ?? []),
    //         'tools'     => $cleanList($ts['tools'] ?? []),
    //         'sqa'       => $cleanList($ts['sqa'] ?? []),
    //     ];

    //     // SECTIONS META (new)
    //     $sectionsMeta = $request->input('sections_meta', $settings->sections_meta ?? []);

    //     // SAVE fixed sections
    //     $settings->sections_meta     = $sectionsMeta; // NEW
    //     $settings->hero              = $hero;
    //     $settings->services          = $request->input('services', []);
    //     $settings->cta_top           = $request->input('cta_top', []);
    //     $settings->featured_projects = $request->input('featured_projects', []);
    //     $settings->why_choose_me     = $request->input('why_choose_me', []);
    //     $settings->process           = $request->input('process', []);
    //     $settings->tech_stack        = $techStack;
    //     $settings->stats             = $request->input('stats', []);
    //     $settings->cta_bottom        = $request->input('cta_bottom', []);
    //     $settings->testimonials      = $request->input('testimonials', []);
    //     $settings->faq               = $request->input('faq', []);

    //     $settings->save();

    //     return back()->with('success', 'HOMEPAGE_SETTINGS_UPDATED');
    // }

    public function updateSectionMeta(Request $request)
    {
        $validated = $request->validate([
            'sections_meta' => ['nullable','array'],

            'sections_meta.services.title' => ['nullable','string','max:120'],
            'sections_meta.services.subtitle' => ['nullable','string','max:255'],

            'sections_meta.why_choose.title' => ['nullable','string','max:120'],
            'sections_meta.why_choose.subtitle' => ['nullable','string','max:255'],

            'sections_meta.process.title' => ['nullable','string','max:120'],
            'sections_meta.process.subtitle' => ['nullable','string','max:255'],

            'sections_meta.tech_stack.title' => ['nullable','string','max:120'],
            'sections_meta.tech_stack.subtitle' => ['nullable','string','max:255'],

            'sections_meta.testimonials.title' => ['nullable','string','max:120'],
            'sections_meta.testimonials.subtitle' => ['nullable','string','max:255'],

            'sections_meta.faq.title' => ['nullable','string','max:120'],
            'sections_meta.faq.subtitle' => ['nullable','string','max:255'],

            'sections_meta.featured_projects.title' => ['nullable','string','max:120'],
            'sections_meta.featured_projects.button_text' => ['nullable','string','max:80'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);

        $existing = (array) ($settings->sections_meta ?? []);
        $merged = array_replace_recursive($existing, $validated['sections_meta'] ?? []);

        $settings->update(['sections_meta' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'Section meta updated successfully.',
            'sections_meta' => $merged,
        ]);
    }

    public function updateHero(Request $request)
    {
        $validated = $request->validate([
            'hero.kicker' => ['nullable','string','max:255'],
            'hero.headline' => ['nullable','string','max:255'],
            'hero.description' => ['nullable','string','max:2000'],

            'hero.activate_title' => ['nullable','string','max:255'],
            'hero.activate_subtitle' => ['nullable','string','max:255'],

            'hero.status.label' => ['nullable','string','max:100'],
            'hero.status.value' => ['nullable','string','max:100'],
            'hero.status.badge' => ['nullable','string','max:50'],

            // buttons: ONLY TEXT (no url)
            'hero.buttons' => ['nullable','array','max:10'],
            'hero.buttons.0.text' => ['required','string','max:50'],
            'hero.buttons.*.text' => ['nullable','string','max:50'],

            'hero.tags' => ['nullable','array','max:20'],
            'hero.tags.*' => ['nullable','string','max:30'],

            'hero.mini_stats' => ['nullable','array','max:10'],
            'hero.mini_stats.*.value' => ['nullable','string','max:30'],
            'hero.mini_stats.*.label' => ['nullable','string','max:50'],

            'hero_profile_image' => ['nullable','image','max:4096'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);

        $heroExisting = (array) ($settings->hero ?? []);
        $heroNew = array_replace_recursive($heroExisting, $validated['hero'] ?? []);

        // ✅ fixed buttons: keep existing length/order, update only text
        $existingButtons = (array) data_get($heroExisting, 'buttons', []);
        $incomingButtons = (array) data_get($validated, 'hero.buttons', []);

        $finalButtons = [];
        foreach ($existingButtons as $i => $btn) {
            $finalButtons[] = [
                'text' => trim((string) data_get($incomingButtons, "{$i}.text", data_get($btn, 'text', ''))),
            ];
        }
        $heroNew['buttons'] = $finalButtons;

        // ✅ Image upload
        if ($request->hasFile('hero_profile_image')) {
            if (!empty($heroExisting['profile_image'])) {
                Storage::disk('public')->delete($heroExisting['profile_image']);
            }
            $path = $request->file('hero_profile_image')->store('homepage', 'public');
            $heroNew['profile_image'] = $path;
        }

        $settings->update(['hero' => $heroNew]);

        return response()->json([
            'ok' => true,
            'message' => 'Hero updated successfully.',
            'hero' => $heroNew,
        ]);
    }

    public function updateServices(Request $request)
    {
        $validated = $request->validate([
            'services' => ['nullable','array','max:30'],
            'services.*.icon' => ['nullable','string','max:10'],
            'services.*.title' => ['required','string','max:100'],
            'services.*.desc' => ['nullable','string','max:500'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);
        $settings->update(['services' => $validated['services'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Services updated successfully.',
            'services' => $settings->services,
        ]);
    }

    public function updateFeaturedProjects(Request $request)
    {
        $validated = $request->validate([
            'featured_projects.title' => ['nullable','string','max:120'],
            'featured_projects.limit' => ['nullable','integer','min:1','max:24'],
            'featured_projects.button_text' => ['nullable','string','max:80'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);

        $existing = (array) ($settings->featured_projects ?? []);
        $merged = array_replace_recursive($existing, $validated['featured_projects'] ?? []);

        $settings->update(['featured_projects' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'Featured projects updated successfully.',
            'featured_projects' => $merged,
        ]);
    }

    public function updateCtaTop(Request $request)
    {
        $validated = $request->validate([
            'cta_top.title' => ['nullable','string','max:160'],
            'cta_top.subtitle' => ['nullable','string','max:500'],
            'cta_top.button_text' => ['nullable','string','max:80'],
            'cta_top.button_url' => ['nullable','string','max:255'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);

        $existing = (array) ($settings->cta_top ?? []);
        $merged = array_replace_recursive($existing, $validated['cta_top'] ?? []);

        $settings->update(['cta_top' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'CTA Top updated successfully.',
            'cta_top' => $merged,
        ]);
    }

    public function updateWhyChoose(Request $request)
    {
        $validated = $request->validate([
            'why_choose_me' => ['nullable','array','max:30'],
            'why_choose_me.*.icon' => ['nullable','string','max:10'],
            'why_choose_me.*.title' => ['required','string','max:120'],
            'why_choose_me.*.desc' => ['nullable','string','max:600'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);
        $settings->update(['why_choose_me' => $validated['why_choose_me'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Why choose updated successfully.',
            'why_choose_me' => $settings->why_choose_me,
        ]);
    }

    public function updateProcess(Request $request)
    {
        $validated = $request->validate([
            'process' => ['nullable','array','max:30'],
            'process.*.step' => ['required','string','max:10'], // আপনি numeric চাইলে integer দিয়ে দিতে পারেন
            'process.*.title' => ['required','string','max:120'],
            'process.*.desc' => ['nullable','string','max:600'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);
        $settings->update(['process' => $validated['process'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Process updated successfully.',
            'process' => $settings->process,
        ]);
    }

    public function updateTechStack(Request $request)
    {
        $validated = $request->validate([
            'tech_stack' => ['nullable','array'],

            'tech_stack.backend' => ['nullable','array','max:50'],
            'tech_stack.backend.*' => ['nullable','string','max:50'],

            'tech_stack.frontend' => ['nullable','array','max:50'],
            'tech_stack.frontend.*' => ['nullable','string','max:50'],

            'tech_stack.wordpress' => ['nullable','array','max:50'],
            'tech_stack.wordpress.*' => ['nullable','string','max:50'],

            'tech_stack.tools' => ['nullable','array','max:50'],
            'tech_stack.tools.*' => ['nullable','string','max:50'],

            'tech_stack.sqa' => ['nullable','array','max:50'],
            'tech_stack.sqa.*' => ['nullable','string','max:50'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);

        $existing = (array) ($settings->tech_stack ?? []);
        $merged = array_replace_recursive($existing, $validated['tech_stack'] ?? []);

        // clean empty values (optional but recommended)
        foreach (['backend','frontend','wordpress','tools','sqa'] as $k) {
            if (isset($merged[$k]) && is_array($merged[$k])) {
                $merged[$k] = array_values(array_filter($merged[$k], fn($v) => is_string($v) && trim($v) !== ''));
            }
        }

        $settings->update(['tech_stack' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'Tech stack updated successfully.',
            'tech_stack' => $merged,
        ]);
    }

    public function updateStats(Request $request)
    {
        $validated = $request->validate([
            'stats' => ['nullable','array','max:20'],
            'stats.*.value' => ['required','numeric','min:0'],
            'stats.*.suffix' => ['nullable','string','max:10'],
            'stats.*.label' => ['required','string','max:120'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);
        $settings->update(['stats' => $validated['stats'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Stats updated successfully.',
            'stats' => $settings->stats,
        ]);
    }

    public function updateCtaBottom(Request $request)
    {
        $validated = $request->validate([
            'cta_bottom.title' => ['nullable','string','max:160'],
            'cta_bottom.subtitle' => ['nullable','string','max:500'],
            'cta_bottom.button_text' => ['nullable','string','max:80'],
            'cta_bottom.button_url' => ['nullable','string','max:255'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);

        $existing = (array) ($settings->cta_bottom ?? []);
        $merged = array_replace_recursive($existing, $validated['cta_bottom'] ?? []);

        $settings->update(['cta_bottom' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'CTA Bottom updated successfully.',
            'cta_bottom' => $merged,
        ]);
    }

    public function updateTestimonials(Request $request)
    {
        $validated = $request->validate([
            'testimonials' => ['nullable','array','max:30'],
            'testimonials.*.text' => ['required','string','max:1200'],
            'testimonials.*.name' => ['required','string','max:120'],
            'testimonials.*.role' => ['nullable','string','max:120'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);
        $settings->update(['testimonials' => $validated['testimonials'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Testimonials updated successfully.',
            'testimonials' => $settings->testimonials,
        ]);
    }

    public function updateFaq(Request $request)
    {
        $validated = $request->validate([
            'faq' => ['nullable','array','max:50'],
            'faq.*.q' => ['required','string','max:180'],
            'faq.*.a' => ['required','string','max:1200'],
        ]);

        $settings = HomepageSetting::firstOrCreate([]);
        $settings->update(['faq' => $validated['faq'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'FAQ updated successfully.',
            'faq' => $settings->faq,
        ]);
    }
}
