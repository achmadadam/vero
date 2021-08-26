<script>window.print();</script>

<div class="container">

    <div class="card shadow my-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Penerima Lembur</h6>
        </div>


        <?php
        $con = mysqli_connect("localhost", "root", "", "db_pl");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $userid = $this->fungsi->user_login()->id;
        $result = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 ORDER BY date");
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
                            <th class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?= $row['username']; ?></td>
                                <td><?= $row['date']; ?></td>
                                <td><?= $row['divisi']; ?></td>
                                <td><?= $row['jo']; ?></td>
                                <td><?= $row['qty']; ?></td>
                                <td><?= $row['time']; ?></td>
                                <td>APPROVE</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div></div>
            </div>
            <div>

                <canvas id="myChart"></canvas>
                <br>
                
                <canvas id="myChart2"></canvas>
            <script>
                var canvas = document.getElementById("myChart");
                var img    = canvas.toDataURL("image/png");
                document.write('<img src="'+img+'"/>');
            </script>
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
                            label: 'Jumlah Pengajuan Lembur Yang Disetujui',
                            data: [
                                <?php
                                $a = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-03'");
                                echo mysqli_num_rows($a);
                                ?>,
                                <?php
                                $b = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-04'");
                                echo mysqli_num_rows($b);
                                ?>,
                                <?php
                                $c = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-05'");
                                echo mysqli_num_rows($c);
                                ?>,
                                <?php
                                $d = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-06'");
                                echo mysqli_num_rows($d);
                                ?>,
                                <?php
                                $d = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-07'");
                                echo mysqli_num_rows($d);
                                ?>,
                                <?php
                                $d = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-11'");
                                echo mysqli_num_rows($d);
                                ?>,
                                <?php
                                $d = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-12'");
                                echo mysqli_num_rows($d);
                                ?>,
                                <?php
                                $d = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-13'");
                                echo mysqli_num_rows($d);
                                ?>,
                                <?php
                                $d = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-24'");
                                echo mysqli_num_rows($d);
                                ?>,
                                <?php
                                $d = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE status_id=1 AND date='2021-08-27'");
                                echo mysqli_num_rows($d);
                                ?>
                            ],
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
                            y: {
                                min: 0,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });



                var ctx = document.getElementById("myChart2").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Produksi", "HRD"],
                        datasets: [{
                            label: 'Jumlah Divisi Yang Lembur',
                            data: [
                                <?php
                                $a = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE divisi='produksi' AND status_id=1");
                                echo mysqli_num_rows($a);
                                ?>,
                                <?php
                                $b = mysqli_query($con, "SELECT * FROM input_spl INNER JOIN user ON input_spl.user_id=user.id WHERE divisi='HRD' AND status_id=1");
                                echo mysqli_num_rows($b);
                                ?>
                            ],
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
                            y: {
                                min: 0,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

</script>