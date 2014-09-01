<?php
/*****************************
 *
 * Funciones para MK
 * Author: Bel Air
 * Contributors: Edwin Barea
 * http://www.mikrotik.com
 * http://wiki.mikrotik.com/wiki/API_PHP_class
 *
 ******************************/

function inforb($localidad){
	switch($localidad){
		case 1:$ip="10.9.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Cancun';
		break;
		case 2: $ip="10.8.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Xpuha';
		break;			
	}
  
	$API = new routeros_api();
	$API->debug = false;

	if ($API->connect($ip, $user, $pass)) {   // Change this as necessery
		$ARRAY = $API->comm("/system/resource/print");
		$first = $ARRAY['0'];
		$memperc = ($first['free-memory']/$first['total-memory']);
		$hddperc = ($first['free-hdd-space']/$first['total-hdd-space']);
		$mem = ($memperc*100);
		$hdd = ($hddperc*100);
	
		echo ("<table id='tabla'>");
			echo "<tr style='border: 1px solid #000'>";
				echo"<th colspan='2' style='border: 1px solid #000'>";
				echo ($resort);
				echo ("</th>");
			echo"</tr>";
			echo "<tr style='border: 1px solid #000'>";
				echo"<td style='border: 1px solid #000'>";		
				echo "Version del OS";
				echo ("</td>");	
				echo"<td style='border: 1px solid #000'>";		
				echo($first['platform'] . " - " . $first['board-name'] . " - "  . $first['version'] . " - " . $first['architecture-name']);
				echo ("</td>");
			echo("</tr>");	
			echo "<tr style='border: 1px solid #000'>";
				echo"<td style='border: 1px solid #000'>";		
				echo "CPU";
				echo ("</td>");	
				echo"<td style='border: 1px solid #000'>";		
				echo($first['cpu'] . " at " . $first['cpu-frequency'] . " Mhz with " . $first['cpu-count'] . " core(s) " );
				echo ("</td>");
			echo("</tr>");	
			echo "<tr style='border: 1px solid #000'>";
				echo"<td style='border: 1px solid #000'>";		
				echo "Tiempo Activo";
				echo ("</td>");	
				echo"<td style='border: 1px solid #000'>";		
				echo($first['uptime'] . " (hh/mm/ss)"  );
				echo ("</td>");
			echo("</tr>");
			echo "<tr style='border: 1px solid #000'>";
				echo"<td style='border: 1px solid #000'>";		
				echo "%CPU";
				echo ("</td>");	
				echo"<td style='border: 1px solid #000'>";		
				echo($first['cpu-load'] . " %"  );
				echo ("</td>");
			echo("</tr>");
			echo "<tr style='border: 1px solid #000'>";
				echo"<td style='border: 1px solid #000'>";		
				echo "Espacio en Memoria %";
				echo ("</td>");	
				echo"<td style='border: 1px solid #000'>";		
				echo($first['free-memory'] . "Kb - " . number_format($mem,3) . " %"  );
				echo ("</td>");
			echo("</tr>");	
			echo "<tr style='border: 1px solid #000'>";
				echo"<td style='border: 1px solid #000'>";		
				echo "Espacio en Disco %";
				echo ("</td>");	
				echo"<td style='border: 1px solid #000'>";		
				echo($first['total-hdd-space'] . "Kb - " . $first['free-hdd-space'] . "Kb - " . number_format($hdd,3) . " %"  );
				echo ("</td>");
			echo("</tr>");	
				
		echo "</table>";
		echo("<br /><hr />");
	   $API->disconnect();
	
	}
}


