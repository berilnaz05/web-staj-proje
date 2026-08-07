<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::latest()->get();

        return view('artworks.index', compact('artworks'));
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'artworks.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'cover_image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('cover_image')) {
            $imagePath = $request
                ->file('cover_image')
                ->store('covers', 'public');
        }

        Artwork::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()
            ->route('artworks.index')
            ->with('success', 'Eser oluşturuldu.');
    }

    public function show(Artwork $artwork)
    {
        $artwork->load([
            'user',
            'category',
            'chapters',
            'comments.user'
        ]);

        return view('artworks.show', compact('artwork'));
    }

    public function edit(Artwork $artwork)
    {
        if ($artwork->user_id != auth()->id()) {
            abort(403);
        }

        $categories = Category::all();

        return view(
            'artworks.edit',
            compact('artwork', 'categories')
        );
    }

    public function update(Request $request, Artwork $artwork)
{
    if ($artwork->user_id != auth()->id()) {
        abort(403);
    }

    $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable',
        'cover_image' => 'nullable|image'
    ]);

    if ($request->hasFile('cover_image')) {

        $imagePath = $request
            ->file('cover_image')
            ->store('covers', 'public');

        $artwork->cover_image = $imagePath;
    }

    $artwork->title = $request->title;
    $artwork->description = $request->description;

    $artwork->save();

    return redirect()
        ->route('artworks.show', $artwork->id)
        ->with('success', 'Eser güncellendi.');
}

public function destroy(Artwork $artwork)
{

    if ($artwork->user_id != auth()->id()) {
        abort(403);
    }

    $artwork->delete();

    return redirect()
        ->route('artworks.index')
        ->with('success', 'Eser silindi.');
}
}