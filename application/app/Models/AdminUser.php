<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\AdminUser
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminUser extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function scopeNameSerach($query, $request){
        // return $this->fuzzySearch('name', $request->input('name'));

        $name = $request->input('name');
        if (!empty($name)) {
            return $query->where('name', 'like', '%' . $name . '%');
        }
        return ;
    }

    public function scopeEmailSerach($query, $request){
        // TODO: trait に追加する
        $email = $request->input('email');
        if (!empty($email)) {
            return $query->where('email', 'like', '%' . $email);
        }
        return ;
    }

    public function scopeIsOwnerSerach($query, $request){
        $iauthority = $request->input('iauthority');
        if (!empty($iauthority) && $iauthority != 0) {
            $iauthority -= 1;
            return $query->where('is_owner', '=', $iauthority);
        }
        return ;
    }

    public function scopeSortOrder($query, $request){
        $sortType = $request->input('sortType');
        if (empty($sortType)) {
            $sortType = "id";
        }

        $sortOrder = $request->input('sortOrder');
        if (empty($sortOrder)) {
            $sortOrder = "asc";
        }

        return $query->orderBy($sortType, $sortOrder);
    }

    public function scopeDisplay($query, $request){
        $display = $request->input('display');
        if (!empty($display)) {
            return $query->paginate($display);
        } else {
            return $query->paginate(10);
        }
    }
}
