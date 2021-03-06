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
						<legend>Submitted Scripts</legend>
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
						
						<table class="table table-hover" id="example2">
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
								if($scripts != null){
									foreach ($scripts as $script ) {
										$topic = $this->Topics_model->get_by_id($script->topic_id);
										$user = $this->ion_auth->user($script->submitted_by)->row();
										if($user =='' || $script->submitted_by == ''){
											$submitted_by = 'User Deleted';
										}else{
											$submittedby = $this->ion_auth->user($script->submitted_by)->row(); 
											$submitted_by = $submittedby->username;
										}
										// $status = ($script->approved == 0) ? '<a href="'.base_url('scripts/toggle_approve/'.$script->id.'').'" class="btn btn-success btn-sm btn-block">Approve Script  <i class="fa fa-toggle-on"></i></a>' : '<a href="'.base_url('scripts/toggle_approve/'.$script->id.'').'" class="btn btn-danger btn-sm btn-block">Decline Script  <i class="fa fa-toggle-off"></i></a>';
										$status = ($script->approved == 0) ? '<a href="'.base_url('scripts/toggle_approve/'.$script->id.'').'" class="btn btn-success btn-sm btn-block">Approve Script  <i class="fa fa-toggle-on"></i></a>' : '';
										$assign = ($script->approved == 1 ) ? '<a href="'.base_url('scripts/assign/'.$topic->id.'').'" class="btn btn-info btn-sm">Assign to Artists  <i class="fa fa-share"></i></a>' : '';
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.$submitted_by.'</td>
												<td>'.date('d/M', $script->submitted_at).'</td>
												<td><a href="'.base_url('topics/doc/'.$script->topic_id.'/'.$script->id.'').'" class="btn btn-warning btn-sm btn-block">View/Download <i class="fa fa-file-word-o"></i></a></td>
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

