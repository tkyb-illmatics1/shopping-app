<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\FuzzySearchable;
use Illuminate\Database\Eloquent\Builder;

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
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param integer $price
     * @param string $operator
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePriceSearch(Builder $query, int $price, string $operator)
    {
        $array = ['>=', '<='];
        if (!in_array($operator, $array)) {
            return $query;
        }
        return $query->where('price', $operator, $price);
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
        $array = ['id', 'product_category_id', 'name', 'price'];
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
