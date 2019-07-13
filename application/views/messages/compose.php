<div class="row">
        <div class="col-md-3">
          <a href="<?=base_url('messages/compose'); ?>" class="btn btn-primary btn-block margin-bottom">Compose</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="<?=base_url('messages'); ?>"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right"><?=$number_of_inbox; ?></span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent <span class="label label-success pull-right"><?=$number_of_outbox; ?></span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts <span class="label label-warning pull-right">0</span></a></li>
                <!-- <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
    
        </div>
        <!-- /.col -->	
	
	
	<?php 
		$logged_in_user = $this->ion_auth->user()->row();
	?>

<div class="col-md-9">
	<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Compose New Message</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<form method="post" action="<?=base_url('messages/compose_action'); ?>">
			<div class="form-group">
			<label for="varchar">Recipient <?php echo form_error('send_to') ?></label>
			<?php if($logged_in_user->usertype != 1): ?>
				<select class="form-control" name="send_to">
					<option>To:</option>
					<?php 
						foreach ($users as $user ) {
							echo '<option value="'.$user->id.'">'.$user->first_name.' '.$user->last_name.'</option>';
						}
					?>
				</select>
			<?php else: ?>
				<select class="form-control" name="send_to">
					<option>To:</option>
					<option value="all"><strong>All Staff</strong></option>
					<option value="writers"><strong>Writers</strong></option>
					<option value="voice-artists"><strong>Voice Artists</strong></option>
					<option value="editors"><strong>Editors</strong></option>
					<?php 
						foreach ($users as $user ) {
							echo '<option value="'.$user->id.'">'.$user->first_name.' '.$user->last_name.'</option>';
						}
					?>
				</select>
			<?php endif; ?>
			</div>
			<div class="form-group">
				<label for="varchar">Subject <?php echo form_error('subject') ?></label>
				<input class="form-control" name="subject" placeholder="Subject:" value="<?=$subject; ?>">
			</div>
			<div class="form-group">
				<label for="varchar">Message <?php echo form_error('body') ?></label>
				<textarea id="compose-textarea" name="body" class="form-control" style="height: 300px">
					<?=$body; ?>
				</textarea>
			</div>
			<!-- <div class="form-group">
				<div class="btn btn-default btn-file">
					<i class="fa fa-paperclip"></i> Attachment
					<input type="file" name="attachment">
				</div>
				<p class="help-block">Max. 32MB</p>
			</div> -->
			</div>
	<!-- /.box-body -->
			<div class="box-footer">
				<div class="pull-right">
					<button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
				</div>
				<button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
			</div>
		</form>

	
	<!-- /.box-footer -->
	</div>
	<!-- /. box -->
</div>
<!-- /.col -->
