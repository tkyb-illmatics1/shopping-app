<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $products = Product::with('productCategory');

        if (filled($request->prductCategory())) {
            $products->where('product_category_id', '=', $request->prductCategory());
        }
        if (filled($request->name())) {
            $products->fuzzySearch('name', $request->name());
        }
        if (filled($request->price()) && filled($request->operator())) {
            $products->priceSearch($request->price(), $request->operator());
        }
        $products = $products->sortOrder($request->sortType(), $request->sortDirection())
                             ->paginate($request->pageUnit());

        $productCategories = ProductCategory::query()->get();

        return view('admin.products.index', compact("products", "productCategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::query()->get();
        return view('admin.products.create', compact("productCategories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $product = Product::create($request->validated());
        if(filled($request->file('image_path'))){
            $path = $request->file('image_path')->store('productImages');
            $product->update(['image_path' => $path]);
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::query()->get();
        return view('admin.products.edit', compact("product", "productCategories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        if(filled($request->file('image_path')) || filled($request->deleteFlg())){
            Storage::delete($product->image_path);
            $product->update(['image_path' => ""]);
        }

        $product->update($request->validated());

        if(filled($request->file('image_path'))){
            $path = $request->file('image_path')->store('productImages');
            $product->update(['image_path' => $path]);
        }

        return redirect()->route('admin.products.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image_path);
        $product->destroy($product->id);

        return redirect()->route('admin.products.index');
    }
}
