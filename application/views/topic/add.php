<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Topic Add</h3>
            </div>
            <?php echo form_open('topic/add_action'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label class="control-label" for="username">Topic <?php echo form_error('topic') ?></label>
						<div class="form-group form-group-lg">
							<input type="text" name="topic" id="topic" class="form-control" value="<?=$topic; ?>" required="required" pattern="" title="Topic or Title">
						</div>
					</div>
					
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
