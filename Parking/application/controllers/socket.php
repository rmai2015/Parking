<?php

class Socket extends CI_Controller
{	
    public function index()
	{
		error_reporting(~E_WARNING);

		$server = '127.0.0.1';
		$port = 9999;

		if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);

			die("Couldn't create socket: [$errorcode] $errormsg \n");
		}

		echo "Socket created \n";

		echo 'Enter a message to send : ';
		$input = 'abc';

		//Send the message to the server
		if( ! socket_sendto($sock, $input , strlen($input) , 0 , $server , $port))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);

			die("Could not send data: [$errorcode] $errormsg \n");
		}

		//Now receive reply from server and print it
		if(socket_recv ( $sock , $reply , 5 , 256 ) === false)
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);

			die("Could not receive data: [$errorcode] $errormsg \n");
		}

		echo "Reply : $reply";
	}
}