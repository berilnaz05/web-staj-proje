<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductComment;



class ProductController extends Controller
{
    public function comment(Request $request, Product $product)
    {
    $request->validate([
        'content' => 'required|max:500'
    ]);



    ProductComment::create([

        'user_id' => auth()->id(),

        'product_id' => $product->id,

        'content' => $request->content

    ]);

    return back();
    }
 

    public function show(Product $product)
    {
        $product->load('comments.user');

        return view('products.show', compact('product'));
    }

   public function deleteComment(ProductComment $comment)
    {
        if ($comment->user_id != auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Yorum silindi.');
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|max:4096',
            'category' => 'required',
        ]);

        $imagePath = $request->file('image')
            ->store('products', 'public');

        Product::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $imagePath,
            'status' => 'satista',
        ]);

        return redirect()->route('sanat-pazari');
    }

    // Ürün silme
public function destroy(Product $product)
{
    if ($product->user_id != auth()->id()) {
        abort(403);
    }

    $product->delete();

    return redirect()
        ->route('urunlerim')
        ->with('success', 'Ürün silindi.');
}


// Satıldı olarak işaretleme
public function updateStatus(Product $product)
{
    if ($product->user_id != auth()->id()) {
        abort(403);
    }

    $product->update([
        'status' => 'satildi'
    ]);

    return redirect()
        ->route('urunlerim')
        ->with('success', 'Ürün satıldı olarak işaretlendi.');
}


public function edit(Product $product)
{
    if ($product->user_id != auth()->id()) {
        abort(403);
    }

    return view('products.edit', compact('product'));
}

public function update(Request $request, Product $product)
{
    if ($product->user_id != auth()->id()) {
        abort(403);
    }


    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'category' => 'required',
    ]);


    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'category' => $request->category,
    ];


    if ($request->hasFile('image')) {

        $data['image'] = $request->file('image')
            ->store('products', 'public');

    }


    $product->update($data);


    return redirect()
        ->route('urunlerim')
        ->with('success', 'Ürün güncellendi.');
}

}
