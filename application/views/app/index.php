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

</style>

<div class="row">
	<div class="col-12 col-md-2" style="padding: 0">
		<div class="sidenav bg-dark navbar-dark text-white">
			<h4>Cloud Storage</h4>
			<ul>
				<a href="#"><li><i class="fas fa-folder-open"></i> Files</li></a>
				<a href="#"><li><i class="fas fa-share-alt"></i> Shared</li></a>
				<a href="<?php echo base_url(); ?>users/logout"><li><i class="fas fa-sign-out-alt"></i> Logout</li></a>
			</ul>
		</div>
	</div>

	<div class="col-12 col-md-10" style="padding: 0">
		<div class="nav text-white p-3" style="background-color: #0063cc">
			<h4>App</h4>
			<button class="btn btn-primary ml-3"><i class="fas fa-file-upload"></i> Upload</button>
		</div>
		<div class="content m-2">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			      <th scope="col">Shared</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">1</th>
			      <td>Plaatje.png</td>
			      <td>0x</td>
			      <td>
			      	<button class="btn btn-sm action btn-warning">Share</button> 
			      	<button class="btn btn-sm action btn-danger">Delete</button>
			      </td>
			    </tr>

			  </tbody>
			</table>
		</div>
	</div>
</div>