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

    public function update(Request $request)
    {
        $settings = HomePageSetting::current();

        $request->validate([
            // SECTION META
            'sections_meta' => ['nullable','array'],

            'sections_meta.services.title' => ['nullable','string','max:255'],
            'sections_meta.services.subtitle' => ['nullable','string','max:255'],

            'sections_meta.why_choose.title' => ['nullable','string','max:255'],
            'sections_meta.why_choose.subtitle' => ['nullable','string','max:255'],

            'sections_meta.process.title' => ['nullable','string','max:255'],
            'sections_meta.process.subtitle' => ['nullable','string','max:255'],

            'sections_meta.tech_stack.title' => ['nullable','string','max:255'],
            'sections_meta.tech_stack.subtitle' => ['nullable','string','max:255'],

            'sections_meta.testimonials.title' => ['nullable','string','max:255'],
            'sections_meta.testimonials.subtitle' => ['nullable','string','max:255'],

            'sections_meta.faq.title' => ['nullable','string','max:255'],
            'sections_meta.faq.subtitle' => ['nullable','string','max:255'],

            'sections_meta.featured_projects.title' => ['nullable','string','max:255'],
            'sections_meta.featured_projects.button_text' => ['nullable','string','max:50'],

            // HERO
            'hero.kicker' => ['nullable','string','max:255'],
            'hero.headline' => ['nullable','string','max:255'],
            'hero.description' => ['nullable','string'],
            'hero.activate_title' => ['nullable','string','max:255'],
            'hero.activate_subtitle' => ['nullable','string','max:255'],

            'hero.status.label' => ['nullable','string','max:50'],
            'hero.status.value' => ['nullable','string','max:50'],
            'hero.status.badge' => ['nullable','string','max:50'],

            'hero.tags' => ['nullable','array'],
            'hero.tags.*' => ['nullable','string','max:50'],

            'hero.buttons' => ['nullable','array'],
            'hero.buttons.*.text' => ['nullable','string','max:50'],
            'hero.buttons.*.url' => ['nullable','string','max:255'],

            'hero.mini_stats' => ['nullable','array'],
            'hero.mini_stats.*.value' => ['nullable','string','max:20'],
            'hero.mini_stats.*.label' => ['nullable','string','max:50'],

            'hero_profile_image' => ['nullable','image','max:2048'],

            // SERVICES
            'services' => ['nullable','array'],
            'services.*.icon' => ['nullable','string','max:10'],
            'services.*.title' => ['nullable','string','max:255'],
            'services.*.desc' => ['nullable','string'],

            // CTA TOP
            'cta_top.title' => ['nullable','string','max:255'],
            'cta_top.subtitle' => ['nullable','string'],
            'cta_top.button_text' => ['nullable','string','max:50'],
            'cta_top.button_url' => ['nullable','string','max:255'],

            // WHY
            'why_choose_me' => ['nullable','array'],
            'why_choose_me.*.icon' => ['nullable','string','max:10'],
            'why_choose_me.*.title' => ['nullable','string','max:255'],
            'why_choose_me.*.desc' => ['nullable','string'],

            // PROCESS
            'process' => ['nullable','array'],
            'process.*.step' => ['nullable','string','max:10'],
            'process.*.title' => ['nullable','string','max:255'],
            'process.*.desc' => ['nullable','string'],

            // TECH STACK (ARRAY INPUTS from admin page)
            'tech_stack' => ['nullable','array'],

            'tech_stack.backend' => ['nullable','array'],
            'tech_stack.backend.*' => ['nullable','string','max:80'],

            'tech_stack.frontend' => ['nullable','array'],
            'tech_stack.frontend.*' => ['nullable','string','max:80'],

            'tech_stack.wordpress' => ['nullable','array'],
            'tech_stack.wordpress.*' => ['nullable','string','max:80'],

            'tech_stack.tools' => ['nullable','array'],
            'tech_stack.tools.*' => ['nullable','string','max:80'],

            'tech_stack.sqa' => ['nullable','array'],
            'tech_stack.sqa.*' => ['nullable','string','max:80'],

            // STATS
            'stats' => ['nullable','array'],
            'stats.*.value' => ['nullable','numeric','min:0'],
            'stats.*.suffix' => ['nullable','string','max:5'],
            'stats.*.label' => ['nullable','string','max:255'],

            // TESTIMONIALS
            'testimonials' => ['nullable','array'],
            'testimonials.*.text' => ['nullable','string'],
            'testimonials.*.name' => ['nullable','string','max:80'],
            'testimonials.*.role' => ['nullable','string','max:80'],

            // FAQ
            'faq' => ['nullable','array'],
            'faq.*.q' => ['nullable','string','max:255'],
            'faq.*.a' => ['nullable','string'],

            // CTA BOTTOM
            'cta_bottom.title' => ['nullable','string','max:255'],
            'cta_bottom.subtitle' => ['nullable','string'],
            'cta_bottom.button_text' => ['nullable','string','max:50'],
            'cta_bottom.button_url' => ['nullable','string','max:255'],

            // FEATURED PROJECTS CONFIG
            'featured_projects.title' => ['nullable','string','max:255'],
            'featured_projects.button_text' => ['nullable','string','max:50'],
            'featured_projects.limit' => ['nullable','integer','min:1','max:24'],
        ]);

        // HERO
        $hero = $request->input('hero', $settings->hero ?? []);

        // Clean empty hero tags/buttons/ministats (optional but good)
        $hero['tags'] = array_values(array_filter($hero['tags'] ?? [], fn($v) => is_string($v) && trim($v) !== ''));
        $hero['buttons'] = array_values(array_filter($hero['buttons'] ?? [], function($b){
            $text = trim((string)($b['text'] ?? ''));
            $url  = trim((string)($b['url'] ?? ''));
            return $text !== '' || $url !== '';
        }));
        $hero['mini_stats'] = array_values(array_filter($hero['mini_stats'] ?? [], function($m){
            $v = trim((string)($m['value'] ?? ''));
            $l = trim((string)($m['label'] ?? ''));
            return $v !== '' || $l !== '';
        }));

        if ($request->hasFile('hero_profile_image')) {
            $path = $request->file('hero_profile_image')->store('homepage', 'public');

            $old = data_get($hero, 'profile_image');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }

            $hero['profile_image'] = $path;
        }

        // TECH STACK (array input)
        $ts = $request->input('tech_stack', []);
        $cleanList = fn($arr) => array_values(array_filter((array)$arr, fn($v) => is_string($v) && trim($v) !== ''));

        $techStack = [
            'backend'   => $cleanList($ts['backend'] ?? []),
            'frontend'  => $cleanList($ts['frontend'] ?? []),
            'wordpress' => $cleanList($ts['wordpress'] ?? []),
            'tools'     => $cleanList($ts['tools'] ?? []),
            'sqa'       => $cleanList($ts['sqa'] ?? []),
        ];

        // SECTIONS META (new)
        $sectionsMeta = $request->input('sections_meta', $settings->sections_meta ?? []);

        // SAVE fixed sections
        $settings->sections_meta     = $sectionsMeta; // NEW
        $settings->hero              = $hero;
        $settings->services          = $request->input('services', []);
        $settings->cta_top           = $request->input('cta_top', []);
        $settings->featured_projects = $request->input('featured_projects', []);
        $settings->why_choose_me     = $request->input('why_choose_me', []);
        $settings->process           = $request->input('process', []);
        $settings->tech_stack        = $techStack;
        $settings->stats             = $request->input('stats', []);
        $settings->cta_bottom        = $request->input('cta_bottom', []);
        $settings->testimonials      = $request->input('testimonials', []);
        $settings->faq               = $request->input('faq', []);

        $settings->save();

        return back()->with('success', 'HOMEPAGE_SETTINGS_UPDATED');
    }
}
