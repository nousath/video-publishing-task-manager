<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title ?></title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!-- [if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="<?php echo base_url('assets/theme/'); ?>https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

			<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/theme/'); ?>bower_components/jquery/dist/jquery.min.js"></script>

	<style>
		tr[data-href] {
			cursor: pointer;
		}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SS</b>MS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SS</b> MediaStaff</span>
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
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="<?php echo base_url(); ?>#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('admin_username'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <!-- <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

                <p>
                  <?php echo $this->session->userdata('admin_username'); ?>
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('#'); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url('assets/theme/'); ?>#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
        <div class="row">
					<div class="pull-left image">
						<span><i class="fa fa-circle"></i></span>
						<!-- <img src="<?php echo base_url('assets/theme/'); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
					</div>
					<div class="pull-left info">
						<p><?php echo $this->session->userdata('admin_username'); ?></p>
						<a href="<?php echo base_url('assets/theme/'); ?>#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
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
		<ul class="sidebar-menu" data-widget="tree">
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
			
			<!-- <li class="header">LABELS</li>
			<li><a href="<?php echo base_url('assets/theme/'); ?>#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
			<li><a href="<?php echo base_url('assets/theme/'); ?>#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
			<li><a href="<?php echo base_url('assets/theme/'); ?>#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$content_header; ?>
        <small><?php echo $subheader = (!empty($content_subheader)) ? $content_subheader : 'Success Secrets TV'; ?></small>
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
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy;<?=date('Y'); ?> | <a href="#">Success Secrets Media Staff</a> | </strong> All rights
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

		<script>
			// $(document).ready(function () {

			// });
		</script>



</body>
</html>
