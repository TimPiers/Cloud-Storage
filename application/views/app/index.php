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
			<h4>App</h4>
			<button type="button" class="btn btn-primary ml-3" data-toggle="modal" data-target="#uploadModal"><i class="fas fa-file-upload"></i> Upload</button>
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
			  <tbody id="files">
			    

			  </tbody>
			</table>
		</div>
	</div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalTitle">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('files/upload'); ?>
      <div class="modal-body">
          <div class="form-label-group text-left">
            <label for="inputName">Name</label>
            <input type="text" id="inputName" class="form-control" placeholder="Name..." name="Name" required autofocus>
          </div>

          <div class="form-label-group text-left">
            <label for="inputFile">File</label>
            <input type="file" id="inputFile" class="mt-3" name="File" required>
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Upload</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Download Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="downloadModalTitle">Download: ...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div id="download">q</div>

      </div>
      <div class="modal-footer" id="btnDownload">
        <button type="submit" class="btn btn-success">Download</button>
      </div>
    </div>
  </div>
</div>


<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shareModalTitle">Sharing file...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('files/shareFile'); ?>
      <div class="modal-body">
          <div id="fileId">
      	  	<input type="hidden" name="FileId" value="0">
          </div>

          <div class="form-label-group text-left">
            <label for="inputName">Email</label>
            <input type="text" id="inputName" class="form-control" placeholder="Share with..." name="Email" required autofocus>
          </div>

      </div>
      <div class="modal-footer" id="btnShare">
        <button type="submit" class="btn btn-success">Share</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
	var selectedFile = null;

	getFiles();

	function getFiles(){
		$.ajax({
		type: 'ajax',
		method: 'get',
		async: false,
		url: '<?php echo base_url();?>files/getFiles',
		dataType: 'json',
		success: function(response){
			var html = '';
			$('#files').html(html);
			if(response.length > 0){
				for(var i = 0; i < response.length; i++){
					html += '<tr>';
					html += '<th scope="row">'+ response[i].Id + '</th>';
					html += '<td>' + response[i].Name + '</td>';
					html += '<td>' + 0 + '</td>';
					html += '<td><button class="btn btn-sm action btn-primary" data-toggle="modal" data-target="#downloadModal" onclick="download(' + response[i].Id + ')"><i class="fas fa-file-download"></i> Download</button> <button class="btn btn-sm action btn-success" data-toggle="modal" data-target="#shareModal" onclick="share(' + response[i].Id + ')"><i class="fas fa-share-alt"></i> Share</button> <button class="btn btn-sm action btn-danger" onclick="deleteFile(' + response[i].Id + ')"><i class="fas fa-trash"></i> Delete</button></td>';
					html += '</tr>';
				}
				$('#files').html(html);
			}else {
				html = 'Je hebt nog geen bestanden geupload!';
				$('#files').parent().html(html);
			}
		}
	});
	
	}


	function download(id){
		$.ajax({
		type: 'ajax',
		method: 'get',
		async: false,
		url: '<?php echo base_url();?>files/getFile/' + id,
		dataType: 'json',
		success: function(response){
			var html = '';
			if(response.length > 0){
				//html = response[0].File;
				html = "file";
				type = response[0].FileType;
				if(type.indexOf("image") >= 0){
					html = '<img class="preview-image" src="data:' + response[0].FileType + ';base64,' + response[0].File + '">';
				}else{
					html = "<h3 class='text-center'>Geen voorbeeld weergaven</h3>";
				}
				$('#downloadModalTitle').html("Download: " + response[0].Name + getFileType(type));
				$('#download').html(html);

				selectedFile = response[0];
				$('#btnDownload').html('<a class="btn btn-primary" href="data:' + selectedFile.FileType + ';base64,' + selectedFile.File + '" download="' + selectedFile.Name + getFileType(selectedFile.FileType) + '">Download</a>');
			}else {
				html = 'Er is een onbekende fout opgetreden';
				$('#download').html(html);
			}
		}
	});
	}

	function getFileType(type){
		if(type == "image/jpeg") {
			return ".jpg";
		} else if(type == "image/png"){
			return ".png";
		} else if(type == "application/vnd.open"){
			return ".docx";			
		} else {
			return "";
		}
	}

	function deleteFile(id){
		$.ajax({
		type: 'ajax',
		method: 'get',
		async: false,
		url: '<?php echo base_url();?>files/deleteFile/' + id,
		dataType: 'json',
		success: function(response){
		}
	});
		getFiles();
	}

	function share(id){
		$('#fileId').html('<input type="hidden" name="FileId" value="' + id + '">');
	}
</script>