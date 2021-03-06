<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users Listing</h3>
            	<div class="box-tools">
                    <a href="<?=site_url('users/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add User</a> 
                </div>
            </div>
            <div class="box-body">
			<?php if ($this->session->flashdata('delete_success')): ?>			
			<?php echo '<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>'.$this->session->flashdata('delete_success').'</strong>
									</div>'; 
			?>
			<?php endif; ?>

			<?php if ($this->session->flashdata('delete_fail')): ?>			
			<?php echo '<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>'.$this->session->flashdata('delete_fail').'</strong>
									</div>'; 
			?>
			<?php endif; ?>

			<?php if ($this->session->flashdata('message')): ?>			
			<?php echo '<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>'.$this->session->flashdata('message').'</strong>
									</div>'; 
			?>
			<?php endif; ?>


                <table class="table table-striped text-left" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
					<thead>	
						<tr>
							<th>Avatar</th>
							<th>Username</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Designition</th>
							
							<th>Tasks Completed</th>
							<th>Last login</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$user_in_session = $this->ion_auth->user()->row(); 
	
						foreach ($users as $u ) {
							$delete_button = ($user_in_session->usertype == 7) ? '' : "<a class='btn btn-danger btn-xs' data-toggle='modal' href='#modal-id-del$u->id'>Delete <i class='fa fa-trash'></i></a>";

							
						echo '	<tr data-href="'.base_url('profile/index/'.$u->id.'').'">
									<td><img src="'.base_url().$u->photo.'" class="img img-responsive img-circle img-md"></td>
									<td>'.$u->username.'</td>
									<td>'.$u->email.'</td>
									<td>'.$u->phone.'</td>
									<td>'.$u->first_name.'</td>
									<td>'.$u->last_name.'</td>
									<td>'.$u->job_title.'</td>
									
									<td>'.$u->tasks_completed.'</td>							
									<td>'.date('d/m/Y H:i:s', $u->last_login).'</td>							
									<td>
										<a href="'.site_url('users/edit/'.$u->id).'" class="btn btn-info btn-xs">Edit <span class="fa fa-pencil"></span></a> 
										'.$delete_button.'
									</td>
								</tr>
							
							
								<div class="modal fade" id="modal-id'.$u->id.'">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Are you sure you want to delete <span class="text text-danger">'.$u->username.'?</span></h4>
										</div>
										<div class="modal-body">
										<a href="'.site_url('users/remove/'.$u->id).'" class="btn btn-danger btn-xs">YES, Delete <span class="fa fa-trash"></span></a>
											<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">NO, Cancel</button>
										</div>
										<div class="modal-footer">
										</div>
									</div>
								</div>
							</div>';
						}
						
					?>
					</tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function () {
		$(document.body).on("click", "tr[data-href]", function(){
			window.location.href = this.dataset.href;
		});
	});
</script>

