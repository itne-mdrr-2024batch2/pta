<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengguna</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-13  ">
                    <button type="button" class="btn btn-default mb-3" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-user-plus"></i> Tambah Data Pengguna
                    </button>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Nomor Handphone</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($user) || !empty($user)) {
                                        foreach ($user as $key => $value) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value->email) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value->name) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value->username) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value->nomor_hp) ?></td>

                                                <td class="text-center">
                                                    <?php
                                                    if ($value->role == 'SUPER') {
                                                        echo '<span class="badge badge-primary">SUPER</span>';
                                                    } elseif ($value->role == 'ADMIN') {
                                                        echo '<span class="badge badge-success">ADMIN</span>';
                                                    } elseif ($value->role == 'VIEWER') {
                                                        echo '<span class="badge badge-warning">USER</span>';
                                                    } else {
                                                        echo '<span class="badge badge-secondary">Unknown</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('Super/cKelolaData/deleteuser/' . $value->id) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                        <button type="button" data-toggle="modal" data-target="#edit<?= $value->id ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="8" class="text-center">Data Tidak Ditemukan</td></tr>';
                                    }
                                    ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Nomor Handphone</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <form action="<?= base_url('super/ckeloladata/createuser') ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Nama anda" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Telepon</label>
                        <input type="text" name="nomor_hp" class="form-control" maxlength="13" minlength="10" id="exampleInputEmail1" placeholder="No Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Role</label>
                        <select class="form-control" name="role" required>
                            <option value="">--Pilih Role---</option>
                            <option value="SUPER">SUPER</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="VIEWER">USER</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
foreach ($user as $key => $value) {
?>
    <div class="modal fade" id="edit<?= $value->id ?>">
        <div class="modal-dialog">
            <form action="<?= base_url('super/ckeloladata/updateuser/' . $value->id) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data Pengguna</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" value="<?= $value->email ?>" class="form-control" id="exampleInputEmail1" placeholder="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" value="<?= $value->username ?>" class="form-control" id="exampleInputEmail1" placeholder="Nama User" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" name="name" value="<?= $value->name ?>" class="form-control" id="exampleInputEmail1" placeholder="Nama User" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Telepon</label>
                            <input type="text" name="nomor_hp" value="<?= $value->nomor_hp ?>" class="form-control" maxlength="13" minlength="11" id="exampleInputEmail1" placeholder="No Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Password Baru" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <select class="form-control" name="role" required>
                                <option value="">--Pilih Role---</option>
                                <option value="SUPER" <?php if ($value->role == 'SUPER') {
                                                            echo 'selected';
                                                        } ?>>SUPER</option>
                                <option value="ADMIN" <?php if ($value->role == 'ADMIN') {
                                                            echo 'selected';
                                                        } ?>>ADMIN</option>
                                <option value="VIEWER" <?php if ($value->role == 'VIEWER') {
                                                            echo 'selected';
                                                        } ?>>USER</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php
}
?>