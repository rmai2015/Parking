<?php

class PLC extends CI_Controller
{	
	public function __construct() {
		parent::__construct();
        if (!$this->session->userdata('user'))
			redirect('user');
	}

    public function index()
    {
		redirect('main');
		$this->load->view('header');
		$this->load->view('select_plc');
		$this->load->view('footer');
	}
}