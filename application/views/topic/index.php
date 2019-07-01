<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Topics Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('topic/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Stage Id</th>
						<th>Topic</th>
						<th>Assigned</th>
						<th>Doc</th>
						<th>Audio</th>
						<th>Video</th>
						<th>Created By</th>
						<th>Created At</th>
						<th>Script</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($topics as $t){ ?>
                    <tr>
						<td><?php echo $t['id']; ?></td>
						<td><?php echo $t['stage_id']; ?></td>
						<td><?php echo $t['topic']; ?></td>
						<td><?php echo $t['assigned']; ?></td>
						<td><?php echo $t['doc']; ?></td>
						<td><?php echo $t['audio']; ?></td>
						<td><?php echo $t['video']; ?></td>
						<td><?php echo $t['created_by']; ?></td>
						<td><?php echo $t['created_at']; ?></td>
						<td><?php echo $t['script']; ?></td>
						<td>
                            <a href="<?php echo site_url('topic/edit/'.$t['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('topic/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
    </div>
</div>
