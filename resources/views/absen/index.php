
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Beranda</title>
    <!-- General CSS Files -->

    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/app.min.css">
    <script type="text/javascript" src="<?= asset('webcam') ?>/adapter.min.js"></script>
    <script type="text/javascript" src="<?= asset('webcam') ?>/vue.min.js"></script>
    <script type="text/javascript" src="<?= asset('webcam') ?>/instascan.min.js"></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?= asset('/') ?>/assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='<?= asset('/') ?>/assets/img/favicon.ico' />

</head>

<body>
<div class="loader"></div>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <h2>ABSEN APEL</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
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
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
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
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="text-info text-center">TUNJUKKAN BARCODE ANDA KE KAMERA</h5>
                        </div>
                        <div class="card-body ">
                            <div class="preview-container">

                                <video id="preview" style="width: 600px;height: 340px ;margin: 0 auto;"></video>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>
</div>
<!-- General JS Scripts -->
<script src="<?= asset('/') ?>/assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="<?= asset('/') ?>/assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="<?= asset('/') ?>/assets/js/custom.js"></script>

<script type="text/javascript" src="<?= asset('webcam') ?>/app.js"></script>
</html>
