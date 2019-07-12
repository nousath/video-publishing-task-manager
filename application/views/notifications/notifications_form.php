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
        <h2 style="margin-top:0px">Notifications <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id <?php echo form_error('id') ?></label>
            <input type="text" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Send To <?php echo form_error('send_to') ?></label>
            <input type="text" class="form-control" name="send_to" id="send_to" placeholder="Send To" value="<?php echo $send_to; ?>" />
        </div>
	    <div class="form-group">
            <label for="body">Body <?php echo form_error('body') ?></label>
            <textarea class="form-control" rows="3" name="body" id="body" placeholder="Body"><?php echo $body; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">Read Status <?php echo form_error('read_status') ?></label>
            <input type="text" class="form-control" name="read_status" id="read_status" placeholder="Read Status" value="<?php echo $read_status; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('notifications') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>