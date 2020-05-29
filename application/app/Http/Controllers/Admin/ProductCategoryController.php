<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Http\Requests\ProductCategory\IndexRequest;
use App\Http\Requests\ProductCategory\StoreRequest;
use App\Http\Requests\ProductCategory\UpdateRequest;
use App\Models\Traits\FuzzySearchable;

class ProductCategoryController extends Controller
{
    use FuzzySearchable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $query = ProductCategory::query();
        $name = $request->input('name');

        $sortType = $request->input('sortType');
        empty($sortType) ? $sortType = "id" : $sortType;

        $sortOrder = $request->input('sortOrder');
        empty($sortOrder) ? $sortOrder = "asc" : $sortOrder;

        $display = $request->input('display');
        empty($display) ? $display = 10 : $display;

        if($name){
            $query = $this->scopeFuzzySearch($query, 'name', $name);
        }
        $productCategories = $query->sortOrder($sortType, $sortOrder)
                          ->paginate($display);

        return view('admin.product_categories.index', compact("productCategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product_categories.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(productCategory $productCategory)
    {
        return view('admin.product_categories.show', compact("productCategory"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(productCategory $productCategory)
    {
        return view('admin.product_categories.edit', compact("productCategory"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, productCategory $productCategory)
    {
        ProductCategory::query()->where('id', $productCategory->id)
                                ->update($request->validated());

        return redirect()->route('admin.product_categories.show', $productCategory->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(productCategory $productCategory)
    {
        $this->authorize('delete', $productCategory->id);

        ProductCategory::destroy($productCategory->id);

        return redirect()->route('admin.product_categories.index');
    }
}
