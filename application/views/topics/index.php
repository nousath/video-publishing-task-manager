
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<!-- <h3 class="box-title">Details</h3> -->
				<a href="<?=base_url('topics/add'); ?>" class="btn btn-info btn-sm" data-toggle="modal" href='#modal-id'><i class="fa fa-plus"></i> Add New Topic</a>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">

						<?php if ($this->session->flashdata('success_message')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('success_message').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('delete_message')): ?>			
						<?php echo '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('delete_message').'</strong>
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

						<?php if ($this->session->flashdata('draft_message')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('draft_message').'</strong>
												</div>'; 
						?>
						<?php endif; ?>



						<div class="table-responsive">
							<table class="table table-hover" id="example2">
								<thead>
									<tr>
										<th>Topic</th>
										<th>Channel</th>
										<th>Assigned To</th>
										<th>Doc</th>
										<th>Audio</th>
										<th>Video</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$user_in_session = $this->ion_auth->user()->row(); 
									// set initial value for SN counter
									// $sn = 0;
									foreach ($topics as $topic ) {
										// increment SN counter by one per loop
										// $sn++;

										// make foreign key values readable
										// $stage = $this->Stages_model->get_by_id($topic->stage_id);
										// $stage_name = $stage->name;
										$user = $this->ion_auth->user($topic->user_id)->row();
										$assigned = ($topic->user_id != '' ) ? 'Assinged' : 'Not assinged';
										$created_by = $this->ion_auth->user($topic->created_by)->row();
										$doc = (!empty($topic->doc)) ? '<a href="'.base_url($topic->doc).'" style="color:orange;"><i class="fa fa-file-word-o"></i> View/Download</a>' : 'Script Unavailable';
										$audio = (!empty($topic->audio)) ? '<a href="'.base_url($topic->audio).'" style="color:blue;"><i class="fa fa-microphone"></i> Listen/Download</a>' : 'Audio Unavailable';
										$video = (!empty($topic->video)) ? '<a href="'.base_url($topic->video).'" style="color:green;"><i class="fa fa-video-camera"></i> Watch/Download</a>' : 'Video Unavailable';
										$draft_button = ($topic->is_draft == 0) ? '<a class="btn btn-default btn-xs" href="'.base_url('topics/save_as_draft/'.$topic->id.'').'"><i class="fa fa-file"></i> Save as draft</a>' : '';
										$channel = ($topic->channel_id != '') ? $this->Channels_model->get_by_id($topic->channel_id) : 'Channel not found';
										$delete_button = ($user_in_session->usertype == 7) ? '' : "<a class='btn btn-danger btn-xs' data-toggle='modal' href='#modal-id$topic->id'>Delete <i class='fa fa-trash'></i></a>";

										echo '<tr>
												<td>'.$topic->topic.'</td>
												<td>'.$channel->name.'</td>
												<td>'.$user->username.'</td>
												<td>
													'.$doc.'
												</td>
												<td>
													'.$audio.'
												</td>
												<td>
													'.$video.'
												</td>
												<td>
													<a class="btn btn-info btn-xs" href="'.base_url('topics/update/'.$topic->id.'').'"><i class="fa fa-edit"></i> Edit</a>
													'.$delete_button.'
													'.$draft_button.'
												</td>
											</tr>
											
											
											<div class="modal fade" id="modal-id'.$topic->id.'">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Are you sure you want to delete <span class="text text-danger">'.$topic->topic.'?</span></h4>
													</div>
													<div class="modal-body">
														<a class="btn btn-danger btn-xs" href="'.base_url('topics/delete/'.$topic->id.'').'"><i class="fa fa-trash"></i>YES, Delete</a>
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

