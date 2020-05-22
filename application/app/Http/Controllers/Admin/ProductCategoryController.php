<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductCategoryRequest $request)
    {
        $lists = ProductCategory::Serach($request);

        return view('admin.product_categories.index', ['lists' => $lists]);
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
    public function store(ProductCategoryRequest $request)
    {
        ProductCategory::create([
            'name' => $request->name,
            'order_no' => $request->order_no,
        ]);

        return redirect('/admin/product_categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(productCategory $productCategory)
    {
        $count = Product::where('product_category_id', $productCategory->id)->count();

        return view('admin.product_categories.show', ['data' => $productCategory, 'disp_flg' => $count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data  = ProductCategory::query()->where('id', $id)->first();

        return view('admin.product_categories.edit', ['old' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        ProductCategory::query()->where('id', $id)->update(['name' => $request->name,'order_no' => $request->order_no,]);

        return redirect('/admin/product_categories/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $id);

        ProductCategory::destroy($id);

        return redirect('/admin/product_categories');
    }
}
