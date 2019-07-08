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
        <h2 style="margin-top:0px">Topics Read</h2>
        <table class="table">
	    <tr><td>Topic</td><td><?php echo $topic; ?></td></tr>
	    <tr><td>Stage Id</td><td><?php echo $stage_id; ?></td></tr>
	    <tr><td>User Id</td><td><?php echo $user_id; ?></td></tr>
	    <tr><td>Assigned</td><td><?php echo $assigned; ?></td></tr>
	    <tr><td>Script</td><td><?php echo $script; ?></td></tr>
	    <tr><td>Doc</td><td><?php echo $doc; ?></td></tr>
	    <tr><td>Audio</td><td><?php echo $audio; ?></td></tr>
	    <tr><td>Video</td><td><?php echo $video; ?></td></tr>
	    <tr><td>Created By</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('topics') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>