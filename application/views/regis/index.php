           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-md-3">
                       <a href="<?= base_url('registrasi/input'); ?>" class="btn btn-block btn-primary">Add Data Karyawan</a>
                   </div>
               </div>
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Daftar Data Karyawan</h6>
                   </div>
                   <?= $this->session->flashdata('success'); ?>
                   <?= $this->session->flashdata('editsuccess'); ?>
                   <div class="card-body">
                       <div class="table-responsive">
                           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                               <thead>
                                   <tr>
                                       <th class="text-center">Name</th>
                                       <th class="text-center">Username</th>
                                       <th class="text-center">Role Id</th>
                                       <th class="text-center">Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php foreach ($data as $dt) : ?>
                                       <tr>
                                           <td><?= $dt['name']; ?></td>
                                           <td><?= $dt['username']; ?></td>
                                           <td><?= $dt['role_id']; ?></td>
                                           <td>
                                               <a href="<?= base_url('registrasi/edit/') . $dt['id']; ?>" class="btn btn-block btn-success">Edit</a>
                                               <a href="<?= base_url('registrasi/delete/') . $dt['id']; ?>" class="btn btn-block btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Hapus</a>
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