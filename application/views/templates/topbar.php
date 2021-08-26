        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <?php
                    $con = mysqli_connect("localhost", "root", "", "db_pl");
                    // Check connection
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }

                    $userid = $this->fungsi->user_login()->id;

                    $result = mysqli_query($con, "SELECT * FROM input_spl WHERE user_id=$userid");
                    $resultbaca = mysqli_query($con, "SELECT * FROM input_spl WHERE baca!='dibaca' && user_id=$userid");
                    $banyak = mysqli_num_rows($resultbaca);
                    ?>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- <div class="topbar" >
                            <i class="far fa-bell"></i>
                        </div> -->
                        <li class="nav-item dropdown no-arrow mx-1">

                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">
                                    <?php echo $banyak; ?>
                                </span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifikasi
                                    <input type="hidden" id="user_id" value="<?= $userid ?>" />
                                </h6>

                                <style type="text/css">
                                    .dibaca {
                                        background-color: #ccc;
                                    }

                                    .nott:hover {
                                        background-color: #eee;
                                    }
                                </style>

                                
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                ?>

                                    

                                    <a class="dropdown-item d-flex align-items-center <?= $row['baca'] ?>" href="<?=base_url("user/data");?>?data=<?= $row['id_input'] ?>">
                                        <div class="mr-3">
                                            <div class="icon-circle <?php
                                                                    $status = "";
                                                                    if ($row['status_id'] == 1) {
                                                                        echo "bg-success";
                                                                        $status = "Approve";
                                                                    } else if ($row['status_id'] == 2) {
                                                                        echo "bg-primary";
                                                                        $status = "Waiting";
                                                                    } else {
                                                                        echo "bg-danger";
                                                                        $status = "Reject";
                                                                    }
                                                                    ?>">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?php echo $row['date'] ?></div>
                                            <span class="font-weight-bold"><?php echo $status ?></span>
                                            <div><?= $row['reason_reject']; ?></div>
                                        </div>
                                    </a>
                                <?php
                                }
                                mysqli_close($con); ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>