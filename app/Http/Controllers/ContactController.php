<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $messages = [
            'name.required' => 'Who are you?',
            'email.required' => 'We\'ll need your email address.',
            'email.email' => 'Please double-check your email - that doesn\'t look right.',
            'message.required' => 'How can we help you?',
        ];
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ], $messages);

        $address = env('CONTACT_FORM_TO', 'example@example.com');
        Mail::to($address)->queue(new ContactFormMail($validatedData));

        return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you soon.');
    }
}
