<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
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
        $this->authorize('index', AdminUser::class);

        $adminUsers = AdminUser::query();

        if (filled($request->name())) {
            $adminUsers->fuzzySearch('name', $request->name());
        }
        if (filled($request->email())) {
            // TODO::顧客管理マージ後入れ替え予定
            // $users->forwardMatchSearch('email', $request->email());
            $adminUsers->forwardMatchSearch('email', $request->email());
        }
        if (filled($request->iauthority()) && $request->iauthority() != 0) {
            $adminUsers->whereIsOwner($request->iauthority()-1);
        }
        $adminUsers = $adminUsers->sortOrder($request->sortType(), $request->sortDirection())
                                    ->paginate($request->pageUnit());

        return view('admin.admin_users.index', compact("adminUsers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', AdminUser::class);

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
        $this->authorize('store', AdminUser::class);

        $paramerter = array_merge($request->validated(), ['password' => Hash::make($request->validated()['password'])]);
        AdminUser::create($paramerter);

        return redirect()->route('admin.admin_users.index');
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return array $productCategories
     */
    public function show(AdminUser $adminUser)
    {
        $this->authorize('show', $adminUser);

        return view('admin.admin_users.show', compact("adminUser"));
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return array $productCategories
     */
    public function edit(AdminUser $adminUser)
    {
        $this->authorize('update', $adminUser);

        return view('admin.admin_users.edit', compact("adminUser"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AdminUser $adminUser)
    {
        $this->authorize('update', $adminUser);

        $paramerter = $request->validated();
        if($request->filled("password")){
            $paramerter = array_merge($paramerter, ['password' => Hash::make($request->validated()['password'])]);
        }else{
            unset($paramerter['password']);
        }
        $adminUser->update($paramerter);

        return redirect()->route('admin.admin_users.show', $adminUser->id);
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUser $adminUser)
    {
        $this->authorize('delete' ,$adminUser);

        $adminUser->destroy($adminUser->id);

        return redirect()->route('admin.admin_users.index');
    }
}
