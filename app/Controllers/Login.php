<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    protected $dataModel;
    public function __construct()
    {
        $this->dataModel = new \App\Models\LoginModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            $data = [
                'page_title' => 'Halaman Login',
                'page_desc' => 'Selamat datang, silahkan login untuk melanjutkan!',
                'page_key' => 'Halaman Login',
            ];
            return view('v_login', $data);
        }

        if (session()->get('user_level') > 0 ){
            return redirect()->to('admin/index.html');
        }
        return redirect('warga/index.html');
    }

    public function loginAuth()
    {
        session();
        $username = $this->request->getVar('username');
        $usrPassword = $this->request->getVar('password');
        $data = $this->dataModel->where('user_name', $username)->first();
        if ($data) {
            if (password_verify($usrPassword, $data['user_password'])) {
                $ses_data = [
                    'user_id'      => $data['user_id'],
                    'user_name'    => $data['user_name'],
                    'user_level'   => $data['user_level'],
                    'isLoggedIn'   => TRUE
                ];
                session()->set($ses_data);
                if ($data['user_level'] > 0 ){
                    return redirect()->to('admin/index.html');
                }
                return redirect('warga/index.html');
            } else {
                return redirect('login')->with('pesan', 'Password yang anda masukkan salah!');
            }
        } else {
            return redirect('login')->with('pesan', 'Username yang anda masukkan salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect('login');
    }
}
