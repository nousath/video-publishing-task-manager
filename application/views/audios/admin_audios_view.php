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
					<div class="col-md-9">
						<legend>Submitted Audios</legend>
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
						
						<table class="table table-hover">
							<thead>
								<tr>
									<th>SN</th>
									<th>Topic</th>
									<th>Submitted By</th>
									<th>Submitted At</th>
									<th>File</th>
									<th>Approve/Decline</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$sn = 1;
								if($audios != null){
									foreach ($audios as $audio ) {
										$topic = $this->Topics_model->get_by_id($audio->topic_id);
										$submitted_by = $this->ion_auth->user($audio->submitted_by)->row(); 
										// $status = ($audio->approved == 0) ? '<a href="'.base_url('audios/toggle_approve/'.$audio->id.'').'" class="btn btn-success btn-sm btn-block">Approve Script  <i class="fa fa-toggle-on"></i></a>' : '<a href="'.base_url('audios/toggle_approve/'.$audio->id.'').'" class="btn btn-danger btn-sm btn-block">Decline Script  <i class="fa fa-toggle-off"></i></a>';
										$status = ($audio->approved == 0) ? '<a href="'.base_url('audios/toggle_approve/'.$audio->id.'').'" class="btn btn-success btn-sm">Approve Audio  <i class="fa fa-toggle-on"></i></a>' : '';
										$assign = ($audio->approved == 1 && $topic->assigned == 0) ? '<a href="'.base_url('audios/assign/'.$topic->id.'').'" class="btn btn-info btn-sm">Assign to Editor  <i class="fa fa-share"></i></a>' : '';
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.$submitted_by->username.'</td>
												<td>'.date('M d, Y H:i:s', $audio->submitted_at).'</td>
												<td><a href="'.base_url('topics/audio/'.$audio->topic_id.'').'" class="btn btn-warning btn-sm btn-block">Listen/Download <i class="fa fa-microphone"></i></a></td>
												<td>'.$status.' '.$assign.'</td>
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

