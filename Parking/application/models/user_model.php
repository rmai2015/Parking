<?php

class User_Model extends CI_Model
{    
    public function CheckUser($email, $password = '')
    {
		if ($password)
			return $this->db->get_where('users', array('email' => $email, 'password' => sha1($password)))->num_rows() != 0;
		else return $this->db->get_where('users', array('email' => $email))->num_rows() != 0;
    }
	
	public function SetPassword($email, $password)
	{
		if ($this->CheckUser($email))
			$this->db->update('users', array('reset_pass' => sha1($password)), 'email = \''.$email.'\'');
		else $this->db->insert('users', array('email' => $email, 'password' => sha1($password)));
	}
	
	function ResetPassword($email)
	{
		$this->db->query('call ResetPassword(\''.$email.'\')');
	}
	
    public function getUser($email)
    {
		if (empty($email))
			return '';
		else {
			$users = $this->db->get_where('users', array('email' => $email))->result();
			foreach ($users as $user)
				$user->plates = $this->db->get_where('number_plates', array('user_id' => $user->id))->result();
			return $users;
		}
	}
	
	function ChangePassword($user_id, $pass)
	{
		$this->db->update('users', array('password' => sha1($pass)), 'id = '.$user_id);
	}
}
