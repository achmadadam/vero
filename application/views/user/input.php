                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    <div class="row">
                    	<div class="col-lg-8">
                    			<form action="<?php echo base_url('user/input') ?>" method="post">
                    		<div class="form-group row">
                    			<label for="name" class="col-sm-2 col-form-label">Name</label>
                    			<div class="col-sm-10">
                    				<input type="text" class="form-control" id="name" name="name" value="<?= $this->fungsi->user_login()->name ?>" readonly>
										<input type="hidden" name="id_user" value="<?= $this->fungsi->user_login()->id ?>" />
                    				<?= form_error('name', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		<div class="form-group row">
                    			<label for="date" class="col-sm-2 col-form-label">Date</label>
                    			<div class="col-sm-10">
                    				<input type="date" class="form-control" id="date" name="date">
                    				<?= form_error('date', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		<div class="form-group row">
                    			<label for="divisi" class="col-sm-2 col-form-label">Division</label>
                    			<div class="col-sm-10">
									<select name="divisi" id="d" class="form-control">
										<option value="Produksi">Produksi</option>
										<option value="HRD">HRD</option>
										<option value="PPIC">PPIC</option>
										<option value="CNC">CNC</option>
										<option value="Bubut">Bubut</option>
										<option value="Engineering">Engineering</option>
										<option value="Purchase Order">Purchase Order</option>
									</select>
                    				<?= form_error('divisi', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		<div class="form-group row">
                    			<label for="jo" class="col-sm-2 col-form-label">No.Job Order</label>
                    			<div class="col-sm-10">
                    				<input type="text" class="form-control" id="jo" name="jo">
                    				<?= form_error('jo', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		<div class="form-group row">
                    			<label for="qty" class="col-sm-2 col-form-label">QTY</label>
                    			<div class="col-sm-10">
                    				<input type="text" class="form-control" id="qty" name="qty">
                    				<?= form_error('qty', '<small class="text-danger pl-2">', '</small>');?>
                    			</div>
                    		</div>
                    		<div class="form-group row">
                    			<label for="time" class="col-sm-2 col-form-label">Hours</label>
                    			<div class="col-sm-10">
                    				<input type="text" class="form-control" id="time" name="time">
                    				<?= form_error('time', '<small class="text-danger pl-2">', '</small>');?>
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

            