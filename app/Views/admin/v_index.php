<?= $this->extend('templates/layout') ;?>

<?= $this->section('content');?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Jendela Informasi</h5>
                <span>Informasi terkait data perumahan Gritas 2 dan sekitarnya akan dimuat disini!</span>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-trash-2 close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                


            <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Jumlah Kepala Keluarga (KK)</div>
                    <div><h1><b><?= $jmlh_warga; ?></b></h1></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <div class="chartjs-tooltip" style="opacity: 100; left: 121.5px; top: 101.831px;"><table style="margin: 0px;"><thead class="chartjs-tooltip-header"><tr style="border-width: 0px;" class="chartjs-tooltip-header-item"></tr></thead><tbody class="chartjs-tooltip-body"><tr class="chartjs-tooltip-body-item"><td style="border-width: 0px;"><span style="background: rgb(50, 31, 219); border-color: rgba(255, 255, 255, 0.55); border-width: 2px; margin-right: 10px; height: 10px; width: 10px; display: inline-block;"></span>Data warga yang <code>AKTIF</code></td></tr></tbody></table></div></div>
              </div>
            </div>
            <!-- /.col-->

          </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection();?>



<?= $this->section('scripts');?>

<?= $this->endSection();?>