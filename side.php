<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?php echo $base_url; ?>view/index.php" class="app-brand-link">
			<!-- logo -->
			<span class="app-brand-text demo menu-text fw-semibold ms-2">Penjualan</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
			<i class="menu-toggle-icon d-xl-block align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Dashboards -->
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons ri-home-smile-line"></i>
				<div data-i18n="Dashboards">Dashboards</div>
				<div class="badge bg-danger rounded-pill ms-auto"></div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item">
				<a href="http://localhost/penjualan/view/Produk/content.php" class="menu-link">
						<div data-i18n="Produk">Produk</div>
					</a>
				</li>
				<li class="menu-item">
					<a href="http://localhost/penjualan/view/Absensi/absensi.php" class="menu-link">
						<div data-i18n="Analytics">Absensi</div>
					</a>
				</li>
			</ul>
		</li>

		<!-- Layouts -->
		<li class="menu-item active open">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons ri-layout-2-line"></i>
				<div data-i18n="Layouts">Data Master</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item <?php echo ($current_segment == 'pemasukan') ? 'active' : ''; ?>">
					<a href="http://localhost/penjualan/view/Penjualan/data_penjualan.php" class="menu-link">
						<div data-i18n="penjualan">Data Penjualan</div>
					</a>
				</li>
				<li class="menu-item <?php echo ($current_segment == 'pembelian') ? 'active' : ''; ?>">
					<a href="http://localhost/penjualan/view/Pembelian/data_pembelian.php" class="menu-link">
						<div data-i18n="pembelian">Data Pembelian</div>
					</a>
				</li>
	
			</ul>
		</li>

		<!-- Front Pages -->
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons ri-file-copy-line"></i>
				<div data-i18n="Front Pages">Transaksi</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item">
					<a
						href="http://localhost/penjualan/view/Penjualan/Penjualan.php"
						class="menu-link"
						target="_blank">
						<div data-i18n="Landing">Penjualan</div>
					</a>
				</li>
				<li class="menu-item">
					<a
						href="http://localhost/penjualan/view/Pembelian/Pembelian.php"
						class="menu-link"
						target="_blank">
						<div data-i18n="Pricing">Pembelian</div>
					</a>
				</li>

			</ul>
		</li>

		
		<!-- Misc -->
		<li class="menu-header mt-7"><span class="menu-header-text">Misc</span></li>
		<li class="menu-item">
			<a
				href="https://www.instagram.com/diaazep4m/"
				target="_blank"
				class="menu-link">
				<i class="menu-icon tf-icons ri-lifebuoy-line"></i>
				<div data-i18n="Support">Support</div>
			</a>
		</li>
		
	</ul>
</aside>
