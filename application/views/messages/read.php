<div class="row">
        <div class="col-md-3">
          <a href="<?=base_url('messages/compose'); ?>" class="btn btn-primary btn-block margin-bottom">Compose</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="<?=base_url('messages'); ?>"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right"><?=$number_of_inbox; ?></span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent <span class="label label-success pull-right"><?=$number_of_outbox; ?></span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts <span class="label label-warning pull-right">0</span></a></li>
                <!-- <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
    
        </div>
        <!-- /.col -->	
	
	
	
	
	
	
	<div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
				<h3><?=$selected_message->subject; ?></h3>
				<?php 
					$sender = $this->ion_auth->user($selected_message->send_from)->row();
				?>
                <h5>From: <?=$sender->username; ?>
				  <span class="mailbox-read-time pull-right"><?=date('d M. Y h:i A', $selected_message->send_at); ?></span></h5>
				  <!-- 15 Feb. 2016 11:03 PM -->
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
					<a class="btn btn-default btn-sm" data-toggle="modal" href='#modal-id' title="Delete"><i class="fa fa-trash-o"></i></a>

					<a class="btn btn-default btn-sm" data-toggle="modal" href='#reply-modal' title="Reply"><i class="fa fa-reply"></i></a>

                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
				<?=$selected_message->body; ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- footer content -->
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
              </div>
              <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->


		
		<!-- Delete model -->
		<div class="modal fade" id="modal-id">
			<div class="modal-dialog">
				<div class="modal-content text-center">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Are you sure you want to delete this message?</h4>
					</div>
					<div class="modal-body">
						<!-- <hr /> -->
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a href="<?=base_url('messages/delete/'.$selected_message->id.''); ?>" class="btn btn-danger btn-md" data-toggle="tooltip" data-container="body" title="Delete">
							<i class="fa fa-thubmbs-up">Yes, Delete</i>
						</a>
					</div>
					<!-- <div class="modal-footer">
						
					</div> -->
				</div>
			</div>
		</div>
		

		
		
		<!-- reply model -->
		<div class="modal fade" id="reply-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body">
						<div class="box box-primary">
							<div class="box-header with-border">
							<h3 class="box-title">Compose New Message</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
							<div class="form-group">
								<input class="form-control" placeholder="To:">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Subject:">
							</div>
							<div class="form-group">
									<textarea id="compose-textarea" class="form-control" style="height: 300px">
									<h1><u>Heading Of Message</u></h1>
									<h4>Subheading</h4>
									<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
										was born and I will give you a complete account of the system, and expound the actual teachings
										of the great explorer of the truth, the master-builder of human happiness. No one rejects,
										dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
										how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
										is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
										but because occasionally circumstances occur in which toil and pain can procure him some great
										pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
										except to obtain some advantage from it? But who has any right to find fault with a man who
										chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
										produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
										dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
										blinded by desire, that they cannot foresee</p>
									<ul>
										<li>List item one</li>
										<li>List item two</li>
										<li>List item three</li>
										<li>List item four</li>
									</ul>
									<p>Thank you,</p>
									<p>John Doe</p>
									</textarea>
							</div>
							<div class="form-group">
								<div class="btn btn-default btn-file">
								<i class="fa fa-paperclip"></i> Attachment
								<input type="file" name="attachment">
								</div>
								<p class="help-block">Max. 32MB</p>
							</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
							<div class="pull-right">
								<button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
								<button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
							</div>
							<button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
							</div>
							<!-- /.box-footer -->
						</div>
					</div>
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div> -->
				</div>
			</div>
		</div>
		
		<!-- <script>
			
		</script> -->
