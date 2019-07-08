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
        <h2 style="margin-top:0px">Topics List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('topics/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('topics/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('topics'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Topic</th>
		<th>Stage Id</th>
		<th>User Id</th>
		<th>Assigned</th>
		<th>Script</th>
		<th>Doc</th>
		<th>Audio</th>
		<th>Video</th>
		<th>Created By</th>
		<th>Created At</th>
		<th>Action</th>
            </tr><?php
            foreach ($topics_data as $topics)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $topics->topic ?></td>
			<td><?php echo $topics->stage_id ?></td>
			<td><?php echo $topics->user_id ?></td>
			<td><?php echo $topics->assigned ?></td>
			<td><?php echo $topics->script ?></td>
			<td><?php echo $topics->doc ?></td>
			<td><?php echo $topics->audio ?></td>
			<td><?php echo $topics->video ?></td>
			<td><?php echo $topics->created_by ?></td>
			<td><?php echo $topics->created_at ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('topics/read/'.$topics->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('topics/update/'.$topics->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('topics/delete/'.$topics->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>