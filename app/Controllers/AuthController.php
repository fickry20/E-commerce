<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class AuthController extends BaseController
{
    public function loginView()
    {
        return view("v_login");
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Check if the login input is an email or username and query accordingly
        $data = $userModel
            ->where('username', $username)
            ->orWhere('email', $username)
            ->first();

        $redirectTo = $this->request->getGet('redirectTo');

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);

            if ($authenticatePassword) {
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'is_logged_in' => TRUE
                ];

                $session->set($ses_data);

                if ($data['role'] == 'admin') {
                    return redirect()->to(base_url('/admin/manage-product'));
                } else {
                    if ($redirectTo) {
                        return redirect()->to(base_url($redirectTo));
                    } else {
                        return redirect()->to(base_url('/'));
                    }
                }
            } else {
                $session->setFlashdata('failed', 'Password is incorrect.');
                return redirect()->to(base_url('/login'));
            }
        } else {
            $session->setFlashdata('failed', 'Email or username does not exist.');
            return redirect()->to(base_url('/login'));
        }
    }


    public function registerView()
    {
        return view("v_register");
    }

    public function registerAuth()
    {
        helper(['form']);
        $userModel = new UserModel();
        $rules = [
            'username' => 'required|max_length[50]',
            'email' => 'required|max_length[100]|valid_email|is_unique[users.email]',
            'password' => 'required|max_length[50]',
            'address' => 'required',
        ];

        if ($this->validate($rules)) {
            $data = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'address' => $this->request->getVar('address'),
                'role' => 'customer',
                'deleted_at' => null,
            ];

            $userModel->save($data);
            session()->setFlashdata('success', 'Registration Successfully.');
            return redirect()->to(base_url("/login"));
        } else {
            $validation = Services::validation();
            return redirect()->to(base_url('/register'))->withInput()->with('validation', $validation);
        }
    }

    function logout()
    {
        $session = session();
        $session->set(array(
            'user_id' => '',
            'user_name' => '',
            'email' => '',
            'role' => '',
            'is_logged_in' => FALSE
        ));
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
