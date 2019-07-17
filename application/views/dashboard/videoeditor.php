  <!-- Main content -->
  <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

	  <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
		  	<a href="<?=base_url('videos'); ?>">
            	<span class="info-box-icon bg-aqua"><i class="fa fa-video-camera"></i></span>
			</a>
            <div class="info-box-content">
              <span class="info-box-text">Videos</span>
              <span class="info-box-number"><?=count($videos_by_user); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
		</div>
		<!-- ./col -->
		

		<div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
			<a href="<?=base_url('messages'); ?>">
				<span class="info-box-icon bg-green"><i class="fa fa-envelope-o"></i></span>
			</a>

            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number"><?=count($messages); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
		</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
