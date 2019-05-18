<?php
class App extends CI_Controller {

	public function index()
	{
		$data['title'] = "CloudStorage - App";

		$this->load->view('templates/header', $data);
		$this->load->view('app/index', $data);
		$this->load->view('templates/footer');

		$this->load->view('app/session');

	}
}
