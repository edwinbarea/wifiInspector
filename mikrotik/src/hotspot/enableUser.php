<?php
session_start();
require('../../funciones/routeros_api.class.php');
require('../../requiere/conn.php');
$idUser =""; $idUser = $_POST["idU"];
try{	 			
    $conexion = crearConexion();
    $consulta = "SELECT * FROM hotel WHERE idHotel='".$_SESSION['id_hotel']."'";
    $sentencia = $conexion->query($consulta);        
    while ($infoHotel = $sentencia->fetch_array()) {        	
    	$ip = ""; $ip = $infoHotel["gateway"];
    	$user = ""; $user = $infoHotel["user_mk"];
    	$pass = ""; $pass = $infoHotel["pass_mk"];
    }
    $conexion->close();
    $sentencia->close();
}catch(Exception $e){
    echo $e;
    $conexion->close();
    $sentencia->close();
    return false;
}
$API = new routeros_api();
$API->debug = false;
if ($API->connect($ip, $user, $pass)) {   // Change this
	if(isset($_POST["en"])){
		$API->write("/ip/hotspot/user/enable",false);
	}else if(isset($_POST["dis"])){
		$API->write("/ip/hotspot/user/disable",false);
	}
	$API->write("=numbers=".$idUser,true);
	$READ = $API->read(false);
	echo("ok");
}else{
	echo("Error al conectar con el router");
}
$API->disconnect();
?>