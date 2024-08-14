<?php
session_start();

class Cart
{
    public function addToCart($product_id, $quantity)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }

        return $_SESSION['cart'];
    }

    public function removeFromCart($product_id)
    {
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }

        return $_SESSION['cart'];
    }

    public function listCart()
    {
        return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $cart = new Cart();
    $cart->addToCart($product_id, $quantity);
    echo json_encode(['success' => true, 'cart' => $cart->listCart()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $product_id = $_GET['product_id'];
    $cart = new Cart();
    $cart->removeFromCart($product_id);
    echo json_encode(['success' => true, 'cart' => $cart->listCart()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $cart = new Cart();
    echo json_encode(['success' => true, 'cart' => $cart->listCart()]);
    exit;
}
?>
