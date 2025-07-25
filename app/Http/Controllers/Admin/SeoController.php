<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'complex');
        $seoMetas = SeoMeta::where('seoable_type', 'App\\Models\\' . ucfirst($type))
            ->with('seoable')
            ->paginate(20);

        return view('admin.seo.index', compact('seoMetas', 'type'));
    }

    public function create(Request $request)
    {
        $type = $request->get('type', 'complex');
        $modelClass = 'App\\Models\\' . ucfirst($type);
        $items = $modelClass::doesntHave('seoMeta')->get();

        return view('admin.seo.create', compact('items', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'seoable_type' => 'required',
            'seoable_id' => 'required',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|url',
            'canonical_url' => 'nullable|url',
            'robots' => 'nullable|string',
        ]);

        $data = $request->all();

        // Eğer OG image girilmemişse, seçilen model'in image'ini al
        if (empty($data['og_image'])) {
            $modelClass = $data['seoable_type'];
            $model = $modelClass::find($data['seoable_id']);

            if ($model && $model->image) {
                $folder = '';
                if ($modelClass == 'App\Models\Developer') {
                    $folder = 'developer';
                } elseif ($modelClass == 'App\Models\Complex') {
                    $folder = 'complex';
                } elseif ($modelClass == 'App\Models\City') {
                    $folder = 'city';
                }

                $data['og_image'] = asset($folder . '/' . $model->image);
            }
        }

        SeoMeta::create($data);

        return redirect()->route('admin.seo.index', ['type' => strtolower(class_basename($request->seoable_type))])
            ->with('message', 'SEO мета информация успешно добавлена.')
            ->with('type', 'success');
    }

    public function edit(SeoMeta $seo)
    {
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, SeoMeta $seo)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|url',
            'canonical_url' => 'nullable|url',
            'robots' => 'nullable|string',
        ]);

        $data = $request->all();

        // Eğer OG image girilmemişse, seçilen model'in image'ini al
        if (empty($data['og_image'])) {
            $model = $seo->seoable;

            if ($model && $model->image) {
                $folder = '';
                $modelClass = get_class($model);
                if ($modelClass == 'App\Models\Developer') {
                    $folder = 'developer';
                } elseif ($modelClass == 'App\Models\Complex') {
                    $folder = 'complex';
                } elseif ($modelClass == 'App\Models\City') {
                    $folder = 'city';
                }

                $data['og_image'] = asset($folder . '/' . $model->image);
            }
        }

        $seo->update($data);

        return redirect()->route('admin.seo.index', ['type' => strtolower(class_basename($seo->seoable_type))])
            ->with('message', 'SEO мета информация успешно обновлена.')
            ->with('type', 'success');
    }

    public function destroy(SeoMeta $seo)
    {
        $type = strtolower(class_basename($seo->seoable_type));
        $seo->delete();

        return redirect()->route('admin.seo.index', ['type' => $type])
            ->with('message', 'SEO мета информация успешно удалена.')
            ->with('type', 'success');
    }
}
