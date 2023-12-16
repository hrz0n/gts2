<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a title="Dashboard" href="<?= base_url('admin/index.html');?>">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                        <span class="pcoded-mtext">Master Data</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?= base_url('admin/master/penduduk.html');?>">
                                <span class="pcoded-mtext">Data Penduduk</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?= base_url('admin/master/kegiatan.html');?>">
                                <span class="pcoded-mtext">Data Kegiatan</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?= base_url('admin/master/anggota.html');?>">
                                <span class="pcoded-mtext">Pendaftaran Anggota</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                        <span class="pcoded-mtext">Transaksi</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="#">
                                <span class="pcoded-mtext">Pemasukan</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <span class="pcoded-mtext">Pengeluaran</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                        <span class="pcoded-mtext">Pengaturan</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="#">
                                <span class="pcoded-mtext">Pengaturan Umum</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="#">
                                <span class="pcoded-mtext">Update Aplikasi</span>
                            </a>
                        </li>
                    </ul>
                </li>



        </ul>

        <p class="text-center text-light mt-4"><small>Made with love by </small><b><code>hrz0n</code></b></p>
    </div>
</nav>