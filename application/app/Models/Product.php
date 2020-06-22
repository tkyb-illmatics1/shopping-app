<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\FuzzySearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use FuzzySearchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_category_id',
        'name',
        'price',
        'description',
        'image_path',
    ];

    /**
     *
     * @param  string  $value
     * @return string
     */
    public function setImagePathAttribute($value)
    {
        $this->attributes['image_path'] = $value;
    }

    /**
     * 対象の商品に紐付く商品カテゴリーを返す。
     * 
     * @return App\Models\ProductCategory
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * 
     */
    protected static function boot()
    {
        parent::boot();

        self::deleted(function($product){
            Storage::delete($product->image_path);
        });

        return;
    }

    /**
     * 価格（以上以下）検索
     * 
     * @param integer $prductCategoryID
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProductCategorySearch(Builder $query, int $prductCategoryID)
    {
        return $query->where('product_category_id', '=', $prductCategoryID);
    }

    /**
     * 価格（以上以下）検索
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param integer $price
     * @param string $operator
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePriceSearch(Builder $query, int $price, string $comparisonOperator)
    {
        $target = ['>=', '<='];
        if (!in_array($comparisonOperator, $target)) {
            return $query;
        }
        return $query->where('price', $comparisonOperator, $price);
    }

    /**
     * ソート（ID、商品カテゴリー、名称、価格）
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $sortType
     * @param string $sortOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOrder(Builder $query, string $sortType, string $sortOrder)
    {
        $array = ['asc', 'desc'];
        if (!in_array($sortOrder, $array)) {
            return $query;
        }

        $array = ['id', 'product_category_id', 'name', 'price'];
        if (!in_array($sortType, $array)) {
            return $query;
        }elseif ($sortType == 'product_category_id') {
            return $query->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                            ->orderBy('product_categories.order_no', $sortOrder)->orderBy('products.id', 'asc');
        }

        return $query->orderBy($sortType, $sortOrder);
    }
}
