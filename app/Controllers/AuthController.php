<?php

namespace App\Controllers;

use App\Models\Muser;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');            
    }

    public function loginSubmit()
    {
        $session = session();
        $model = new Muser();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $user = $model->getUserById($email);
        
        if ($user && md5($password) === $user['password']) {
            $session->set([
                'user_id' => $user['email'],
                'username' => $user['nama'],
                'email' => $user['email'],
                'level' => $user['level'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('msg', 'Incorrect email or password');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
