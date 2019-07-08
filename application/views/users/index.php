<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users Listing</h3>
            	<div class="box-tools">
                    <a href="<?=site_url('users/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add User</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped text-left" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                    <tr>
						<th>Avatar</th>
						<th>Username</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Designition</th>
						<th>Salary</th>
						<th>Tasks Completed</th>
						<th>Last login</th>
						<th>Actions</th>
                    </tr>
                    <?php
					if($users != null){
						// onclick="window.location='#'
						// <a href="'.base_url('users/'.$u['id'].'').'" class="text text-danger">
						// </a>
						foreach ($users as $u ) {

							
						echo '	<tr data-href="'.base_url('profile/index/'.$u['id'].'').'">
									<td><img src="'.base_url().$u['photo'].'" class="img img-responsive img-circle img-md"></td>
									<td>'.$u['username'].'</td>
									<td>'.$u['email'].'</td>
									<td>'.$u['phone'].'</td>
									<td>'.$u['first_name'].'</td>
									<td>'.$u['last_name'].'</td>
									<td>'.$u['job_title'].'</td>
									<td>'.$u['salary'].'</td>
									<td>'.$u['tasks_completed'].'</td>							
									<td>'.date('d/m/Y H:i:s', $u['last_login']).'</td>							
									<td>
										<a href="'.site_url('users/edit/'.$u['id']).'" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
										<a href="'.site_url('users/remove/'.$u['id']).'" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
									</td>
								</tr>
							';
						}

					}
						
                    ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function () {
		$(document.body).on("click", "tr[data-href]", function(){
			window.location.href = this.dataset.href;
		});
	});
</script>