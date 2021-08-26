<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-3">
            <a href="<?= base_url('user/input'); ?>" class="btn btn-block btn-primary">Add Surat Perintah Lembur</a>
        </div>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Print Data <a class="small" href="<?= base_url('admin/laporan2'); ?>"><i class="fas fa-3x fa-print "></i></a></li>
        </ol>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Perintah Lembur</h6>
        </div>
        <?= $this->session->flashdata('success'); ?>
        <?= $this->session->flashdata('editsuccess'); ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Division</th>
                            <th class="text-center">No. Job Order</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">Hours</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rej = ''; foreach ($lembur as $lmb) : ?>
                            <tr>

                            <?php
                            
                            if ($lmb['status_id'] == 3) {
                                $rej = 'Alasan: ';
                            }

                            ?>
                                <td><?= $lmb['name']; ?></td>
                                <td><?= $lmb['date']; ?></td>
                                <td><?= $lmb['divisi']; ?></td>
                                <td><?= $lmb['jo']; ?></td>
                                <td><?= $lmb['qty']; ?></td>
                                <td><?= $lmb['time']; ?></td>
                                <td><label class="badge <?= $lmb['warna_status']; ?>"><?= $lmb['nama_status']; ?></label> <br><?= $rej; echo $lmb['reason_reject']; ?></td>
                                <td>
                                    <?php
                                    if ($lmb['status_id'] == 2 || $lmb['status_id'] == 3) {
                                    ?>
                                        <a href="<?= base_url('user/edit/') . $lmb['id_input']; ?>" class="btn btn-block btn-success">Edit</a>
                                        <a href="<?= base_url('user/delete/') . $lmb['id_input']; ?>" class="btn btn-block btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Hapus</a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($lmb['status_id'] == 1) {
                                    ?>
                                        <span class="badge badge-secondary">Approved</span>
                                    <?php
                                    }
                                    ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>