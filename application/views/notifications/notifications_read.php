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
        <h2 style="margin-top:0px">Notifications Read</h2>
        <table class="table">
	    <tr><td>Id</td><td><?php echo $id; ?></td></tr>
	    <tr><td>Send To</td><td><?php echo $send_to; ?></td></tr>
	    <tr><td>Body</td><td><?php echo $body; ?></td></tr>
	    <tr><td>Read Status</td><td><?php echo $read_status; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('notifications') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>