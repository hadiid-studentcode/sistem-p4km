<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    public function index()
    {


        $session = session();

        if ($session->get('isLogin')) {
            return redirect()->to('/dashboard');
        }

        return view('login');
    }

    public function attemptLogin()
    {
        $model = new UsersModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $model->getUserByUsername($username);


        if ($user['username'] == $username && $user['password'] == $password) {
            $session = session();

            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLogin' => true,
            ]);

            return redirect()->to('dashboard');
        } else {
            dd('error');
            return redirect()->back()->with('error', 'Username dan Password Salah');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
