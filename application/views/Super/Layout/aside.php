<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/logo_pustek.png" alt="PUSTEKINFO Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-LIGHT" style="color: #007bff;">PUSTEKINFO</span>
    </a>

    <?php
    // Ambil data user dari API
    $ch = curl_init();
    $apiUrl = $this->config->item('api_url') . '/user/me';
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $_SESSION['accessToken']
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $user = json_decode($response, true);
    $username = isset($user['username']) ? $user['username'] : 'Guest';
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Selamat Datang, <br><?= htmlspecialchars($username) ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Profile -->
                <li class="nav-item">
                    <a href="<?= base_url('Super/cKelolaData/profil') ?>"
                        class="nav-link <?= $this->uri->segment(2) == 'cKelolaData' && $this->uri->segment(3) == 'profil' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('Super/cDashboard') ?>"
                        class="nav-link <?= $this->uri->segment(2) == 'cDashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <!-- Data Master -->
                        <li class="nav-item">
                            <a href="<?= base_url('Super/cKelolaData/tablet') ?>"
                                class="nav-link <?= $this->uri->segment(3) == 'tablet' ? 'active' : '' ?>">
                                <i class="fas fa-tablet nav-icon"></i>
                                <p>Perangkat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Super/cKelolaData/pegawai') ?>"
                                class="nav-link <?= $this->uri->segment(3) == 'pegawai' ? 'active' : '' ?>">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Super/cKelolaData/user') ?>"
                                class="nav-link <?= $this->uri->segment(3) == 'user' ? 'active' : '' ?>">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>Pengguna</p>
                            </a>
                </li>
                <!-- Transaksi -->
                <li class="nav-item">
                    <a href="<?= base_url('Super/cKelolaData/transaksi') ?>"
                        class="nav-link <?= $this->uri->segment(2) == 'cKelolaData' && $this->uri->segment(3) == 'transaksi' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                <!-- Logout -->
                <li class="nav-item">
                    <a href="<?= base_url('cAuth/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script src="<?= base_url('asset/AdminLTE/') ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('asset/AdminLTE/') ?>dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function() {
        $('[data-widget="pushmenu"]').PushMenu(); // Sidebar toggle
    });
    $(document).ready(function() {
        // Paksa Data Master tetap terbuka
        $('.has-treeview.menu-open > .nav-treeview').css('display', 'block');
        $('.has-treeview.menu-open > a').off('click'); // Nonaktifkan klik untuk menutup
    });
</script>

<style>
    .nav-item.menu-open>.nav-treeview {
        display: block !important;
        /* Pastikan submenu terlihat */
    }

    .nav-item.menu-open>a {
        pointer-events: none;
        /* Nonaktifkan klik pada "Data Master" */
    }
</style>