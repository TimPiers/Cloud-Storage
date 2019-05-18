<?php
	class User_model extends CI_Model {
		public function __construct(){
			$this->load->database();
		}

		public function register($enc_password){
			// User data array

			$data = array(
				'Email' => $this->input->post('Email'),
				'Firstname' => $this->input->post('Firstname'),
				'Lastname' => $this->input->post('Lastname'),
				'Password' => $enc_password,
			);

			return $this->db->insert('user', $data);
			

		}

		public function login($email, $enc_password){
			$this->db->where('Email', $email);
			$this->db->where('Password', $enc_password);
			$result = $this->db->get('user');
			
			if($result->num_rows() === 1) {
				return $result->row(0)->Id;
			}else {
				return false;
			}
		}
	}
?>

