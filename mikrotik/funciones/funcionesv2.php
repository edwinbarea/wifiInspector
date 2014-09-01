<?php
require('routeros_api.class.php');
require('../../requiere/conn.php');	

################################################################
######              Informacion del router           ###########
################################################################


function inforb($localidad){
	try{	 			
        $conexion = crearConexion();
        $consulta = "SELECT * FROM hotel WHERE idHotel='$localidad'";
        $sentencia = $conexion->query($consulta);        
        while ($infoHotel = $sentencia->fetch_array()) {        	
        	$ip = ""; $ip = $infoHotel["gateway"];
        	$user = ""; $user = $infoHotel["user_mk"];
        	$pass = ""; $pass = $infoHotel["pass_mk"];
        	$resort = ""; $resort = $infoHotel["nombre"];        	
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

	if ($API->connect($ip, $user, $pass)) {   // Datos para logearse
		$ARRAY = $API->comm("/system/resource/print");
		$first = $ARRAY['0'];
		$memperc = ($first['free-memory']/$first['total-memory']);
		$hddperc = ($first['free-hdd-space']/$first['total-hdd-space']);
		$mem = ($memperc*100);
		$hdd = ($hddperc*100);		
		
		echo('<h1 class="page-header">Informacion '.$resort.'</h1>');

		echo('<div class="table-responsive">');
		echo('<table class="table">');
  		echo('<thead>');
    		echo('<tr>');      		
      			echo('<td>Version del OS</td>');
      			echo('<td>'.$first["platform"] .' - '. $first["board-name"].' - '.$first["version"].' - '.$first["architecture-name"].'</td>');
    		echo('</tr>');
    		echo('<tr>');      		
      			echo('<td>CPU</td>');
      			echo('<td>'.$first["cpu"] .' at '.$first["cpu-frequency"].' Mhz with '.$first["cpu-count"].' core(s) </td>');
    		echo('</tr>');
    		echo('<tr>');      		
      			echo('<td>Tiempo Activo</td>');
      			echo('<td>'.$first["uptime"].' (hh/mm/ss)</td>');
    		echo('</tr>');
    		echo('<tr>');      		
      			echo('<td>%CPU</td>');
      			echo('<td>'.$first["cpu-load"].' %</td>');
    		echo('</tr>');
    		echo('<tr>');      		
      			echo('<td>Espacio en Memoria %</td>');
      			echo('<td>'.$first["free-memory"].' Kb - '.number_format($mem,3).' %</td>');
    		echo('</tr>');
    		echo('<tr>');      		
      			echo('<td>Espacio en Disco %</td>');
      			echo('<td>'.$first["total-hdd-space"].'Kb - '.$first["free-hdd-space"].'Kb - '.number_format($hdd,3).' %</td>');
    		echo('</tr>');
  		echo('</thead>');  		        
		echo('</table>');
		echo('</div>');
		
		echo("<br /><hr />");
	   $API->disconnect();
	
	}
}

################################################################
######       Informacion de las interfases           ###########
################################################################
function interfaces($localidad){
	try{	 			
        $conexion = crearConexion();
        $consulta = "SELECT * FROM hotel WHERE idHotel='$localidad'";
        $sentencia = $conexion->query($consulta);        
        while ($infoHotel = $sentencia->fetch_array()) {        	
        	$ip = ""; $ip = $infoHotel["gateway"];
        	$user = ""; $user = $infoHotel["user_mk"];
        	$pass = ""; $pass = $infoHotel["pass_mk"];
        	$resort = ""; $resort = $infoHotel["nombre"];        	
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
		$API->write("/interface/getall",true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);

		echo('<h1 class="page-header">Interfases '.$resort.'</h1>');

		echo('<div class="table-responsive">');
		echo('<table class="table">');			
			echo "<tr>";	
			for($i=0;$i<count($ARRAY);$i++){				
				$first = $ARRAY[$i];
				if($first['running']=="true"){
					echo"<td title='".$first['name']."' style='border: 1px solid #000;background:#0C0;'>";		
						echo "Eth".$i."<br>";
						$API->write("/interface/monitor-traffic",false);
            $API->write("=interface=".$first['name'],false);
            $API->write("=once=",true);
            $READ = $API->read(false);
            $ARRAY2 = $API->parse_response($READ);               
            $RX_MB = $ARRAY2[0]["rx-bits-per-second"] * 0.001;
            $TX_MB = $ARRAY2[0]["tx-bits-per-second"] * 0.001;
            echo(number_format($TX_MB,2)."KB TX <br> ".number_format($RX_MB,2)."KB RX");
					echo ("</td>");		          
				}else{
					echo"<td title='".$first['name']."' style='border: 1px solid #000;background:#F00;'>";		
						echo "Eth".$i;
					echo ("</td>");
				}
			}	
			echo("</tr>");
		echo('</table>');
		echo('</div>');	    
	} 
		$API->disconnect();  
}

function neighborList($localidad){
  try{  
        $conexion = crearConexion();
        $consulta = "SELECT * FROM hotel WHERE idHotel='$localidad'";
        $sentencia = $conexion->query($consulta);        
        while ($infoHotel = $sentencia->fetch_array()) {          
          $ip = ""; $ip = $infoHotel["gateway"];
          $user = ""; $user = $infoHotel["user_mk"];
          $pass = ""; $pass = $infoHotel["pass_mk"];
          $resort = ""; $resort = $infoHotel["nombre"];         
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
  if ($API->connect($ip, $user, $pass)) {
    $API->write("/ip/neighbor/getall",true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);
    
    try{  
        $conexion = crearConexion();
        $consulta = "SELECT * FROM ap WHERE idHotel='$localidad'";
        $sentencia = $conexion->query($consulta); 
        if($count= $sentencia->num_rows)               {
          $rows = $sentencia->fetch_all();          
        }else{
          $rows = array();
        }
        $conexion->close();
        $sentencia->close();
    }catch(Exception $e){
        echo $e;
        $conexion->close();
        $sentencia->close();
        return false;
    }     
    echo('<h1 class="page-header">Lista de AP de '.$resort.'</h1>');
    echo('<div class="row">');
      echo('<div class="col-md-8">');
        echo('<div class="panel panel-default">');
          echo('<div class="panel-heading">');
            echo('<h3 class="panel-title">Neighbors</h3>');
          echo('</div>');
          echo('<div class="panel-body">');
            echo("<table class='table-bordered'>");
              for($i=0;$i<count($ARRAY);$i++){  
                $first = $ARRAY[$i];
                if(isset($first["address"])){
                  echo('<tr>');
                    echo('<td class="col-md-2"><center>');
                      echo('<a href="/mikrotik/src/aps/view.php?neighbor='.$first["address"].'">');
                        echo($first["identity"]);
                      echo('</a>');
                    echo('</center></td>');                    
                    echo('<td class="col-md-2"><center>');
                      echo($first["address"]);
                    echo('</center></td>');
                    echo('<td class="col-md-2"><center>');
                      echo($first["mac-address"]);
                    echo('</center></td>');
                    echo('<td class="col-md-1"><center>');
                      $existe = 0;
                      for ($x=0; $x < count($rows); $x++) { 
                        //echo 'Esta es ='.$rows[$x]["1"];
                        if($rows[$x]["1"] == $first["mac-address"]){
                          $existe = "1";
                        }
                      }
                      if($existe == "1"){
                        echo("Registrada");
                      }else{
                        echo("Desconocida");
                      }
                    echo('</center></td>');
                  echo('</tr>');
                }
              }
            echo("</table>");
          echo('</div>');
        echo('</div>');
      echo('</div>');
    echo('</div>');    
  }
}

function viewAP($ipAP,$localidad){
  try{        
        $conexion = crearConexion();
        $consulta = "SELECT * FROM hotel WHERE idHotel='$localidad'";
        $sentencia = $conexion->query($consulta);        
        while ($infoHotel = $sentencia->fetch_array()) { 
          $ip = ""; $ip = $infoHotel["gateway"];                 
          $user = ""; $user = $infoHotel["user_mk"];
          $pass = ""; $pass = $infoHotel["pass_mk"];
          $resort = ""; $resort = $infoHotel["nombre"];         
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

  if ($API->connect($ipAP, $user, $pass)) {    
    
    $API->write("/interface/wireless/registration-table/getall",true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);

    echo('<h1 class="page-header">Lista de AP de '.$resort.'</h1>');
    echo('<div class="row">');
      echo('<div class="col-md-8">');
        echo('<div class="panel panel-default">');
          echo('<div class="panel-heading">');
            echo('<h3 class="panel-title">Conectados</h3>');
          echo('</div>');
          echo('<div class="panel-body">');
            echo("<table class='table-bordered'>");
              echo('<tr>');
                echo('<td>');
                  echo('Mac Address');
                echo('</td>');
                echo('<td>');
                  echo('IP');
                echo('</td>');
                echo('<td>');
                  echo('Signal');
                echo('</td>');
              echo('</tr>');
              for($i=0;$i<count($ARRAY);$i++){        
                $first = $ARRAY[$i];        
                echo('<tr>');
                  echo('<td>');
                    echo($first["mac-address"]);
                  echo('</td>');
                  echo('<td>');
                    echo($first["last-ip"]);
                  echo('</td>');
                  echo('<td>');
                    echo($first["signal-strength-ch0"]);
                  echo('</td>');
                echo('</tr>');
              }
            echo("</table>");
          echo('</div>');
        echo('</div>');
      echo('</div>');
    echo('</div>');     
  }else{
    echo("Ocurrio un problema al conectarnos");
  }

}
?>