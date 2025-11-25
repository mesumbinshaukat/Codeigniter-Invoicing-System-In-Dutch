<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }
        
        return view('admin/login');
    }

    public function authenticate()
    {
        $userModel = new UserModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->orWhere('email', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Ongeldige gebruikersnaam of wachtwoord');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
