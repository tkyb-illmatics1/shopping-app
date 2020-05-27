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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $productCategories = ProductCategory::nameSearch($request->input('name'))
                                            ->sortOrder($request->input('sortType'), $request->input('sortOrder'))
                                            ->searchPaginate($request->input('display'));

        return view('admin.product_categories.index', ['productCategories' => $productCategories]);
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

        return redirect('/admin/product_categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(productCategory $productCategory)
    {
        return view('admin.product_categories.show', ['productCategory' => $productCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(productCategory $productCategory)
    {
        return view('admin.product_categories.edit', ['productCategory' => $productCategory]);
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
                                ->update(['name' => $request->name,'order_no' => $request->order_no,]);

        return redirect('/admin/product_categories/'.$productCategory->id);
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

        return redirect('/admin/product_categories');
    }
}
