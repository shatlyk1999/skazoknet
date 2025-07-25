<?php

namespace App\Services;

class SeoService
{
    protected $title;
    protected $description;
    protected $keywords;
    protected $ogTitle;
    protected $ogDescription;
    protected $ogImage;
    protected $canonicalUrl;
    protected $robots = 'index,follow';
    protected $schemaMarkup = [];

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = is_array($keywords) ? implode(', ', $keywords) : $keywords;
        return $this;
    }

    public function setOgTitle($ogTitle)
    {
        $this->ogTitle = $ogTitle;
        return $this;
    }

    public function setOgDescription($ogDescription)
    {
        $this->ogDescription = $ogDescription;
        return $this;
    }

    public function setOgImage($ogImage)
    {
        $this->ogImage = $ogImage;
        return $this;
    }

    public function setCanonicalUrl($canonicalUrl)
    {
        $this->canonicalUrl = $canonicalUrl;
        return $this;
    }

    public function setRobots($robots)
    {
        $this->robots = $robots;
        return $this;
    }

    public function addSchemaMarkup($type, $data)
    {
        $this->schemaMarkup[] = [
            '@context' => 'https://schema.org',
            '@type' => $type,
            ...$data
        ];
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getOgTitle()
    {
        return $this->ogTitle ?: $this->title;
    }

    public function getOgDescription()
    {
        return $this->ogDescription ?: $this->description;
    }

    public function getOgImage()
    {
        return $this->ogImage;
    }

    public function getCanonicalUrl()
    {
        return $this->canonicalUrl;
    }

    public function getRobots()
    {
        return $this->robots;
    }

    public function getSchemaMarkup()
    {
        return $this->schemaMarkup;
    }

    public function renderMetaTags()
    {
        $html = '';

        if ($this->title) {
            $html .= '<title>' . e($this->title) . '</title>' . "\n";
            $html .= '<meta name="title" content="' . e($this->title) . '">' . "\n";
        }

        if ($this->description) {
            $html .= '<meta name="description" content="' . e($this->description) . '">' . "\n";
        }

        if ($this->keywords) {
            $html .= '<meta name="keywords" content="' . e($this->keywords) . '">' . "\n";
        }

        if ($this->robots) {
            $html .= '<meta name="robots" content="' . e($this->robots) . '">' . "\n";
        }

        if ($this->canonicalUrl) {
            $html .= '<link rel="canonical" href="' . e($this->canonicalUrl) . '">' . "\n";
        }

        // Open Graph tags
        if ($this->getOgTitle()) {
            $html .= '<meta property="og:title" content="' . e($this->getOgTitle()) . '">' . "\n";
        }

        if ($this->getOgDescription()) {
            $html .= '<meta property="og:description" content="' . e($this->getOgDescription()) . '">' . "\n";
        }

        if ($this->ogImage) {
            $html .= '<meta property="og:image" content="' . e($this->ogImage) . '">' . "\n";
        }

        $html .= '<meta property="og:type" content="website">' . "\n";
        $html .= '<meta property="og:url" content="' . e(request()->url()) . '">' . "\n";

        // Schema markup
        if (!empty($this->schemaMarkup)) {
            $html .= '<script type="application/ld+json">' . "\n";
            $html .= json_encode($this->schemaMarkup, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
            $html .= '</script>' . "\n";
        }

        return $html;
    }
}
