<?php include('../../config.php'); ?>
<?php include('../../head.php'); ?>

<?php

// Mendapatkan segmen URL setelah 'localhost/lat'
$url_segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$current_segment = isset($url_segments[2]) ? $url_segments[2] : ''; 


// Logika untuk menambahkan data penjualan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama_barang']) && isset($_POST['jenis_barang']) && isset($_POST['harga']) && isset($_POST['jumlah'])) {
    $nama_barang = $_POST['nama_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $date = date('Y-m-d H:i:s');

    // Data penjualan baru
    $new_sale = [
        'nama_barang' => $nama_barang,
        'jenis_barang' => $jenis_barang,
        'harga' => $harga,
        'jumlah' => $jumlah,
        'date' => $date
    ];

    // Baca data penjualan yang ada
    $file = 'sales.json';
    if (file_exists($file)) {
        $sales = json_decode(file_get_contents($file), true);
    } else {
        $sales = [];
    }

    // Tambahkan data penjualan baru
    $sales[] = $new_sale;

    // Simpan data penjualan ke file JSON
    file_put_contents($file, json_encode($sales, JSON_PRETTY_PRINT));

    // Redirect kembali ke halaman Penjualan.php
    header('Location: Penjualan.php');
    exit();
}

// Logika untuk menghapus data penjualan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['index'])) {
    $index = $_POST['index'];

    // Baca data penjualan yang ada
    $file = 'sales.json';
    if (file_exists($file)) {
        $sales = json_decode(file_get_contents($file), true);
    } else {
        $sales = [];
    }

    // Hapus data penjualan berdasarkan index
    if (isset($sales[$index])) {
        array_splice($sales, $index, 1);
    }

    // Simpan data penjualan yang telah diperbarui ke file JSON
    file_put_contents($file, json_encode($sales, JSON_PRETTY_PRINT));

    // Redirect kembali ke halaman data_penjualan.php
    header('Location: data_penjualan.php');
    exit();
}

// Baca data penjualan dari file JSON
$file = 'sales.json';
if (file_exists($file)) {
    $sales = json_decode(file_get_contents($file), true);
} else {
    $sales = [];
}

// Hitung grand total
$grand_total = 0;
foreach ($sales as $sale) {
    $harga = (float)str_replace('.', '', $sale['harga']);
    $jumlah = (int)$sale['jumlah'];
    $grand_total += $harga * $jumlah;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                <?php include('../../navbar.php'); ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container mt-4">
                        <h2>Data Penjualan</h2>
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
                                <?php if (!empty($sales)): ?>
                                    <?php foreach ($sales as $index => $sale): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($sale['nama_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($sale['jenis_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($sale['harga']); ?></td>
                                            <td><?php echo htmlspecialchars($sale['jumlah']); ?></td>
                                            <td><?php echo htmlspecialchars($sale['date']); ?></td>
                                            <td>
                                                <form method="POST" action="data_penjualan.php" style="display:inline;">
                                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data penjualan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- / Content -->

                    <!-- Tabel Grand Total -->
                    <div class="container mt-4">
                        <h2>Grand Total</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-end">Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- / Tabel Grand Total -->

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