<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Warga extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'Halaman User',
            'page_desc' => 'Halaman ini khusus untuk User',
            'page_key' => 'Halaman User'
        ];
        return view('warga/v_index', $data);
    }

}
