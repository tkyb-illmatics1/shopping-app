<?php namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FuzzySearchable
{
    /**
     * あいまい検索
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column_name
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFuzzySearch(Builder $query, string $column_name, string $value)
    {
        return $query->where($column_name, 'like', '%' . $value . '%');
    }
}
