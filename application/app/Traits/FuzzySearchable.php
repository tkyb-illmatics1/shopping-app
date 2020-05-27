<?php namespace App\Traits;

trait FuzzySearchable
{
    // あいまい検索
    public function scopeFuzzySearch($column_name, $value)
    {
        return $this->where($column_name, 'like', '%' . $value . '%');
    }
}