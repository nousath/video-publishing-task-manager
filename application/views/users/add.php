<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Add</h3>
            </div>
            <?php echo form_open('users/add'); ?>
          	<div class="box-body">
          		<!-- <div class="row clearfix"> -->
				  <div class="col-md-6">
						<label for="username" class="control-label"><span class="text-danger">*</span>Username</label>
						<div class="form-group">
							<input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control" id="username" required />
							<span class="text-danger"><?php echo form_error('username');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="password" class="control-label"><span class="text-danger">*</span>Password</label>
						<div class="form-group">
							<input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="password" required />
							<span class="text-danger"><?php echo form_error('password');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label"><span class="text-danger">*</span>Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" required />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
				
					<div class="col-md-6">
						<label for="job_title" class="control-label"><span class="text-danger">*</span>User Group</label>
						<div class="form-group">
							<select name="group" class="form-control" id="group" required>
								<option></option>
								<?php								
									foreach ($groups as $group) {
										echo '<option value="'.$group->id.'">'.$group->name.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="salary" class="control-label"><span class="text-danger">*</span>Salary</label>
						<div class="form-group">
							<input type="number" name="salary" value="<?php echo $this->input->post('salary'); ?>" class="form-control" id="salary" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="job_describtion" class="control-label">Job Describtion</label>
						<div class="form-group">
							<textarea name="job_describtion" class="form-control" id="job_describtion"><?php echo $this->input->post('job_describtion'); ?></textarea>
						</div>
					</div>
				<!-- </div> -->
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
