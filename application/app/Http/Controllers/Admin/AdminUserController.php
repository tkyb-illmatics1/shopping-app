<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;

class AdminUserController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showAdminUserList(Request $request)
    {
        $query = AdminUser::query();

        //検索条件
        $name = $request->input('name');
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $email = $request->input('email');
        if (!empty($email)) {
            $query->where('email', 'like', $email);
        }

        $iauthority = $request->input('iauthorityRadioOptions');
        if (!empty($iauthority) && $iauthority != 999) {
            $query->where('is_owner', '=', $iauthority);
        }else{
            $iauthority = 999;
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

        return view('admin.admin_user', ['lists' => $lists, 'paginate' => $paginate, 'old' => $old ]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showAdminUserDetail(Request $request)
    {
        $query = AdminUser::query();

        //検索条件
        $id = $request->input('id');
        if (!empty($id)) {
            $query->where('name', '=', $id );
        }
        
        $user = $query->get();

        return view('admin.admin_user_detail', ['user' => $user]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createAdminUser(Request $request)
    {
        if ($request->get('action') === 'back') {
            // 入力画面へ戻る
            return redirect()
                ->view('admin.admin_user', ['old' => ['name' => "",
                                                      'email' => "",
                                                      'iauthority' => "",
                                                      'sortType' => "",
                                                      'sortOrder' => "",
                                                      'display' => ""]]);
        }

        $set = ['name' => "",
                'email' => "",
                'iauthority' => "",
               ];
        
        return view('admin.admin_user_create', ['old' => $set]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function insertAdminUser(Request $request)
    {
        $set = array();
        $name = $request->input('name');
        if (!empty($name)) {
            $set = ['name' => $name];
        }

        $email = $request->input('email');
        if (!empty($email)) {
            $set = ['email' => $email];
        }

        $password = $request->input('password');
        // $password2 = $request->input('password');
        // if (!empty($password) && ) {
        //     $$set = ['email' => $email];
        // }

        $email = $request->input('iauthority');
        if (!empty($email)) {
            $set = ['is_owner' => $email];
        }

        // AdminUser::query()->insert(
        // [
        //     'name' => $set["name"],
        //     'email' => $set["email"],
        //     // 'password' => ,
        //     // 'is_owner' => 
        // ]);

        return view('admin.admin_user_create', ['old' => $set]);
    }
}