/* Lectura de interfaces*/
function interfaces($localidad){
	switch($localidad){
		case 1: $ip="10.9.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Cancun';
		break;
		
		case 2:$ip="10.8.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Xpuha';
		break;
	}
	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ip, $user, $pass)) {   // Change this
		$ARRAY = $API->comm("/interface/getall");
		$first = $ARRAY['6'];
		echo "<table>";
		echo "<tr>";
			echo"<td colspan='".count($ARRAY)."' style='border: 1px solid #000'>";
			echo ("<center>Interfaces ".$resort."</center>");
			echo ("</td>");
		echo"</tr>";		
		
		echo "<tr style='border: 1px solid #000'>";	
		for($i=0;$i<count($ARRAY);$i++){				
			$first = $ARRAY[$i];
			if($first['running']=="true"){
				echo"<td title='".$first['name']."' style='border: 1px solid #000;background:#0C0;'>";		
				echo "Eth".$i;
				echo ("</td>");		          
			}else{
				echo"<td title='".$first['name']."' style='border: 1px solid #000;background:#F00;'>";		
				echo "Eth".$i;
				echo ("</td>");
			}
          	//echo"<td style='border: 1px solid #000'>";		
			//echo $first['running'];
			//echo ("</td>");															
		}	
		echo("</tr>");			
		echo "</table>";

		print_r($ARRAY);
	} 
		$API->disconnect();  
}
   
                                               
  function direcciones($localidad){
	switch($localidad){
		case 1: $ip="10.8.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Xpuha';
		break;
		
		case 2:$ip="200.79.224.141" ;
				$user='cancun';
				$pass='belair';
				$resort='Cancun';
		break;
	}
	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ip, $user, $pass)) {   // Change this
		$ARRAY = $API->comm("/ip/address/getall");
		$first = $ARRAY['6'];
		echo "<table>";
	
			echo "<tr style='border: 1px solid #000'>";
			echo"<td colspan='8' style='border: 1px solid #000'>";
			echo ("DIRECCIONES");
			echo ("</td>");
		echo"</tr>";
			
			echo ("</td>");
		echo"</tr>";		
			
			for($i=0;$i<count($ARRAY);$i++){	
				echo "<tr style='border: 1px solid #0xf0f8ff'>";
					$first = $ARRAY[$i];
						
            echo"<td style='border: 1px solid #000'>";		
						echo $first['interface'];
						echo ("</td>");
            
            echo"<td style='border: 1px solid #000'>";		
						echo $first['address'];
						echo ("</td>");		
          
          	echo"<td style='border: 1px solid #000'>";		
						echo $first['network'];
						echo ("</td>");	
								
			}	
		echo("</tr>");	
		
echo "</table>";
	
	}
	$API->disconnect();
} 
                       
function aps($localidad){
	switch($localidad){
		case 1: $ip="10.9.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Cancun';
		break;
		
		case 2:$ip="10.8.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Xpuha';
		break;
	}
	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ip, $user, $pass)) {   // Change this
		$ARRAY = $API->comm("/ip/neighbor/getall");
		$first = $ARRAY['6'];
		echo "<table>";
	
		echo "<tr style='border: 1px solid #000'>";
			echo"<td colspan='8' style='border: 1px solid #000'>";
			echo ("APS");
			echo ("</td>");
		echo"</tr>";	
			
			echo ("</td>");
		echo"</tr>";		
			
			for($i=0;$i<count($ARRAY);$i++){	
				echo "<tr style='border: 1px solid #0xf0f8ff'>";
					$first = $ARRAY[$i];
						echo"<td style='border: 1px solid #000'>";		
						echo $first['identity'];
						echo ("</td>");		
          
          	echo"<td style='border: 1px solid #000'>";		
						echo $first['version'];
						echo ("</td>");	
						
			echo"<td style='border: 1px solid #000'>";		
						echo $first['mac-address'];
						echo ("</td>");					
			}	
		echo("</tr>");	
		
echo "</table>";
echo "<br />Debug:<br>";	
	# print_r($ARRAY);	
	}

				$routerID=9;
				echo("ID: ".$ARRAY[$routerID][".id"]."<br>");			
				echo("Interfaces: ".$ARRAY[$routerID]["interface"]."<br>");			
				echo("Direccion: ".$ARRAY[$routerID]["address"]."<br>");			
				echo("IPV4: ".$ARRAY[$routerID]["address4"]."<br>");			
				#echo("IPV6: ".$ARRAY[$routerID]["address6"]."<br>");			
				echo("MAC: ".$ARRAY[$routerID]["mac-address"]."<br>");			
				echo("Identificador: ".$ARRAY[$routerID]["identity"]."<br>");			
				echo("Plataforma: ".$ARRAY[$routerID]["platform"]."<br>");			
				echo("Version: ".$ARRAY[$routerID]["version"]."<br>");			
				echo("Unpack: ".$ARRAY[$routerID]["unpack"]."<br>");			
				echo("Age: ".$ARRAY[$routerID]["age"]."<br>");			
				#echo("Uptime: ".$ARRAY[$routerID]["uptime"]."<br>");			
				#echo("Software: ".$ARRAY[$routerID]["software-id"]."<br>");			
				#echo("Tarjeta: ".$ARRAY[$routerID]["board"]."<br>");			
				#echo("IPV6 Suppot: ".$ARRAY[$routerID]["ipv6"]."<br>");			
				echo("Interfaces Name: ".$ARRAY[$routerID]["interface-name"]."<br>");
			
	$API->disconnect();
}
                                               
