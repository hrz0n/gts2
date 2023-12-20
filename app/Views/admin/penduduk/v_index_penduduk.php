<?= $this->extend('templates/layout') ;?>

<?= $this->section('content');?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Master Data Penduduk</h5>
                <span class="mb-2">Tambah, edit, cari dan hapus data penduduk</span>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-trash-2 close-card"></i></li>
                    </ul>
                </div>

                <div class="d-flex flex-wrap justify-content-between">
                    <div style="margin-left:-18px;" class="col-md-6 mb-1">
                        <a id="refreshdata" href="javascript:void(0);" class="btn float-left ml-1 mb-1 btn-sm btn-pill btn btn-dark"><b><i class="feather icon-rotate-ccw"></i> Refresh</b></a>
                        <a id="tambahdata" href="javascript:void(0);" class="btn float-left ml-1 mb-1 btn-sm btn-pill btn btn-primary"><b><i class="feather icon-plus"></i> Tambah</b></a>
                        <a id="cetakdata" href="javascript:void(0);" class="btn btn-sm float-left ml-1 mb-1 btn-pill btn btn-success"><b><i class="feather icon-printer"></i> Cetak</b></a>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text bg-light">
                                <span style="margin-top:-3px;" class="feather icon-search form-control-feedback"></span>
                            </div>
                            </div>
                            <input placeholder='Cari data apapun disini...' type="text" class="btn-outline-2x form-control global_filter" id="global_filter">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-block" style="margin-top:-30px;">
                <div class="table-responsive">
                    <table id="tbl-jadwal" class="table table-framed table-hover" style="width:100%">
                        <thead class="bg-light">
                            <tr>
                                <th width="20px">#</th>
                                <th width="26px">No</th>
                                <th width="1000px">Nama Lengkap<br><small class="text-muted">Alamat (Blok dan nomor)</small></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Status<br><small class="text-muted">Status Rumah</small></th>
                                <th width="400px">Aksi<br><small class="text-muted">(Edit dan Hapus)</small></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade docs-example-modal-lg" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="modal-title"><i class="cil-paper-plane text-white"></i>Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form">
                    <form id="form" class="form-horizontal" method="POST">
                        <input type="hidden" value="" name="x_id" />
                        <div class="form-body">                            
                            <div class="form-group form-group-sm row">
                                <label for="nama_depan" class="col-sm-3 col-form-label"><b>Nama Depan</b><span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input placeholder="Nama Depan" id="nama_depan" class="form-control" type="text" name="nama_depan" value="" required>
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="nama_belakang" class="col-sm-3 col-form-label"><b>Nama Belakang</b></label>
                                <div class="col-sm-9">
                                    <input placeholder="Nama Belakang" id="nama_belakang" class="form-control" type="text" name="nama_belakang" value="">
                                </div>
                            </div>

                            <div style="margin-top:-4px;" class="form-group form-group-sm row">
                                <label for="jk" class="col-sm-3 col-form-label"><b>Jenis Kelamin</b><span class="text-danger">*</span></label>
                                <div id="jenisk" class="col-sm-9">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input"  type="radio" value="L" name="jk">
                                        <label class="form-check-label" for="jk">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" type="radio" value="P" name="jk">
                                        <label class="form-check-label"  for="jk">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="email" class="col-sm-3 col-form-label"><b>Email</b></label>
                                <div class="col-sm-9">
                                    <input placeholder="Email, Ex: harison@gmail.com" id="email" class="form-control" type="text" name="email" value="">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="tmpt_lahir" class="col-sm-3 col-form-label"><b>Tempat Lahir</b></label>
                                <div class="col-sm-9">
                                    <input placeholder="Tempat lahir, Ex : Muara Mais" id="tmpt_lahir" class="form-control" type="text" name="tmpt_lahir" value="">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label"><b>Tanggal Lahir</b></label>
                                <div class="col-sm-4">
                                    <input placeholder="Tanggal lahir" id="tgl_lahir" class="form-control" type="date" name="tgl_lahir" value="<?= date('Y-m-d') ?>">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="no_hp" class="col-sm-3 col-form-label"><b>Nomor Hp</b></label>
                                <div class="col-sm-9">
                                    <input placeholder="No Hp, Ex: 0987618171" id="no_hp" class="form-control" type="text" name="no_hp" value="">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="alamat" class="col-sm-3 col-form-label"><b>Alamat</b></label>
                                <div class="col-sm-9">
                                    <textarea placeholder="Alamat, Ex: Perumahan Griya Tanjung Payang Sejahtera 2" id="alamat" class="form-control" type="text" name="alamat" value=""></textarea>
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="blok" class="col-sm-3 col-form-label"><b>Blok Rumah</b></label>
                                <div class="col-sm-9">
                                    <select id="blok" name="blok" class="form-control">
                                        <?php
                                        $dataBlok = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                                        foreach ($dataBlok as $key => $value) {
                                            echo "<option value='".$value."'>".$value."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="nomor" class="col-sm-3 col-form-label"><b>Nomor Rumah</b></label>
                                <div class="col-sm-9">
                                    <input placeholder="Nomor, Ex : 10" id="nomor" class="form-control" type="text" name="nomor" value="">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="nomor_kk" class="col-sm-3 col-form-label"><b>Nomor KK</b></label>
                                <div class="col-sm-9">
                                    <input placeholder="Nomor KK, Ex : 19878772887728820001" id="nomor_kk" class="form-control" type="text" name="nomor_kk" value="">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="jmlh_jiwa" class="col-sm-3 col-form-label"><b>Jumlah Jiwa<span class="text-danger">*</span></b></label>
                                <div class="col-sm-9">
                                    <select id="jmlh_jiwa" name="jmlh_jiwa" class="form-control">
                                        <?php
                                            for ($i=1; $i < 11 ; $i++) { 
                                                echo "<option value='".$i."'>".$i."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="status_rumah" class="col-sm-3 col-form-label"><b>Status Rumah<span class="text-danger">*</span></b></label>
                                <div class="col-sm-9">
                                    <select id="status_rumah" name="status_rumah" class="form-control">
                                        <option value="TETAP">Milik Sendiri</option>
                                        <option value="KONTRAK">Kontrak</option>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="status_penduduk" class="col-sm-3 col-form-label"><b>Status Penduduk<span class="text-danger">*</span></b></label>
                                <div class="col-sm-6">
                                    <select id="status_penduduk" name="status_penduduk" class="form-control">
                                        <option value="AKTIF">Aktif</option>
                                        <option value="TIDAK AKTIF">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                <p class="float-left">Semua tanda (<span class="text-danger">*</span>) wajib diisi!</p>
                    <button type="button" class="btn-pill btn btn-warning" data-dismiss="modal"><i class="feather icon-rotate-ccw"></i> Batal</button>
                    <button id="simpanData" name="simpanData" type="button" class="btn btn-primary btn-pill"><b><i class="feather icon-navigation"></i> Simpan</b></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modal-title-hapus" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-delete" class="form-horizontal" method="POST">
                    <input type="hidden" value="" name="x_id_hapus" />
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="modal-title-hapus"><i class="cil-trash"></i> Hapus Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Data yang telah dihapus tidak bisa dikembalikan, Apakah kaka yakin untuk menghapus data ini?
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="float-left ml-1 btn-pill btn btn-secondary" data-dismiss="modal"><i class="feather icon-rotate-ccw"></i> Batal</button>
                        <button type="button" class="float-left ml-1 btn-pill btn btn-danger " id="delete-confirm-button"><i class="feather icon-trash-2 close-card"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmCetak" tabindex="-1" role="dialog" aria-labelledby="modal-title-hapus" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-cetak" class="form-horizontal" method="POST">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title" id="modal-title-cetak"><i class="feather icon-printer"></i> Cetak Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-group-sm row">
                            <label for="c_kat" class="col-sm-3 col-form-label"><b>Kategory<span class="text-danger">*</span></b></label>
                            <div class="col-sm-9">
                                <select id="c_kat" name="c_kat" class="form-control">
                                    <option value='0'>Semua Kategory</option>
                                    <option value='TETAP'>RUMAH SENDIRI</option>
                                    <option value='KONTRAK'>KONTRAK</option>
                                </select>
                            </div>
                        </div>

                        <div style="margin-top:-12px;" class="form-group form-group-sm row">
                            <label for="c_blok" class="col-sm-3 col-form-label"><b>Blok<span class="text-danger">*</span></b></label>
                            <div class="col-sm-9">
                                <select id="c_blok" name="c_blok" class="form-control">
                                    <option value='0'>Semua Blok</option>
                                    <?php 
                                    $dataBlok = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                                    foreach ($dataBlok as $key => $value) {
                                        echo "<option value='".$value."'>".$value."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div style="margin-top:-12px;" class="form-group form-group-sm row">
                            <label for="c_warga" class="col-sm-3 col-form-label"><b>Warga<span class="text-danger">*</span></b></label>
                            <div class="col-sm-9">
                                <select id="c_warga" name="c_warga" class="form-control">
                                    <option value='0'>Semua Warga</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="float-left ml-1 btn-pill btn btn-secondary" data-dismiss="modal"><i class="feather icon-rotate-ccw"></i> Batal</button>
                        <a onClick="cetakPDF()" href="javascript:void(0);" class="float-left ml-1 btn-pill btn btn-success " id="cetak-pdf-confirm-button"><i class="feather icon-printer"></i> Ekspor PDF</a>
                    </div>
                </form>
            </div>
        </div>
    </div>



     <?= $this->endSection();?>
     <?= $this->section('scripts');?>

<script type="text/javascript">
    var table;
    var save_method;
    var idblok=0;
    var idkat=0;

    var urlserver = "<?= base_url('admin/master/penduduk/');?>";

  $(document).ready(function() {
    getPenduduk(idkat, idblok);

    $('#c_blok').change(function () {
		idblok = $('#c_blok').val();
        getPenduduk(idkat, idblok);
	});

    $('#c_kat').change(function () {
		idkat = $('#c_kat').val();
        getPenduduk(idkat, idblok);
	});

    $('#refreshdata').click(function(){
  	    $('#tbl-jadwal').DataTable().ajax.reload();
    });

    $('#cetakdata').click(function(){
        $('#status_rumah').val("TETAP").trigger('change');
        $('#status_penduduk').val("AKTIF").trigger('change');
        $('#jmlh_jiwa').val("1").trigger('change');
        $('#confirmCetak').modal('show');
    });

    $('#tambahdata').click(function(){
        save_method = 'add';
        $('#modal_form').trigger('reset');
        $('#form')[0].reset();
        $('[name="x_id"]').val();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $('input[type=radio][name="jk"][value=L]').prop('checked', true);
        $('#status_rumah').val("TETAP").trigger('change');
        $('#status_penduduk').val("AKTIF").trigger('change');
        $('#jmlh_jiwa').val("1").trigger('change');
        $('#modal-title').text('Tambah data warga');
        $('#modal_form').modal('show');
    });

    $('#modal_form').on('hidden.bs.modal', function () {
        $('#modal_form').trigger('reset');
        $('#form')[0].reset();
    });

	$('#modal_form').on('shown.bs.modal', function () {
        $('#nama_depan').focus();
	});

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    });

    $('#simpanData').click(function(){
        var url;
        if(save_method == 'add') {
            url = urlserver+"simpan";
        } else {
            url = urlserver+"edit";
        }
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.error) {
                    swal({
                        title: "Error!",
                        text: "Oupppssss...."+data.message,
                        icon: "error",
                    });
                } else {
                    swal({
                        title: "Pakam kak!",
                        text: "Data berhasil disimpan!",
                        icon: "success",
                    });
                    $('#modal_form').modal('hide');
                }
                
                $('#tbl-jadwal').DataTable().ajax.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                swal({
                    title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server, silahkan coba kembali!",
                    icon: "error",
                });
                $('#modal_form').modal('hide');
                $('#tbl-jadwal').DataTable().ajax.reload();
            }
        });

    });

    $('#delete-confirm-button').click(function(){
        $.ajax({
            url : urlserver+"hapus",
            type: "POST",
            data: $('#form-delete').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.error) {
                    swal({
                        title: "Error!",
                        text: "Oupppssss...."+data.message,
                        icon: "error",
                    });
                } else {
                    swal({
                        title: "Pakam kak!",
                        text: data.message,
                        icon: "success",
                    });
                }
                $('#confirmDelete').modal('hide');
                $('#tbl-jadwal').DataTable().ajax.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                swal({
                    title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server, silahkan coba kembali!",
                    icon: "error",
                });
                $('#confirmDelete').modal('hide');
                $('#tbl-jadwal').DataTable().ajax.reload();
            }
        });

    });

    table = $('#tbl-jadwal').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        bDestroy: true,
        olReorder: true,
        order:[],
        dom: 'tip',
        ordering:true,
        searching: true,
        ajax: '<?= base_url('admin/master/penduduk/index_ajax');?>',
        pageLength: 40,
        language: {
            'search': "Filter Data",
            'loadingRecords': 'Sedang memuat data, mohon tunggu sebentar...',
            'processing': 'Sedang memuat data, mohon tunggu sebentar...'
        },
        fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            var h_nik = '';
            if (aData[7] != '') {
                h_nik = '[ '+aData[7]+' ]';
            }
			table.cell( nRow, 2 ).data('<b>'+aData[3]+" "+aData[4]+ "</b> "+ h_nik +'<br><small class="text-muted">Blok '+aData[5]+' No.'+aData[6]+'</small>');
            var kat = "Kontrak";
            if (aData[8] == "TETAP") {
                kat = "Milik Sendiri"
            }
            table.cell( nRow, 8 ).data('<small>'+kat+'</small>');
        },

        columnDefs :[
        {
            'targets': [0],
            "orderable":false,
            'searchable': false,
            'className': 'text-center align-middle',
            'checkboxes':
            {
                'selectRow': false
            }
        },
        {
            "targets": 1,
            'className': 'text-center align-middle',
            "orderable":true,
        },
        {
            "targets": 2,
            'className': 'align-middle',
            "orderable":true,
            'searchable': true,
        },
        {
            "targets": 3,
            'className': 'text-center align-middle',
            "visible" : false,
            'searchable': true,
        },
        {
            "targets": 4,
            "visible" : false,
            'searchable': true,
        },
        {
            "targets": 5,
            "visible" : false,
            'searchable': true,
        },
        {
            "targets": 6,
            "visible" : false,
            'searchable': true,
        },
        {
            "targets": 7,
            "visible" : false,
            'searchable': true,
        },
        {
            "targets": 8,
            'className': 'align-middle',
            "orderable":true,
            'searchable': true,
        },
        {
            "targets": -1,
            'className': 'text-center align-middle',
            "orderable":false,
            'searchable': false,
        },

      ],
      select:
      {
        'style': 'multi',
        'selector': 'td:first-child'
      },
      order: [[1, 'DESC']]

    });

    table.on( 'draw draw.dt order.dt search.dt', function () {
        var PageInfo = $('#tbl-jadwal').DataTable().page.info();
        table.column(1, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start+".";
        });

    });
});

