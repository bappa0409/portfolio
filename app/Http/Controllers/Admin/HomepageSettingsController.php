<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageSettingsController extends Controller
{
   /* ============================================================
     | HOMEPAGE SETTINGS CONTROLLER
     | ------------------------------------------------------------
     | Admin panel: Homepage section-wise content management.
     | This controller is designed for AJAX (multipart/form-data)
     | section-wise updates to avoid full page refresh.
     | ------------------------------------------------------------
     | Sections:
     | - Section Meta
     | - Hero (with profile image upload)
     | - Services
     | - Featured Projects
     | - CTA 1 / CTA 2
     | - Why Choose
     | - Process
     | - Tech Stack
     | - Stats
     | - Testimonials
     | - FAQ
     * ============================================================ */

    /* ------------------------------------------------------------
     | EDIT PAGE
     | ------------------------------------------------------------
     | Renders the settings editor page.
     | Ensures a single row exists in DB (firstOrCreate).
     * ------------------------------------------------------------ */
    public function edit()
    {
        $settings = HomePageSetting::firstOrCreate(['id' => 1]);
        return view('backend.pages.home_page', compact('settings'));
    }


    /* ============================================================
     | SECTION META
     | ------------------------------------------------------------
     | Controls headings/subheadings for fixed sections
     * ============================================================ */
    public function updateSectionMeta(Request $request)
    {
        $validated = $request->validate([
            'sections_meta' => ['nullable', 'array'],

            'sections_meta.services.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.services.subtitle' => ['nullable', 'string', 'max:255'],

            'sections_meta.why_choose.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.why_choose.subtitle' => ['nullable', 'string', 'max:255'],

            'sections_meta.process.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.process.subtitle' => ['nullable', 'string', 'max:255'],

            'sections_meta.tech_stack.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.tech_stack.subtitle' => ['nullable', 'string', 'max:255'],

            'sections_meta.testimonials.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.testimonials.subtitle' => ['nullable', 'string', 'max:255'],

            'sections_meta.faq.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.faq.subtitle' => ['nullable', 'string', 'max:255'],

            'sections_meta.projects.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.projects.subtitle' => ['nullable', 'string', 'max:255'],

            'sections_meta.featured_projects.title' => ['nullable', 'string', 'max:120'],
            'sections_meta.featured_projects.button_text' => ['nullable', 'string', 'max:80'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);

        $existing = (array) ($settings->sections_meta ?? []);
        $incoming = (array) ($validated['sections_meta'] ?? []);

        $merged = array_replace_recursive($existing, $incoming);

        $settings->update(['sections_meta' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'Section meta updated successfully.',
            'sections_meta' => $merged,
        ]);
    }

    /* ============================================================
     | HERO
     | ------------------------------------------------------------
     | Updates hero content + uploads profile image.
     | Important:
     | - Accepts multipart/form-data
     | - Buttons: only text (no url). Keeps existing order/length.
     * ============================================================ */

    public function updateHero(Request $request)
    {
        $validated = $request->validate([
            'hero.kicker' => ['nullable', 'string', 'max:255'],
            'hero.headline' => ['nullable', 'string', 'max:255'],
            'hero.description' => ['nullable', 'string', 'max:2000'],

            'hero.activate_title' => ['nullable', 'string', 'max:255'],
            'hero.activate_subtitle' => ['nullable', 'string', 'max:255'],

            'hero.status.label' => ['nullable', 'string', 'max:100'],
            'hero.status.value' => ['nullable', 'string', 'max:100'],
            'hero.status.badge' => ['nullable', 'string', 'max:50'],

            'hero.buttons' => ['nullable', 'array', 'max:10'],
            'hero.buttons.0.text' => ['required', 'string', 'max:50'],
            'hero.buttons.*.text' => ['nullable', 'string', 'max:50'],

            'hero.tags' => ['nullable', 'array', 'max:20'],
            'hero.tags.*' => ['nullable', 'string', 'max:30'],

            'hero.mini_stats' => ['nullable', 'array', 'max:10'],
            'hero.mini_stats.*.value' => ['nullable', 'string', 'max:30'],
            'hero.mini_stats.*.label' => ['nullable', 'string', 'max:50'],

            'hero_profile_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);

        $heroExisting = (array) ($settings->hero ?? []);
        $heroIncoming = (array) ($validated['hero'] ?? []);

        // Merge base fields
        $heroNew = array_replace_recursive($heroExisting, $heroIncoming);

        /* ------------------------------------------------------------
        | Buttons Handling (Fixed Order / Fixed Count)
        * ------------------------------------------------------------ */
        $existingButtons = (array) data_get($heroExisting, 'buttons', []);
        $incomingButtons = (array) data_get($validated, 'hero.buttons', []);

        if (!empty($existingButtons)) {
            $finalButtons = [];
            foreach ($existingButtons as $i => $btn) {
                $finalButtons[] = [
                    'text' => trim((string) data_get($incomingButtons, "{$i}.text", data_get($btn, 'text', ''))),
                ];
            }
            $heroNew['buttons'] = $finalButtons;
        } else {
            $heroNew['buttons'] = array_values(array_map(function ($b) {
                return ['text' => trim((string) ($b['text'] ?? ''))];
            }, $incomingButtons));
        }

        if ($request->hasFile('hero_profile_image')) {
            $file = $request->file('hero_profile_image');
            $ext  = $file->getClientOriginalExtension();

            $fileName = "hero-profile.{$ext}";

            $heroNew['profile_image'] = upload_image(
                $file,
                dir: 'upload/images',
                disk: 'public',
                deleteOldPath: $heroExisting['profile_image'] ?? null,
                keepOriginalName: false,
                storeAsName: $fileName
            );
        }

        $settings->update(['hero' => $heroNew]);

        return response()->json([
            'ok' => true,
            'message' => 'Hero updated successfully.',
            'hero' => $heroNew,
            'profile_image_url' => file_url($heroNew['profile_image'] ?? null),
        ]);
    }


    /* ============================================================
     | SERVICES
     * ============================================================ */
    public function updateServices(Request $request)
    {
        $validated = $request->validate([
            'services' => ['nullable', 'array', 'max:30'],
            'services.*.icon' => ['nullable', 'string', 'max:10'],
            'services.*.title' => ['required', 'string', 'max:100'],
            'services.*.desc' => ['nullable', 'string', 'max:500'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);
        $settings->update(['services' => $validated['services'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Services updated successfully.',
            'services' => $settings->services,
        ]);
    }

    /* ============================================================
     | FEATURED PROJECTS
     * ============================================================ */
    public function updateFeaturedProjects(Request $request)
    {
        $validated = $request->validate([
            'featured_projects' => ['nullable', 'array'],
            'featured_projects.limit' => ['nullable', 'integer', 'min:1', 'max:24'],
            'featured_projects.button_text' => ['nullable', 'string', 'max:80'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);

        $existing = (array) ($settings->featured_projects ?? []);
        $incoming = (array) ($validated['featured_projects'] ?? []);

        $merged = array_replace_recursive($existing, $incoming);

        $settings->update(['featured_projects' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'Featured projects updated successfully.',
            'featured_projects' => $merged,
        ]);
    }

    /* ============================================================
     | CTA 1 (TOP)
     * ============================================================ */
    public function updateCta1(Request $request)
    {
        $validated = $request->validate([
            'cta_1.title' => ['nullable', 'string', 'max:160'],
            'cta_1.subtitle' => ['nullable', 'string', 'max:500'],
            'cta_1.button_text' => ['nullable', 'string', 'max:80'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);

        $existing = (array) ($settings->cta_1 ?? []);
        $incoming = (array) ($validated['cta_1'] ?? []);

        $merged = array_replace_recursive($existing, $incoming);

        $settings->update(['cta_1' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'CTA 1 updated successfully.',
            'cta_1' => $merged,
        ]);
    }

    /* ============================================================
     | WHY CHOOSE
     * ============================================================ */
    public function updateWhyChoose(Request $request)
    {
        $validated = $request->validate([
            'why_choose_me' => ['nullable', 'array', 'max:30'],
            'why_choose_me.*.icon' => ['nullable', 'string', 'max:10'],
            'why_choose_me.*.title' => ['required', 'string', 'max:120'],
            'why_choose_me.*.desc' => ['nullable', 'string', 'max:600'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);
        $settings->update(['why_choose_me' => $validated['why_choose_me'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Why choose updated successfully.',
            'why_choose_me' => $settings->why_choose_me,
        ]);
    }

    /* ============================================================
     | PROCESS
     * ============================================================ */
    public function updateProcess(Request $request)
    {
        $validated = $request->validate([
            'process' => ['nullable', 'array', 'max:30'],
            'process.*.step' => ['required', 'string', 'max:10'], // numeric only চাইলে integer rule দিতে পারো
            'process.*.title' => ['required', 'string', 'max:120'],
            'process.*.desc' => ['nullable', 'string', 'max:600'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);
        $settings->update(['process' => $validated['process'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Process updated successfully.',
            'process' => $settings->process,
        ]);
    }

    /* ============================================================
     | TECH STACK
     | ------------------------------------------------------------
     | Saves tags by category. Cleans empty values.
     * ============================================================ */
    public function updateTechStack(Request $request)
    {
        $validated = $request->validate([
            'tech_stack' => ['nullable', 'array'],

            'tech_stack.backend' => ['nullable', 'array', 'max:50'],
            'tech_stack.backend.*' => ['nullable', 'string', 'max:50'],

            'tech_stack.frontend' => ['nullable', 'array', 'max:50'],
            'tech_stack.frontend.*' => ['nullable', 'string', 'max:50'],

            'tech_stack.wordpress' => ['nullable', 'array', 'max:50'],
            'tech_stack.wordpress.*' => ['nullable', 'string', 'max:50'],

            'tech_stack.tools' => ['nullable', 'array', 'max:50'],
            'tech_stack.tools.*' => ['nullable', 'string', 'max:50'],

            'tech_stack.sqa' => ['nullable', 'array', 'max:50'],
            'tech_stack.sqa.*' => ['nullable', 'string', 'max:50'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);

        $existing = (array) ($settings->tech_stack ?? []);
        $incoming = (array) ($validated['tech_stack'] ?? []);

        $merged = array_replace_recursive($existing, $incoming);

        // Clean empty values + reindex arrays
        foreach (['backend', 'frontend', 'wordpress', 'tools', 'sqa'] as $k) {
            if (isset($merged[$k]) && is_array($merged[$k])) {
                $merged[$k] = array_values(array_filter($merged[$k], function ($v) {
                    return is_string($v) && trim($v) !== '';
                }));
            }
        }

        $settings->update(['tech_stack' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'Tech stack updated successfully.',
            'tech_stack' => $merged,
        ]);
    }

    /* ============================================================
     | STATS
     * ============================================================ */
    public function updateStats(Request $request)
    {
        $validated = $request->validate([
            'stats' => ['nullable', 'array', 'max:20'],
            'stats.*.value' => ['required', 'numeric', 'min:0'],
            'stats.*.suffix' => ['nullable', 'string', 'max:10'],
            'stats.*.label' => ['required', 'string', 'max:120'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);
        $settings->update(['stats' => $validated['stats'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Stats updated successfully.',
            'stats' => $settings->stats,
        ]);
    }

    /* ============================================================
     | CTA 2 (BOTTOM)
     * ============================================================ */
    public function updateCta2(Request $request)
    {
        $validated = $request->validate([
            'cta_2.title' => ['nullable', 'string', 'max:160'],
            'cta_2.subtitle' => ['nullable', 'string', 'max:500'],
            'cta_2.button_text_1' => ['nullable', 'string', 'max:80'],
            'cta_2.button_text_2' => ['nullable', 'string', 'max:80'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);

        $existing = (array) ($settings->cta_2 ?? []);
        $incoming = (array) ($validated['cta_2'] ?? []);

        $merged = array_replace_recursive($existing, $incoming);

        $settings->update(['cta_2' => $merged]);

        return response()->json([
            'ok' => true,
            'message' => 'CTA 2 Bottom updated successfully.',
            'cta_2' => $merged,
        ]);
    }

    /* ============================================================
     | TESTIMONIALS
     * ============================================================ */
    public function updateTestimonials(Request $request)
    {
        $validated = $request->validate([
            'testimonials' => ['nullable', 'array', 'max:30'],
            'testimonials.*.text' => ['required', 'string', 'max:1200'],
            'testimonials.*.name' => ['required', 'string', 'max:120'],
            'testimonials.*.role' => ['nullable', 'string', 'max:120'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);
        $settings->update(['testimonials' => $validated['testimonials'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'Testimonials updated successfully.',
            'testimonials' => $settings->testimonials,
        ]);
    }

    /* ============================================================
     | FAQ
     * ============================================================ */
    public function updateFaq(Request $request)
    {
        $validated = $request->validate([
            'faq' => ['nullable', 'array', 'max:50'],
            'faq.*.q' => ['required', 'string', 'max:180'],
            'faq.*.a' => ['required', 'string', 'max:1200'],
        ]);

        $settings = HomePageSetting::firstOrCreate(['id' => 1]);
        $settings->update(['faq' => $validated['faq'] ?? []]);

        return response()->json([
            'ok' => true,
            'message' => 'FAQ updated successfully.',
            'faq' => $settings->faq,
        ]);
    }
}