function wifi($localidad){
	switch($localidad){
		case 1: $ip="10.9.1.128" ;
				$user='cancun';
				$pass='belair';
				$resort='Lobby_ADM';
		break;
		
		case 2:$ip="192.168.9.4" ;
				$user='cancun';
				$pass='belair';
				$resort='Sector_Park';
		break;
    
    case 3:$ip="192.168.9.7" ;
				$user='cancun';
				$pass='belair';
				$resort='Sector_MotorLobby';
		break;
    
    case 4:$ip="192.168.9.8" ;
				$user='cancun';
				$pass='belair';
				$resort='Sushi_bar';
		break;
    
    case 4:$ip="192.168.9.138" ;
				$user='cancun';
				$pass='belair';
				$resort='Sector_Snack';
		break;
    
    case 5:$ip="192.168.9.12" ;
				$user='cancun';
				$pass='belair';
				$resort='Sector_Playa';
		break;
    
    case 6:$ip="192.168.9.6" ;
				$user='cancun';
				$pass='belair';
				$resort='Hab_6507';
		break;
   
   case 7:$ip="192.168.9.5" ;
				$user='cancun';
				$pass='belair';
				$resort='Hab_6307';
		break;
     
	}
	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ip, $user, $pass)) {   // Change this
		$ARRAY = $API->comm("/interface/wireless/registration-table/getall");
		$first = $ARRAY['0'];
		echo "<table>";
	
		echo "<tr style='border: 1px solid #000'>";
			echo"<td colspan='8' style='border: 1px solid #000'>";
			echo ("Clientes $resort");
			echo ("</td>");
		echo"</tr>";	
			
			echo ("</td>");
		echo"</tr>";		
			
			for($i=0;$i<count($ARRAY);$i++){	
				echo "<tr style='border: 1px solid #0xf0f8ff'>";
					$first = $ARRAY[$i];
						echo"<td style='border: 1px solid #000'>";		
						echo $first['mac-address'];
						echo ("</td>");	
          
          	echo"<td style='border: 1px solid #000'>";		
						echo $first['interface'];
						echo ("</td>");	
						
            echo"<td style='border: 1px solid #000'>";		
						echo $first['tx-rate'];
						echo ("</td>");					
			}	
		echo("</tr>");	
		
echo "</table>";
	/*echo "<br />Debug:";*/
	}
	$API->disconnect();
}

     

/* Lectura de interfaces 2*/
function interfaces2($localidad){
	switch($localidad){
		case 1: $ip="10.9.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Cancun';
		break;
		
		case 2:$ip="10.8.0.1" ;
				$user='cancun';
				$pass='belair';
				$resort='Xpuha';
		break;
	}
	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ip, $user, $pass)) {   // Change this
		$ARRAY = $API->comm("/interface/getall");
		$first = $ARRAY['6'];
		echo "<table>";
		echo "<tr style='border: 1px solid #000'>";
			echo"<td colspan='8' style='border: 1px solid #000'>";
			echo ("Interfaces ".$resort);
			echo ("</td>");
		echo"</tr>";		
		echo "<tr style='border: 1px solid #000'>";	
		for($i=0;$i<count($ARRAY);$i++){	
			
			$first = $ARRAY[$i];
			if($first['running']=="true"){
				echo"<td style='border: 1px solid #000;background:#0C0;'>";		
				echo $first['name'];
				echo ("</td>");		          
			}else{
				echo"<td style='border: 1px solid #000;background:#F00;'>";		
				echo $first['name'];
				echo ("</td>");
			}
          	echo"<td style='border: 1px solid #000'>";		
			echo $first['running'];
			echo ("</td>");															
		}	
		echo("</tr>");			
		echo "</table>";
	} 
		$API->disconnect();  
}
?>