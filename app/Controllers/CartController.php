<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\FileModel;

class CartController extends BaseController
{
    public function cartView()
    {
        $cartModel = new CartModel();
        $session = session();
        $userId = $session->get('user_id');
        $carts = $cartModel
            ->join('products', 'products.product_id = cart.product_id')
            ->where('user_id', $userId)
            ->where('status', 'cart')
            ->where('cart.deleted_at', null)
            ->findAll();

        $fileModel = new FileModel();
        $totalPrice = 0;
        foreach ($carts as &$cart) {
            $image = $fileModel
                ->where('product_id', $cart['product_id'])
                ->first();

            $cart['file_path'] = $image['file_path'];

            $totalPrice += $cart['price'];
        }

        $data = [
            'carts' => $carts,
            'totalPrice' => $totalPrice
        ];

        return view('customer/v_cart', $data);
    }

    public function getCart()
    {
        $cartModel = new CartModel();
        $session = session();
        $userId = $session->get('user_id');
        $carts = $cartModel
            ->where('user_id', $userId)
            ->where('status', 'cart')
            ->findAll();

        return $this->response->setJSON($carts);
    }

    public function addToCart($productId)
    {
        helper(['form', 'url']);
        $cartModel = new CartModel();
        $session = session();
        $userId = $session->get('user_id');
        if (!$userId) {
            return redirect()->to(base_url('/login?redirectTo=/product/' . $productId));
        }
        $cartItem = [
            'product_id' => $productId,
            'size_id' => 1,
            'user_id' => $userId,
            'status' => 'cart',
            'deleted_at' => null
        ];
        if ($cartModel->save($cartItem)) {
            $session->setFlashdata('success', 'Item added to cart!');
        } else {
            $session->setFlashdata('error', 'Failed to add item to cart. Please try again.');
        }

        return redirect()->back();
    }


    public function updateStatus($currentStatus, $newStatus)
    {
        $cartModel = new CartModel();
        $session = session();
        $userId = $session->get('user_id');

        $cartModel
            ->where('user_id', $userId)
            ->where('status', $currentStatus)
            ->set(['status' => $newStatus])
            ->update();

        return redirect()->back();
    }
}
