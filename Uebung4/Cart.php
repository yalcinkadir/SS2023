<?php

class Cart
{
    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addArticle($articleId)
    {
        if (array_key_exists($articleId, $_SESSION['cart'])) {
            $_SESSION['cart'][$articleId]++;
        } else {
            $_SESSION['cart'][$articleId] = 1;
        }
        return true;
    }

    public function removeArticle($articleId)
    {
        if (array_key_exists($articleId, $_SESSION['cart'])) {
            if ($_SESSION['cart'][$articleId] > 1) {
                $_SESSION['cart'][$articleId]--;
            } else {
                unset($_SESSION['cart'][$articleId]);
            }
            return true;
        }
        return false;
    }

    public function listCart($productService)
    {
        $cartItems = [];
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = $productService->getProductById($productId);
            $cartItems[] = ['articleName' => $product['name'], 'amount' => $quantity];
        }
        return $cartItems;
    }
}
?>