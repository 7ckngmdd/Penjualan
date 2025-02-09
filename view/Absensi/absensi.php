<?php
session_start();
include('../../config.php');
include('../../head.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hapus'])) {
        // Hapus data absensi berdasarkan indeks
        $index = $_POST['hapus'];
        unset($_SESSION['absensi'][$index]);
        $_SESSION['absensi'] = array_values($_SESSION['absensi']); // Reindex array
    } else {
        $nama = $_POST['nama'];
        $status = $_POST['status'];
        $tanggal = date("Y-m-d");

        // Inisialisasi variabel sesi absensi jika belum ada
        if (!isset($_SESSION['absensi'])) {
            $_SESSION['absensi'] = [];
        }

        // Tambahkan data absensi ke variabel sesi
        $_SESSION['absensi'][] = [
            'nama' => $nama,
            'tanggal' => $tanggal,
            'status' => $status
        ];
    }
}

// Ambil data absensi dari sesi
$absensi = isset($_SESSION['absensi']) ? $_SESSION['absensi'] : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pegawai</title>
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
                        <h2 class="mb-4">Absensi Pegawai</h2>
                        <form method="POST" class="mb-4">
                            <div class="mb-3">
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="mb-3">
                                <select name="status" class="form-control">
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpha">Alpha</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                        </form>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($absensi)) { $no = 1; foreach ($absensi as $index => $row) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row['nama']); ?></td>
                                        <td><?= $row['tanggal']; ?></td>
                                        <td><?= $row['status']; ?></td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <button type="submit" name="hapus" value="<?= $index; ?>" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }} else { ?>
                                    <tr><td colspan="5" class="text-center">Belum ada data absensi</td></tr>
                                <?php } ?>
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
