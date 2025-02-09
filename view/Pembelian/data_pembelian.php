<?php include('../../config.php'); ?>
<?php include('../../head.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama_barang']) && isset($_POST['jenis_barang']) && isset($_POST['harga']) && isset($_POST['jumlah'])) {
    $nama_barang = $_POST['nama_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $date = date('Y-m-d H:i:s');

    // Data pembelian baru
    $new_purchase = [
        'nama_barang' => $nama_barang,
        'jenis_barang' => $jenis_barang,
        'harga' => $harga,
        'jumlah' => $jumlah,
        'date' => $date
    ];

    // Baca data pembelian yang ada
    $file = 'purchases.json';
    if (file_exists($file)) {
        $purchases = json_decode(file_get_contents($file), true);
    } else {
        $purchases = [];
    }

    // Tambahkan data pembelian baru
    $purchases[] = $new_purchase;

    // Simpan data pembelian ke file JSON
    file_put_contents($file, json_encode($purchases, JSON_PRETTY_PRINT));

    // Redirect kembali ke halaman Pembelian.php
    header('Location: Pembelian.php');
    exit();
}

// Logika untuk menghapus data pembelian
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_index'])) {
    $delete_index = $_POST['delete_index'];

    // Baca data pembelian yang ada
    $file = 'purchases.json';
    if (file_exists($file)) {
        $purchases = json_decode(file_get_contents($file), true);
    } else {
        $purchases = [];
    }

    // Hapus data pembelian berdasarkan index
    if (isset($purchases[$delete_index])) {
        array_splice($purchases, $delete_index, 1);
    }

    // Simpan data pembelian yang telah diperbarui ke file JSON
    file_put_contents($file, json_encode($purchases, JSON_PRETTY_PRINT));

    // Redirect kembali ke halaman data_pembelian.php
    header('Location: data_pembelian.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include('../../side.php'); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include('../../navbar.php'); ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h2>Data Pembelian</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Baca data pembelian dari file JSON
                                $file = 'purchases.json';
                                if (file_exists($file)) {
                                    $purchases = json_decode(file_get_contents($file), true);
                                } else {
                                    $purchases = [];
                                }

                                if (!empty($purchases)) {
                                    foreach ($purchases as $index => $purchase) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($purchase['nama_barang']) . '</td>';
                                        echo '<td>' . htmlspecialchars($purchase['jenis_barang']) . '</td>';
                                        echo '<td>' . htmlspecialchars($purchase['harga']) . '</td>';
                                        echo '<td>' . htmlspecialchars($purchase['jumlah']) . '</td>';
                                        echo '<td>' . htmlspecialchars($purchase['date']) . '</td>';
                                        echo '<td>';
                                        echo '<form method="POST" action="data_pembelian.php" style="display:inline;">';
                                        echo '<input type="hidden" name="delete_index" value="' . $index . '">';
                                        echo '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
                                        echo '</form>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">Tidak ada data pembelian</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include('../../footer.php'); ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- / Content wrapper -->
            </div>
            <!-- / Layout page -->

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </div>

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
