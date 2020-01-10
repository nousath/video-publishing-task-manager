<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php $settings = $this->Settings_model->get_by_id(1); ?>
  <title><?=$title.' | '. $settings->tagline; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/'); ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/'); ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/'); ?>dist/css/skins/_all-skins.min.css">

	<!-- datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/css/datapicker/datepicker3.css'); ?>">

	<!-- SweetAlert -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css'); ?>" >
	
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url('assets/theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
	
	<!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/theme/'); ?>bower_components/jquery/dist/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!-- [if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="<?php echo base_url('assets/theme/'); ?>https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


	<style>
		tr[data-href] {
			cursor: pointer;
		}
		
		.photo-dp{
		    width:40px;
		    height:30;
		}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $user = $this->ion_auth->user()->row(); ?>
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?=$settings->system_name_prefix; ?></b>ms</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=$settings->system_name_prefix; ?></b> <?=$settings->system_name; ?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="<?php echo base_url('assets/theme/'); ?>#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-envelope-o"></i>
							<?php 
								$number_of_unread_messages = $this->Messages_model->count_unread_messages($user->id, 0); 
								$messages = $this->Messages_model->get_by_user($user->id, 5);

								// create excerpt
								function excerpt($title) {
									$new = substr($title, 0, 27);
					
									if (strlen($title) > 30) {
											return $new.'...';
									} else {
											return $title;
									}
								}

								function message_subject_excerpt($title) {
									$new = substr($title, 0, 15);
					
									if (strlen($title) > 18) {
											return $new.'...';
									} else {
											return $title;
									}
								}

								

								if($number_of_unread_messages > 0){
									echo '<span class="label label-success">'.$number_of_unread_messages.'</span>
									<ul class="dropdown-menu">
										<li class="header">You have '.$number_of_unread_messages.' messages</li>
										<li>
											<!-- inner menu: contains the actual data -->
											<ul class="menu">
											<!-- start message -->
												';


												foreach ($messages as $message ) {
													$send_message_time = new DateTime(date('d-m-Y H:i:s', $message->send_at));
													$view_message_time = new DateTime("NOW");

													$how_long = $send_message_time->diff($view_message_time);

													if($how_long->d > 0 ){

														$time_ago = $how_long->d.' days '.$how_long->h.' hours '.$how_long->i.' minutes';
						
													}else{
														$time_ago = $how_long->h .' hours '. $how_long->i.' minutes';
													}
						

													$sender = $this->ion_auth->user($message->send_from)->row();

													echo '<li>
																<a href="'.base_url('messages/read/'.$message->id.'').'">
																	<div class="pull-left">
																		<img src="'.base_url($sender->photo).'" class="img-circle photo-dp" alt="User Image" />
																	</div>
																	<h4>
																		'.message_subject_excerpt($message->subject).'
																		<small><i class="fa fa-clock-o"></i> '.$time_ago.'</small>
																	</h4>
																	<p>'.excerpt($message->body).'</p>
																</a>
															</li>';
												}

										echo '
												<!-- end message -->
											
											</ul>
										</li>
										<li class="footer"><a href="'.base_url('messages').'">See All Messages</a></li>
									</ul>';
								}


							?>

              
            </a>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<?php 
								$number_of_unread_notifications = $this->Notifications_model->count_unread_notifications($user->id, 0); 
								$notifications = $this->Notifications_model->get_by_user($user->id, 5);

								// create excerpt
								// function excerpt($title) {
								// 	$new = substr($title, 0, 27);
					
								// 	if (strlen($title) > 30) {
								// 			return $new.'...';
								// 	} else {
								// 			return $title;
								// 	}
								// }


							?>
							<?php if($number_of_unread_notifications > 0){
								echo '<span class="label label-warning">'.$number_of_unread_notifications.'</span>
											<ul class="dropdown-menu">
												<li class="header">You have '.$number_of_unread_notifications.' notifications</li>
												<li>
													<!-- inner menu: contains the actual data -->
													<ul class="menu">';
													
													foreach ($notifications as $notification ) {
														if($notification->read_status == 0){
															echo '<li style="background-color: #D7D9DF;">
																		<a href="'.base_url('notifications').'">
																			<i class="fa fa-clock-o text-aqua"></i><strong> '.date('M, d -', $notification->created_at).'</strong> '.excerpt($notification->body).'
																		</a>
																	</li>';
														}else{
															echo '<li>
																		<a href="'.base_url('notifications').'">
																			<i class="fa fa-clock-o text-aqua"></i><strong> '.date('M, d -', $notification->created_at).'</strong> '.excerpt($notification->body).'
																		</a>
																	</li>';
														}
														
													}

										echo '</ul>
														</li>
														<li class="footer"><a href="'.base_url('notifications').'">View all</a></li>

												</ul>';
							}
							?>
								
            </a>
          </li>
         
          <!-- User Account: style can be found in dropdown.less -->
          <!-- <?=base_url($user->photo); ?> -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url($user->photo); ?>" class="img-circle photo-dp" alt="User Image" />
              <span class="hidden-xs"> <?php echo $user->username; ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <!--<img src="<?=base_url($user->photo);?>" class="img-circle" alt="User Image" /> -->

                <p>
								<?php echo $user->first_name.' '.$user->last_name; ?>
                  <!--<small>Employed since <?=date('M - Y', $user->employed_on); ?></small>-->
                </p>
              </li>
              <!-- /Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url('profile/index/'.$user->id.''); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
					<div class="pull-left image">						
						<img src="<?php echo base_url($user->photo); ?>" class="img-circle" alt="User Image" /> <!-- height="50" width="50" -->
					</div>
					<div class="pull-left info">
						<p>
						<?php
							$name_of_user = ($user->first_name == '' && $user->first_name == '') ? $user->username : $user->first_name.' '.$user->last_name;
						 echo $name_of_user; 
						 
						 ?>
						 </p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
	  <!-- sidebar menu: : style can be found in sidebar.less -->
	  
	  <!-- <ul class="sidebar-menu" data-widget="tree">
			<li><a href="<?=base_url('dashboard'); ?>"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
			<li class="header">COMPONENTS</li>
			<li><a href="<?=base_url('topics'); ?>"> <i class="fa fa-file"></i> <span>Topics</span> </a></li>
			<li><a href="<?=base_url(); ?>"> <i class="fa fa-edit"></i> <span>Scripts</span> </a></li>
			<li><a href="#"> <i class="fa fa-microphone"></i> <span>Audios</span> </a></li>
			<li><a href="#"> <i class="fa fa-video-camera"></i> <span>Videos</span> </a></li>
			<li><a href="<?=base_url('users'); ?>"> <i class="fa fa-group"></i> <span>Staff</span> </a></li>
			<li><a href="<?=base_url('admin/viewreports'); ?>"> <i class="fa fa-archive"></i> <span>Reports</span> </a></li>
		 

        	<li class="header">SYSTEM</li>
			<li><a href="<?=base_url('reports'); ?>"> <i class="fa fa-shield"></i> <span>Admins</span> </a></li>
			<li><a href="<?=base_url('groups'); ?>"> <i class="fa fa-users"></i> <span>Groups</span> </a></li>
			<li><a href="<?=base_url('admin/users'); ?>"> <i class="fa fa-hdd-o"></i> <span>Backup</span></a></li>
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-book"></i> <span>Manual</span></a></li>
			<li><a href="<?=base_url('reports'); ?>"> <i class="fa fa-cog"></i> <span>Settings</span> </a></li>
			
			 <li class="header">LABELS</li>
			<li><a href="<?php echo base_url('assets/theme/'); ?>#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
			<li><a href="<?php echo base_url('assets/theme/'); ?>#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
			<li><a href="<?php echo base_url('assets/theme/'); ?>#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      <!--	</ul> -->
	  <?php 
	  	switch ($user->usertype) {
			  case 1:
				  # user is super admin
				  
				  echo '<ul class="sidebar-menu" data-widget="tree">
							<li><a href="'.base_url('dashboard').'"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
							<li class="header">SECTIONS</li>
							<li><a href="'.base_url('channels').'"> <i class="fa fa-television"></i> <span>Channels</span> </a></li>
							<li><a href="'.base_url('topics').'"> <i class="fa fa-file"></i> <span>Topics</span> </a></li>
							<li class="treeview">
							<li><a href="'.base_url('topics/drafts').'"> <i class="fa fa-file"></i> <span>Drafts</span> </a></li>
							<li class="treeview">
							<a href="#">
								<i class="fa fa-archive"></i>
								<span>Reserves</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="'.base_url('reserves').'"><i class="fa fa-circle-o"></i> Topics</a></li>
								<li><a href="'.base_url('reserves/scripts').'"><i class="fa fa-circle-o"></i> Scripts</a></li>
								<li><a href="'.base_url('reserves/audios').'"><i class="fa fa-circle-o"></i> Audios</a></li>
								<li><a href="'.base_url('reserves/videos').'"><i class="fa fa-circle-o"></i> Videos</a></li>
							</ul>
							</li>
							<li><a href="'.base_url('scripts').'"> <i class="fa fa-edit"></i> <span>Scripts</span> </a></li>
							<li><a href="'.base_url('audios').'"> <i class="fa fa-microphone"></i> <span>Audios</span> </a></li>
							<li><a href="'.base_url('videos').'"> <i class="fa fa-video-camera"></i> <span>Videos</span> </a></li>
							<li><a href="'.base_url('users').'"> <i class="fa fa-group"></i> <span>Staff</span> </a></li>
							<li><a href="#"> <i class="fa fa-book"></i> <span>Reports</span> </a></li>
						
				
							<li class="header">SYSTEM</li>
							<li><a href="'.base_url('backups').'"> <i class="fa fa-database"></i> <span>Backup</span></a></li>
							<li><a href="'.base_url('videos/manual').'"> <i class="fa fa-book"></i> <span>Manual</span></a></li>
							<li><a href="'.base_url('settings').'"> <i class="fa fa-cog"></i> <span>Settings</span> </a></li>
						</ul>';
				  break;

				  case 7:
					# user is regular admin
					
					echo '<ul class="sidebar-menu" data-widget="tree">
							  <li><a href="'.base_url('dashboard').'"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
							  <li class="header">SECTIONS</li>
							  <li><a href="'.base_url('channels').'"> <i class="fa fa-television"></i> <span>Channels</span> </a></li>
							  <li><a href="'.base_url('topics').'"> <i class="fa fa-file"></i> <span>Topics</span> </a></li>
							  <li class="treeview">
							  <li><a href="'.base_url('topics/drafts').'"> <i class="fa fa-file"></i> <span>Drafts</span> </a></li>
							  <li class="treeview">
							  <a href="#">
								  <i class="fa fa-archive"></i>
								  <span>Reserves</span>
								  <span class="pull-right-container">
								  <i class="fa fa-angle-left pull-right"></i>
								  </span>
							  </a>
							  <ul class="treeview-menu">
								  <li><a href="'.base_url('reserves').'"><i class="fa fa-circle-o"></i> Topics</a></li>
								  <li><a href="'.base_url('reserves/scripts').'"><i class="fa fa-circle-o"></i> Scripts</a></li>
								  <li><a href="'.base_url('reserves/audios').'"><i class="fa fa-circle-o"></i> Audios</a></li>
								  <li><a href="'.base_url('reserves/videos').'"><i class="fa fa-circle-o"></i> Videos</a></li>
							  </ul>
							  </li>
							  <li><a href="'.base_url('scripts').'"> <i class="fa fa-edit"></i> <span>Scripts</span> </a></li>
							  <li><a href="'.base_url('audios').'"> <i class="fa fa-microphone"></i> <span>Audios</span> </a></li>
							  <li><a href="'.base_url('videos').'"> <i class="fa fa-video-camera"></i> <span>Videos</span> </a></li>
							  <li><a href="'.base_url('users').'"> <i class="fa fa-group"></i> <span>Staff</span> </a></li>
							  <li><a href="#"> <i class="fa fa-book"></i> <span>Reports</span> </a></li>
						  
				  
							  <li class="header">SYSTEM</li>
							  <li><a href="'.base_url('backups').'"> <i class="fa fa-database"></i> <span>Backup</span></a></li>
							  <li><a href="'.base_url('videos/manual').'"> <i class="fa fa-book"></i> <span>Manual</span></a></li>
							  <li><a href="'.base_url('settings').'"> <i class="fa fa-cog"></i> <span>Settings</span> </a></li>
						  </ul>';
					break;

				case 2:
				  # user is a writer
				  echo '<ul class="sidebar-menu" data-widget="tree">
							<li><a href="'.base_url('dashboard').'"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
							<li class="header">SECTIONS</li>
							<li><a href="'.base_url('scripts').'"> <i class="fa fa-file"></i> <span>Scripts</span> </a></li>
							<li><a href="'.base_url('messages').'"> <i class="fa fa-envelope"></i> <span>Messages</span> </a></li>
							<li><a href="'.base_url('notifications').'"> <i class="fa fa-bell"></i> <span>Notifications</span> </a></li>
							<li><a href="'.base_url('profile/index/'.$user->id.'').'"> <i class="fa fa-user"></i> <span>Profile</span> </a></li>
						</ul>';
				  
				  break;

				case 3:
				  # user is a voice artist...
				  echo '<ul class="sidebar-menu" data-widget="tree">
							<li><a href="'.base_url('dashboard').'"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
							<li class="header">SECTIONS</li>
							<li><a href="'.base_url('audios').'"> <i class="fa fa-microphone"></i> <span>Audios</span> </a></li>
							<li><a href="'.base_url('messages').'"> <i class="fa fa-envelope"></i> <span>Messages</span> </a></li>
							<li><a href="'.base_url('notifications').'"> <i class="fa fa-bell"></i> <span>Notifications</span> </a></li>
							<li><a href="'.base_url('profile/index/'.$user->id.'').'"> <i class="fa fa-user"></i> <span>Profile</span> </a></li>
						</ul>';
				  break;

				case 4:
				  # user is an editor...
				  echo '<ul class="sidebar-menu" data-widget="tree">
							<li><a href="'.base_url('dashboard').'"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
							<li class="header">SECTIONS</li>
							<li><a href="'.base_url('videos').'"> <i class="fa fa-video-camera"></i> <span>Videos</span> </a></li>
							<li><a href="'.base_url('messages').'"> <i class="fa fa-envelope"></i> <span>Messages</span> </a></li>
							<li><a href="'.base_url('notifications').'"> <i class="fa fa-bell"></i> <span>Notifications</span> </a></li>
							<li><a href="'.base_url('profile/index/'.$user->id.'').'"> <i class="fa fa-user"></i> <span>Profile</span> </a></li>
						</ul>';
				  break;
				
				case 5:
				  # user is a proof-reader ...
				  echo '<ul class="sidebar-menu" data-widget="tree">
							<li><a href="'.base_url('dashboard').'"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
						</ul>';
				  break;

				case 6:
				  # user is a proof-reader ...
				  echo '<ul class="sidebar-menu" data-widget="tree">
							<li><a href="'.base_url('dashboard').'"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
						</ul>';
				  break;

				

			  default:
				  echo '----NO SIDE MENU----';
				  break;
		  }
	  ?>


    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$content_header; ?>
        <small><?=$settings->header; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>











    <!-- Main content -->
    <section class="content">
	  <?php $this->load->view($content); ?>
    </section>
	<!-- /.content -->
	
















	
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Software version</b> 1.2.0
    </div>
    <strong>Copyright &copy;<?=date('Y'); ?> <a href="#"><?=$settings->footer; ?></a> | </strong> All rights
    reserved.
  </footer>

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

			

	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets/theme/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url('assets/theme/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('assets/theme/'); ?>dist/js/adminlte.min.js"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url('assets/theme/'); ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap  -->
	<script src="<?php echo base_url('assets/theme/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url('assets/theme/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo base_url('assets/theme/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url('assets/theme/'); ?>bower_components/chart.js/Chart.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?php echo base_url('assets/theme/'); ?>dist/js/pages/dashboard2.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url('assets/theme/'); ?>dist/js/demo.js"></script>

	<!-- SweetAlert -->
	<script src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>

	<!-- Datepicker -->
	<script src="<?php echo base_url('assets/theme/js/datapicker/bootstrap-datepicker.js'); ?>"></script>
	
	<!-- DataTables -->
	<script src="<?php echo base_url('assets/theme/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?> "></script>
	<script src="<?php echo base_url('assets/theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?> "></script>


	<!-- Datatable -->
	  <script src="<?php echo base_url('assets/theme/js/'); ?>data-table/bootstrap-table.js"></script>
    <script src="<?php echo base_url('assets/theme/js/'); ?>data-table/tableExport.js"></script>
    <script src="<?php echo base_url('assets/theme/js/'); ?>data-table/data-table-active.js"></script>
    <script src="<?php echo base_url('assets/theme/js/'); ?>data-table/bootstrap-table-editable.js"></script>
    <script src="<?php echo base_url('assets/theme/js/'); ?>data-table/bootstrap-editable.js"></script>
    <script src="<?php echo base_url('assets/theme/js/'); ?>data-table/bootstrap-table-resizable.js"></script>
    <script src="<?php echo base_url('assets/theme/js/'); ?>data-table/colResizable-1.5.source.js"></script>
		<script src="<?php echo base_url('assets/theme/js/'); ?>data-table/bootstrap-table-export.js"></script>

		<!-- Bootstrap WYSIHTML5 -->
	<script src="<?=base_url('assets/theme/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

	  <script>
			$(function () {
				//Add text editor
				$("#compose-textarea").wysihtml5();
			});



		$(function () {
			$('#example1').DataTable()
			$('#mailTable').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
			})


			$('#example2').DataTable({
				'paging'      : true,
				'lengthChange': false,
				'searching'   : true,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : false
			})
		})

		// $(function () {

		// })
	</script>




</body>
</html>
