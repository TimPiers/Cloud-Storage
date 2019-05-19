<style type="text/css">
	.sidenav {
		min-height: 100vh !important;
		padding: 15px;
	}

	.sidenav ul {
		padding-left: 15px;
	}

	.sidenav ul a {
		color: inherit;
		text-decoration: inherit;

	}

	.sidenav ul li{
		list-style-type: none;
		font-size: 18px;
	}

	.action {
		position: relative;
		top: -5px;
	}

	.preview-image {
		width: 400px;
		height: auto;
		margin-left: 25%;
	}

</style>

<div class="row">
	<div class="col-12 col-md-2" style="padding: 0">
		<div class="sidenav bg-dark navbar-dark text-white">
			<h4>Cloud Storage</h4>
			<ul>
				<a href="<?php echo base_url(); ?>app/index"><li><i class="fas fa-folder-open"></i> Files</li></a>
				<a href="<?php echo base_url(); ?>app/shared"><li><i class="fas fa-share-alt"></i> Shared</li></a>
				<a href="<?php echo base_url(); ?>users/logout"><li><i class="fas fa-sign-out-alt"></i> Logout</li></a>
			</ul>
		</div>
	</div>

	<div class="col-12 col-md-10" style="padding: 0">
		<div class="nav text-white p-3" style="background-color: #0063cc">
			<h4>Shared files</h4>
			
		</div>
		<div class="content m-2">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody id="files">
			    

			  </tbody>
			</table>
		</div>
	</div>
</div>


<script type="text/javascript">
	getFiles();

	function getFiles(){
		$.ajax({
		type: 'ajax',
		method: 'get',
		async: false,
		url: '<?php echo base_url();?>files/getSharedFiles',
		dataType: 'json',
		success: function(response){
			var html = '';
			$('#files').html(html);
			if(response.length > 0){
				for(var i = 0; i < response.length; i++){
					html += '<tr>';
					html += '<th scope="row">'+ response[i].Id + '</th>';
					html += '<td>' + response[i].FilesId + '</td>';
					html += '<td><button class="btn btn-sm action btn-primary">Download</button></td>';
					html += '</tr>';
				}
				$('#files').html(html);
			}else {
				html = 'Er zijn nog geen bestanden met jou gedeeld!';
				$('#files').parent().html(html);
			}
		}
	});
	
	}
</script>