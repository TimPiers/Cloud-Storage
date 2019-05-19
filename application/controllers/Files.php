<?php
class Files extends CI_Controller {

	public function upload()
	{
		$this->form_validation->set_rules('Name', 'Name', 'required|strip_tags');

		if($this->form_validation->run() === FALSE){
			show_404();
		}else{
			// Upload image
			$file = $_FILES['File'];

			$this->file_model->upload($file);
			redirect('app/index');
		}
	}

	public function getFiles(){
		$files = $this->file_model->getFiles();
		echo json_encode($files);
		return $files;
	}

	public function getFile($id){
		$file = $this->file_model->getFile($id);
		echo json_encode($file);
		return $file;
	}

	public function deleteFile($id){
		return $this->file_model->deleteFile($id);
	}

	public function getSharedFiles(){
		$files = $this->file_model->getSharedFiles();
		echo json_encode($files);
		return $files;
	}

	public function shareFile(){
		$this->form_validation->set_rules('Email', 'Email', 'required');
		$this->form_validation->set_rules('FileId', 'FileId', 'required|strip_tags');

		if($this->form_validation->run() === FALSE){
			return false;
		}
		
		$this->file_model->shareFile($this->input->post('FileId'), $this->input->post('Email'));
		redirect('app/index');
	}
}
