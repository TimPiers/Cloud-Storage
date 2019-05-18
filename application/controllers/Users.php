<?php
class Users extends CI_Controller {

	public function register()
	{
		$data['title'] = "CloudStorage - Register";

		$this->form_validation->set_rules('Firstname', 'Firstname', 'required|strip_tags');
		$this->form_validation->set_rules('Lastname', 'Lastname', 'required|strip_tags');
		$this->form_validation->set_rules('Email', 'Email', 'required|strip_tags');
		$this->form_validation->set_rules('Password', 'Password', 'required|strip_tags');
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('users/register', $data);
			$this->load->view('templates/footer');
			if($this->session->userdata('logged_in')){
				redirect('app/index');
			} 
		}else {
			$enc_password = hash('sha256', $this->input->post('Password'));
			$this->user_model->register($enc_password);
			redirect('users/login');
		}

	}

	public function login()
	{
		$data['title'] = "CloudStorage - Login";

		$this->form_validation->set_rules('Email', 'Email', 'required|strip_tags');
		$this->form_validation->set_rules('Password', 'Password', 'required|strip_tags');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('users/login', $data);
			$this->load->view('templates/footer');
			if($this->session->userdata('logged_in')){
				redirect('app/index');
			} 
		}else {
			$email = $this->input->post('Email');
			$enc_password = hash('sha256', $this->input->post('Password'));
			$user_id = $this->user_model->login($email, $enc_password);
			
			if($user_id){
				$user_data = array(
					'id' => $user_id,
					'email' => $email,
					'logged_in' => true
				);
				$this->session->set_userdata($user_data);
				redirect('app/index');
			}else {
				redirect('users/login');
			}
		}

	}

	public function logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		redirect('users/login');
	}	

	public function check_email_exists($email){
		return false;
	}
}
