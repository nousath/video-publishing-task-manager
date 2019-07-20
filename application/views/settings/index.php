
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
					<div class="col-md-8">
						<?php if ($this->session->flashdata('message')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('message').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<table class="table table-striped table-hover">
							<thead>
								<!-- <tr>
									<th></th>
								</tr> -->
							</thead>
							<tbody>
								<tr>
									<td class="text text-primary"><strong>System Name - Prefix</strong></td>
									<td><?=$settings->system_name_prefix; ?></td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>System Name - Suffix</strong></td>
									<td><?=$settings->system_name;?></td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Tagline</strong></td>
									<td><?=$settings->tagline;?></td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Header</strong></td>
									<td><?=$settings->header;?></td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Footer</strong></td>
									<td><?=$settings->footer;?></td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Delete Scripts After</strong></td>
									<td>
										<?php 
											if($settings->delete_docs_in == 0){
												echo "Never delete scripts";
											}else{
												echo $settings->delete_docs_in." days";
											}
										?> 
									</td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Delete audios After</strong></td>
									<td>
										<?php 
											if($settings->delete_audios_in == 0){
												echo "Never delete audios";
											}else{
												echo $settings->delete_audios_in." days";
											}
										?> 
									</td>
								</tr>	
								<tr>
									<td class="text text-primary"><strong>Delete videos After</strong></td>
									<td>
										<?php 
											if($settings->delete_videos_in == 0){
												echo "Never delete videos";
											}else{
												echo $settings->delete_videos_in." days";
											}
										?> 
									</td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Backup Database After</strong></td>
									<td>
										<?php 
											if($settings->backup_in == 0){
												echo "Never Backup database";
											}else{
												echo $settings->backup_in." days";
											}
										?> 
									</td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Software Version</strong></td>
									<td><?=$settings->software_version;?> </td>
								</tr>
								<tr>
									<td class="text text-primary"><strong>Software Mode</strong></td>
									<td>
										<?php 
											if($settings->app_mode == 0){
												echo "Software currently on maintainance mode";
											}elseif($settings->app_mode == 1){
												echo "Software is currently LIVE";
											}
										?> 
									</td>
								</tr>
							</tbody>
						</table>
						
					</div>
					<!-- /.col -->

					<div class="col-md-4">
						<a class="btn btn-warning btn-lg btn-block" data-toggle="modal" href='#modal-id'>Change Settings <i class="fa fa-cogs"></i></a>
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
				<h4 class="modal-title">Edit System Settings</h4>
			</div>
			<div class="modal-body">
				
				<form action="<?=base_url('settings/update_action');?>" method="POST" role="form">
					<!-- <legend>Form title</legend> -->
				
					<div class="form-group">
						<label for="">System Name Prefix</label>
						<input type="text" class="form-control" id="system_name_prefix" name="system_name_prefix" value="<?=$settings->system_name_prefix; ?>" placeholder="Enter name prefix" required>
					</div>

					<div class="form-group">
						<label for="">System Name</label>
						<input type="text" class="form-control" id="system_name" name="system_name" value="<?=$settings->system_name; ?>" placeholder="Enter system name" required>
					</div>

					<div class="form-group">
						<label for="">Header</label>
						<input type="text" class="form-control" id="header" name="header" value="<?=$settings->header; ?>" placeholder="Header" required>
					</div>

					<div class="form-group">
						<label for="">Footer</label>
						<input type="text" class="form-control" id="footer" name="footer" value="<?=$settings->footer; ?>" placeholder="Footer" required>
					</div>

					<div class="form-group">
						<label for="">Tagline</label>
						<input type="text" class="form-control" id="tagline" name="tagline" value="<?=$settings->tagline; ?>" placeholder="Tagline" required>
					</div>

					<div class="form-group">
						<label for="">Delete scripts After</label>
						<span class="label label-primary">
							<?php 
								if($settings->delete_docs_in == 0){
									echo "Never delete scripts";
								}else{
									echo $settings->delete_docs_in." days";
								}
							?> 
						</span>
						<select class="form-control" id="delete_docs_in" name="delete_docs_in">
							<option value="30"><option>
							<option value="0">Never Delete Documents<option>
							<?php 
								for ($i=1; $i <= 30; $i++) { 
									echo '<option value="'.$i.'">'.$i.'<option>';
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="">Delete Audios After</label>
						<span class="label label-primary">
							<?php 
								if($settings->delete_audios_in == 0){
									echo "Never delete audios";
								}else{
									echo $settings->delete_audios_in." days";
								}
							?> 
						</span>
						<select class="form-control" id="delete_audios_in" name="delete_audios_in">
							<option value="30"><option>
							<option value="0">Never Delete Audios<option>
							<?php 
								for ($i=1; $i <= 30; $i++) { 
									echo '<option value="'.$i.'">'.$i.'<option>';
								}
							?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="">Delete Videos After</label>
						<span class="label label-primary">
							<?php 
								if($settings->delete_videos_in == 0){
									echo "Never delete videos";
								}else{
									echo $settings->delete_videos_in." days";
								}
							?> 
						</span>
						<select class="form-control" id="delete_videos_in" name="delete_videos_in">
							<option value="30"><option>
							<option value="0">Never Delete Videos<option>
							<?php 
								for ($i=1; $i <= 30; $i++) { 
									echo '<option value="'.$i.'">'.$i.'<option>';
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="">Backup Database After</label>
						<span class="label label-primary">
							<?php 
								if($settings->backup_in == 0){
									echo "Never backup database";
								}else{
									echo $settings->backup_in." days";
								}
							?> 
						</span>
						<select class="form-control" id="backup_in" name="backup_in">
							<option value="30"><option>
							<option value="0">Never Backup Database<option>
							<?php 
								for ($i=1; $i <= 30; $i++) { 
									echo '<option value="'.$i.'">'.$i.'<option>';
								}
							?>
						</select>
					</div>

					
					<input type="hidden" name="id" id="id" class="form-control" value="<?=$settings->id; ?>">
					
					
					<button type="submit" class="btn btn-primary">Update Settings</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</form>
				
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>
