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
	if(isset($_POST["upd"])){
		$API->write("/ip/hotspot/user/getall",true);
        $READ = $API->read(false);
        $ARRAY2 = $API->parse_response($READ);
        for ($i=0; $i < count($ARRAY2) ; $i++) { 
            if($i == $idUser){
                return $ARRAY2[$i];
            }
        }
	}
}else{
	echo("Error al conectar con el router");
}
$API->disconnect();
?>