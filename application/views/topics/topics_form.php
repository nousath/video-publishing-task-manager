
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Create Topic</h3>

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
						<p>Fields marked (<span class="text text-danger">*</span>) are compulsory.</p>
						<form action="<?=base_url('topics/create_action'); ?>" method="post">
							<div class="form-group form-group-lg">
								<label for="varchar"><span class="text text-danger"><strong>*</strong></span> Title <?php echo form_error('topic') ?></label>
								<input type="text" class="form-control" name="topic" id="topic" placeholder="For example: Henry Ford's 7 Secrets To Success" value="<?php echo $topic; ?>" />
							</div>

							<div class="form-group form-group-lg">
								<label for="varchar"><span class="text text-danger"><strong>*</strong></span> Assign Topic To <?php echo form_error('assignto') ?></label>
								<select name="assignto" id="assignto" class="form-control" required>
									<option></option>
									<?php 
										foreach ($users as $user ) {
											echo '<option value="'.$user->id.'">'.$user->username.'</option>';
										}
									?>
								</select>
							</div>

							<div class="form-group form-group-lg">
								<label for="varchar">Stage This Topic<?php echo form_error('stage') ?></label>
								<select name="stage" id="stage" class="form-control">
									<option></option>
									<?php 
										foreach ($stages as $stage ) {
											echo '<option value="'.$stage->id.'">'.$stage->name.'</option>';
										}
									?>
								</select>
							</div>

							<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button> 
							<a href="<?php echo site_url('topics') ?>" class="btn btn-default">Cancel</a>
						</form>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- ./box-body -->
			
			<!-- <div class="box-footer">
				<div class="row">
					
				</div>
			</div> -->
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->


