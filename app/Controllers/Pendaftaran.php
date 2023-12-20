<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use \App\Models\LoginModel;
use \App\Models\PendaftaranModel;
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

    public function getDataAjax()
    {
        $db = db_connect();
        $sql_user   = $db->query('SELECT * FROM tbl_user WHERE user_level = 0 ORDER BY blok,nomor,user_firstname ASC');
        $arr_user = $sql_user->getResultArray();

        $data = [];
        foreach ($arr_user as $row) {
            $sql_kegiatan   = 'SELECT * FROM tbl_user_kegiatan 
                            INNER JOIN tbl_kegiatan ON tbl_kegiatan.id_kegiatan = tbl_user_kegiatan.id_kegiatan_tr
                            WHERE tbl_user_kegiatan.id_user_kegiatan=:id:';
            $query = $db->query($sql_kegiatan, [
                'id'     => $row['user_id']
            ]);
            $arr_kegiatan = $query->getResultArray();
            $kegiatan = '';
            foreach ($arr_kegiatan as $key => $value) {
                $kegiatan .= " <span class='badge badge-primary'>".$value['nama_kegiatan'] . "</span> ";
            }
            $str_kegiatan = $kegiatan;
            if ($kegiatan == '') {
                $str_kegiatan = '<b>BELUM MENGIKUTI KEGIATAN APAPUN</b>';
            }

            $no_kk = '';
            if ($row['no_kk'] != '') {
                $no_kk = " [". $row['no_kk'] ."] ";
            }
            $r = [];
            $r[] = $row['user_id'];
            $r[] = "";
            $r[] = "<b>".$row['user_firstname']." " .$row['user_lastname']. "</b>". $no_kk."<br><small>Blok : ".$row['blok'] . " Nomor : ".$row['nomor']. " Kat : ". $row['kategori_user']."</small>";
            $r[] = $str_kegiatan;
            $r[] = "<div class='btn-group btn-group-sm' role='group'><a onClick='detailWarga(".$row['user_id'].");' class='btn btn-sm btn-warning tblEdit' href='javascript:void(0)'><i class='feather icon-edit' aria-hidden='true'></i></a></div>";

            $data[] = $r;

        }
        
        $output = array(
            "data" => $data
          );
        echo json_encode($output, JSON_PRETTY_PRINT);

        // helper(['config_helper']);

        // if (session()->get('user_level') > 0 && session()->get('isLoggedIn')) {
        //     $datamodel = new LoginModel();
        //     $builder = $datamodel->select('user_id,user_name,user_email,user_firstname,user_lastname,blok,nomor,no_kk,kategori_user')
        //             ->where('user_level',0)
        //             ->orderBy('blok ASC', 'nomor ASC');
            
        //             print_r($builder);die;
            
        //     return DataTable::of($builder)->add(null, function($row){
        //         return '<div class="btn-group btn-group-sm text-center" role="group">
        //         <a onClick="tblDetail('.$row->user_id.')" href="javascript:void(0);" class="btn btn-sm btn-warning"><i class="feather icon-edit"></i></a>
        //         <a onClick="tblHapus('.$row->user_id.')" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="feather icon-trash-2 close-card"></i></a></div>';
        //     })->toJson();          

        // }
    }

    public function simpan() {
        // helper(['config_helper']);
        $datamodel = new PendaftaranModel();
        if ($this->request->getPost('kegiatan') == 0 || $this->request->getPost('x_id_user_kegiatan')==0) {
            $error = true;
            $message = 'Warga dan kegiatan harus dipilih!!';
        } else {
            $result = $datamodel->insert([
                'id_user_kegiatan'   => $this->request->getPost('x_id_user_kegiatan'),
                'id_kegiatan_tr' => $this->request->getPost('kegiatan'),
                'biaya_pendaftaran' => $this->request->getPost('biaya'),
                'status_kegiatan' => 'AKTIF'
            ]);
    
            if($result) {
                $error = false;
                $message = 'Berhasil menyimpan data';
            } else {
                $error = true;
                $message = 'Gagal saat mencoba menyimpan data';
            }

        }

        $output = [
            'error'=> $error,
            'message' => $message
        ];

        echo json_encode( $output );
    }

    public function getKegiatanAjax($user_id)
    {
        $thn_now = date('Y');
        $datamodel = new PendaftaranModel();
        $data = [];
        if ($user_id > 0) {
            $data = $datamodel->select('*')
            ->where('id_user_kegiatan',$user_id)
            ->join('tbl_kegiatan', 'tbl_kegiatan.id_kegiatan = tbl_user_kegiatan.id_kegiatan_tr')
            ->orderBy('id ASC')
            ->findAll();
        }

        $output = [
            'data' => $data,
        ];

        echo json_encode( $output );
    }

    public function hapus() {

        $datamodel = new PendaftaranModel();
        if ($this->request->getPost('x_id_user_kegiatan_delete') == '') {
            $error = true;
            $message = 'Tidak dapat menemukan data yang dipilih!';
        } else {
            $result = $datamodel->delete(['id', $this->request->getPost('x_id_user_kegiatan_delete')]);
            if($result) {
                $error = false;
                $message = 'Berhasil menghapus data';
            } else {
                $error = true;
                $message = 'Gagal saat mencoba menghapus data';
            }

        }

        $output = [
            'error'=> $error,
            'message' => $message
        ];

        echo json_encode( $output );
    }

    public function cetakKegiatanPDF($kat="", $blok="", $id_user=0) {
        $datamodel = new LoginModel();
        $where = [
            'user_level' => 0
        ];
        $nama_file = "Rekap_Data_Warga_".date('Y')."_";
        if ($id_user > 0) {
            $where['user_id'] = $id_user;
        } 
        if ($blok != 0) {
            $where['blok'] = $blok;
            $nama_file .= $blok."_";
        }
        if ($kat != 0) {
            $where['kategori_user'] = $kat;
            $nama_file .= $kat;
        }
        if ($id_user == 0 && $blok == 0 && $kat == 0 ) {
            $nama_file .= 'ALL';
        }

        
        $data = $datamodel->select('*')
                ->where($where)
                ->orderBy('blok ASC', 'nomor ASC')
                ->findAll();

        
        $pdf = new FPDF();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(1,13);
        $pdf->SetTitle("Export Data Warga PDF");
        $pdf->AddPage('P','A4');
        $pdf->SetFont('arial','B',14);

        $tahunNow = date('Y');
        $pdf->Cell(190,7,'Data Warga Perumahan Griya Sejahtera 2',0,1,'C');
        $pdf->Cell(190,7,'Dan Kavlingan Tahun '.$tahunNow,0,1,'C');
        $pdf->Ln(4);
        $pdf->SetFont('arial','B',10);
        $pdf->Cell(15,8,'No.',1,0,'C');
        $pdf->Cell(40,8,'Nama Lengkap',1,0,'L');
        $pdf->Cell(30,8,'Nomor KK',1,0,'L');
        $pdf->Cell(15,8,'JK',1,0,'C');
        $pdf->Cell(30,8,'Kategori',1,0,'C');
        $pdf->Cell(60,8,'Alamat',1,0,'L');
        $pdf->Ln();
        $pdf->SetFont('arial','',10);
        $no = 0;
        $kat = "Rumah Sendiri";
        foreach($data as $row){
            $blok = '';
            $nomor = '';
            if (!empty($row['blok'])) {
                $blok = ' Blok '. $row['blok'];
            }

            if (!empty($row['nomor'])) {
                $nomor = ' No. '. $row['nomor'];
            }

            $no++;
            if ($row['kategori_user'] == 'KONTRAK') {
                $kat = 'Kontrak';
            }
            $pdf->Cell(15,6,$no,'LRTB',0,'C');
            $pdf->Cell(40,6,$row['user_firstname']." ".$row['user_lastname'],'LRTB',0,'L');
            $pdf->Cell(30,6,$row['no_kk'],'LRTB',0,'L');
            $pdf->Cell(15,6,$row['user_gender'],'LRTB',0,'C');
            $pdf->Cell(30,6,$kat,'LRTB',0,'C');
            $pdf->Cell(60,6,$row['alamat'].$blok.$nomor,'LRTB',1,'L');
        }
        $pdf->Ln(8);
        $dataNow = date('d-m-Y');
        $pdf->SetFont('arial','B',10);
        $pdf->Cell(130,6,'',0);
        $pdf->Cell(50,10,'Lahat, '. $dataNow,'',1);
        $pdf->Cell(130,3,'',0);
        $pdf->Cell(50,3,'Mengetahui','',1);
        $pdf->Cell(130,6,'',0);
        $pdf->Cell(50,8,'Ketua Lingkungan','',1);
        $pdf->Cell(130,40,'',0);
        $pdf->Cell(50,40,'SUKMAN','',1);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('D',$nama_file.'.pdf');

    }
}
