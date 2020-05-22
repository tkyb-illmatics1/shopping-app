<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any product categories.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the product category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ProductCategory  $productCategory
     * @return mixed
     */
    public function view(User $user, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can create product categories.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ProductCategory  $productCategory
     * @return mixed
     */
    public function update(User $user, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can delete the product category.
     *
     * @param  int  $id
     * @return mixed
     */
    public function delete($id)
    {
        $count = Product::where('product_category_id', $id)->count();

        return $count == 0;
    }

    /**
     * Determine whether the user can restore the product category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ProductCategory  $productCategory
     * @return mixed
     */
    public function restore(User $user, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ProductCategory  $productCategory
     * @return mixed
     */
    public function forceDelete(User $user, ProductCategory $productCategory)
    {
        //
    }
}
