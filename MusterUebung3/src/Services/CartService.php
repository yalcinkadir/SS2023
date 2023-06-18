<?php

namespace Fhtechnikum\Uebung34\Services;

use Fhtechnikum\Uebung34\Models\CartModel;

class CartService
{
    private $cartItems;

    public function __construct()
    {
        $this->cartItems = [];
    }

    public function addToCart(CartModel $cartItem)
    {
        if (isset($this->cartItems[$cartItem->productId])) {
            $this->cartItems[$cartItem->productId]->quantity += $cartItem->quantity;
        } else {
            $this->cartItems[$cartItem->productId] = $cartItem;
        }
    }

    public function removeFromCart($productId)
    {
        unset($this->cartItems[$productId]);
    }

    public function getCartItems()
    {
        return $this->cartItems;
    }
}
