<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FuzzySearchable;

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

    public function scopeNameSearch($query, $name){
        return $this->scopeFuzzySearch('name', $name);
    }

    public function scopeSortOrder($query, $sortType, $sortOrder){
        if (empty($sortType)) {
            $sortType = "id";
        }

        if (empty($sortOrder)) {
            $sortOrder = "asc";
        }

        return $query->orderBy($sortType, $sortOrder);
    }

    public function scopeSearchPaginate($query, $display){
        if (!empty($display)) {
            return $query->paginate($display);
        } else {
            return $query->paginate(10);
        }
    }
}
