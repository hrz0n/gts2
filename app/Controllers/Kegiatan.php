<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable; 
use \App\Models\KegiatanModel;
use App\ThirdParty\FPDF;

class Kegiatan extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'Data Kegiatan - Master Data ',
            'page_desc' => 'Data Kegiatan - Master Data ',
            'page_key' => 'Data Kegiatan - Master Data ',
            'kategory' => ''
        ];
        return view('admin/kegiatan/v_index_kegiatan', $data);
    }

    public function getDataAjax()
    {
        if (session()->get('user_level') > 0 && session()->get('isLoggedIn')) {
            $datamodel = new KegiatanModel();
            $builder = $datamodel->select('id_kegiatan,id_kegiatan,nama_kegiatan,deskripsi_kegiatan,biaya,metode_bayar,tipe_bayar,status_kegiatan')
                    ->orderBy('tipe_bayar ASC', 'nama_kegiatan ASC');
            
            return DataTable::of($builder)->add(null, function($row){
                return '<div class="btn-group btn-group-sm text-center" role="group">
                <a onClick="tblDetail('.$row->id_kegiatan.')" href="javascript:void(0);" class="btn btn-sm btn-warning"><i class="feather icon-edit"></i></a>
                <a onClick="tblHapus('.$row->id_kegiatan.')" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="feather icon-trash-2 close-card"></i></a></div>';
            })->toJson();          

        }
    }
}
