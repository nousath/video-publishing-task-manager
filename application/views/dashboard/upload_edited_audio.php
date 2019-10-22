<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Audio Upload</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<div class="row">

                    <div class="col-md-12">
                        <?php if ($this->session->flashdata('error_message')): ?>			
                        <?php echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>'.$this->session->flashdata('error_message').'</strong>
                                    </div>'; 
                        ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('topic_unknown')): ?>			
                        <?php echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>'.$this->session->flashdata('topic_unknown').'</strong>
                                    </div>'; 
                        ?>
                        <?php endif; ?>



                        <?php if ($this->session->flashdata('re_upload_fail')): ?>			
                        <?php echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>'.$this->session->flashdata('re_upload_fail').'</strong>
                                    </div>'; 
                        ?>
                        <?php endif; ?>
                    </div>




					<div class="col-md-4">
                        <form action="<?=base_url('topics/re_upload_audio/'.$topic_id.'/'.$audio_id.''); ?>" method="POST" enctype="multipart/form-data" role="form">
                            <div class="form-group">
                                <label for="audio" class="control-label">Upload edited audio</label>
                                <input type="file" class="form-control" name="audio" id="audio">
                                <button type="submit" class="btn btn-default btn-sm">Upload</button>
                            </div>
                        </form>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- ./box-body -->
			
			<div class="box-footer">
				<div class="row">
					
				</div>
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
