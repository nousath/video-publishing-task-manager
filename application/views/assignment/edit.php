<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Assignment Edit</h3>
            </div>
			<?php echo form_open('assignment/edit/'.$assignment['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="topic_id" class="control-label">Topic Id</label>
						<div class="form-group">
							<input type="text" name="topic_id" value="<?php echo ($this->input->post('topic_id') ? $this->input->post('topic_id') : $assignment['topic_id']); ?>" class="form-control" id="topic_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="user_id" class="control-label">User Id</label>
						<div class="form-group">
							<input type="text" name="user_id" value="<?php echo ($this->input->post('user_id') ? $this->input->post('user_id') : $assignment['user_id']); ?>" class="form-control" id="user_id" />
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