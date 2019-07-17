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
						
						<table class="table table-hover" id="example2">
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
								if($scripts != null){
									foreach ($scripts as $script ) {
										$topic = $this->Topics_model->get_by_id($script->topic_id);
										$submitted_by = $this->ion_auth->user($script->submitted_by)->row(); 
										$status = ($script->approved == 0) ? '<a href="'.base_url('scripts/toggle_approve/'.$script->id.'').'" class="btn btn-success btn-sm btn-block">Approve Script  <i class="fa fa-toggle-on"></i></a>' : '<a href="'.base_url('scripts/toggle_approve/'.$script->id.'').'" class="btn btn-danger btn-sm btn-block">Decline Script  <i class="fa fa-toggle-off"></i></a>';
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.$submitted_by->username.'</td>
												<td>'.date('M d, Y H:i:s', $script->submitted_at).'</td>
												<td><a href="'.base_url('topics/doc/'.$script->topic_id.'').'" class="btn btn-warning btn-sm btn-block"><i class="fa fa-file-word-o"></i> View/Download</a></td>
												<td>'.$status.'</td>
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

