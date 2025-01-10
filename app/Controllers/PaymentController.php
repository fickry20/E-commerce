<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\PaymentModel;

class PaymentController extends BaseController
{
    public function payment()
    {
        $cartModel = new CartModel();
        $session = session();
        $userId = $session->get('user_id');

        // Save payment data
        $data = [
            'user_id' => $userId,
            'total' => $this->request->getVar('total_price'),
            'status' => 'waitiing_confirmation',
            'deleted_at' => null
        ];

        $cartModel
            ->where('user_id', $userId)
            ->where('status', 'cart')
            ->set(['status' => 'success_payment'])
            ->update();

        return redirect()->to(base_url('/success-payment'));
    }

    public function successPaymentView()
    {
        return view('customer/v_success_payment');
    }
}
