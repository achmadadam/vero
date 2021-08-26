<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-lg-6">
            <form id="myForm" action="<?= base_url('admin'); ?>" method="post">
                <div class="input-group input-group-sm mt-4">
                    <input type="text" class="form-control" name="keyword" autocomplete="off" placeholder="Search By Name or Division">
                    <span class="input-group-append">
                        <input type="submit" id="submit-input" name="search" class="btn btn-info btn-flat"></input>
                    </span>
                </div>

                <div class="input-group input-group-sm mt-4" style="margin: top 1em;">
                    <label for="" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="startDate" name="startDate">
                        <?= form_error('date', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="input-group input-group-sm mt-4">
                    <label for="date" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="endDate" name="endDate">
                        <?= form_error('date', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>
                </div>
                <button type="submit" id='btn-submit' style="display: none; visibility: hidden;"></submit>

                    <!--   <?php echo form_open('admin/laporan/<?php $tgl_awal?>/'); ?> -->
                    <!-- <input type="date" name="tgl_awal">
                         <input type="date" name="tgl_akhir"> -->
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Print Data <a class="small" href="<?= base_url('admin/laporan2'); ?>"><i class="fas fa-3x fa-print "></i></a></li>
                <li class="breadcrumb-item">Print Chart<a class="small" target="_blank" href="<?= base_url('admin/cetaklaporan'); ?>"><i class="fas fa-3x fa-print "></i></a></li>
            </ol>
        </div>
        <!--  </form>
        <?php echo form_close(); ?> -->
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lembur as $lmb) : ?>
                            <tr>
                                <td><?= $lmb['name']; ?></td>
                                <td><?= $lmb['date']; ?></td>
                                <td><?= $lmb['divisi']; ?></td>
                                <td><?= $lmb['jo']; ?></td>
                                <td><?= $lmb['qty']; ?></td>
                                <td><?= $lmb['time']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div></div>
            </div>
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <script>
                var label = ["<?= implode('","', $label) ?>"];
                var chartData = ["<?= implode('","', $chartData) ?>"];

                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Jumlah Pengajuan Lembur',
                            data: chartData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById("startDate").onchange = function() {
        myFunction()
    };
    document.getElementById("endDate").onchange = function() {
        myFunction()
    };

    function myFunction() {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();

        if (startDate && endDate) {
            document.getElementById("myForm").submit();
            // document.getElementById("btn-submit").addEventListener("click", function () {
            //     form.submit()
            // });
        }
    }
</script>