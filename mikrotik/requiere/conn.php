<?php 
function crearConexion(){
	$servidor=""; $localhost="localhost";
	$user=""; $user="root";
	$pass="";
	$bd=""; $bd="wifiinspector";
	$conn = new mysqli($servidor, $user, $pass, $bd);
	if ($conn->connect_errno) {
	    echo "Fallo al contenctar a MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
	return $conn;
}
?>