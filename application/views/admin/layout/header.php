<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/admin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <?php 
        $about = $this->db->get_where('m_about', ['id'=>1])->row();
    ?>
    <link rel="shortcut icon" href="<?= $about->logo ?>" type="image/x-icon">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/admin/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/admin/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    
    <!-- Page level plugins -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.css');?>">
    <script src="<?= base_url('assets/admin/vendor/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/vendor/daterangepicker/moment.min.js')?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/daterangepicker/daterangepicker.css')?>" />
    <script type="text/javascript" src="<?= base_url('assets/admin/vendor/daterangepicker/daterangepicker.min.js')?>"></script>

    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/select2/select2.min.css?n=1')?>" />
    <script type="text/javascript" src="<?= base_url('assets/admin/vendor/select2/select2.min.js')?>"></script>

    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/toasts/iziToast.css')?>" />
    <script type="text/javascript" src="<?= base_url('assets/admin/vendor/toasts/iziToast.js')?>"></script>

    
    <script src="<?= base_url('assets/admin/vendor/swal/sweetalert2@10.js') ?>"></script>

    <script>
        function showLoad(){
            let style = {
                "pointer-events" : "none",
                "opacity" : 0.6
            }
            $('.content').css(style);
            $('.load').addClass('loader');
        }

        function hideLoad(){
            $('.content').removeAttr('style');
            $('.load').removeClass('loader');
        }

        function scrollUp(elm){
            $([document.documentElement, document.body]).animate({
                scrollTop: $(elm).offset().top
            }, 1000);
        }

        function formatCurrency(amount, decimalCount = 2, decimal = ",", thousands = ".") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands);
            } catch (e) {
                console.log(e)
            }
        }

    </script>

</head>
<?php 
    $sidebar_toggled = $this->session->userdata('sidebar_toggled');
?>
<body id="page-top" class="<?= $sidebar_toggled == 'true' ? 'sidebar-toggled' : '' ?>">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion <?= $sidebar_toggled == 'true' ? 'toggled' : '' ?>" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= $about->logo ?>" alt="" class="img-fluid" width="50">
                </div>
                <div class="sidebar-brand-text mx-3">Masjid Baiturrahman</div>
            </a>

            <?php  
                $segment2 = $this->uri->segment(2);
                $segment3 = $this->uri->segment(3);
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($segment2=='dashboard') echo 'active' ?>">
                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item - User -->
            <!-- <li class="nav-item <?php if($segment2=='user') echo 'active' ?>">
                <a class="nav-link" href="<?= base_url('admin/user') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span>
                </a>
            </li> -->

            <!-- Nav Item - Jamaah -->
            <li class="nav-item <?php if($segment2=='jamaah') echo 'active' ?>">
                <a class="nav-link" href="<?= base_url('admin/jamaah') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Jamaah</span>
                </a>
            </li>

            <!-- Nav Item - Transaksi -->
            <li class="nav-item <?php if($segment2=='transaction') echo 'active' ?>">
                <a class="nav-link" href="<?= base_url('admin/transaction') ?>">
                    <i class="fas fa-fw fa-calculator"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <!-- Nav Item - Pengeluaran -->
            <li class="nav-item <?php if($segment2=='pengeluaran') echo 'active' ?>">
                <a class="nav-link" href="<?= base_url('admin/pengeluaran') ?>">
                    <i class="fas fa-fw fa-outdent"></i>
                    <span>Pengeluaran</span>
                </a>
            </li>

            <!-- Nav Item - Tabungan Qurban -->
            <li class="nav-item <?php if($segment2=='tabungan_qurban') echo 'active' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTabunganQurban"
                    aria-expanded="true" aria-controls="collapseTabunganQurban">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Tabungan Qurban</span>
                </a>
                <div id="collapseTabunganQurban" class="collapse <?php if($segment2=='tabungan_qurban') echo 'show' ?>" aria-labelledby="headingTabunganQurban"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if($segment3=='group') echo 'active' ?>" href="<?= base_url('admin/tabungan_qurban/group') ?>">Group Qurban</a>
                        <a class="collapse-item <?php if($segment3=='hewan') echo 'active' ?>" href="<?= base_url('admin/tabungan_qurban/hewan') ?>">Hewan Qurban</a>
                        <a class="collapse-item <?php if($segment3=='tabungan') echo 'active' ?>" href="<?= base_url('admin/tabungan_qurban/tabungan') ?>">Tabungan</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pengaturan Web -->
            <li class="nav-item <?php if($segment2=='pengaturan_web') echo 'active' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturanWeb"
                    aria-expanded="true" aria-controls="collapsePengaturanWeb">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan Web</span>
                </a>
                <div id="collapsePengaturanWeb" class="collapse <?php if($segment2=='pengaturan_web') echo 'show' ?>" aria-labelledby="headingPengaturanWeb"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if($segment3=='about') echo 'active' ?>" href="<?= base_url('admin/pengaturan_web/about') ?>">About</a>
                        <a class="collapse-item <?php if($segment3=='kegiatan') echo 'active' ?>" href="<?= base_url('admin/pengaturan_web/kegiatan') ?>">Kegiatan</a>
                        <a class="collapse-item <?php if($segment3=='banner') echo 'active' ?>" href="<?= base_url('admin/pengaturan_web/banner') ?>">Banner</a>
                        <a class="collapse-item <?php if($segment3=='pengurus') echo 'active' ?>" href="<?= base_url('admin/pengaturan_web/pengurus') ?>">Pengurus</a>
                        <a class="collapse-item <?php if($segment3=='berita') echo 'active' ?>" href="<?= base_url('admin/pengaturan_web/berita') ?>">Berita</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= strtoupper($userdata->username) ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/admin/img/undraw_profile.svg') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">