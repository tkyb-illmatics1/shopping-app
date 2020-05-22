<?php namespace App\Traits;

trait SarchTrait
{
    // あいまい検索
    public function setFuzzySearch($column_name, $value)
    {
        return  $this->where($column_name, 'like', '%' . $value . '%');
    }
}