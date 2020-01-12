
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Manage Channels</h3>
				<div class="box-tools pull-right">
					<a class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-id'>Create Channel <i class="fa fa-plus-circle"></i></a>

					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<?php if ($this->session->flashdata('channel_created')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('channel_created').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('delete_successful')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('delete_successful').'</strong>
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

						<?php if ($this->session->flashdata('channel_updated')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('channel_updated').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<table class="table table-hover" id="example2">
							<div class="pull-right">
								
							</div>
							<thead>
								<tr>
									<th>SN</th>
									<th>Channel Name</th>
									<th>Videos</th>
									<th>Date</th>
									<th>Created By</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$sn = 1;
								$user_in_session = $this->ion_auth->user()->row(); 
								foreach ($channels as $channel ) {
									$number_of_topics_per_channel = $this->Topics_model->num_by_channel($channel->id);
									$user = $this->ion_auth->user($channel->created_by)->row();
									$created_by = ($user->first_name == '' && $user->first_name == '') ? $user->username : $user->first_name.' '.$user->last_name;
									$delete_button = ($user_in_session->usertype == 7) ? '' : "<a class='btn btn-danger btn-xs' data-toggle='modal' href='#modal-id-del$channel->id'>Edit <i class='fa fa-trash'></i></a>";
									echo '<tr>
											<td>'.$sn.'</td>
											<td>'.$channel->name.'</td>
											<td>'.$number_of_topics_per_channel.'</td>
											<td>'.date('d/M', $channel->created_at).'</td>
											<td>'.$created_by.'</td>
											<td>';
												echo "<a class='btn btn-primary btn-xs' data-toggle='modal' href='#modal-id$channel->id'>Edit <i class='fa fa-edit'></i></a> ";
												echo ''.$delete_button.'
												
											</td>
										</tr>
										
										
										<div class="modal fade" id="modal-id'.$channel->id.'">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Edit Channel</h4>
													</div>
													<div class="modal-body">
														<form action="'.base_url('channels/edit/'.$channel->id.'').'" method="POST" role="form">
																
															<div class="form-group">
																<!-- <label class="sr-only" for=""></label> -->
																<input type="text" class="form-control" id="name" name="name" value="'.$channel->name.'" placeholder="Channel Name" required>
															</div>
															<button type="submit" class="btn btn-primary">Save <i class="fa fa-check"></i></button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														</form>
													</div>
													<div class="modal-footer">
														<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
													</div>
												</div>
											</div>
										</div>


										<div class="modal fade" id="modal-id-del'.$channel->id.'">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Are you sure you want to delete this channel?</h4>
													</div>
													<div class="modal-body">
													<a href="'.base_url('channels/delete/'.$channel->id.'').'" class="btn btn-danger btn-xs">YES, Delete <i class="fa fa-trash"></i></a>
														<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">NO, Cancel</button>
													</div>
													<div class="modal-footer">
													</div>
												</div>
											</div>
										</div>
										';

										$sn++;
								}
							?>
							</tbody>
						</table>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- ./box-body -->
			
			<div class="box-footer">
				<div class="row">
					
				</div>
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->



<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Create Channel</h4>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('channels/create');?>" method="POST" role="form">
						
					<div class="form-group">
						<!-- <label class="sr-only" for=""></label> -->
						<input type="text" class="form-control" id="name" name="name" placeholder="Channel Name" required>
					</div>
					<button type="submit" class="btn btn-primary">Save <i class="fa fa-check"></i></button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</form>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>



