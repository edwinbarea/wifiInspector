<?php
require('../../requiere/conn.php');
$mac =""; $mac = $_POST["mac"];
$nombre =""; $nombre = $_POST["nombre"];
$ip =""; $ip = $_POST["ip"];
$marca =""; $marca = $_POST["marca"];
$modelo =""; $modelo = $_POST["modelo"];
$hotel =""; $hotel = $_POST["hotel"];
$red =""; $red = $_POST["red"];
$insert = "";
try{
	$conexion = crearConexion();
    $consulta = "INSERT INTO ap VALUES (0,'$mac','$ip', '$nombre', '$marca','$modelo', '$red', NULL, '$hotel','A' )";
    if($conexion->query($consulta)){    	
    	$insert = "ok";
    }else{
    	$insert = "error";
    }   
	$conexion->close();
	//$insertAP->close();
}catch(Exception $e){
    echo $e;
    $conexion->close();
    $insertAP->close();
    return false;
}
echo $insert;
?>