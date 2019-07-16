
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">List</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<div class="row">
					<div class="col-md-8">
						




					<div class="box-group" id="accordion">
							<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
							<?php 
								// create excerpt
								function notification_excerpt($title) {
									$new = substr($title, 0, 35);
					
									if (strlen($title) > 38) {
											return $new.'...';
									} else {
											return $title;
									}
								}

								// check if there are any notifications
								if($notifications == null){
									echo '<p>You have no notifications yet</p>';
								}else{
									$i = 0;
									$colors_array = array('danger', 'info', 'primary', 'success', 'warning');

									foreach ($notifications as $notification ) {
										$pick_random_color = rand(0, count($colors_array));
										
										echo '<div class="panel box box-'.$colors_array[$pick_random_color].'">
											<div class="box-header with-border">
												<h4 class="box-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">
													'.notification_excerpt($notification->body).'
												</a>
												</h4>
											</div>
											<div id="collapseOne'.$i.'" class="panel-collapse collapse in">
												<div class="box-body">
													'.$notification->body.'
												</div>
											</div>
										</div>';

										$i++;

									}
								}
								
								
							?>
							



							<!-- <div class="panel box box-danger">
							<div class="box-header with-border">
								<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									Collapsible Group Danger
								</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="box-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
								wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
								eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
								assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
								nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
								farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
								labore sustainable VHS.
								</div>
							</div>
							</div>
							<div class="panel box box-success">
							<div class="box-header with-border">
								<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									Collapsible Group Success
								</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
								<div class="box-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
								wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
								eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
								assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
								nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
								farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
								labore sustainable VHS.
								</div>
							</div>
							</div>
						</div>
 -->



					

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
