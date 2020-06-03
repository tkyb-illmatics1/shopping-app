<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\FuzzySearchable;
use Illuminate\Database\Eloquent\Builder;

class ProductCategory extends Model
{
    use FuzzySearchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order_no',
    ];

    /**
     * ソート（ID、名称、並び順）
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $sortType
     * @param string $sortOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOrder(Builder $query, string $sortType, string $sortOrder){
        return $query->orderBy($sortType, $sortOrder);
    }
}
