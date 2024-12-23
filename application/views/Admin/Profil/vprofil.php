<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ml-5">
                <div class="col-sm-6">
                    <h1>Profil Pengguna</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <h4>Informasi Profil Pengguna</h4>
            <table class="table table-bordered">
                <?php if (!empty($profil)) { ?>
                    <tr>
                        <th>Nama</th>
                        <td><?php echo htmlspecialchars($profil['name'] ?? 'Tidak tersedia'); ?></td>
                    </tr>
                    <tr>
                        <th>Nomor HP</th>
                        <td><?php echo htmlspecialchars($profil['nomor_hp'] ?? 'Tidak tersedia'); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($profil['email'] ?? 'Tidak tersedia'); ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?php echo htmlspecialchars($profil['username'] ?? 'Tidak tersedia'); ?></td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td><?php $role = isset($profil['role']) ? $profil['role'] : 'Guest';
                            if ($role === 'VIEWER') {
                                $role_display = 'User';
                            } elseif ($role === 'ADMIN') {
                                $role_display = 'Admin';
                            } elseif ($role === 'SUPER') {
                                $role_display = 'Super';
                            } else {
                                $role_display = 'Guest';
                            }
                            echo htmlspecialchars($role_display); ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td colspan="2">Data profil tidak tersedia</td>
                    </tr>
                <?php } ?>
            </table>

            <!-- Form Ubah Kata Sandi -->
            <h3>Ubah Kata Sandi</h3>
            <!-- Success and error messages -->
            <?php if ($this->session->userdata('success')) { ?>
                <div class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                    <?= $this->session->userdata('success') ?>
                </div>
            <?php } elseif ($this->session->userdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
                    <?= $this->session->userdata('error') ?>
                </div>
            <?php } ?>

            <form action="<?php echo base_url('Admin/cKelolaData/updatePassword'); ?>" method="post">
                <div class="form-group">
                    <label>Kata Sandi Lama</label>
                    <input type="password" name="oldPassword" class="form-control" placeholder="Masukkan Kata Sandi Lama" required>
                    <label class="mt-2">Kata Sandi Baru</label>
                    <input type="password" name="newPassword" class="form-control" placeholder="Masukkan Kata Sandi Baru" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Ubah Kata Sandi</button>
            </form>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>