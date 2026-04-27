<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    function __construct()
    {
        helper('form');
    }
    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUsers = [
                ['username' => 'april', 'password' => '202cb962ac59075b964b07152d234b70', 'role' => 'admin'], // passw 123
                ['username' => 'tamu', 'password' => '202cb962ac59075b964b07152d234b70', 'role' => 'guest']   // passw 123
            ];

            $userFound = null;
            foreach ($dataUsers as $user) {
                if ($username == $user['username']) {
                    $userFound = $user;
                    break;
                }
            }

            if ($userFound) {
                if (md5($password) == $userFound['password']) {
                    session()->set([
                        'username' => $userFound['username'],
                        'role' => $userFound['role'],
                        'isLoggedIn' => TRUE
                    ]);

                    return redirect()->to(base_url('/'));
                } else {
                    session()->setFlashdata('failed', 'Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            return view('v_login');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}