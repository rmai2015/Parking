<?php

require_once 'controller.php';

class Main extends CI_Controller
{
	public function __construct()
	{
		 parent::__construct();
		$this->load->model('Parking_Model');
	}
	
    public function index()
    {
		//$state = array("class"=>array('free', 'reserved', 'busy'), "text"=>array("wolny", "rezerwacja", "zajęty"));
		$this->load->view('header');
		$this->load->view('main', array("parking"=>$this->Parking_Model->get_parkings()));//, "state"=>$state));
		$this->load->view('footer');
    }
	
	function parkings()
	{
		$this->load->view('parkings', array("parking"=>$this->Parking_Model->get_parkings()));
	}
	
	function getParkings()
	{
		echo json_encode($this->Parking_Model->get_parkings());
	}
	
	function places()
	{
		$this->load->view('places');
	}
	
	function user_config()
	{
		$this->load->view('user_config');
	}
	
	function getPlaces($id_parking)
	{
		echo json_encode($this->Parking_Model->get_places($id_parking));
		//$places_history = $this->Parking_Model->get_places_history();
	}
	
	function setReservation($userID, $placeID, $plateID = 1)
	{
		echo $this->Parking_Model->setReservation($userID, $placeID, $plateID);
	}
	
	function occupyPlace($userID, $placeID)
	{
		$this->Parking_Model->occupyPlace($userID, $placeID);
	}
	
	function releasePlace($userID, $placeID)
	{
		$this->Parking_Model->releasePlace($userID, $placeID);
	}
	
	function canReservation($userID, $id_parking)
	{
		echo $this->Parking_Model->canReservation($userID, $id_parking);
	}
	
	function getReservations($userID)
	{
		echo json_encode($this->Parking_Model->getReservations($userID));
	}
	
	function removeReservation($placeID)
	{
		$this->Parking_Model->removeReservation($placeID);
	}
	
	function getUsers()
	{
		echo json_encode($this->Parking_Model->getUsers());
	}
	
	function ChangePlate($id, $number)
	{
		$this->Parking_Model->ChangePlate($id, $number);
	}
	
	function AddPlate($user_id, $number)
	{
		$this->Parking_Model->AddPlate($user_id, $number);
	}
	
	function RemovePlate($id)
	{
		$this->Parking_Model->RemovePlate($id);
	}
}
