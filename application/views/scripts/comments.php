
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<?php 
					$topic = $this->Topics_model->get_by_id($script->topic_id);
				?>
				<h3 class="box-title"><?=$topic->topic; ?></h3>

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





					 <!-- DIRECT CHAT PRIMARY -->
					 <div class="box box-primary direct-chat direct-chat-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Comments</h3>
								<div class="box-tools pull-right">
									<!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span> -->
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<!-- <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"> -->
									<i class="fa fa-comments"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<?php foreach($comments as $comment): ?>
									<!-- Conversations are loaded here -->
									<!-- <div class="direct-chat-messages"> -->
										<?php if($comment->comment_from == $user->id ): ?>
											<!-- Message. Default to the left -->
											<div class="direct-chat-msg">
												<div class="direct-chat-info clearfix">
													<?php 
														$name_of_user = ($user->first_name == '' && $user->first_name == '') ? $user->username : $user->first_name.' '.$user->last_name;
													?>
													<span class="direct-chat-name pull-left"><?=$name_of_user; ?></span>
													<span class="direct-chat-timestamp pull-right"><?=date('d M, Y H:i:s', $comment->created_at); ?></span>
												</div>
												<!-- /.direct-chat-info -->
												<img class="direct-chat-img" src="<?=base_url($user->photo);?>" alt="Message User Image"><!-- /.direct-chat-img -->
												<div class="direct-chat-text">
													<?=$comment->comment; ?>
												</div>
												<!-- /.direct-chat-text -->
											</div>
											<!-- /.direct-chat-msg -->

										<?php else: ?>
											<?php 
												$admin_user = $this->ion_auth->user($comment->comment_from)->row();

											?>
											<!-- Message to the right -->
											<div class="direct-chat-msg right">
												<div class="direct-chat-info clearfix">
													<?php 
														$name_of_user = ($admin_user->first_name == '' && $admin_user->first_name == '') ? $admin_user->username : $admin_user->first_name.' '.$admin_user->last_name;
													?>
													<span class="direct-chat-name pull-right"><?=$name_of_user; ?></span>
													<span class="direct-chat-timestamp pull-left"><?=date('d M, Y H:i:s', $comment->created_at); ?></span>
												</div>
												<!-- /.direct-chat-info -->
												<img class="direct-chat-img" src="<?=base_url($admin_user->photo);?>" alt="Message User Image"><!-- /.direct-chat-img -->
												<div class="direct-chat-text">
												<?=$comment->comment; ?>
												</div>
												<!-- /.direct-chat-text -->
											</div>
											<!-- /.direct-chat-msg -->
										<?php endif;?>

									<!-- </div> -->
									<!--/.direct-chat-messages-->
								<?php endforeach; ?>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<form action="<?=base_url('comments/create_action'); ?>" method="post">
									<div class="input-group">
										<span class="input-group-btn">
											<a href="<?=base_url('scripts'); ?>" class="btn btn-default btn-flat" title="Back to scripts"><i class="fa fa-chevron-left"></i></a>
										</span>
										<input type="text" name="comment" id="comment" placeholder="Type Comment ..." class="form-control" required>
										
										<input type="hidden" name="media_type" id="media_type" class="form-control" value="1">
										<input type="hidden" name="media_id" id="media_id" class="form-control" value="<?=$doc_id;?>">
										<input type="hidden" name="topic_id" id="topic_id" class="form-control" value="<?=$topic->id;?>">
										
										<span class="input-group-btn">
											<button type="submit" class="btn btn-primary btn-flat" title="Submit comment" ><i class="fa fa-plus"></i></button>
										</span>
									</div>
									
								</form>
							</div>
							<!-- /.box-footer-->
						</div>
						<!--/.direct-chat -->






						
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
