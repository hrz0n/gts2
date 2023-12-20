<?= $this->extend('templates/layout') ;?>

<?= $this->section('content');?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Pendaftaran Data Kegiatan</h5>
                <span class="mb-2">Tambah, edit, cari dan hapus data pendaftaran kegiatan</span>
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
                                <th width="1000px">Nama Warga<br><small class="text-muted">Alamat (Blok dan nomor)</small></th>
                                <th width="1000px">Kegiatan<br><small class="text-muted">Semua Kegiatan yang Diikuti</small></th>
                                <th width="400px">Aksi<br><small class="text-muted">(Daftarkan Anggota)</small></th>
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
                        <input type="hidden" value="" name="x_id_user_kegiatan" id="x_id_user_kegiatan"/>
                        <div class="form-body">                            
                            <div class="form-group form-group-sm row">
                                <label class="col-sm-12 col-form-label"><h4><div id="nama_modal">-</div></h4></label>
                            </div>

                            <div style="margin-top:-32px;" class="form-group form-group-sm row">
                                <label  class="col-sm-12 col-form-label text-muted"><b><div id="alamat_modal">-</div></b></label>
                            </div>

                            <div style="margin-top:-10px;" class="form-group form-group-sm row">
                                <div class="col-sm-12 table-responsive" id="daftar_kegiatan_modal">
                                    <table class='table table-sm border-less'>
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="width:20px;">#</th>
                                                <th>Kegiatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-kegiatan-modal">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>

                            <div  class="form-group form-group-sm row">
                                <label for="kegiatan" class="col-sm-3 col-form-label"><b>Kegiatan<span class="text-danger">*</span></b></label>
                                <div class="col-sm-9">
                                    <select id="kegiatan" name="kegiatan" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="biaya" class="col-sm-3 col-form-label"><b>Biaya Pendaftaran<span class="text-danger">*</span></b></label>
                                <div class="col-sm-9">
                                    <input placeholder="Biaya, Ex : 100000" id="biaya" class="form-control" type="text" name="biaya" value="0">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                <button id="simpanData" name="simpanData" type="button" class="btn btn-primary btn-pill"><b><i class="feather icon-navigation"></i> Tambah Kegiatan</b></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                <p class="float-left">Semua tanda (<span class="text-danger">*</span>) wajib diisi, isi <code>0</code> jika biaya gratis!</p>
                    <button type="button" class="btn-pill btn btn-warning" data-dismiss="modal"><i class="feather icon-rotate-ccw"></i> Selesai</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modal-title-hapus" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-delete" class="form-horizontal" method="POST">
                    <input type="hidden" value="" name="x_id_user_kegiatan_delete" />
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
                        <a target="balnk" href="<?= base_url('admin/master/penduduk/cetak/pdf');?>" class="float-left ml-1 btn-pill btn btn-success " id="cetak-pdf-confirm-button"><i class="feather icon-printer"></i> Ekspor PDF</a>
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
    var id_kegiatan=0;
    var urlserver = "<?= base_url('admin/master/anggota/');?>";

  $(document).ready(function() {

    $('#kegiatan').on('change',function() {
        id_kegiatan = $(this).val();
        $("#biaya").val(0);
        getKegiatan(id_kegiatan);
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

    $('#modal_form').on('hidden.bs.modal', function () {
        $('#modal_form').trigger('reset');
        $('#form')[0].reset();
    });

	$('#modal_form').on('shown.bs.modal', function () {
        $('#kegiatan').focus();
	});

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    });

    $('#simpanData').click(function(){
        var url;
        var user_id = $('#x_id_user_kegiatan').val();
        if(save_method == 'add') {
            url = urlserver+"simpankegiatan";
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
                        text: data.message,
                        icon: "success",
                    });
                }
                // $('#modal_form').modal('hide');
                insertTableKegiatan(user_id);
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
        var user_id = $('#x_id_user_kegiatan').val();
        $.ajax({
            url : urlserver+"hapususerkegiatan",
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

                insertTableKegiatan(user_id);
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
        // serverSide: true,
        deferRender: true,
        bDestroy: true,
        olReorder: true,
        order:[],
        dom: 'tip',
        ordering:true,
        searching: true,
        ajax:{
            'url':'<?= base_url('admin/master/anggota/index_ajax');?>',
            'type':"GET",
            'dataType': "JSON",
            'data':''
        },
        pageLength: 40,
        language: {
            'search': "Filter Data",
            'loadingRecords': 'Sedang memuat data, mohon tunggu sebentar...',
            'processing': 'Sedang memuat data, mohon tunggu sebentar...'
        },
        fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
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
            'searchable': true,
        },
        {
            "targets": 2,
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

function detailWarga(user_id) {
    insertTableKegiatan(user_id);
    getKegiatan(0);
    getDataWarga(user_id);
    save_method = 'add';
    $('[name="x_id_user_kegiatan"]').val(user_id);
    $('#modal-title').text('Detail Kegiatan Warga');
    $('#modal_form').modal('show');
}

function filterGlobal () {
    $('#tbl-jadwal').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}

function getKegiatan(id_kegiatan) {
    $.ajax({
        url : urlserver+"getkegiatan/"+id_kegiatan,
        type: "GET",
        data:'',
        dataType: "JSON",
        success: function(data) {
            if (id_kegiatan > 0) {
                $('#biaya').val(data.data[0]['pendaftaran']);
            } else {
                var s = '';
                s += '<option value="0">Pilih kegiatan</option>';
                for (var i = 0; i < data.data.length; i++) {
                s += '<option value="' + data.data[i]['id_kegiatan'] + '">'+ data.data[i]['nama_kegiatan'] + ' ('+data.data[i]['tipe_bayar'] +' - '+data.data[i]['metode_bayar']+' )' +'</option>';
                }
                $("#kegiatan").html(s);
            }

        },
        error: function (jqXHR, textStatus, errorThrown){
            swal({  title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server!",
                    icon: "error",
                });
        }
    });
}

function insertTableKegiatan(id_user) {
    $.ajax({
        url : urlserver+"getkegiatanuser/"+id_user,
        type: "GET",
        data:'',
        dataType: "JSON",
        success: function(data) {
            var s = '';
            if (data.data.length > 0) {
                var no = 0;
                for (var i = 0; i < data.data.length; i++) {
                    no++;
                    s += '<tr>';
                    s += '<td><b>'+ no+'.</b></td>';
                    s += '<td>'+ data.data[i]['nama_kegiatan']+'</td>';
                    s += '<td><a onclick="tblHapus('+ data.data[i]['id']+')" href="javascript:void(0);" class=""><i class="feather icon-trash-2 text-danger"></i></a></td>';
                    s += '</tr>';
                }
                
            } else {
                s = '<tr class="text-muted text-center"><td colspan="3">Belum terdaftar dalam kegiatan apapun</td></tr>'
            }
            $("#tbl-kegiatan-modal").html(s);
        },
        error: function (jqXHR, textStatus, errorThrown){
            swal({  title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server!",
                    icon: "error",
                });
        }
    });
}

function getDataWarga(user_id) {
    $.ajax({
        url : urlserver+"getdatawarga/"+user_id,
        type: "GET",
        data:'',
        dataType: "JSON",
        success: function(data) {
            if (data.data.length > 0) {
                var no_kk = '';
                var blok = '';
                var nomor = '';
                if (data.data[0]['no_kk'] != '') {
                    no_kk = " ["+data.data[0]['no_kk']+"]";
                }
                if (data.data[0]['blok'] != '') {
                    blok = " Blok "+data.data[0]['blok'];
                }
                if (data.data[0]['nomor'] != '') {
                    nomor = " Nomor " + data.data[0]['nomor'];
                }
                $('#nama_modal').html(data.data[0]['user_firstname'] + " " +data.data[0]['user_lastname']);
                $('#alamat_modal').html(data.data[0]['alamat'] + blok + nomor);
            }

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
    $('[name="x_id_user_kegiatan_delete"]').val(user_id);
    $('#modal-title').html('Hapus Kegiatan');
    $('#confirmDelete').modal('show');
}
</script>


<?= $this->endSection();?>