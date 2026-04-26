<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:80'],
            'mobile'  => ['required', 'string', 'max:20'],
            'email'   => ['required', 'email', 'max:120'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $contact = Contact::create([
            'name'    => $data['name'],
            'mobile'  => $data['mobile'],
            'email'   => $data['email'],
            'message' => $data['message'],
            'status'  => Contact::STATUS_NEW,
        ]);

        Mail::to(config('mail.contact_to'))->queue(new ContactMail($contact));

        return response()->json([
            'success' => true,
            'message' => 'Thanks! I will contact you within 24 hours.',
        ]);
    }
}