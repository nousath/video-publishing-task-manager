
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
					<div class="col-md-6">

						<?php if ($this->session->flashdata('error_message')): ?>			
						<?php echo '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('error_message').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						


						<form action="<?=base_url('audios/assign_to_editor/'.$topic->topic.''); ?>" method="POST" role="form">
							<legend>Assign Voice-over to Editor</legend>

							<div class="form-group">
								<label for="document" class="control-label"><span class="text text-danger">*</span> Topic</label>
								<input type="text" class="form-control" name="topic" id="topic" value="<?=$topic->topic; ?>" required="required" disabled/>
							</div>

							<div class="form-group">
								<label for="document" class="control-label"><span class="text text-danger">*</span> Voice-Over Artists</label>
								<select name="user" id="user" class="form-control" required>
									<option value=""></option>
									<?php 
										foreach ($editors as $editor ) {
											$editor_name = ($editor->first_name == '' && $editor->first_name == '') ? $editor->username : $editor->first_name.' '.$editor->last_name;
											echo '<option value="'.$editor->id.'">'.$editor_name.'</option>';
										}
									?>
									
								</select>
							</div>
						
							<button type="submit" class="btn btn-info btn-sm">Submit <i class="fa fa-upload"></i></button>
						</form>
						
					</div>
					<!-- /.col -->

					<div class="col-md-6">
						
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

