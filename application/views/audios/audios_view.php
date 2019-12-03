
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

						


						<form action="<?=base_url('audios/upload'); ?>" method="POST" enctype="multipart/form-data" role="form">
							<legend>Upload Audios to Admin</legend>

							<div class="form-group">
								<label for="document" class="control-label">* Topic</label>
								<select name="selected_topic" id="selected_topic" class="form-control" required>
									<option value=""></option>
									<?php 
										if($assigned_scripts != null){

											foreach ($assigned_scripts as $topic ) {
												echo '<option value="'.$topic->id.'">'.$topic->topic.'</option>';
											}
										}
										// else{
										// 	echo 'No assigned scripts';
										// }
									?>
									
								</select>
							</div>

							<div class="form-group">
								<label for="document" class="control-label">Upload MP3 or WAV audio file</label>
								<input type="file" class="form-control" name="audio" id="audio">
							</div>
						
							<button type="submit" class="btn btn-info btn-sm">Submit <i class="fa fa-upload"></i></button>
						</form>
						
					</div>
					<!-- /.col -->

					<div class="col-md-4">
						<legend>Download scripts</legend>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>SN</th>
									<th>Topic</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$sn = 1;
								if($assigned_scripts != null){
									foreach ($assigned_scripts as $topic ) {
										
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td><a href="'.base_url($topic->doc).'" class="btn btn-warning btn-sm btn-block"><i class="fa fa-file-word-o"></i> Download Script</a></td>
											</tr>';

											$sn++;
									}
								}
							?>
							</tbody>
						</table>
					</div>
					<!-- /.col -->

					<div class="col-md-5">
						<legend>My Submitted Audios</legend>
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
									<!-- <th>Audio Status</th> -->
								</tr>
							</thead>
							<tbody>
							<?php 
								$sn = 1;
								// if($scripts_by_user != null){
									foreach ($audios as $audio ) {
										$topic = $this->Topics_model->get_by_id($audio->topic_id);
										// $status = ($audio->approved == 0) ? 'Not Approved <i class="fa fa-times"></i>' : 'Approved <i class="fa fa-check"></i>';
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.date('d/M', $audio->submitted_at).'</td>
												<td><a class="btn btn-danger btn-flat" href="'.base_url("audios/index/$audio->id").'">Comments <i class="fa fa-comments"></i></a></td>
											</tr>';

											$sn++;
									}
								// }
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



<!-- <script type="text/javascript">
	$(document).ready(function() { 
		 $('#imageupload').submit(function(e) {	
			if($('#image_up_id').val()) {
				e.preventDefault();
 
				$("#progress-bar-status-show").width('0%');
				var file_details 		= 	document.getElementById("image_up_id").files[0];
				var extension 			= 	file_details['name'].split(".");
				
				var allowed_extension 	= 	["png", "jpg", "jpeg"];
				var check_for_valid_ext = 	allowed_extension.indexOf(extension[1]);
 
				
 
				if(file_details['size'] > 2097152)
				{
					alert('Please upload a file less than 2 MB');
					return false;
				}
				else if(check_for_valid_ext == -1)
				{
					alert('upload valid image file');
					return false;
				}
				else
				{	
					if(file_details['size'] < 2097152 && check_for_valid_ext != -1)
					{
						$('#loader').show();
						$(this).ajaxSubmit({ 
							target:   '#toshow', 
							beforeSubmit: function() {
							  $("#progress-bar-status-show").width('0%');
							},
							uploadProgress: function (event, position, total, percentComplete){	
								$("#progress-bar-status-show").width(percentComplete + '%');
								$("#progress-bar-status-show").html('<div id="progress-percent">' + percentComplete +' %</div>');								
							},
							success:function (){
								$('#loader').hide();
								$('#imageDiv').show();
								var url = $('#toshow').text();
								var img = document.createElement("IMG");
								img.src = url;
								img.height = '100';
								img.width  = '150';
								document.getElementById('imageDiv').appendChild(img);							
							},
							resetForm: true 
						}); 
						return false;
					}		
				}		 
			}
		});
	}); 
	</script> -->
