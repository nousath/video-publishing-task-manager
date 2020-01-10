<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Submitted Audios</h3>

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
						<legend><a class="btn btn-danger btn-xs" data-toggle="modal" href='#modal-id'>View Drafts</a></legend>
						<?php if ($this->session->flashdata('toggle_success')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('toggle_success').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('assingment_success')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('assingment_success').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('reserve_message')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('reserve_message').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('audio_declined')): ?>			
						<?php echo '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('audio_declined').'</strong>
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
						
						<table class="table table-hover">
							<thead>
								<tr>
									<th>SN</th>
									<th>Topic</th>
									<th>Submitted By</th>
									<th>Date</th>
									<th>File</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$sn = 1;
								if($audios != null){
									foreach ($audios as $audio ) {
										$topic = $this->Topics_model->get_by_id($audio->topic_id);
										$user = $this->ion_auth->user($audio->submitted_by)->row();
										if($user =='' || $audio->submitted_by == ''){
											$submitted_by = 'User Deleted';
										}else{
											$submittedby = $this->ion_auth->user($audio->submitted_by)->row(); 
											$submitted_by = $submittedby->username;
										}
										
										
										// $status = ($audio->approved == 0) ? '<a href="'.base_url('audios/toggle_approve/'.$audio->id.'').'" class="btn btn-success btn-sm btn-block">Approve Script  <i class="fa fa-toggle-on"></i></a>' : '<a href="'.base_url('audios/toggle_approve/'.$audio->id.'').'" class="btn btn-danger btn-sm btn-block">Decline Script  <i class="fa fa-toggle-off"></i></a>';
										// $status = ($audio->approved == 0) ? '<a href="'.base_url('audios/toggle_approve/'.$audio->id.'').'" class="btn btn-success btn-xs">Approve Audio  <i class="fa fa-toggle-on"></i></a>' : '';
										// $decline = ($audio->approved == 0) ? '<a href="'.base_url('audios/decline/'.$audio->id.'').'" class="btn btn-danger btn-xs">Decline Audio  <i class="fa fa-toggle-off"></i></a>' : '';
										// $reserve_button = ($audio->is_reserved == 0) ? '<a href="'.base_url('reserves/do_reserve/'.$audio->id.'/2').'" class="btn btn-primary btn-xs">Reserve Audio  <i class="fa fa-archive"></i></a>' : '';
										// '.$reserve_button.'
										$assigned_user = $this->ion_auth->user($topic->user2_id)->row();

										$assign = ($audio->approved == 1 ) ? '<a href="'.base_url('audios/assign/'.$topic->id.'').'" class="btn btn-info btn-xs">Assign to Editor  <i class="fa fa-share"></i></a>' : 'Assigned to <span class="text text-primary text-bold">'.$assigned_user->username.' </span>';
										$draft_button = ($audio->is_draft == 0) ? '<a class="btn btn-default btn-xs" href="'.base_url('audios/save_as_draft/'.$audio->id.'').'"><i class="fa fa-file"></i> Save as draft</a>' : '';
										$editing_status = ($script->is_proofread == 1) ? '<span data-toggle="tooltip" title="This audio has been edited" class="badge bg-green"><i class="fa fa-check"></i></span>' : '';
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.' '.$editing_status.'</td>
												<td>'.$submitted_by.'</td>
												<td>'.date('d/M', $audio->submitted_at).'</td>
												<td><a href="'.base_url("topics/audio/$audio->topic_id/$audio->id").'" class="btn btn-warning btn-xs btn-block">Listen/Download <i class="fa fa-microphone"></i></a></td>
												<td> '.$assign.' '.$draft_button.'</td>
											</tr>';

											$sn++;
									}
								}else{
									echo '<p>No records yet</p>';
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
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>SN</th>
						<th>Topic</th>
						<th>Submitted By</th>
						<th>Date</th>
						<th>File</th>
						<th>Approve/Decline</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$sn = 1;
					foreach ($drafts as $draft ) {
						$topic = $this->Topics_model->get_by_id($draft->topic_id);
						$user = $this->ion_auth->user($draft->submitted_by)->row();
						if($user =='' || $draft->submitted_by == ''){
							$submitted_by = 'User Deleted';
						}else{
							$submittedby = $this->ion_auth->user($draft->submitted_by)->row(); 
							$submitted_by = $submittedby->username;
						}
						
						
						// $status = ($draft->approved == 0) ? '<a href="'.base_url('audios/toggle_approve/'.$audio->id.'').'" class="btn btn-success btn-xs">Approve Audio  <i class="fa fa-toggle-on"></i></a>' : '';
						$assign = ($draft->approved == 1 ) ? '<a href="'.base_url('audios/assign/'.$topic->id.'').'" class="btn btn-info btn-xs">Assign to Editor  <i class="fa fa-share"></i></a>' : '';
						// $decline = ($audio->approved == 0) ? '<a href="'.base_url('audios/decline/'.$audio->id.'').'" class="btn btn-danger btn-xs">Decline Audio  <i class="fa fa-toggle-off"></i></a>' : '';
						$reserve_button = ($draft->is_reserved == 0) ? '<a href="'.base_url('reserves/do_reserve/'.$draft->id.'/2').'" class="btn btn-primary btn-xs">Reserve Audio  <i class="fa fa-archive"></i></a>' : '';
						// $draft_button = ($audio->is_draft == 0) ? '<a class="btn btn-default btn-xs" href="'.base_url('audios/save_as_draft/'.$audio->id.'').'"><i class="fa fa-file"></i> Save as draft</a>' : '';
						echo '<tr>
								<td>'.$sn.'</td>
								<td>'.$topic->topic.'</td>
								<td>'.$submitted_by.'</td>
								<td>'.date('d/M', $draft->submitted_at).'</td>
								<td><a href="'.base_url("topics/audio/$draft->topic_id/$draft->id").'" class="btn btn-warning btn-xs btn-block">Listen/Download <i class="fa fa-microphone"></i></a></td>
								<td>'.$assign.' '.$reserve_button.'</td>
							</tr>';

							$sn++;
					}
				?>
				</tbody>
			</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>
