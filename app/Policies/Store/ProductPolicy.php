<?php

namespace App\Policies\Store;

use App\Sold;
use App\User;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return $user->member->company_id === $product->company_id;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        // le produit ne doit pas :
            // avoir une quantité dans le store [store-Qt]
            // être mentionner dans le accounting
            //
        if($product->qt == 0){
            if(isset($product->solds[0])){
                return false;
            }
            else{
                if(isset($product->purchaseds[0])){
                    return false;
                }
                return true;
            }
        }
        return false;
    }
}
