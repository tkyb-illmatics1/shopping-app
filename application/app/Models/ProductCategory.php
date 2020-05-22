<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SarchTrait;

class ProductCategory extends Model
{
    use SarchTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order_no',
    ];

    public function scopeSerach($query, $request){

        $query = $this->setFuzzySearch('name', $request->input('name'));

        $sortType = $request->input('sortType');
        if (empty($sortType)) {
            $sortType = "id";
        }

        $sortOrder = $request->input('sortOrder');
        if (empty($sortOrder)) {
            $sortOrder = "asc";
        }

        $query->orderBy($sortType, $sortOrder);
        
        $display = $request->input('display');
        if (!empty($display)) {
            return $query->paginate($display);
        } else {
            return $query->paginate(10);
        }
    }
}
