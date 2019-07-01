<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Topic Edit</h3>
            </div>
			<?php echo form_open('topic/edit/'.$topic['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="stage_id" class="control-label">Topic</label>
						<div class="form-group">
							<select name="stage_id" class="form-control">
								<option value="">select topic</option>
								<?php 
								foreach($all_topics as $topic)
								{
									$selected = ($topic['id'] == $topic['stage_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$topic['id'].'" '.$selected.'>'.$topic['stage_id'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="topic" class="control-label"><span class="text-danger">*</span>Topic</label>
						<div class="form-group">
							<input type="text" name="topic" value="<?php echo ($this->input->post('topic') ? $this->input->post('topic') : $topic['topic']); ?>" class="form-control" id="topic" />
							<span class="text-danger"><?php echo form_error('topic');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="assigned" class="control-label">Assigned</label>
						<div class="form-group">
							<input type="text" name="assigned" value="<?php echo ($this->input->post('assigned') ? $this->input->post('assigned') : $topic['assigned']); ?>" class="form-control" id="assigned" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="doc" class="control-label">Doc</label>
						<div class="form-group">
							<input type="text" name="doc" value="<?php echo ($this->input->post('doc') ? $this->input->post('doc') : $topic['doc']); ?>" class="form-control" id="doc" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="audio" class="control-label">Audio</label>
						<div class="form-group">
							<input type="text" name="audio" value="<?php echo ($this->input->post('audio') ? $this->input->post('audio') : $topic['audio']); ?>" class="form-control" id="audio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="video" class="control-label">Video</label>
						<div class="form-group">
							<input type="text" name="video" value="<?php echo ($this->input->post('video') ? $this->input->post('video') : $topic['video']); ?>" class="form-control" id="video" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="created_by" class="control-label">Created By</label>
						<div class="form-group">
							<input type="text" name="created_by" value="<?php echo ($this->input->post('created_by') ? $this->input->post('created_by') : $topic['created_by']); ?>" class="form-control" id="created_by" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="created_at" class="control-label">Created At</label>
						<div class="form-group">
							<input type="text" name="created_at" value="<?php echo ($this->input->post('created_at') ? $this->input->post('created_at') : $topic['created_at']); ?>" class="form-control" id="created_at" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="script" class="control-label">Script</label>
						<div class="form-group">
							<textarea name="script" class="form-control" id="script"><?php echo ($this->input->post('script') ? $this->input->post('script') : $topic['script']); ?></textarea>
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