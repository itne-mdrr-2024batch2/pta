<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMq+0Z2BOPsSOazC3Pa3cxD5U5bxDIkmNBt3s" crossorigin="anonymous">
    <!-- Tambahkan stylesheet lain di sini -->
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark-bold">Beranda</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="mb-3">
                    <h4>Jumlah Perangkat</h3>
                </div>
                <div class="row">
                    <!-- Total Perangkat -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-black elevation-1"><i class="fas fa-tablet"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">TOTAL</span>
                                <span class="info-box-number"><?= $tabCounts['total'] ?? 0 ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Total Samsung S8 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-black elevation-1"><i class="fas fa-tablet"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">SAMSUNG GALAXY TAB S8 5G</span>
                                <span class="info-box-number"><?= $tabCounts['SAMSUNG_GALAXY_TAB_S8_5G'] ?? 0 ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Total Samsung S7 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-black elevation-1"><i class="fas fa-tablet"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">SAMSUNG GALAXY TAB S7+</span>
                                <span class="info-box-number"><?= $tabCounts['SAMSUNG_GALAXY_TAB_S7_PLUS'] ?? 0 ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <h4>Informasi Transaksi</h3>
                </div>
                <div class="row">
                    <!-- Info box 1 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perangkat Diterima</span>
                                <span class="info-box-number"><?= $transaksi['transaksi']['PENERIMAAN'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 2 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-reply"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perangkat Dikembalikan</span>
                                <span class="info-box-number"><?= $transaksi['transaksi']['PENGEMBALIAN'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 3 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perangkat Lengkap</span>
                                <span class="info-box-number"><?= $transaksi['status']['LENGKAP'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 4 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perangkat Tidak Lengkap</span>
                                <span class="info-box-number"><?= $transaksi['status']['TIDAK_LENGKAP'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 5 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-check-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perangkat Berfungsi</span>
                                <span class="info-box-number"><?= $transaksi['kondisi']['BERFUNGSI'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 6 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-times-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Perangkat Tidak Berfungsi</span>
                                <span class="info-box-number"><?= $transaksi['kondisi']['TIDAK_BERFUNGSI'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        $ch = curl_init();

                        $token = $this->session->userdata('accessToken');
                        $apiUrl = $this->config->item('api_url') . '/user/me';

                        curl_setopt($ch, CURLOPT_URL, ($apiUrl));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            'Authorization: Bearer ' . $token,
                            'Content-Type: application/json'
                        ]);

                        $response = curl_exec($ch);
                        curl_close($ch);

                        $user = json_decode($response, true);

                        $name = isset($user['name']) ? $user['name'] : 'Guest';
                        $username = isset($user['username']) ? $user['username'] : 'Guest';
                        $role = isset($user['role']) ? $user['role'] : 'Guest';
                        if ($role === 'VIEWER') {
                            $role_display = 'User';
                        } elseif ($role === 'ADMIN') {
                            $role_display = 'Admin';
                        } elseif ($role === 'SUPER') {
                            $role_display = 'Super';
                        } else {
                            $role_display = 'Guest';
                        }
                        ?>
                        <!-- MAP & BOX PANE -->
                        <div class="">
                            <div class="info">
                                <br>
                                <h4 href="#" class="d-block ml-4 mb-4">Kamu Login sebagai <?php echo htmlspecialchars($role_display); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
</body>

</html>