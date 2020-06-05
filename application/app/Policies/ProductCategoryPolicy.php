<?php

namespace App\Policies;

use App\Models\AdminUser;
use App\Models\ProductCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the product category.
     *
     * @param  ProductCategory  $productCategory
     * @return mixed
     */
    public function delete(AdminUser $loginUser, ProductCategory $productCategory)
    {
        return $productCategory->products()->doesntExist();
    }
}
