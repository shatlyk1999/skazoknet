<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Complex;
use App\Models\Developer;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Главная страница
        $sitemap .= $this->addUrl(route('home'), now(), 'daily', '1.0');

        // Города
        City::all()->each(function ($city) use (&$sitemap) {
            $sitemap .= $this->addUrl(
                url('/complexes/all?city=' . $city->id),
                $city->updated_at,
                'weekly',
                '0.8'
            );
        });

        // Застройщики
        Developer::where('status', 1)->get()->each(function ($developer) use (&$sitemap) {
            $sitemap .= $this->addUrl(
                route('show.developer', $developer->slug),
                $developer->updated_at,
                'weekly',
                '0.8'
            );
        });

        // Комплексы
        Complex::where('status', 1)->get()->each(function ($complex) use (&$sitemap) {
            $sitemap .= $this->addUrl(
                route('show.complex', $complex->slug),
                $complex->updated_at,
                'weekly',
                '0.9'
            );
        });

        $sitemap .= '</urlset>';

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    private function addUrl($url, $lastmod = null, $changefreq = 'weekly', $priority = '0.5')
    {
        $xml = '  <url>' . "\n";
        $xml .= '    <loc>' . htmlspecialchars($url) . '</loc>' . "\n";

        if ($lastmod) {
            $xml .= '    <lastmod>' . $lastmod->format('Y-m-d\TH:i:s+00:00') . '</lastmod>' . "\n";
        }

        $xml .= '    <changefreq>' . $changefreq . '</changefreq>' . "\n";
        $xml .= '    <priority>' . $priority . '</priority>' . "\n";
        $xml .= '  </url>' . "\n";

        return $xml;
    }
}
