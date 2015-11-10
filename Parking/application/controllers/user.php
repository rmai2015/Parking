<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->load->model('User_Model');
	}
	
	function logout() {
		$this->session->unset_userdata('user');
		redirect('main');
	}
	
	public function data_check()
	{
		return $this->User_Model->CheckUser($this->input->post('email'), $this->input->post('password'));
	}
	
	private function View($login)
	{
		if (($success = $this->form_validation->run() && (!$this->session->userdata('send') || $this->session->userdata('send') != $this->input->post('send'))))
			if ($login) {
				$this->session->set_userdata('user', $this->input->post('email'));
				redirect('plc');
			} else {
				$this->session->set_userdata('send', $this->input->post('send'));
				$this->load->helper('string');
				$this->load->library('email');
				$this->email->from('nanotest321@gmail.com', 'Parking');
				$this->User_Model->SetPassword($email = $this->input->post('email'), $password = random_string('alnum', 8));
				$this->email->to($email); 
				$this->email->subject('Konto NANOmatic.pl');
				if ($this->input->post('send') != '')
					$message = 'po kliknięciu w poniższy link, Twoje hasło zostanie zmienione na: <b>'.$password.'</b><br />'.anchor(base_url($this->router->fetch_class().'/reset/'.sha1($email).sha1($password)), 'Resetuj hasło');
				else 
					$message = 'Twoje hasło to: <b>'.$password.'</b><br />'.anchor(base_url($this->router->fetch_class().'/login'), 'Zaloguj się teraz');
				$this->email->message($this->load->view('header', true).'Witaj<br /><br />'.$message.$this->load->view('footer', true));	
				$this->email->send();
				$success = true;
			}
		$this->load->view('header');
		$this->load->view($this->router->fetch_class().'/'.$this->router->fetch_method(), array('success' => $success));
		$this->load->view('footer');
	}

	public function index()
	{
		redirect('user/login');
	}
	
	public function login()
    {
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[40]');
		$this->form_validation->set_rules('password', 'Hasło', 'trim|required|min_length[6]|max_length[40]|callback_data_check');
		$this->View(true);
    }
	
	public function reset($reset_code = '')
	{
		if ($reset_code) {
			$array = str_split($reset_code, 40);
			$query = $this->db->get_where('users', array('sha1(email)' => $array[0], 'reset_pass' => $array[1]));
			if ($query->num_rows())
				$this->User_Model->ResetPassword($query->row()->email);
			redirect($this->router->fetch_class().'/login');
		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[40]|callback_data_check');
			$this->View(false);
		}
	}
	
	public function add()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[40]|is_unique[users.email]');
		$this->View(false);
	}
	
	function getUserDelail()
	{
		echo json_encode($this->User_Model->getUser($this->session->userdata('user')));
	}
	
	function SetPassword($id, $pass)
	{
		$this->User_Model->ChangePassword($id, $pass);
	}
}