<?php
################################################################
######              Informacion del router           ###########
################################################################
function login($user,$pass){
	try{	 			
    	$conexion = crearConexion();
    	$pass2 = sha1($pass);
        $consulta = "SELECT COUNT(1) AS validacion,idUsuario,idNivel,idHotel FROM usuario WHERE user='$user' AND pass='$pass2' AND status='A'";
        $sentencia = $conexion->query($consulta);        
        while ($infoUser = $sentencia->fetch_array()) {        	
        	$validar = ""; $validar = $infoUser["validacion"];
        	$idUsuario = ""; $idUsuario = $infoUser["idUsuario"];
        	$idNivel = ""; $idNivel = $infoUser["idNivel"];     	
        	$idHotel = ""; $idHotel = $infoUser["idHotel"];

        	if($validar!= "0"){				
				switch($idNivel){				
					case 1:$_SESSION["logged_corp"] = $idUsuario;
				   			$_SESSION["id_hotel"] = $idHotel;
					break;
					case 2:$_SESSION["logged_sist"] = $idUsuario;						
				   			$_SESSION["id_hotel"] = $idHotel;			
					break;
					case 3:$_SESSION["logged_user"] = $idUsuario;						
				   			$_SESSION["id_hotel"] = $idHotel;			
					break;
				}
			}
        }
        $conexion->close();
        $sentencia->close();
    }catch(Exception $e){
        echo $e;
        $conexion->close();
        $sentencia->close();
        return false;
    }	
}

?>