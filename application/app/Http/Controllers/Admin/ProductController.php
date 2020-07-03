<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * @param  \Illuminate\Http\Request $request
     * @return array $products
     * @return array $productCategories
     */
    public function index(IndexRequest $request)
    {
        $products = Product::with('productCategory');

        if (filled($request->prductCategory())) {
            $products->whereProductCategoryId($request->prductCategory());
        }
        if (filled($request->name())) {
            $products->fuzzySearch('name', $request->name());
        }
        if (filled($request->price()) && filled($request->priceOperator())) {
            $products->priceSearch($request->price(), $request->priceOperator());
        }
        $products = $products->sortOrder($request->sortType(), $request->sortDirection())
                             ->paginate($request->pageUnit());

        $productCategories = ProductCategory::sortOrder('order_no', 'asc')->get();

        return view('admin.products.index', compact("products", "productCategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array $productCategories
     */
    public function create()
    {
        $productCategories = ProductCategory::query()->get();
        return view('admin.products.create', compact("productCategories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Product $product
     * @return \Illuminate\Http\Response
     * @return array $productCategories
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Product $product
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
     * @param  App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $paramerter = $request->validated();
        if ($request->filled("deleteFlg")) {
            $paramerter = array_merge($paramerter, ['image_path' => null]);
        }
        $product->update($paramerter);

        return redirect()->route('admin.products.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->destroy($product->id);

        return redirect()->route('admin.products.index');
    }
}
