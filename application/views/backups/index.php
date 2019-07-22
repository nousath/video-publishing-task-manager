
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Available Backups</h3>

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
						<?php if ($this->session->flashdata('backup_success')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('backup_success').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('backup_unsuccessful')): ?>			
						<?php echo '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('backup_unsuccessful').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('delete_success')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('delete_success').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<?php if ($this->session->flashdata('delete_fail')): ?>			
						<?php echo '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('delete_fail').'</strong>
												</div>'; 
						?>
						<?php endif; ?>


						<?php if ($this->session->flashdata('file_absent')): ?>			
						<?php echo '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('file_absent').'</strong>
												</div>'; 
						?>
						<?php endif; ?>

						<a href="<?=base_url('backups/built_backup'); ?>" class="btn btn-primary btn-flat btn-lg">CREATE NEW BACKUP <i class="fa fa-database"></i></a>
						<small>Automatic Backups are created every week.</small>
						<hr>

						<table class="table table-hover">
							<thead>
								<tr>
									<th>SN</th>
									<th>Name</th>
									<th>Backup Date & Time</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sn = 1;
									foreach ($backups as $backup) {
										echo '<tr>
												<td>'.$sn.'</td>
												<td>'.$backup->name.'</td>
												<td>'.date('d/m/Y H:i:s', $backup->created_at).'</td>
												<td>
													<a href="'.site_url($backup->path).'" class="btn btn-info btn-flat btn-xs">Download Backup <i class="fa fa-download"></i></a> 
													<a href="'.site_url('backups/delete/'.$backup->id).'" class="btn btn-danger btn-flat btn-xs"> Delete Backup <i class="fa fa-trash"></i></a>
												</td>
											  </tr>';
										$sn++;
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
