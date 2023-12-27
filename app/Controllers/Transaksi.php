<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use \App\Models\PendaftaranModel;
use \App\Models\TransaksiModel;
use \App\Models\KegiatanModel;
use App\ThirdParty\FPDF;

class Transaksi extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'Data Transaksi Masuk - Master Data ',
            'page_desc' => 'Data Transaksi Masuk - Master Data ',
            'page_key' => 'Data Transaksi Masuk - Master Data ',
            'kategory' => ''
        ];
        return view('admin/transaksi/v_index_transaksi', $data);
    }


    public function getPendaftaran($user_id=0)
    {
        $datamodel = new PendaftaranModel();
        $where = ['id >' => 0];
        if ($user_id > 0) {
            $where['id_user_kegiatan'] = $user_id;
        } 

        $data = $datamodel->select('id_kegiatan_tr')
                ->where($where)
                ->orderBy('id_kegiatan_tr ASC')
                ->findAll();

        return $data;
    }

    public function getKegiatan($id_kat_kegiatan, $tahun)
    {
        $datamodel = new KegiatanModel();
        $data = $datamodel->select('*')
                ->where('id_kategori',$id_kat_kegiatan)
                ->where('status_kegiatan','AKTIF')
                ->where('tahun',$tahun)
                ->findAll();
        return $data;
    }

    public function getTagihan($user_id=0, $id_kat_kegiatan=0, $thn='')
    {
        $datamodel = new TransaksiModel();

        $arr_bulan = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        
        $bulanNow = date('m');
        $tahunNow = $thn;
        if (empty($thn)) {
            $tahunNow = date('Y');
        }
        

        $db = db_connect();
        $dataKegiatan = $this->getPendaftaran($user_id);
        $id_kat_kegiatan_tr = 0;
        if (count($dataKegiatan) > 0) {
            foreach ($dataKegiatan as $item) {
                if ($id_kat_kegiatan == $item['id_kegiatan_tr']) {
                    $id_kat_kegiatan_tr = $id_kat_kegiatan;
                }
            }
        }

        $tagihan_arr = [];
        $arr_kegiatan = $this->getKegiatan($id_kat_kegiatan_tr, $tahunNow);
        $id_kegiatan = 0;
        if (count($arr_kegiatan) > 0) {
            $id_kegiatan = $arr_kegiatan[0]['id_kegiatan'];
        }


        for ($i=0; $i < $bulanNow; $i++) { 

            $sqltagihan   = $db->query(
                "SELECT *, SUM(tbl_transaksi.jmlh_bayar) as jmlh_sudah_bayar FROM tbl_transaksi
                 INNER JOIN tbl_kegiatan ON tbl_kegiatan.id_kegiatan = tbl_transaksi.id_kegiatan_tr
                 WHERE tbl_transaksi.id_kegiatan_tr ='".$id_kegiatan."'
                 AND tbl_transaksi.periode_bulan ='".$arr_bulan[$i]."'
                 AND tbl_transaksi.periode_tahun = '".$tahunNow."'
                 group by tbl_transaksi.id_user_tr");
            $arr_tagihan = $sqltagihan->getResultArray();


            if (count($arr_tagihan)) {
                //lunas
                $tagihan_arr[$arr_bulan[$i]] = [
                    'nama_kegiatan' => $arr_tagihan[0]['nama_kegiatan'],
                    'biaya' => "Rp." .number_format($arr_tagihan[0]['biaya']),
                    'periode' => $arr_bulan[$i],
                    'jmlh_sudah_bayar' => "Rp." .number_format($arr_tagihan[0]['jmlh_sudah_bayar']),
                    'status' => '<span class="badge badge-success">Lunas</span>',
                    'aksi' => '<button type="button" class="btn btn-danger btn-sm"><b><i class="feather icon-trash"></i> Hapus</b></button>'
                ];
            } else {
                // belum lunas
                
                if (count($arr_kegiatan) > 0) {
                    $tagihan_arr[$arr_bulan[$i]] = [
                        'nama_kegiatan' => $arr_kegiatan[0]['nama_kegiatan'],
                        'biaya' => "Rp." .number_format($arr_kegiatan[0]['biaya']),
                        'periode' => $arr_bulan[$i],
                        'jmlh_sudah_bayar' => 0,
                        'status' => '<span class="badge badge-danger">Belum Lunas</span>',
                        'aksi' => '<a href="javascript:void(0);" class="btn btn-primary btn-sm btnBayarTagihan"><b><i class="feather icon-navigation"></i> Bayar</b></a>'
                    ];
                }
            }
        }

        $arr_finish = [];
        foreach ($tagihan_arr as $key => $value) {
            $arr_finish[] = [
                0,
                $value['periode'],
                $value['biaya'],
                $value['jmlh_sudah_bayar'],
                $value['status'],
                $value['aksi']
            ];
        }

        $output = [
            'data' => $arr_finish,
        ];

        echo json_encode( $output );
        
      
    }
}
