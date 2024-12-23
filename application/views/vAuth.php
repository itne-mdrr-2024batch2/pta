<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | Manajemen Aset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/') ?>dist/css/adminlte.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Roboto:wght@300;500&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Reset semua margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Setel latar belakang global */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f5f7fa;
            font-family: 'Roboto', sans-serif;
        }

        .main-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-bottom: 10px; /* Mengurangi margin bawah lebih lanjut */
}

        /* Login box styling */
        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-logo img {
            display: block;
            margin: 0 auto;
            margin-bottom: 10px;
        }

        /* Variasi warna untuk teks SIEMA */
        .login-logo a {
            font-size: 36px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Warna hitam untuk "SI" dan warna logo untuk "EMA" */
        .login-logo a .si {
            color: #000; /* Hitam */
        }

        .login-logo a .ema {
            color: #073D5F; /* Warna logo */
        }

        /* Variasi warna untuk teks deskripsi */
        .login-logo p {
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            margin-top: 5px;
        }

        /* Variasi warna untuk "Sistem Informasi Elektronik Manajemen Aset" */
        .login-logo p .highlight {
            color: #258899; /* Warna logo */
        }

        footer {
    background-color: #f5f7fa;
    color: #333;
    padding: 8px 10px; /* Mengurangi padding footer lebih lanjut */
    text-align: center;
    border-top: 1px solid #ddd;
    margin-top: 0; /* Mengurangi margin atas agar lebih rapat dengan konten */
}
        footer a {
            text-decoration: none;
            color: #007bff;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Konten Utama -->
    <div class="main-container">
        <div class="login-box">
            <div class="login-logo">
                <!-- Logo -->
                <img src="<?= base_url('asset/images/') ?>pustekinfo.png" 
                     alt="AdminLTE Logo" 
                     class="brand-image" 
                     style="width: 200px; height: auto; padding-bottom: 16px;">
                
                <!-- Judul Utama dengan variasi warna -->
                <a href="<?= base_url('#') ?>">
                    <span class="ema">SI</span><span class="ema">EMA</span>
                </a>

                <!-- Deskripsi dengan highlight warna -->
                <p>
                    <span class="highlight">Sistem Informasi Elektronik <br>Manajemen Aset</span>
                </p>
            </div>

            <!-- Error or success notifications -->
            <?php if ($this->session->userdata('error')): ?>
                <div class="callout callout-danger">
                    <h5>Error!</h5>
                    <p><?= $this->session->userdata('error') ?></p>
                </div>
            <?php endif; ?>

            <?php if ($this->session->userdata('success')): ?>
                <div class="callout callout-success">
                    <h5>Sukses!</h5>
                    <p><?= $this->session->userdata('success') ?></p>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <div class="card">
                <div class="card-body login-card-body">
                    <form action="<?= base_url('cAuth') ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Nama Pengguna">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Kata Sandi">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p style="line-height: 1; padding-top: 16px;">&copy; <span>2024</span> <strong>Sistem Manajemen Aset</strong></p>
        <p style="line-height: 1;">Dikembangkan oleh <a href="https://instagram.com/networking_daily" target="_blank">Kampus Merdeka 2024 Batch 2</a></p>
        <p style="line-height: 1;">
            <a href="https://instagram.com/pustekinfo.dprri" target="_blank">
                <i class="fab fa-instagram"></i> Instagram
            </a>
        </p>
    </footer>
</body>

</html>
