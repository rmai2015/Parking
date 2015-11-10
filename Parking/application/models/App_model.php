<?php

class App_Model extends CI_Model
{    
    function CheckUser($email, $password)
    {
        return $this->db->get_where('users', array('email' => $email, 'password' => sha1($password)))->result();
    }
    
    function getfrees()
    {
         $frees=0; //utworzenie zmiennej z iloscia miejsc wolnych
         foreach ($this->db->get_where('parkings', array('state'=>0 ))->result() as $row)
         {
             if(!$this->db->get_where('parking_user', array('id_parking'=>$row->id))->num_rows()) 
                $frees++;  //inkrementacja frees jeżeli żaden użytkownik nie jest podpi do miejsca
         }
         return $frees;

    }
	
	function GetPlates($user_id)
	{
		return $this->db->get_where('number_plates', array('user_id' => $user_id))->result();
	}
}