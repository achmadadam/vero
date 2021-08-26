<div class="container-fluid">
                        <div class="row mb-2"> 
                            <div class="col-md-3">
                                <a href="<?= base_url('user/input');?>" class="btn btn-block btn-primary">Add Surat Perintah Lembur</a>
                            </div>
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Print Data <a class="small" href="<?= base_url('admin/laporan2');?>"><i class="fas fa-3x fa-print "></i></a></li>
                        </ol>
                        </div>
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Perintah Lembur</h6>
                        </div>
                         <?= $this->session->flashdata('success'); ?>
                         <?= $this->session->flashdata('editsuccess'); ?>

                         <?php
                            $con = mysqli_connect("localhost", "root", "", "db_pl");
                            // Check connection
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }

                            $data = $_GET['data'];

                            $upt = "UPDATE input_spl SET baca='dibaca' WHERE id_input=$data";

                            if (mysqli_query($con, $upt)) {
                            echo "Record updated successfully";
                            } else {
                            echo "Error updating record: " . mysqli_error($con);
                            }

                            $userid = $this->fungsi->user_login()->id;
                            $result = mysqli_query($con, "SELECT * FROM input_spl WHERE user_id=$userid AND id_input=$data");
                        ?>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
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
                                        
                                        <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>

                                            <?php 
                                            $warna_status = '';
                                            $nama_status = '';
                                            
                                                if ($row['status_id'] == 1) {
                                                    $warna_status = 'badge-success';
                                                    $nama_status = 'Approved';
                                                } elseif ($row['status_id'] == 3) {
                                                    
                                                    $warna_status = 'badge-danger';
                                                    $nama_status = 'Reject';
                                                }
                                            ?>

                                            <td><?= $row['date']; ?></td>
                                            <td><?= $row['divisi']; ?></td>
                                            <td><?= $row['jo']; ?></td>
                                            <td><?= $row['qty']; ?></td>
                                            <td><?= $row['time']; ?></td>
                                            <td><label class="badge <?= $warna_status;?>"><?= $nama_status;?></label><br>  <?= $row['reason_reject'];?></td>
                                            <td>
                                             <?php
                                                    if ($row['status_id']==2 || $row['status_id'] == 3)
                                                    { 
                                                        ?>
                                                    <a href="<?= base_url('user/edit/') . $row['id_input'];?>" class="btn btn-block btn-success">Edit</a> 
                                                       <a href="<?= base_url('user/delete/') . $row['id_input'];?>" class="btn btn-block btn-danger">Hapus</a>   
                                                <?php 
                                                    }
                                                    ?>

                                                <?php
                                                    if ($row['status_id']==1)
                                                    { 
                                                        ?>
                                                   <span class="badge badge-secondary">Approved</span> 
                                                <?php 
                                                    }
                                                ?>
                                                     
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
</div>