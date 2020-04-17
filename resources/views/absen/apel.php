
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Ality - Admin Dashboard Template</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/app.min.css">
<!--    <link rel="stylesheet" href="--><?//= asset('webcam') ?><!--/style.css">-->
    <script type="text/javascript" src="<?= asset('webcam') ?>/adapter.min.js"></script>
    <script type="text/javascript" src="<?= asset('webcam') ?>/vue.min.js"></script>
    <script type="text/javascript" src="<?= asset('webcam') ?>/instascan.min.js"></script>
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />

</head>

<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i
                                class="fas fa-bars"></i></a></li>
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i class="fas fa-expand"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav navbar-right">

                <li class="dropdown"><a href="#" data-toggle="dropdown"
                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?= asset('/') ?>/assets/img/user.png" class="user-img-radious-style">
                        <span class="d-sm-none d-lg-inline-block"></span></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Hello Sarah Smith</div>
                        <a href="profile.html" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <a href="timeline.html" class="dropdown-item has-icon">
                            <i class="fas fa-bolt"></i> Activities
                        </a>
                        <a href="#" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="auth-login.html" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html">
                        <img alt="image" src="<?= asset('/') ?>/assets/img/logo.png" class="header-logo" />
                        <span class="logo-name">Ality</span>
                    </a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Main</li>

                    <li><a class="nav-link" href="blank.html"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                    <li><a class="nav-link" href="blank.html"><i class="fas fa-address-card"></i><span>Profil</span></a></li>
                    <li><a class="nav-link" href="<?= url('pegawai') ?>"><i class="fas fa-users"></i><span>Pegawai</span></a></li>
                    <li class="menu-header">Absen</li>
                    <li><a class="nav-link" href="<?= url('absen/apel') ?>"><i class="fas fa-user-check"></i><span>Apel</span></a></li>
                    <li><a class="nav-link" href="<?= url('absen/pagi') ?>"><i class="fas fa-user-check"></i><span>Pagi</span></a></li>
                    <li><a class="nav-link" href="<?= url('absen/siang') ?>"><i class="fas fa-user-check"></i><span>Siang</span></a></li>



                </ul>
            </aside>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Absen Apel</h1>

                </div>
                <div class="section-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <section class="cameras">
                                        <h2>Cameras</h2>
                                        <ul>
                                            <li v-if="cameras.length === 0" class="empty">No cameras found</li>
                                            <li v-for="camera in cameras">
                                <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)"
                                      class="active">{{ formatName(camera.name) }}</span>
                                                <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                                        <a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
                                </span>
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="scans">
                                        <h2>Scans</h2>
                                        <ul v-if="scans.length === 0">
                                            <li class="empty">No scans yet</li>
                                        </ul>
                                        <transition-group name="scans" tag="ul">
                                            <!--                <li v-for="scan in scans" :key="scan.date" :title="scan.content">{{ scan.content }}</li>-->
                                            <!--                <form action="--><?//= url('/tes') ?><!--" method="POST">-->

                                            <input type="text" readonly class="form-control" name="absen" v-for="scan in scans" :key="scan.date" :title="scan.content" v-bind:value="scan.content">
                                            <a :href="'<?= url('/absen/apel').'/' ?>'+scan.content" v-for="scan in scans" :key="scan.date" :title="scan.content"><button class="btn btn-success form-control">Absen</button></a>
                                            <!--                </form>-->
                                        </transition-group>
                                    </section>

                                </div>
                                <div class="col-md-8">
                                    <h5 class="text-info">TUNJUKKAN BARCODE ANDA KE KAMERA</h5>
                                    <div class="preview-container">

                                        <video id="preview"></video>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="#">Redstar</a>
            </div>
            <div class="footer-right">
            </div>
        </footer>
    </div>
</div>
<!-- General JS Scripts -->
<script src="<?= asset('/') ?>/assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<script src="<?= asset('/') ?>/assets/bundles/datatables/datatables.min.js"></script>
<script src="<?= asset('/') ?>/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= asset('/') ?>/assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="<?= asset('/') ?>/assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="<?= asset('/') ?>/assets/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="<?= asset('/') ?>/assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="<?= asset('/') ?>/assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="<?= asset('/') ?>/assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<script src="<?= asset('/') ?>/assets/js/page/datatables.js"></script>
<!-- Template JS File -->
<script src="<?= asset('/') ?>/assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="<?= asset('/') ?>/assets/js/custom.js"></script>
<script type="text/javascript" src="<?= asset('webcam') ?>/app.js"></script>

</html>
