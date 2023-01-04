<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'photo' => 'image|file'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('public/products');
        }

        Product::create($data);

        return redirect()
            ->route('product.index')
            ->with('success', 'Success create product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'photo' => 'image|file'
        ]);

        if ($request->hasFile('photo')) {

            if ($request->oldPhoto) {
                Storage::delete($request->oldPhoto);
            }

            $data['photo'] = $request->file('photo')->store('public/products');
        } else {
            $data['photo'] = $product->photo;
        }

        $product->update($data);

        return redirect()
            ->route('product.index')
            ->with('update', 'Success create product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::delete($product->photo);
        }

        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('delete', 'Success deleted product');
    }
}
