<?php include('../../config.php'); ?>
<?php include('../../head.php'); ?>
<?php
// Mendapatkan segmen URL setelah 'localhost/lat'
$url_segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$current_segment = isset($url_segments[2]) ? $url_segments[2] : ''; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>styles.css">
    <style>
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <?php include('../../side.php'); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <?php include '../../navbar.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y center-form">
                        <div class="card">
                            <h5 class="card-header">Input Data Penjualan</h5>
                            <div class="card-body">
                                <form method="POST" action="data_penjualan.php">
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="namaBarang"
                                            name="nama_barang"
                                            aria-describedby="floatingInputHelp" required />
                                        <label for="namaBarang">Nama Barang</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="jenisBarang"
                                            name="jenis_barang"
                                            aria-describedby="floatingInputHelp" required />
                                        <label for="jenisBarang">Jenis Barang</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="harga"
                                            name="harga"
                                            aria-describedby="floatingInputHelp" required />
                                        <label for="harga">Harga</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="jumlah"
                                            name="jumlah"
                                            aria-describedby="floatingInputHelp" required />
                                        <label for="jumlah">Berapa banyak</label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include('../../footer.php'); ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php echo $base_url; ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo $base_url; ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo $base_url; ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo $base_url; ?>assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?php echo $base_url; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo $base_url; ?>assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?php echo $base_url; ?>assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
