<?php

namespace App\Http\Controllers;

use App\Facades\SEO;
use App\Models\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function index(Request $request)
    {
        $company_id = $request->company_id;

        // SEO
        SEO::setTitle('Получить доступ к управлению профилем - Сказокнет')
            ->setDescription('Подайте заявку на получение доступа к управлению профилем вашей компании на платформе Сказокнет.')
            ->setKeywords('получить доступ, управление профилем, застройщик, сказокнет')
            ->setCanonicalUrl(request()->url());

        return view('pages.gaining-access', compact('company_id'));
    }

    public function store(Request $request)
    {
        try {
            Access::create([
                'company_id' => $request->company_id,
                'company_name' => $request->company_name,
                'company_code' => $request->company_code,
                'email' => $request->email,
            ]);

            // SEO
            SEO::setTitle('Заявка отправлена - Сказокнет')
                ->setDescription('Ваша заявка на получение доступа успешно отправлена. Мы рассмотрим её в ближайшее время.')
                ->setKeywords('заявка отправлена, доступ, управление профилем');

            return view('pages.gaining-access-completed');
        } catch (\Exception $e) {
            return redirect('500');
        }
    }
}
