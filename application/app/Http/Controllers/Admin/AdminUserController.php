<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\AdminUser;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = AdminUser::query();

        $name = $request->input('name');
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $email = $request->input('email');
        if (!empty($email)) {
            $query->where('email', 'like', '%' . $email);
        }

        $iauthority = $request->input('iauthority');
        if (!empty($iauthority) && $iauthority != 999) {
            $query->where('iauthority', '=', $iauthority);
        }else{
            $iauthority == 999;
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
                'email' => $email,
                'iauthority' => $iauthority,
                'sortType' => $sortType,
                'sortOrder' => $sortOrder,
                'display' => $display];

        return view('admin.admin_users.index', ['lists' => $lists, 'old' => $old, 'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
