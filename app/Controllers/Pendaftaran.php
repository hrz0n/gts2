<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pendaftaran extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'Pendaftaran Penduduk - Master Data ',
            'page_desc' => 'Pendaftaran Penduduk - Master Data ',
            'page_key' => 'Pendaftaran Penduduk - Master Data ',
            'kategory' => ''
        ];
        return view('admin/pendaftaran/v_index_pendaftaran', $data);
    }
}
