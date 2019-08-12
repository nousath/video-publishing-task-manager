
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

						<?php if ($this->session->flashdata('message')): ?>			
						<?php echo '<div class="alert alert-warning">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('message').'</strong>
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



						<div class="table-responsive">
							<table class="table table-hover" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
								<thead>
									<tr>
										<th>SN</th>
										<th>Title</th>
										<th>Assigned To</th>
										<th>Created by</th>
										<th>Created at</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									// set initial value for SN counter
									$sn = 1;
									foreach ($topics as $topic ) {										

										$writers = $this->User_model->get_by_usertype_and_channel(2, $topic->channel_id);

										// make foreign key values readable
										$user = $this->ion_auth->user($topic->user_id)->row();
										$assigned = ($topic->user_id != '' ) ? 'Assinged' : 'Not assinged';
										$created_by = $this->ion_auth->user($topic->created_by)->row();
										$doc = (!empty($topic->doc)) ? '<a href="'.base_url('topics/doc/'.$topic->id.'').'" class="btn btn-warning btn-xs"><i class="fa fa-file-word-o"></i> View/Download</a>' : 'Script Unavailable';
										$audio = (!empty($topic->audio)) ? '<a href="'.base_url('topics/audio/'.$topic->id.'').'" class="btn btn-primary btn-xs"><i class="fa fa-microphone"></i> Listen/Download</a>' : 'Audio Unavailable';
										$video = (!empty($topic->video)) ? '<a href="'.base_url('topics/video/'.$topic->id.'').'" class="btn btn-success btn-xs"><i class="fa fa-video-camera"></i> Watch/Download</a>' : 'Video Unavailable';

										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$topic->topic.'</td>
												<td>'.$user->username.'</td>
												<td>'.$created_by->username.'</td>
												<td>'.date('d/m/Y H:i:s', $topic->created_at).'</td>
												<td>
													<a class="btn btn-success btn-xs" data-toggle="modal" href="#modal-id'.$sn.'"><i class="fa fa-share"></i> Assign to writer</a>
													<a class="btn btn-info btn-xs" href="'.base_url('topics/update/'.$topic->id.'').'"><i class="fa fa-edit"></i> Edit</a>
													<a class="btn btn-danger btn-xs" href="'.base_url('topics/delete/'.$topic->id.'').'"><i class="fa fa-trash"></i> Delete</a>
												</td>
											</tr>';


									
										echo '<div class="modal fade" id="modal-id'.$sn.'">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title">Assign Script to Artist</h4>
														</div>
														<div class="modal-body">
															<form action="'.base_url('topics/assign_to_writer').'" method="POST" role="form">
																<!-- <legend>Assign Script to Artist</legend> -->
											
																<div class="form-group">
																	<label for="document" class="control-label"><span class="text text-danger">*</span> Topic '.form_error('topic').'</label>
																	<input type="text" class="form-control" name="topic" id="topic" value="'.$topic->topic.'" required disabled/>
																</div>
											
																<div class="form-group">
																	<label for="document" class="control-label"><span class="text text-danger">*</span> Writer '.form_error('user').'</label>
																	<select name="user" id="user" class="form-control" required>
																		<option value="">--choose--</option>
																		';
																			foreach ($writers as $writer ) {
																				$writer_name = ($writer->first_name == '' && $writer->first_name == '') ? $writer->username : $writer->first_name.' '.$writer->last_name;
																				echo '<option value="'.$writer->id.'">'.$writer_name.'</option>';
																			}
																	echo '	
																	</select>
																</div>
											
																<!-- $topic->id -->
																<input type="hidden" id="topic_id" name="topic_id" value="'.$topic->id.'">
															
																<button type="submit" class="btn btn-info btn-sm">Submit <i class="fa fa-share"></i></button> 
															</form>
														</div>
														<!-- <div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary">Save changes</button>
														</div> -->
													</div>
												</div>
											</div>';

										$sn++;

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




<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->

