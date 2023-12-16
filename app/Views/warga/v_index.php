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
                


            </div>
        </div>
    </div>
</div>

<?= $this->endSection();?>


<?= $this->section('scripts');?>

<?= $this->endSection();?>