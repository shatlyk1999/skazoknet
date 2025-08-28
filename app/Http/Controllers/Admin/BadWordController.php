<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BadWord;
use Exception;
use Illuminate\Http\Request;

class BadWordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BadWord::query();

        if ($request->filled('search')) {
            $query->where('word', 'like', '%' . $request->search . '%');
        }

        $badWords = $query->orderByDesc('id')->paginate(10);

        return view('admin.bad-word.index', compact('badWords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'word' => 'required|string|max:255|unique:bad_words,word'
        ]);

        try {
            BadWord::create([
                'word' => $request->word,
            ]);

            return to_route('bad-word.index')->with([
                'type' => 'success',
                'message' => 'Плохое слово успешно добавлено',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'word' => 'required|string|max:255|unique:bad_words,word,' . $id
        ]);

        $badWord = BadWord::find($id);
        if (!$badWord) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Плохое слово не найдено',
            ]);
        }

        try {
            $badWord->update([
                'word' => $request->word,
            ]);

            return to_route('bad-word.index')->with([
                'type' => 'success',
                'message' => 'Плохое слово успешно обновлено',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $badWord = BadWord::find($id);
        if (!$badWord) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Плохое слово не найдено',
            ]);
        }

        try {
            $badWord->delete();
            return to_route('bad-word.index')->with([
                'type' => 'success',
                'message' => 'Плохое слово успешно удалено',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
