<div class="container-fluid">
                        <div class="row mb-3">
                        <div class="col-lg-6">
                        <form action="<?= base_url('menu');?>" method="post">
                        <div class="input-group input-group-sm mt-4">
                        <input type="text" class="form-control" name="keyword" autocomplete="off" placeholder="Search By Name or Division">
                        <span class="input-group-append">
                            <input type="submit" name="search" class="btn btn-info btn-flat"></input>
                        </span>
                        </div>
                        </form>
                        </div>
                        </div>
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Perintah Lembur</h6>
                        </div>
                         <?= $this->session->flashdata('success'); ?>


                         <?php
                            $con = mysqli_connect("localhost", "root", "", "db_pl");
                            // Check connection
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }

                            $data = $_GET['data'];

                            $userid = $this->fungsi->user_login()->id;
                            $result = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id = user.id WHERE id_input=$data");
                        ?>

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
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $row['name']; ?></td>
                                            <td><?= $row['date']; ?></td>
                                            <td><?= $row['divisi']; ?></td>
                                            <td><?= $row['jo']; ?></td>
                                            <td><?= $row['qty']; ?></td>
                                            <td><?= $row['time']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    if ($row['status_id']==2 && $this->fungsi->user_login()->role_id === "3")
                                                    { 
                                                        ?>
                                                    <a href="<?= base_url('menu/approve/') . $row['id_input'];?>" class="btn btn-block btn-success">Approve</a>  
                                                    <button id="myBtn" type="button" class="btn btn-block btn-danger" data-toggle="modal" data-userid="<?php echo $row['id_input']; ?>" data-target="#rejectModal">Reject</button>
                                                    <!-- <a href="<?= base_url('menu/reject/') . $row['id_input'];?>" class="btn btn-block btn-danger">Reject</a>   -->
                                                    
                                                    <!-- Reject Modal-->
                                                    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin ?</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <form action="<?php echo base_url('menu/reject/') . $row['id_input']; ?>" method="post">
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <input type="hidden" name="user_id" value="">
                                                                            <input type="text" class="form-control form-control-user" id="rejectReason" name="rejectReason"
                                                                                placeholder="Alasan Reject">
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    <!-- <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                        <a class="btn btn-primary" href="<?= base_url('menu/reject/') . $row['id'];?>">Ok</a>
                                                                        <button class="btn btn-primary" type="submit" data-dismiss="modal">Submit</button>
                                                                    </div> -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php 
                                                    }
                                                    ?>

                                                <?php
                                                    if ($row['status_id']==1)
                                                    { 
                                                ?>
                                                   <span class="badge badge-secondary">Approved</span> 
                                                <?php 
                                                    } else if($row["status_id"] == 3){
                                                ?>
                                                    <span class="badge badge-secondary">Rejected</span> 
                                                <?php } ?>
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