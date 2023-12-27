<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\LoginModel;
use \App\Models\KegiatanModel;

class Admin extends BaseController
{
    public function index()
    {
        $datamodel = new LoginModel();
        $count = $datamodel->select('user_id')
        ->where('user_level', 0)
        ->where('user_status', 'AKTIF')
        ->countAllResults();


        $datamodel = new KegiatanModel();
        $j_kegiatan = $datamodel->select('id_kegiatan')
        ->where('status_kegiatan', 'AKTIF')
        ->groupBy('id_kategori')
        ->countAllResults();

        $data = [
            'page_title' => 'Halaman Admin',
            'page_desc' => 'Halaman ini khusus untuk admin',
            'page_key' => 'Halaman Admin',
            'jmlh_warga' => $count,
            'jmlh_kegiatan' => $j_kegiatan
        ];
        return view('admin/v_index', $data);
    }

}
