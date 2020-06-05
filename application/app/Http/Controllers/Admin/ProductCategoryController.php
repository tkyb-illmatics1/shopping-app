<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Http\Requests\ProductCategory\IndexRequest;
use App\Http\Requests\ProductCategory\StoreRequest;
use App\Http\Requests\ProductCategory\UpdateRequest;

class ProductCategoryController extends Controller
{
    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array $productCategories
     */
    public function index(IndexRequest $request)
    {
        $productCategories = ProductCategory::query();

        if (filled($request->name())) {
            $productCategories->fuzzySearch('name', $request->name());
        }
        $productCategories = $productCategories->sortOrder($request->sortType(), $request->sortDirection())
                                               ->paginate($request->pageUnit());

        return view('admin.product_categories.index', compact("productCategories"));
    }

    /**
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product_categories.create');
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        ProductCategory::create($request->validated());

        return redirect()->route('admin.product_categories.index');
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return array $productCategories
     */
    public function show(productCategory $productCategory)
    {
        return view('admin.product_categories.show', compact("productCategory"));
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return array $productCategories
     */
    public function edit(productCategory $productCategory)
    {
        return view('admin.product_categories.edit', compact("productCategory"));
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, productCategory $productCategory)
    {
        $productCategory->update($request->validated());

        return redirect()->route('admin.product_categories.show', $productCategory->id);
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(productCategory $productCategory)
    {
        $this->authorize('delete', $productCategory);

        $productCategory->destroy($productCategory->id);

        return redirect()->route('admin.product_categories.index');
    }
}
