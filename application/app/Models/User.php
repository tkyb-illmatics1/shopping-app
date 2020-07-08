<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\FuzzySearchable;
use App\Models\Traits\ForwardMatchSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\WishProduct;
use App\Models\ProductReview;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use FuzzySearchable;
    use ForwardMatchSearchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 対象の顧客に紐付くほしい物リストを返す。
     * 
     * @return App\Models\WishProduct
     */
    public function wishProducts()
    {
        return $this->hasMany(WishProduct::class);
    }

    /**
     * 対象の顧客に紐付く商品レビューを返す。
     * 
     * @return App\Models\ProductReview
     */
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     *
     * @param  UploadedFile  $value
     * @return string
     */
    public function setImagePathAttribute(?UploadedFile $value)
    {
        if (isset($this->image_path) && Storage::exists($this->image_path)) {
            Storage::delete($this->image_path);
        }
        if (is_null($value)) {
            $this->attributes['image_path'] = "";
            return;
        }
        $this->attributes['image_path'] = $value->store('userImages');
    }

    /**
     * 
     */
    protected static function boot()
    {
        parent::boot();

        self::deleting(function($user){
            Storage::delete($user->image_path);
            $user->wishProducts()->delete();
            $user->productReviews()->delete();
        });

        return;
    }

    /**
     * ソート（ID、名称、メールアドレス）
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $sortType
     * @param string $sortOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOrder(Builder $query, string $sortType, string $sortOrder)
    {
        $array = ['id', 'name', 'email'];
        if (!in_array($sortType, $array)) {
            return $query;
        }

        $array = ['asc', 'desc'];
        if (!in_array($sortOrder, $array)) {
            return $query;
        }
        return $query->orderBy($sortType, $sortOrder);
    }
}
