<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Groups Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('groups/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> New Group</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>SN</th>
						<th>Name</th>
						<th>Description</th>
						<th>Actions</th>
                    </tr>
					<?php $sn = 0 ?>
                    <?php foreach($groups as $g){ ?>
					<?php $sn++ ?>
                    <tr>
						<td><?=$sn; ?></td>
						<td><?php echo $g->name; ?></td>
						<td><?php echo $g->description; ?></td>
						<td>
                            <a href="<?php echo site_url('groups/edit/'.$g->id); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('groups/remove/'.$g->id); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
