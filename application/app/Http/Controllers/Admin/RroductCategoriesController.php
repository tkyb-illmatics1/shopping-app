<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

class RroductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ProductCategory::query();

        $name = $request->input('name');
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $sortType = $request->input('sortType');
        if (empty($sortType)) {
            $sortType = "id";
        }

        $sortOrder = $request->input('sortOrder');
        if (empty($sortOrder)) {
            $sortOrder = "asc";
        }
        
        $display = $request->input('display');
        if (!empty($display)) {
            $paginate = $query->paginate($display);
        }else{
            $paginate = $query->paginate(10);
        }
        
        $lists = $query->orderBy($sortType, $sortOrder)->get();

        $old = ['name' => $name,
                'sortType' => $sortType,
                'sortOrder' => $sortOrder,
                'display' => $display];

        return view('admin.product_categories.index', ['lists' => $lists, 'paginate' => $paginate, 'old' => $old ]);
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
    public function store(Request $request)
    {
        $action = $request->get('action', 'back');
        if($action == 'back'){
            return redirect('/admin/product_categories');
        }

        $validatedData = $request->validate([
            'name' => 'required|unique:App\Models\ProductCategory',
            'order_no' => 'required|numeric|unique:App\Models\ProductCategory',
        ],[
            'name.required' => '名称は必ず入力してください。',
            'name.unique' => '指定の名称は既に使用されています。',
            'order_no.required' => '並び順番号は必ず入力してください。',
            'order_no.numeric' => '並び順番号は半角数字を入力してください。',
            'order_no.unique' => '指定の並び順番号は既に使用されています。',
            ]
        );

        $productCategory = new ProductCategory();
        $productCategory->name = $request->name;
        $productCategory->order_no = $request->order_no;
        $productCategory->save();

        return redirect('/admin/product_categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data  = ProductCategory::query()->where('id', $id)->first();
        $count = Product::where('product_category_id', $id)->count();

        return view('admin.product_categories.show', ['data' => $data, 'disp_flg' => $count]);
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
    public function update(Request $request, $id)
    {
        $action = $request->get('action', 'back');
        if($action == 'back'){
            return redirect('/admin/product_categories/'.$id);
        }

        $validatedData = $request->validate([
            'name' => 'required|unique:App\Models\ProductCategory',
            'order_no' => 'required|numeric|unique:App\Models\ProductCategory',
        ],[
            'name.required' => '名称は、必ず入力してください。',
            'name.unique' => '指定の名称は既に使用されています。',
            'order_no.required' => '並び順番号は、必ず入力してください。',
            'order_no.numeric' => '並び順番号は、半角数字を入力してください。',
            'order_no.unique' => '指定の並び順番号は既に使用されています。',
            ]
        );

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
        $count = Product::where('product_category_id', $id)->count();
        if($count != 0){
            abort('403');
        }
        ProductCategory::destroy($id);

        return redirect('/admin/product_categories');
    }
}
