<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Password</th>
						<th>Forgotten Password Selector</th>
						<th>Forgotten Password Code</th>
						<th>Forgotten Password Time</th>
						<th>Ip Address</th>
						<th>Username</th>
						<th>Email</th>
						<th>Activation Selector</th>
						<th>Activation Code</th>
						<th>Remember Selector</th>
						<th>Remember Code</th>
						<th>Created On</th>
						<th>Last Login</th>
						<th>Active</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Job Title</th>
						<th>Employed On</th>
						<th>Salary</th>
						<th>Tasks Completed</th>
						<th>Dob</th>
						<th>Photo</th>
						<th>Company</th>
						<th>Phone</th>
						<th>Job Describtion</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($users as $u){ ?>
                    <tr>
						<td><?php echo $u['id']; ?></td>
						<td><?php echo $u['password']; ?></td>
						<td><?php echo $u['forgotten_password_selector']; ?></td>
						<td><?php echo $u['forgotten_password_code']; ?></td>
						<td><?php echo $u['forgotten_password_time']; ?></td>
						<td><?php echo $u['ip_address']; ?></td>
						<td><?php echo $u['username']; ?></td>
						<td><?php echo $u['email']; ?></td>
						<td><?php echo $u['activation_selector']; ?></td>
						<td><?php echo $u['activation_code']; ?></td>
						<td><?php echo $u['remember_selector']; ?></td>
						<td><?php echo $u['remember_code']; ?></td>
						<td><?php echo $u['created_on']; ?></td>
						<td><?php echo $u['last_login']; ?></td>
						<td><?php echo $u['active']; ?></td>
						<td><?php echo $u['first_name']; ?></td>
						<td><?php echo $u['last_name']; ?></td>
						<td><?php echo $u['job_title']; ?></td>
						<td><?php echo $u['employed_on']; ?></td>
						<td><?php echo $u['salary']; ?></td>
						<td><?php echo $u['tasks_completed']; ?></td>
						<td><?php echo $u['dob']; ?></td>
						<td><?php echo $u['photo']; ?></td>
						<td><?php echo $u['company']; ?></td>
						<td><?php echo $u['phone']; ?></td>
						<td><?php echo $u['job_describtion']; ?></td>
						<td>
                            <a href="<?php echo site_url('user/edit/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
