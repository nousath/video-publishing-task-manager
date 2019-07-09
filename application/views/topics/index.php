
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

						<div class="table-responsive">
							<table class="table table-hover" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
								<thead>
									<tr>
										<th>SN</th>
										<th>Title</th>
										<th>Stage</th>
										<th>Assigned To</th>
										<th>Status</th>
										<th>Doc</th>
										<th>Audio</th>
										<th>Video</th>
										<th>Created by</th>
										<th>Created at</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									// set initial value for SN counter
									$sn = 0;
									foreach ($topics as $topic ) {
										// increment SN counter by one per loop
										$sn++;

										// make foreign key values readable
										$stage = $this->Stages_model->get_by_id($topic->stage_id);
										$stage_name = $stage->name;
										$user = $this->ion_auth->user($topic->user_id)->row();
										$assigned = ($topic->user_id == 0 ) ? 'Not assinged' : 'Assinged';
										$created_by = $this->ion_auth->user($topic->created_by)->row();

										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.$stage->name.'</td>
												<td>'.$user->username.'</td>
												<td>'.$assigned.'</td>
												<td>
													<a href="'.base_url('topics/doc/'.$topic->id.'').'" class="btn btn-warning btn-xs"><i class="fa fa-file-word-o"></i> View/Download</a>
												</td>
												<td>
													<a href="'.base_url('topics/audio/'.$topic->id.'').'" class="btn btn-primary btn-xs"><i class="fa fa-microphone"></i> Listen/Download</a>
												</td>
												<td>
													<a href="'.base_url('topics/video/'.$topic->id.'').'" class="btn btn-success btn-xs"><i class="fa fa-video-camera"></i> Watch/Download</a>
												</td>
												<td>'.$created_by->username.'</td>
												<td>'.date('d/m/Y H:i:s', $topic->created_at).'</td>
												<td>
													<a class="btn btn-danger btn-xs" href="'.base_url('topics/delete/'.$topic->id.'').'"><i class="fa fa-trash"></i> Delete</a>
												</td>
											</tr>';

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

