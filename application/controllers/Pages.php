<?php
class Pages extends CI_Controller {

	public function view($page = 'home')
	{
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}

		$data['title'] = "CloudStorage - ".ucfirst($page);

		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');

		if($this->session->userdata('logged_in')){
			redirect('app/index');
		}else{
			redirect('users/register');
		}
	}
}
