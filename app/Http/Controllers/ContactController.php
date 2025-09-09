<?php

namespace App\Http\Controllers;

use App\Facades\SEO;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // SEO
        SEO::setTitle('Связаться с нами - Сказокнет')
            ->setDescription('Свяжитесь с командой Сказокнет. Мы готовы ответить на ваши вопросы о платформе отзывов о недвижимости.')
            ->setKeywords('связаться с нами, контакты, сказокнет, поддержка')
            ->setCanonicalUrl(request()->url());

        return view('pages.contact');
    }

    public function store(Request $request)
    {
        try {
            Contact::create([
                'user_id' => $request->user_id,
                'email' => $request->email,
                'name' => $request->name,
                'note' => $request->note,
            ]);

            // SEO
            SEO::setTitle('Сообщение отправлено - Сказокнет')
                ->setDescription('Ваше сообщение успешно отправлено. Мы свяжемся с вами в ближайшее время.')
                ->setKeywords('сообщение отправлено, контакт, сказокнет');

            return view('pages.contact-completed');
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }
}