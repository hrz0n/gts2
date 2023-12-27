<?= $this->extend('templates/layout') ;?>

<?= $this->section('content');?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Master Data Transaksi Masuk</h5>
                <span class="mb-2">Tambah, edit, cari dan hapus data transaksi masuk</span>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-trash-2 close-card"></i></li>
                    </ul>
                </div>
            </div>

            <div class="card-block">
                <div style="margin-top:-12px;" class="form-group form-group-sm row">
                    <label for="email" class="col-sm-3 col-form-label"><b>Nama Warga<span class="text-danger">*</span></b></label>
                    <div class="col-sm-9">
                        <select name="nama_warga" id="nama_warga" class="form-control select2">
                            <option value="0">Pilih Nama Warga</option>
                        </select>
                    </div>
                </div>

                <div style="margin-top:-12px;" class="form-group form-group-sm row">
                    <label for="nama_kegiatan" class="col-sm-3 col-form-label"><b>Kegiatan<span class="text-danger">*</span></b></label>
                    <div class="col-sm-9">
                        <select name="nama_kegiatan" id="nama_kegiatan" class="form-control select2">
                            <option value="0">Pilih Nama Kegiatan</option>
                        </select>
                    </div>
                </div>

                <div style="margin-top:-12px;" class="form-group form-group-sm row">
                    <label for="periode_thn" class="col-sm-3 col-form-label"><b>Tahun<span class="text-danger">*</span></b></label>
                    <div class="col-sm-9">
                        <select name="periode_thn" id="periode_thn" class="form-control select2">
                        </select>
                    </div>
                </div>
                <div style="margin-top:-12px;" class="form-group form-group-sm row">
                    <label for="tmbl_tampilkan" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-grid gap-2">
                            <button
                                type="button"
                                name="tmbl_tampilkan"
                                id="tmbl_tampilkan"
                                class="btn btn-primary"><i class="feather icon-rotate-ccw"></i>
                                Tampilkan Data
                            </button>
                        </div>
                        
                    </div>
                </div>


                <div id="detail-pembayaran" class="table-responsive d-none">
                    <table id="tbl-jadwal" class="table table-framed table-hover" style="width:100%">
                        <thead class="bg-light">
                            <tr>
                                <th width="16px">No</th>
                                <th width="200px">Periode Bulan</th>
                                <th></th>
                                <th width="100px">Dibayar</th>
                                <th width="200px">Keterangan</th>
                                <th width="200px">Aksi</th>
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
                                <label for="nama_depan" class="col-sm-12 col-form-label"><b>Nama Lengkap Warga</b><span class="text-danger">*</span></label>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="nama_belakang" class="col-sm-12 col-form-label"><b>Nama Kegiatan Tahun 2023</b></label>
                            </div>


                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="jmlh_bayar" class="col-sm-3 col-form-label"><b>Jumlah Bayar</b></label>
                                <div class="col-sm-9">
                                    <input placeholder="Jumlah yg akan di bayar, ex : 5000" id="jmlh_bayar" class="form-control" type="text" name="jmlh_bayar" value="">
                                </div>
                            </div>

                            <div style="margin-top:-12px;" class="form-group form-group-sm row">
                                <label for="tgl_pembayaran" class="col-sm-3 col-form-label"><b>Tanggal Pembayaran</b></label>
                                <div class="col-sm-4">
                                    <input placeholder="Tanggal pembayaran" id="tgl_pembayaran" class="form-control" type="date" name="tgl_pembayaran" value="<?= date('Y-m-d') ?>">
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
    var user_id=0;
    var id_kat_kegiatan=0;
    var thn =0;

    var urlserver = "<?= base_url('admin/master/transaksi-masuk/');?>";

  $(document).ready(function() {

    // getPenduduk(idkat, idblok);
    getPenduduk();
    getKegiatan();
    tahun();
    // loadTagihan(86, 2, 2023)

    $('#tmbl_tampilkan').click(function(){
        user_id = $('#nama_warga').val();
        id_kat_kegiatan = $('#nama_kegiatan').val();
        thn = $('#periode_thn').val();

        if (user_id == 0 || id_kat_kegiatan == 0) {
            swal({  title: "Error!",
                    text: "Oupppssss.... Silahkan pilih nama penduduk dan kegiatan terlebih dahulu!",
                    icon: "error",
                });
        } else {
            loadTagihan(user_id, id_kat_kegiatan, thn);
            $('#detail-pembayaran').removeClass('d-none');
        }
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


    $('#tbl-jadwal tbody').on( 'click', '.btnBayarTagihan', function () {
  		var data = table.row( $(this).parents('tr') ).data();
        var afterText = getFromBetween.get(data[1],"<b>","</b>");
        $('#modal-title').text('Tambah data warga'+ afterText);
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


});

function loadTagihan(user_id, id_kat_kegiatan, thn) {
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
        ajax: urlserver+"getTagihan/"+user_id+"/"+id_kat_kegiatan+"/"+thn,
        pageLength: 40,
        language: {
            'search': "Filter Data",
            'loadingRecords': 'Sedang memuat data, mohon tunggu sebentar...',
            'processing': 'Sedang memuat data, mohon tunggu sebentar...'
        },
        fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            table.cell( nRow, 1 ).data("<b>"+aData[1].toUpperCase()+"</b>"+'<br>'+aData[2]);
        },

        columnDefs :[
        {
            "targets": 1,
            'className': 'text-left align-middle',
            "orderable":true,
            'searchable': true,
        },
        {
            "targets": 2,
            "visible" : false
        },
        {
            "targets": 3,
            'className': 'text-left align-middle',
            "orderable":true,
            'searchable': true,
        },

        {
            "targets": 4,
            'className': 'text-center align-middle',
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
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start+".";
        });

    });
}

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

function getPenduduk() {
    $.ajax({
        url : "<?= base_url('admin/master/penduduk/index_filter/0/0');?>",
        type: "GET",
        data:'',
        dataType: "JSON",
        success: function(data) {
            var s = '';
            s += '<option value="0">Pilih Warga</option>';
            for (var i = 0; i < data.data.length; i++) {
            s += '<option value="' + data.data[i]['user_id'] + '">'+ data.data[i]['user_firstname'] + ' ' + data.data[i]['user_lastname']+ ' ('+data.data[i]['blok'] +''+data.data[i]['nomor']+' )' +'</option>';
            }
            $("#nama_warga").html(s);

        },
        error: function (jqXHR, textStatus, errorThrown){
            swal({  title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server!",
                    icon: "error",
                });
        }
    });
}

function getKegiatan() {
    $.ajax({
        url : "<?= base_url('admin/master/anggota/getkegiatan/0');?>",
        type: "GET",
        data:'',
        dataType: "JSON",
        success: function(data) {
            var s = '';
            s += '<option value="0">Pilih kegiatan</option>';
            for (var i = 0; i < data.data.length; i++) {
            s += '<option value="' + data.data[i]['id_kategori'] + '">'+ data.data[i]['nama_kegiatan'] + ' ('+data.data[i]['tipe_bayar'] +' - '+data.data[i]['metode_bayar']+' )' +'</option>';
            }
            $("#nama_kegiatan").html(s);
        },
        error: function (jqXHR, textStatus, errorThrown){
            swal({  title: "Error!",
                    text: "Oupppssss.... Error saat mencoba menghubungi server!",
                    icon: "error",
                });
        }
    });
}

function tahun() {
    var currentTime = new Date();
    var year = currentTime.getFullYear();
    var s = '';
    var y = 4;
    var z = 0;

    var selected = '';
    for (let index = 0; index < 7; index++) {
        y--;
        if (y <= 0 ) {
            var strTahun = (year + z);
            if (strTahun == year) {
                selected = ' selected="selected" ';
            } else {
                selected = '';
            }
            s += '<option '+selected+' value="'+strTahun+'">'+strTahun+'</option>';
            z++;
        } else {
            var strTahun = (year - y);
            s += '<option '+selected+' value="'+strTahun+'">'+strTahun+'</option>';
        }
    }
    $("#periode_thn").html(s);
}

function cetakPDF() {

    var kat = $('#c_kat').val();
    var blok = $('#c_blok').val();
    var user_id = $('#c_warga').val();

    window.location = urlserver+"cetak/pdf/"+kat+"/"+blok+"/"+user_id;
}

var getFromBetween = {
  results:[],
  string:"",
  getFromBetween:function (sub1,sub2) {
      if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
      var SP = this.string.indexOf(sub1)+sub1.length;
      var string1 = this.string.substr(0,SP);
      var string2 = this.string.substr(SP);
      var TP = string1.length + string2.indexOf(sub2);
      return this.string.substring(SP,TP);
  },
  removeFromBetween:function (sub1,sub2) {
      if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
      var removal = sub1+this.getFromBetween(sub1,sub2)+sub2;
      this.string = this.string.replace(removal,"");
  },
  getAllResults:function (sub1,sub2) {
      // first check to see if we do have both substrings
      if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return;

      // find one result
      var result = this.getFromBetween(sub1,sub2);
      // push it to the results array
      this.results.push(result);
      // remove the most recently found one from the string
      this.removeFromBetween(sub1,sub2);

      // if there's more substrings
      if(this.string.indexOf(sub1) > -1 && this.string.indexOf(sub2) > -1) {
          this.getAllResults(sub1,sub2);
      }
      else return;
  },
  get:function (string,sub1,sub2) {
      this.results = [];
      this.string = string;
      this.getAllResults(sub1,sub2);
      return this.results;
  }
};
</script>


<?= $this->endSection();?>