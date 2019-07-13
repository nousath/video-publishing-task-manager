
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="<?=base_url($topic->id); ?>" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Download</a>
				<!-- <h3 class="box-title">Script Document</h3> -->

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
						<iframe src='https://docs.google.com/viewer?url=<?=base_url($topic->doc); ?>&embedded=true' frameborder='0'>
						</iframe>
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