function filterGlobal () {
    $('#tbl-jadwal').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}

function tblEdit(user_id) {
    save_method = 'update';
    var idgroup = [];
    var r_data = table.row($(this).parents('tr')).data();
    $('#form')[0].reset();
      $.ajax({
        url : urlserver+"detail/"+user_id,
        type: "POST",
        data:'x_id='+r_data[0],
        dataType: "JSON",
        success: function(data) {
          $('[name="x_id"]').val(data.x_id);
          $('[name="x_name"]').val(data.x_name);
          $('[name="x_password"]').val('flyexam');
          $('[name="x_email"]').val(data.x_email);
          $('[name="x_f_name"]').val(data.x_f_name);
          $('[name="x_l_name"]').val(data.x_l_name);
          $('[name="x_level"]').val(data.x_level);
          $('[name="x_tmpt_lahir"]').val(data.x_birthplace);
          $('[name="x_tgllahir"]').val(data.x_birthdate);
          $('#x_level').val(data.x_level).trigger('change');
          $('input[type=radio][name="jk"][value="'+data.x_jk+'"]').prop('checked', true);

          $('#modal-title').text('Update data warga');
          $('#modal_form').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown){
            swal({  title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server!",
                    icon: "error",
                });
        }
    });


}

function tblDetail(user_id) {
    save_method = 'update';
    $('#form')[0].reset();
      $.ajax({
        url : urlserver+"detail/"+user_id+".html",
        type: "POST",
        data:'',
        dataType: "JSON",
        success: function(data) {
            $('[name="x_id"]').val(user_id);
            $('[name="nama_depan"]').val(data.data['user_firstname']);
            $('[name="nama_belakang"]').val(data.data['user_lastname']);
            $('input[type=radio][name="jk"][value="'+data.data['user_gender']+'"]').prop('checked', true);
            $('[name="email"]').val(data.data['user_email']);
            $('[name="tmpt_lahir"]').val(data.data['user_birthplace']);
            $('[name="tgl_lahir"]').val(data.data['user_birthdate']);
            $('[name="no_hp"]').val(data.data['no_hp']);
            $('[name="alamat"]').val(data.data['alamat']);
            $('[name="blok"]').val(data.data['blok']);
            $('[name="nomor"]').val(data.data['nomor']);
            $('[name="nomor_kk"]').val(data.data['no_kk']);
            $('#jmlh_jiwa').val(data.data['jmlh_jiwa']).trigger('change');
            $('#status_rumah').val(data.data['kategori_user']).trigger('change');
            $('#status_penduduk').val(data.data['user_status']).trigger('change');
            $('#modal-title').html('Update data warga <b>'+ data.data['user_firstname']+' '+data.data['user_lastname']+'</b>');
            $('#modal_form').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown){
            swal({  title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server!",
                    icon: "error",
                });
        }
    });


}

function tblHapus(user_id) {
    $('[name="x_id_hapus"]').val(user_id);
    $('#modal-title-hapus').text('Hapus data warga');
    $('#confirmDelete').modal('show');
}

function getPenduduk(kat, blok) {
    $.ajax({
        url : urlserver+"index_filter/"+kat+"/"+blok,
        type: "GET",
        data:'',
        dataType: "JSON",
        success: function(data) {
            var s = '';
            s += '<option value="0">Semua Warga</option>';
            for (var i = 0; i < data.data.length; i++) {
            s += '<option value="' + data.data[i]['user_id'] + '">'+ data.data[i]['user_firstname'] + ' ' + data.data[i]['user_lastname']+ ' ('+data.data[i]['blok'] +''+data.data[i]['nomor']+' )' +'</option>';
            }
            $("#c_warga").html(s);

        },
        error: function (jqXHR, textStatus, errorThrown){
            swal({  title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server!",
                    icon: "error",
                });
        }
    });
}

function cetakPDF() {

    var kat = $('#c_kat').val();
    var blok = $('#c_blok').val();
    var user_id = $('#c_warga').val();

    window.location = urlserver+"cetak/pdf/"+kat+"/"+blok+"/"+user_id;
}
</script>


<?= $this->endSection();?>