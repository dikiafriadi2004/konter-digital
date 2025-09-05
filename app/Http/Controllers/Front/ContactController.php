<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact.index');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'full-name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        // Kirim email (contoh sederhana)
        Mail::raw($data['message'], function ($msg) use ($data) {
            $msg->to('pt.mudk@gmail.com')
                ->subject('Pesan Baru dari Contact Form')
                ->replyTo($data['email'], $data['full-name']);
        });

        return redirect()->route('contact.index')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
