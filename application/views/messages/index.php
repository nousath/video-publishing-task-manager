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

					<?php if ($this->session->flashdata('message_send')): ?>			
						<?php echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<strong>'.$this->session->flashdata('message_send').'</strong>
												</div>'; 
						?>
						<?php endif; ?>



          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <!-- <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div> -->
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <a href="<?=base_url('messages/multiple_delete');?>" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>
                  <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button> -->
                </div>
                <!-- /.btn-group -->
                <a href="<?=base_url('messages');?>" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="mailTable">
                  <tbody>
				  <?php
					// use Faker\Provider\ka_GE\DateTime;

					function message_excerpt($title) {
						$new = substr($title, 0, 25);
		
						if (strlen($title) > 28) {
								return $new.'...';
						} else {
								return $title;
						}
					}

					function subject_excerpt($title) {
						$new = substr($title, 0, 37);
		
						if (strlen($title) > 40) {
								return $new.'...';
						} else {
								return $title;
						}
					}

					function time_ago($posted_time){
						$send_message_time = new DateTime($posted_time);
						$view_message_time = new DateTime("NOW");

						return $send_message_time->diff($view_message_time);
					}

					if($messages != null){
						foreach ($messages as $message ) {

							$message_send_from = $this->ion_auth->user($message->send_from)->row();
							$how_long = time_ago(date('d-m-Y H:i:s', $message->send_at));

							if($how_long->d > 0 ){

								$time_ago = $how_long->d.' days '.$how_long->h.' hours '.$how_long->i.' minutes';

							}else{
								$time_ago = $how_long->h .' hours '. $how_long->i.' minutes';
							}

							echo '<tr>
								<td>
									<form action="" method="post">
										<input type="checkbox" name="rows[]" value="'.$message->id.'">
									</form>
								</td>
								<td class="mailbox-name"><a href="'.base_url('messages/read/'.$message->id.'').'">'.$message_send_from->first_name.' '.$message_send_from->last_name.'</a></td>
								<td class="mailbox-subject"><b>'.subject_excerpt($message->subject).'</b> - '.message_excerpt($message->body).'
								</td>
								<td class="mailbox-date">'.$time_ago.' ago</td>
							</tr>';
						} 
					}else{
						echo '<p>You have no messages</p>';
					}
				 	
				  ?>
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
               
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

	