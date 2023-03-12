<?php

namespace App\Http\Controllers;

use App\Exceptions\AccessDenied;
use App\Http\Resources\WordCollection;
use App\Http\Resources\WordResource;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return WordCollection::collection($request->user()->words());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): WordResource
    {
        $request->validate([
            'word_1' => 'required|max:255',
            'word_2' => 'required|max:255',
        ]);

        $word = new Word();
        $word->user_id = $request->user()->id;
        $word->word_1 = $request->word_1;
        $word->word_2 = $request->word_2;
        $word->save();

        return new WordResource($word);
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word): WordResource
    {
        return new WordResource($word);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word): array
    {
        $request->validate([
            'word_1' => 'required|max:255',
            'word_2' => 'required|max:255',
        ]);

        if ($word->user_id !== $request->user()->id) {
            throw new AccessDenied();
        }

        $word->word_1 = $request->word_1;
        $word->word_2 = $request->word_2;
        $word->save();

        return [
            'success' => true
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Word $word): array
    {
        if ($word->user_id !== $request->user()->id) {
            throw new AccessDenied();
        }

        return [
            'success' => true
        ];
    }
}
