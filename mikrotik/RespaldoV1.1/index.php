<?php
require('./funciones/routeros_api.class.php');
require('./funciones/function.php');
include('./menu/menu.php');
include('./menu/menu-h.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Informacion MK</title>
    <link href="css.css" rel="stylesheet" type="text/css" />
    <link href="./menu/menu.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="main"><!-- DIV Principal -->
 <div id="header"><!-- DIV HEAD (Logo y Menu) -->
 <h1>Wifi Inspector</h1> 
 </div><!-- DIV HEAD (Logo y Menu) -->
 <div id="menu_horizontal"><!-- DIV MH (Menu sistema) -->
 	<?php menu_h(); ?>
 </div><!-- DIV DIV MH (Menu sistema) --> 
 <br><br>
 <div id="cuerpo"><!-- DIV CUERPO (Menu IZQ Y AREA) -->
   <div id="menu_izq"><!-- DIV (IZQ) -->     
    <?php menu_hoteles();?>
   </div><!-- DIV (IZQ) -->   
   
   <div id="areat"><!-- DIV AREA (DER) -->
		<?php 
			$ciudad=''; $ciudad=$_REQUEST["h"];
			$op=''; $op=$_REQUEST["op"];
			if($ciudad!='' and $op!=''){
				switch($op){
					case 1: inforb($ciudad);
							break;
					case 2: interfaces($ciudad);
							break;
					case 3: aps($ciudad);
							break;		
				}
			}else{
				echo("Seleccione su sopcion..");
			}
        		
		?> 
   </div><!-- DIV AREA (DER) -->
   
 </div><!-- /DIV CUERPO (Menu IZQ Y AREA) --> 
 <div id="footer"><!-- /DIV FOOTER (Menu IZQ Y AREA) --> 
 #MomentosBelAir
 </div><!-- /DIV FOOTER (Menu IZQ Y AREA) --> 
</div><!-- /DIV Principal -->
</body>
</html>
