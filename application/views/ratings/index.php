
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Staff Rating List</h3>

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
						<span id="users_list"></span>
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

<script>
	$(document).ready(function () {
		load_data();

		function load_data(){
			$.ajax({
				url: "<?=base_url();?>ratings/fetch",
				type: "POST",
				success: function (data) {
					$("#users_list").html(data);
				}
			});
		}

		$(document).on('mouseenter', '.rating', function(){
			var index = $(this).data('index');
			var user_id = $(this).data('user_id');
			remove_background(user_id);
			for(var count = 1; count <= index; count++)
			{
				$('#'+user_id+'-'+count).css('color', '#ffcc00');
			}
		});

		$(document).on('mouseleave', '.rating', function(){
			var index = $(this).data('index');
			var user_id = $(this).data('user_id');
			var rating = $(this).data('rating');
			remove_background(user_id);
			for(var count = 1; count <= rating; count++)
			{
				$('#'+user_id+'-'+count).css('color', '#ffcc00');
			}
		});


		function remove_background(user_id)
		{
			for(var count = 1; count <= 5; count++)
			{
				$('#'+user_id+'-'+count).css('color', '#ccc');
			}
		}

		$(document).on('click', '.rating', function(){
			var index = $(this).data('index');
			var user_id = $(this).data('user_id');
			$.ajax({
				url: "<?=base_url();?>ratings/insert",
				type: "POST",
				data: {index:index, user_id:user_id},
				success: function (data) {
					load_data();
					alert("You have rated "+ index +" out of 5");
				}
			});
		});


	});
</script>
