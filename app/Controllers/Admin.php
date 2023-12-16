<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\LoginModel;

class Admin extends BaseController
{
    public function index()
    {
        $datamodel = new LoginModel();
        $count = $datamodel->select('user_id')
        ->where('user_level', 0)
        ->where('user_status', 'AKTIF')
        ->countAllResults();

        $data = [
            'page_title' => 'Halaman Admin',
            'page_desc' => 'Halaman ini khusus untuk admin',
            'page_key' => 'Halaman Admin',
            'jmlh_warga' => $count
        ];
        return view('admin/v_index', $data);
    }

}
