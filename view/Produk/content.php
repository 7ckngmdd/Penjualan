<?php include('../../config.php'); ?>
<?php include('../../head.php'); ?>

<?php
// File JSON untuk menyimpan data produk
$file = 'products.json';

// Baca data produk dari file JSON
if (file_exists($file)) {
    $products = json_decode(file_get_contents($file), true);
} else {
    // Contoh data produk jika file JSON tidak ada
    $products = [
        ['id' => 1, 'name' => 'Samsung Galaxy S21', 'price' => 12000000, 'stock' => 5],
        ['id' => 2, 'name' => 'Samsung Galaxy Note 20', 'price' => 15000000, 'stock' => 3],
        ['id' => 3, 'name' => 'Samsung Galaxy A52', 'price' => 5000000, 'stock' => 10],
        ['id' => 4, 'name' => 'Samsung Galaxy S20 FE', 'price' => 7000000, 'stock' => 7],
        ['id' => 5, 'name' => 'Samsung Galaxy M31', 'price' => 3000000, 'stock' => 8],
        ['id' => 6, 'name' => 'Samsung Galaxy Z Fold 3', 'price' => 25000000, 'stock' => 2],
        ['id' => 7, 'name' => 'Samsung Galaxy Z Flip 3', 'price' => 20000000, 'stock' => 4],
        ['id' => 8, 'name' => 'Samsung Galaxy A72', 'price' => 6000000, 'stock' => 6],
        ['id' => 9, 'name' => 'Samsung Galaxy M51', 'price' => 4000000, 'stock' => 9],
        ['id' => 10, 'name' => 'Samsung Galaxy S10', 'price' => 10000000, 'stock' => 5]
    ];

    // Simpan data produk awal ke file JSON
    file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
}

// Periksa apakah formulir edit telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['stock'])) {
    $id = $_POST['id'];
    $new_stock = $_POST['stock'];

    // Perbarui stok produk
    foreach ($products as &$product) {
        if ($product['id'] == $id) {
            $product['stock'] = $new_stock;
            break;
        }
    }
    unset($product); // Hapus referensi ke elemen terakhir

    // Simpan data produk yang diperbarui ke file JSON
    file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
}

// Periksa apakah formulir tambah produk telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['stock'])) {
    $new_product = [
        'id' => end($products)['id'] + 1,
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock']
    ];

    // Tambahkan produk baru ke daftar produk
    $products[] = $new_product;

    // Simpan data produk yang diperbarui ke file JSON
    file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
}

// Periksa apakah formulir hapus produk telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Hapus produk dari daftar produk
    foreach ($products as $key => $product) {
        if ($product['id'] == $delete_id) {
            unset($products[$key]);
            break;
        }
    }

    // Simpan data produk yang diperbarui ke file JSON
    file_put_contents($file, json_encode(array_values($products), JSON_PRETTY_PRINT));
}

$total_sales = 0; // Simulasi total penjualan
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Produk</title>
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
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Daftar Produk</h4>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $product): ?>
                                            <tr>
                                                <td><?php echo $product['id']; ?></td>
                                                <td><?php echo $product['name']; ?></td>
                                                <td><?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                                                <td><?php echo $product['stock']; ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $product['id']; ?>">Edit</button>
                                                    <form method="POST" action="content.php" style="display:inline;">
                                                        <input type="hidden" name="delete_id" value="<?php echo $product['id']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $product['id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel<?php echo $product['id']; ?>">Edit Stok Produk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="content.php">
                                                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                                <div class="mb-3">
                                                                    <label for="stock" class="form-label">Stok</label>
                                                                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $product['stock']; ?>" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Modal Add Product -->
                    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="content.php">
                                        <div class="mb-3">
                                            <label for="productName" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" id="productName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Harga</label>
                                            <input type="number" class="form-control" id="productPrice" name="price" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productStock" class="form-label">Stok</label>
                                            <input type="number" class="form-control" id="productStock" name="stock" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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
