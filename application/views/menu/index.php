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
                                        <?php foreach($lembur as $lmb):?>
                                        <tr>
                                            <td><?= $lmb['name']; ?></td>
                                            <td><?= $lmb['date']; ?></td>
                                            <td><?= $lmb['divisi']; ?></td>
                                            <td><?= $lmb['jo']; ?></td>
                                            <td><?= $lmb['qty']; ?></td>
                                            <td><?= $lmb['time']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    if ($lmb['status_id']==2 && $this->fungsi->user_login()->role_id === "3")
                                                    { 
                                                        ?>
                                                    <a href="<?= base_url('menu/approve/') . $lmb['id_input'];?>" class="btn btn-block btn-success">Approve</a>  
                                                    <button id="myBtn" type="button" class="btn btn-block btn-danger" data-toggle="modal" data-userid="<?php echo $lmb['id_input']; ?>" data-target="#rejectModal">Reject</button>
                                                    <!-- <a href="<?= base_url('menu/reject/') . $lmb['id_input'];?>" class="btn btn-block btn-danger">Reject</a>   -->
                                                    
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
                                                                <form action="<?php echo base_url('menu/reject/') . $lmb['id_input']; ?>" method="post">
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
                                                                        <a class="btn btn-primary" href="<?= base_url('menu/reject/') . $lmb['id'];?>">Ok</a>
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
                                                    if ($lmb['status_id']==1)
                                                    { 
                                                ?>
                                                   <span class="badge badge-secondary">Approved</span> 
                                                <?php 
                                                    } else if($lmb["status_id"] == 3){
                                                ?>
                                                    <span class="badge badge-secondary">Rejected</span> 
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
</div>

<!-- <script>
    // $(document).ready(function() {

        $('#btnSubmit').click(function() {
            var inputVal = $('#inputField').val();
            console.log('inputVal', inputVal)
            $.ajax({
                type: "GET",
                url: "<?= base_url('menu/reject/'). $lmb['id'] ?>",
                data: JSON.stringify({"Username":inputVal}),
                cache: false,
                success: function(data){
                    console.log(data)
                    $("#resultarea").text(data);
                }
            });
            .done(function(data) {
                console.log(data);
            });
        });
    // });
</script> -->