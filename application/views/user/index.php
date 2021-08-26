


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    

                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $user['name']; ?></h5>
                                <p class="card-text"><?= $user['username']; ?></p>
                                <p class="card-text"><small class="text-muted">Staff Since <?= date('d F Y', $user['date_created']); ?></small></p>

                              
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            