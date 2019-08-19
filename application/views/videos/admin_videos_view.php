<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Submitted Videos</h3>

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

						<?php if ($this->session->flashdata('video_published')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('video_published').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('video_reserved')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('video_reserved').'</strong>
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
									<th>Edited By</th>
									<th>Submitted At</th>
									<th>File</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$sn = 1;
								if($videos != null){
									foreach ($videos as $video ) {
										$topic = $this->Topics_model->get_by_id($video->topic_id);
										$user = $this->ion_auth->user($video->submitted_by)->row();
										if($user =='' || $video->submitted_by == ''){
											$submitted_by = 'User Deleted';
										}else{
											$submittedby = $this->ion_auth->user($video->submitted_by)->row(); 
											$submitted_by = $submittedby->username;
										}
										$status = ($video->approved == 0) ? '<a href="'.base_url('videos/toggle_approve/'.$video->id.'').'" class="btn btn-success btn-xs">Approve Video  <i class="fa fa-toggle-on"></i></a>' : '';
										$publish = '<a href="'.base_url('videos/publish/'.$topic->id.'').'" class="btn btn-success btn-xs">Mark as Published  <i class="fa fa-check"></i></a>';
										$reserve_button = ($video->is_reserved == 0) ? '<a href="'.base_url('reserves/do_reserve/'.$video->id.'/3').'" class="btn btn-primary btn-xs">Reserve Video  <i class="fa fa-archive"></i></a>' : '';
										$draft_button = ($video->is_draft == 0) ? '<a class="btn btn-default btn-xs" href="'.base_url('videos/save_as_draft/'.$video->id.'').'"><i class="fa fa-file"></i> Save as draft</a>' : '';
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.$submitted_by.'</td>
												<td>'.date('M d, Y H:i:s', $video->submitted_at).'</td>
												<td><a href="'.base_url("topics/video/$video->topic_id/$video->id").'" class="btn btn-warning btn-xs btn-block"><i class="fa fa-video-camera"></i> Watch/Download</a></td>
												<td>'.$status.' '.$publish.' '.$reserve_button.' '.$draft_button.'</td>
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
						<th>Edited By</th>
						<th>Submitted At</th>
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
						$status = ($draft->approved == 0) ? '<a href="'.base_url('videos/toggle_approve/'.$draft->id.'').'" class="btn btn-success btn-xs btn-block">Approve Video  <i class="fa fa-toggle-on"></i></a>' : '';
						$publish = '<a href="'.base_url('videos/publish/'.$topic->id.'').'" class="btn btn-success btn-xs btn-block">Mark as Published  <i class="fa fa-check"></i></a>';
						$reserve_button = ($draft->is_reserved == 0) ? '<a href="'.base_url('reserves/do_reserve/'.$draft->id.'/3').'" class="btn btn-primary btn-xs btn-block">Reserve Video  <i class="fa fa-archive"></i></a>' : '';
						echo '<tr>
								<td>'.$sn.'</td>
								<td>'.$topic->topic.'</td>
								<td>'.$submitted_by.'</td>
								<td>'.date('M d, Y H:i:s', $draft->submitted_at).'</td>
								<td><a href="'.base_url("topics/video/$draft->topic_id/$draft->id").'" class="btn btn-warning btn-xs btn-block"><i class="fa fa-video-camera"></i> Watch/Download</a></td>
								<td>'.$publish.' '.$reserve_button.'</td>
							</tr>';

							$sn++;
					}
				?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
