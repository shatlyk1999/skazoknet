<?php

namespace App\Traits;

use App\Models\SeoMeta;

trait HasSeo
{
    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function getSeoTitle()
    {
        return $this->seoMeta?->title ?? $this->getDefaultSeoTitle();
    }

    public function getSeoDescription()
    {
        return $this->seoMeta?->description ?? $this->getDefaultSeoDescription();
    }

    public function getSeoKeywords()
    {
        return $this->seoMeta?->keywords ?? $this->getDefaultSeoKeywords();
    }

    public function getOgTitle()
    {
        return $this->seoMeta?->og_title ?? $this->getSeoTitle();
    }

    public function getOgDescription()
    {
        return $this->seoMeta?->og_description ?? $this->getSeoDescription();
    }

    public function getOgImage()
    {
        return $this->seoMeta?->og_image ?? $this->getDefaultOgImage();
    }

    public function getCanonicalUrl()
    {
        return $this->seoMeta?->canonical_url ?? $this->getDefaultCanonicalUrl();
    }

    public function getRobots()
    {
        return $this->seoMeta?->robots ?? 'index,follow';
    }

    // Эти методы должны быть реализованы в каждой модели
    abstract protected function getDefaultSeoTitle();
    abstract protected function getDefaultSeoDescription();
    abstract protected function getDefaultSeoKeywords();
    abstract protected function getDefaultOgImage();
    abstract protected function getDefaultCanonicalUrl();
}
