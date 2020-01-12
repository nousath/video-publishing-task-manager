<?php
	function display_chats(){
		
	}
?>






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
					<div class="col-md-3">

						<?php if ($this->session->flashdata('error_message')): ?>			
						<?php echo '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('error_message').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						


						<form action="<?=base_url('scripts/upload'); ?>" method="POST" enctype="multipart/form-data" role="form">
							<legend>Upload Script to Admin</legend>

							<div class="form-group">
								<label for="document" class="control-label">* Topic</label>
								<select name="selected_topic" id="selected_topic" class="form-control" required>
									<option value=""></option>
									<?php 
										if($assigned_topics != null){

											foreach ($assigned_topics as $topic ) {
												$unsubmitted_topic = $this->Scripts_model->get_num_rows_by_topic($topic->id);
												if($unsubmitted_topic < 1){
													echo '<option value="'.$topic->id.'">'.$topic->topic.'</option>';
												}
												
											}
										}
									?>
									
								</select>
							</div>

							<div class="form-group">
								<label for="document" class="control-label">Upload DOCX or PDF file</label>
								<input type="file" class="form-control" name="document" id="document">
							</div>
						
							<button type="submit" class="btn btn-info btn-sm">Submit <i class="fa fa-upload"></i></button>
						</form>
						
					</div>
					<!-- /.col -->

					<div class="col-md-9">

						<div role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="text text-danger text-bold">Unwritten Scripts (Topics)</span></a>
								</li>
								<li role="presentation">
									<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><span class="text text-success text-bold">Submitted Scripts</span></a>
								</li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">

									<!-- Unwritten Scripts -->
									<!-- <legend>Submitted Scripts</legend> -->
									<?php if ($this->session->flashdata('upload_success')): ?>			
									<?php echo '<div class="alert alert-success">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																<strong>'.$this->session->flashdata('upload_success').'</strong>
															</div>'; 
									?>
									<?php endif; ?>
									
									<table class="table table-hover">
										<thead>
											<tr>
												<th>SN</th>
												<th>Topic</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$sn = 1;
											foreach ($scripts as $script ) {

												$unsubmitted_topic = $this->Scripts_model->get_num_rows_by_topic($script->topic_id);
												if($unsubmitted_topic < 1){
													$topic = $this->Topics_model->get_by_id($script->topic_id);
													echo '<tr>
															<td>'.$sn.'</td>
															<td>'.$topic->topic.'</td>
															<td>'.date('d/M', $script->submitted_at).'</td>
															<td><a class="btn btn-danger btn-flat" href="'.base_url("scripts/index/$script->id").'">Comments <i class="fa fa-comments"></i></a></td>
														</tr>';

													$sn++;
												}
												
											}
										?>
										</tbody> 
									</table>

								</div>

								<!-- Submitted Scripts -->
								<div role="tabpanel" class="tab-pane" id="tab">

									<?php if ($this->session->flashdata('upload_success')): ?>			
									<?php echo '<div class="alert alert-success">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																<strong>'.$this->session->flashdata('upload_success').'</strong>
															</div>'; 
									?>
									<?php endif; ?>
									
									<table class="table table-hover">
										<thead>
											<tr>
												<th>SN</th>
												<th>Topic</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$sn = 1;
											foreach ($scripts as $script ) {
												$topic = $this->Topics_model->get_by_id($script->topic_id);
												echo '<tr>
														<td>'.$sn.'</td>
														<td>'.$topic->topic.'</td>
														<td>'.date('d/M', $script->submitted_at).'</td>
														<td><a class="btn btn-danger btn-flat" href="'.base_url("scripts/index/$script->id").'">Comments <i class="fa fa-comments"></i></a></td>
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



