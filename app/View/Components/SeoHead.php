<?php

namespace App\View\Components;

use App\Services\SeoService;
use Illuminate\View\Component;

class SeoHead extends Component
{
    public $seoService;
    public $model;

    public function __construct($model = null)
    {
        $this->model = $model;
        $this->seoService = app(SeoService::class);

        if ($model && method_exists($model, 'getSeoTitle')) {
            $this->seoService
                ->setTitle($model->getSeoTitle())
                ->setDescription($model->getSeoDescription())
                ->setKeywords($model->getSeoKeywords())
                ->setOgTitle($model->getOgTitle())
                ->setOgDescription($model->getOgDescription())
                ->setOgImage($model->getOgImage())
                ->setCanonicalUrl($model->getCanonicalUrl())
                ->setRobots($model->getRobots());
        }
    }

    public function render()
    {
        return view('components.seo-head');
    }
}
