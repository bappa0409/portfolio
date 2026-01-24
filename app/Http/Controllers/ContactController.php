<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:120'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        // Set your receiving email in .env as CONTACT_TO_EMAIL
        $to = config('mail.contact_to');

        if ($to) {
            Mail::to($to)->send(new ContactMail($data));
        }

        return back()->with('success', 'Thanks! I will contact you within 24 hours.');
    }
}
