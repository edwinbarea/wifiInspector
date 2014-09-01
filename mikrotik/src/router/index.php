<?php 
//error_reporting(0);
session_start();
require_once("../../funciones/funcionesv2.php");
require_once("../../menus/menus.php");
require_once('../../funciones/consultas.php'); 
require_once('../../requiere/conn.php');

if(!isset($_REQUEST["task"])){ $task=0; }else{ $task=$_REQUEST["task"]; }
if(isset($_REQUEST["op"]) && $_REQUEST["op"]=="Out"){ session_destroy(); header("Location: /mikrotik/"); }
if (!isset($_SESSION["logged_corp"]) && !isset($_SESSION["logged_sist"]) && !isset($_SESSION["logged_user"])){
    die("<head>
        <title>Error</title>        
      </head>
      <body>        
          <center>
          <h1 id='logo'>Wifi Inspector.. </h1>
          <h1>Por favor <a href='/mikrotik/index.php'>Inicia sesion</a></h1>
          </center>        
      </body>");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/FM/include/favicon.ico">

    <title> Wifi Inspector V2 </title>

    <!-- ########################### AQUI EMPIEZA TODO ###################################-->
    <!-- Bootstrap core CSS -->
    <link href="/mikrotik/include/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/mikrotik/include/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/mikrotik/include/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- El bueno -->
    <link href="/mikrotik/include/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/mikrotik/include/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!-- Imagenes -->
    <link href="/mikrotik/include/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- ########################### AQUI ACABA TODO #######################################-->
          
    <!-- Validacion usuario-->
    <!-- <script src="/FM/requiere/js/scriptFront.js"></script> -->


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="/FM/include/js/ie-emulation-modes-warning.js"></script> -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--  <script src="/FM/include/js/ie10-viewport-bug-workaround.js"></script> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">
    <div id="wrapper">
      
      <?php nav("info"); ?>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <!--Inicia el contenido de la web de administrador-->            
            <?php 
            switch($task){
              case 0: interfaces($_SESSION["id_hotel"]); 
                      neighborList($_SESSION["id_hotel"]);                
                      break;
              case 1: neighborList($_SESSION["id_hotel"]);
                      break;
              case 2: inforb($_SESSION["id_hotel"]);
                      break;
            }
            ?>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->                        
      </div>
     <!-- /#page-wrapper -->	            

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- jQuery Version 1.11.0 -->
    <script src="/mikrotik/include/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/mikrotik/include/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript importante-->
    <script src="/mikrotik/include/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/mikrotik/include/js/sb-admin-2.js"></script>

    <!-- Morris Charts JavaScript graficas-->
    <script src="/mikrotik/include/js/plugins/morris/raphael.min.js"></script>
    <script src="/mikrotik/include/js/plugins/morris/morris.min.js"></script>
    <script src="/mikrotik/include/js/plugins/morris/morris-data.js"></script>    
	
  </body>
</html>