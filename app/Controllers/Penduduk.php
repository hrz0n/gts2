<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use \App\Models\LoginModel;
use App\ThirdParty\FPDF;

class Penduduk extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'Data Penduduk - Master Data ',
            'page_desc' => 'Data Penduduk - Master Data ',
            'page_key' => 'Data Penduduk - Master Data ',
            'kategory' => ''
        ];
        return view('admin/penduduk/v_index_penduduk', $data);
    }

    public function getDataAjax()
    {
        helper(['config_helper']);

        if (session()->get('user_level') > 0 && session()->get('isLoggedIn')) {
            $datamodel = new LoginModel();
            $builder = $datamodel->select('user_id,user_name,user_email,user_firstname,user_lastname,blok,nomor,no_kk,kategori_user')
                    ->where('user_level',0)
                    ->orderBy('blok ASC', 'nomor ASC');
            
            return DataTable::of($builder)->add(null, function($row){
                return '<div class="btn-group btn-group-sm text-center" role="group">
                <a onClick="tblDetail('.$row->user_id.')" href="javascript:void(0);" class="btn btn-sm btn-warning"><i class="feather icon-edit"></i></a>
                <a onClick="tblHapus('.$row->user_id.')" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="feather icon-trash-2 close-card"></i></a></div>';
            })->toJson();          

        }
    }

    public function simpan() {
        helper(['config_helper']);
        $datamodel = new LoginModel();
        if ($this->request->getPost('nama_depan') == '') {
            $error = true;
            $message = 'Field dengan tanda merah wajib diisi!!';
        } else {
            $result = $datamodel->insert([
                'user_name'   => trim(strtolower($this->request->getPost('nama_depan'))).trim(strtolower($this->request->getPost('nama_belakang'))),
                'user_password' => password_hash('12345', PASSWORD_DEFAULT),
                'user_email' => $this->request->getPost('email'),
                'user_firstname' => $this->request->getPost('nama_depan'),
                'user_lastname' => $this->request->getPost('nama_belakang'),
                'user_birthplace' => $this->request->getPost('tmpt_lahir'),
                'user_birthdate' => $this->request->getPost('tgl_lahir'),
                'user_gender' => $this->request->getPost('jk'),
                'no_kk' => $this->request->getPost('nomor_kk'),
                'jmlh_jiwa' => $this->request->getPost('jmlh_jiwa'),
                'alamat' => $this->request->getPost('alamat'),
                'blok' => $this->request->getPost('blok'),
                'nomor' => $this->request->getPost('nomor'),
                'no_hp' => $this->request->getPost('no_hp'),
                'user_level' => 0,
                'user_status' => $this->request->getPost('status_penduduk'),
                'kategori_user' => $this->request->getPost('status_rumah'),
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

    public function detail($user_id)
    {
        $datamodel = new LoginModel();
        $data = [];
        $error = true;
        $message = 'Gagal menampilkan data!';
        if ($result = $datamodel->find($user_id)) {
            $data = $datamodel->find($user_id);
            $error = false;
            $message = 'Data berhasil ditampilkan!';
        } 
        
        $output = [
            'error' => $error,
            'message'=> $message,
            'data' => $data,
        ];

        echo json_encode( $output );
    }

    public function edit() {
        helper(['config_helper']);
        $datamodel = new LoginModel();
        if ($this->request->getPost('x_id') == '' || $this->request->getPost('nama_depan') == '') {
            $error = true;
            $message = 'Field dengan tanda merah wajib diisi!!';
        } else {
            $result = $datamodel->update($this->request->getPost('x_id'),[
                'user_email' => $this->request->getPost('email'),
                'user_firstname' => $this->request->getPost('nama_depan'),
                'user_lastname' => $this->request->getPost('nama_belakang'),
                'user_birthplace' => $this->request->getPost('tmpt_lahir'),
                'user_birthdate' => $this->request->getPost('tgl_lahir'),
                'user_gender' => $this->request->getPost('jk'),
                'no_kk' => $this->request->getPost('nomor_kk'),
                'jmlh_jiwa' => $this->request->getPost('jmlh_jiwa'),
                'alamat' => $this->request->getPost('alamat'),
                'blok' => $this->request->getPost('blok'),
                'nomor' => $this->request->getPost('nomor'),
                'no_hp' => $this->request->getPost('no_hp'),
                'user_status' => $this->request->getPost('status_penduduk'),
                'kategori_user' => $this->request->getPost('status_rumah'),
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

    public function hapus() {
        helper(['config_helper']);
        $datamodel = new LoginModel();
        if ($this->request->getPost('x_id_hapus') == '') {
            $error = true;
            $message = 'Tidak dapat menemukan data yang dipilih!';
        } else {
            $result = $datamodel->delete(['user_id', $this->request->getPost('x_id_hapus')]);
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

    public function cetakWargaPDF($kat="", $blok="", $id_user=0) {
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

    public function getWargaFillter($kat, $blok, $u_id=0){
        $datamodel = new LoginModel();
        $data = [];
        if ($u_id == 0) {
            if (!$kat == 0 && !$blok == 0) {
                $data = $datamodel->select('*')
                    ->where('user_level',0)
                    ->where('kategori_user',$kat)
                    ->where('blok',$blok)
                    ->orderBy('blok ASC', 'nomor ASC')
                    ->findAll();
            } elseif (!$kat == 0 && $blok == 0) {
                $data = $datamodel->select('*')
                    ->where('user_level',0)
                    ->where('kategori_user',$kat)
                    ->orderBy('blok ASC', 'nomor ASC')
                    ->findAll();
            } elseif ($kat == 0 && !$blok == 0) {
                $data = $datamodel->select('*')
                    ->where('user_level',0)
                    ->where('blok',$blok)
                    ->orderBy('blok ASC', 'nomor ASC')
                    ->findAll();
            } else {
                $data = $datamodel->select('*')
                    ->where('user_level',0)
                    ->orderBy('blok ASC', 'nomor ASC')
                    ->findAll();
            }
        } else {
            $data = $datamodel->select('*')
                    ->where('user_id',$u_id)
                    ->findAll();
        }
        




        $output = [
            'data' => $data,
        ];

        echo json_encode( $output );
    }

}
