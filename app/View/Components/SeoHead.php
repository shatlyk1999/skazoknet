<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SeoHead extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('components.seo-head', [
            'seoService' => app('seo')
        ]);
    }
}
