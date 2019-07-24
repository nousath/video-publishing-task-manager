<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<!-- <h3 class="box-title">Monthly Recap Report</h3> -->

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<div class="row">
					<div class="col-md-10">
						<legend>Submitted Videos</legend>
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
										$status = ($video->approved == 0) ? '<a href="'.base_url('videos/toggle_approve/'.$video->id.'').'" class="btn btn-success btn-sm">Approve Video  <i class="fa fa-toggle-on"></i></a>' : '';
										$publish = ($video->approved == 1) ? '<a href="'.base_url('videos/publish/'.$topic->id.'').'" class="btn btn-success btn-sm">Mark as Published  <i class="fa fa-check"></i></a> <a href="'.base_url('videos/reserve/'.$topic->id.'').'" class="btn btn-info btn-sm">Set as Reserve  <i class="fa fa-archive"></i></a>' : '';
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.$submitted_by.'</td>
												<td>'.date('M d, Y H:i:s', $video->submitted_at).'</td>
												<td><a href="'.base_url('topics/video/'.$video->topic_id.'').'" class="btn btn-warning btn-sm btn-block"><i class="fa fa-video-camera"></i> Watch/Download</a></td>
												<td>'.$status.' '.$publish.'</td>
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

