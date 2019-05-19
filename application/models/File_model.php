<?php
	class File_model extends CI_Model {
		public function __construct(){
			$this->load->database();
		}

		public function upload($file){

			$data = array(
				'UserId' => $this->session->userdata('id'),
				'Name' => $this->input->post('Name'),
				'Time' => Date('Y-m-d H:i'),
				'File' => base64_encode(file_get_contents(addslashes($file['tmp_name']))),
				'FileType' => $file['type'],
			);

			return $this->db->insert('file', $data);
		}

		public function getFiles(){
			$this->db->select('*');
			$this->db->from('file');
			$this->db->where("UserId = ".$this->session->userdata('id'));
			$query = $this->db->get();

			return $query->result_array();
		}

		public function getFile($id){
			$this->db->select('*');
			$this->db->from('file');
			$this->db->where("Id = ".$id);
			$query = $this->db->get();

			return $query->result_array();
		}

		public function deleteFile($id){
			$this->db->where("Id = $id");
			return $this->db->delete('file');
		}

		public function getSharedFiles(){
			$this->db->select('*');
			$this->db->from('shared');
			$this->db->where("UserId = ".$this->session->userdata('id'));
			$query = $this->db->get();

			return $query->result_array();
		}

		public function shareFile($fileId, $email){
			$email = str_replace('%40', '@', $email);
			$userId = $this->user_model->findUser($email);

			$data = array(
				'UserId' => $userId,
				'FilesId' => $fileId
			);

			return $this->db->insert('shared', $data);
		}

	}
?>

