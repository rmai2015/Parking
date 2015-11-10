<?php

class App extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('App_model');
    }  
    public function index()
    {
    }

    function login($login, $pass)
    {
        $login=  str_replace('%40', '@', $login);
		$user = $this->App_model->CheckUser($login, $pass);
		$user = $user[0];
		$user->plates = $this->App_model->GetPlates($user->id);
		echo json_encode($user);
    }
    
    function getfrees()
    { 
        echo $this->App_model->getfrees();
       
    }
}
