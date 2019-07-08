<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Topics <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Topic <?php echo form_error('topic') ?></label>
            <input type="text" class="form-control" name="topic" id="topic" placeholder="Topic" value="<?php echo $topic; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Stage Id <?php echo form_error('stage_id') ?></label>
            <input type="text" class="form-control" name="stage_id" id="stage_id" placeholder="Stage Id" value="<?php echo $stage_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Assigned <?php echo form_error('assigned') ?></label>
            <input type="text" class="form-control" name="assigned" id="assigned" placeholder="Assigned" value="<?php echo $assigned; ?>" />
        </div>
	    <div class="form-group">
            <label for="script">Script <?php echo form_error('script') ?></label>
            <textarea class="form-control" rows="3" name="script" id="script" placeholder="Script"><?php echo $script; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Doc <?php echo form_error('doc') ?></label>
            <input type="text" class="form-control" name="doc" id="doc" placeholder="Doc" value="<?php echo $doc; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Audio <?php echo form_error('audio') ?></label>
            <input type="text" class="form-control" name="audio" id="audio" placeholder="Audio" value="<?php echo $audio; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Video <?php echo form_error('video') ?></label>
            <input type="text" class="form-control" name="video" id="video" placeholder="Video" value="<?php echo $video; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('topics') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>