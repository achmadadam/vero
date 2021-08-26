                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                   

                    <div class="row">
                    	<div class="col-lg-8">
                    			<form action="<?php echo base_url('registrasi/input') ?>" method="post">
                    		<div class="form-group row">
                    			<label for="name" class="col-sm-2 col-form-label">Name</label>
                    			<div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name">
                    				<?= form_error('name', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		<div class="form-group row">
                    			<label for="username" class="col-sm-2 col-form-label">Username</label>
                    			<div class="col-sm-10">
                    				<input type="text" class="form-control" id="username" name="username">
                    				<?= form_error('username', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		<div class="form-group row">
                    			<label for="divisi" class="col-sm-2 col-form-label">Role Id</label>
                    			<select id="role" name="role_id" class="form-control form-control inverse">
                                    <option selected="0">Select Role Id</option>
                                    <?php foreach ($role as $rl):?> 
                                        <option value="<?= $rl['role_id']; ?>"><?= $rl['role']; ?></option>
                                    <?php endforeach;?>
                                </select>
                    		</div>
                    		<div class="form-group row">
                    			<label for="password" class="col-sm-2 col-form-label">Password</label>
                    			<div class="col-sm-10">
                    				<input type="password" class="form-control" id="password" name="password">
                    				<?= form_error('password', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		
                    	</div>
                    </div>
                			

                    <div class="form-group row">
                    	<div class="col-sm-10">
                    		<button type="submit" class="btn btn-primary">Submit</button>
                    	</div>
                    </div>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            



