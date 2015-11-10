<?php

class Parking_Model extends CI_Model
{    
    function get_parkings()
	{
		return $this->db->get('parkings')->result();
	}
	
	function get_places($id_parking)
	{
		return $this->db->get_where('places', array('id_parking' => $id_parking + 1))->result();
	}
	
	function setReservation($userID, $placeID, $plateID)
	{
		if ($this->canReservation($userID, $this->db->get_where('places', array('id' => $placeID))->row()->id_parking)) {
			$this->db->update('places', array('user_id' => $userID, 'state' => 2, 'number_id' => $plateID), array('id' => $placeID, 'state' => 0));
			$this->db->set('time_start', 'NOW()', FALSE);
			$this->db->set('time_end', date('Y-m-d h:i:s', time() + 30));
			$this->db->insert('places_history', array('id_place' => $placeID, 'id_user' => $userID, 'number_id' => $plateID));
			return true;
		} else return false;
	}
	
	function occupyPlace($userID, $placeID)
	{
		$this->db->update('places', array('user_id' => 0, 'state' => 1), array('id' => $placeID));
	}
	
	function releasePlace($userID, $placeID)
	{
		$this->db->update('places', array('user_id' => 0, 'state' => 0), array('id' => $placeID));
	}
	
	function canReservation($userID, $id_parking)
	{
		return $this->db->get_where('places', array('user_id' => $userID, 'id_parking' => $id_parking))->num_rows() == 0;
	}
	
	function getReservations($userID)
	{
		return $this->db->get_where('places', array('user_id' => $userID))->result();
	}
	
	function removeReservation($placeID)
	{
		$this->db->update('places', array('user_id' => 0, 'state' => 0), array('id' => $placeID));
	}
	
	function getUsers() {
		$users = $this->db->get('users')->result();
		foreach ($users as $user)
			$user->plates = $this->db->get_where('number_plates', array('user_id' => $user->id))->result();
		return $users;
	}
	
	function ChangePlate($id, $number)
	{
		$this->db->update('number_plates', array('number' => $number), array('id' => $id));
	}
	
	function AddPlate($user_id, $number)
	{
		$this->db->insert('number_plates', array('user_id' => $user_id, 'number' => $number));
	}
	
	function RemovePlate($id)
	{
		$this->db->where('id', $id)->delete('number_plates');
	}
}
