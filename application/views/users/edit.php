<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Profile</h3>
            </div>
			<!-- 
				Check if logged in user is admin
			 -->
			<?php if (!$this->ion_auth->is_admin()): ?>
		<!-- <div class="row"> -->
			<form role="form" action="<?=base_url('users/edit/'.$user->id); ?>" method="post" enctype="multipart/form-data">
			<div class="box-body">
				<div class="col-md-12">
					<div class="col-md-3">
						<label for="photo" class="control-label">Photo</label>
						<div class="form-group">
							<img src="<?php echo base_url().($this->input->post('photo') ? $this->input->post('photo') : $user->photo); ?>" class="img img-responsive img-rounded" id="photo" height="250" width="200" />
							<label for="photo" class="control-label">Photo</label>
							<input type="file" class="form-control" name="photo" id="photo">
						</div>
					</div>


					<div class="col-md-4">
						<label for="username" class="control-label">Username</label>
						<div class="form-group">
							<input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $user->username); ?>" class="form-control" id="username" disabled />
							<span class="text-danger"><?php echo form_error('username');?></span>
						</div>
					</div>
					<div class="col-md-4">
						<label for="email" class="control-label">Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user->email); ?>" class="form-control" id="email" />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
					<div class="col-md-4">
						<label for="first_name" class="control-label">First Name</label>
						<div class="form-group">
							<input type="text" name="first_name" value="<?php echo ($this->input->post('first_name') ? $this->input->post('first_name') : $user->first_name); ?>" class="form-control" id="first_name" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="last_name" class="control-label">Last Name</label>
						<div class="form-group">
							<input type="text" name="last_name" value="<?php echo ($this->input->post('last_name') ? $this->input->post('last_name') : $user->last_name); ?>" class="form-control" id="last_name" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="job_title" class="control-label">Job Title</label>
						<div class="form-group">
							<input type="text" name="job_title" value="<?php echo ($this->input->post('job_title') ? $this->input->post('job_title') : $user->job_title); ?>" class="form-control" id="job_title" disabled />
						</div>
					</div>
					<div class="col-md-4">
						<label for="employed_on" class="control-label">Employed On</label>
						<div class="form-group">
							<input type="text" name="employed_on" value="<?php echo (date('d/m/Y', $this->input->post('employed_on')) ? date('d/m/Y', $this->input->post('employed_on')) : date('d/m/Y', $user->employed_on)); ?>" class="form-control" id="employed_on" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="salary" class="control-label">Salary</label>
						<div class="form-group">
							<input type="text" name="salary" value="&#8358; <?php echo ($this->input->post('salary') ? $this->input->post('salary') : number_format($user->salary)); ?>" class="form-control" id="salary" disabled />
						</div>
					</div>
					<div class="col-md-4">
						<label for="dob" class="control-label">DOB</label>
						<div class="form-group">
							<input type="text" name="dob" value="<?php echo (date('d/m/Y', $this->input->post('dob')) ? date('d/m/Y', $this->input->post('dob')) : date('d/m/Y', $user->dob)); ?>" class="form-control" id="dob" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="phone" class="control-label">Phone</label>
						<div class="form-group">
							<input type="text" name="phone" value="<?php echo ($this->input->post('phone') ? $this->input->post('phone') : $user->phone); ?>" class="form-control" id="phone" />
						</div>
					</div>
					
						
					</div>
					<div class="col-md-4">
						<div class="box-footer">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-check"></i> Save
							</button>
						</div>	
					</div>
								
					<?php echo form_close(); ?>

				</div>
					
				
					
		<!-- </div> -->
			<?php else: ?>

			<!-- 
				Logged in user not admin
			 -->
				
			 <?php echo form_open('users/edit/'.$user->id); ?>
			<div class="box-body">
					<div class="col-md-12">
						<div class="form-group">
							<img src="<?php echo base_url('uploads/').($this->input->post('photo') ? $this->input->post('photo') : $user->photo); ?>" class="img img-responsive img-circle" id="photo" height="250" width="200" />
						</div>
					</div>
				<!-- <div class="row"> -->
					<div class="col-md-6">
						<label for="username" class="control-label">Username</label>
						<div class="form-group">
							<input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $user->username); ?>" class="form-control" id="username" disabled />
							<span class="text-danger"><?php echo form_error('username');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label"><span class="text-danger">*</span>Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user->email); ?>" class="form-control" id="email" />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="first_name" class="control-label">First Name</label>
						<div class="form-group">
							<input type="text" name="first_name" value="<?php echo ($this->input->post('first_name') ? $this->input->post('first_name') : $user->first_name); ?>" class="form-control" id="first_name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="last_name" class="control-label">Last Name</label>
						<div class="form-group">
							<input type="text" name="last_name" value="<?php echo ($this->input->post('last_name') ? $this->input->post('last_name') : $user->last_name); ?>" class="form-control" id="last_name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="job_title" class="control-label">Job Title</label>
						<div class="form-group">
							<input type="text" name="job_title" value="<?php echo ($this->input->post('job_title') ? $this->input->post('job_title') : $user->job_title); ?>" class="form-control" id="job_title" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="employed_on" class="control-label">Employed On</label>
						<div class="form-group">
							<input type="text" name="employed_on" value="<?php echo (date('d/m/Y', $this->input->post('employed_on')) ? date('d/m/Y', $this->input->post('employed_on')) : date('d/m/Y', $user->employed_on)); ?>" class="form-control" id="employed_on" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="salary" class="control-label">Salary</label>
						<div class="form-group">
							<input type="text" name="salary" value="<?php echo ($this->input->post('salary') ? $this->input->post('salary') : $user->salary); ?>" class="form-control" id="salary" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dob" class="control-label">DOB</label>
						<div class="form-group">
							<input type="text" name="dob" value="<?php echo (date('d/m/Y', $this->input->post('dob')) ? date('d/m/Y', $this->input->post('dob')) : date('d/m/Y', $user->dob)); ?>" class="form-control" id="dob" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="phone" class="control-label">Phone</label>
						<div class="form-group">
							<input type="text" name="phone" value="<?php echo ($this->input->post('phone') ? $this->input->post('phone') : $user->phone); ?>" class="form-control" id="phone" />
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


			<?php endif; ?>

		</div>
    </div>
</div>
