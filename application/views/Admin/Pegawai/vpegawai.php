<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pegawai</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->userdata('success')) {
        ?>
            <div class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <?= $this->session->userdata('success') ?>
            </div>
        <?php
        } ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Data Pegawai</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIP Pegawai</th>
                                        <th class="text-center">Nama Pegawai</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Unit Kerja (Eselon 3)</th>
                                        <th class="text-center">Unit Kerja (Eselon 2)</th>
                                        <th class="text-center">Tanggal Pensiun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $today = date("Y-m-d"); // Get today's date in Y-m-d format
                                    if (is_array($pegawai) && !empty($pegawai)) {
                                        foreach ($pegawai as $key => $value) {
                                            // Check if TMT exists; if not, default to 'SUDAH PENSIUN'
                                            $tmtDate = $value['tmt'] ? $value['tmt'] : null;
                                            $formattedDate = $tmtDate ? date("d-m-Y", strtotime($tmtDate)) : 'SUDAH PENSIUN';

                                            if ($tmtDate && strtotime($tmtDate) < strtotime($today)) {
                                                $formattedDate = 'SUDAH PENSIUN';
                                                $rowClass = '';
                                            } elseif ($tmtDate && (strtotime($tmtDate) - strtotime($today)) <= 30 * 24 * 60 * 60) {
                                                $rowClass = 'style="background-color: #ffbaba;"';
                                            } else {
                                                $rowClass = '';
                                            }

                                            // Calculate days remaining to retirement if within 31 days
                                            $daysRemaining = null;
                                            if ($tmtDate) {
                                                $dateDiff = (strtotime($tmtDate) - strtotime($today)) / (60 * 60 * 24);
                                                if ($dateDiff > 0 && $dateDiff <= 31) {
                                                    $daysRemaining = round($dateDiff);
                                                }
                                            }

                                    ?>
                                            <tr <?= $rowClass ?>>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value['nip_pegawai']) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value['nama_pegawai']) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value['jabatan']) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value['satker_1']) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value['satker_2']) ?></td>
                                                <td class="text-center">
                                                    <?= htmlspecialchars($formattedDate) ?>
                                                    <?php if ($daysRemaining !== null): ?>
                                                        <span>(<?= $daysRemaining ?> hari menuju pensiun)</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="7" class="text-center">Data Pegawai Kosong</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIP Pegawai</th>
                                        <th class="text-center">Nama Pegawai</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Unit Kerja (Eselon 3)</th>
                                        <th class="text-center">Unit Kerja (Eselon 2)</th>
                                        <th class="text-center">Tanggal Pensiun</th>

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