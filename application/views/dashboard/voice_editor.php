<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Audios</h3>

				<div class="box-tools pull-right">
                    <!-- <a class="btn btn-danger" data-toggle="modal" href='#modal-id'>Upload audio <i class="fa fa-upload"></i></a> -->
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
                        
                    <?php if ($this->session->flashdata('re_upload_success')): ?>			
                    <?php echo '<div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>'.$this->session->flashdata('re_upload_success').'</strong>
                                </div>'; 
                    ?>
                    <?php endif; ?>

                    <table class="table table-hover" id="example2">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Topic</th>
                                <th>Submitted By</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sn = 1;
                            if($audios != null){
                                foreach ($audios as $audio ) {
                                    $topic = $this->Topics_model->get_by_id($audio->topic_id);
                                    $user = $this->ion_auth->user($audio->submitted_by)->row();
                                    if($user =='' || $audio->submitted_by == ''){
                                        $submitted_by = 'User Deleted';
                                    }else{
                                        $submittedby = $this->ion_auth->user($audio->submitted_by)->row(); 
                                        $submitted_by = $submittedby->username;
                                    }
                                    
                                    
                                    echo '<tr>
                                            <td>'.$sn.'</td>
                                            <td>'.$topic->topic.'</td>
                                            <td>'.$submitted_by.'</td>
                                            <td>'.date('m/y', $audio->submitted_at).'</td>
                                            <td>
                                                <a href="'.base_url($topic->audio).'" class="btn btn-default">Listen/Download <i class="fa fa-file-word-o"></i></a>
                                                <a class="btn btn-default" href="'.base_url('dashboard/upload_edited_audio/'.$audio->topic_id.'/'.$audio->id.'').'">Upload audio <i class="fa fa-upload"></i></a>
                                            </td>
                                        </tr>';

                                        $sn++;
									}
								}else{
									echo '<p>No records yet</p>';
								}
							?>
							</tbody>
						</table>
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



