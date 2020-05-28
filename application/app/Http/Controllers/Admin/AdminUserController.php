<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\AdminUser;
use App\Http\Requests\AdminUser\IndexRequest;
use App\Http\Requests\AdminUser\StoreRequest;
use App\Http\Requests\AdminUser\UpdateRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $adminUsers = AdminUser::nameSerach($request)
                                ->emailSerach($request)
                                ->isOwnerSerach($request)
                                ->sortOrder($request)
                                ->display($request);

        return view('admin.admin_users.index', ['adminUsers' => $adminUsers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin_users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // AdminUser::create($request->validated());

        return redirect('/admin/admin_users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUser $adminUser)
    {
        return view('admin.admin_users.show', ['adminUser' => $adminUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin.admin_users.edit', ['adminUser' => $adminUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AdminUser $adminUser)
    {
        return view('admin.admin_users.show', ['adminUser' => $adminUser]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
