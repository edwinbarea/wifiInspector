<?php 
//error_reporting(0);
session_start();
require_once('funciones/consultas.php'); 
require_once('requiere/conn.php');
if(isset($_REQUEST["conn"]) && $_REQUEST["conn"]=="now"){
  $u=$_REQUEST["user"];
  $p=$_REQUEST["pass"];
  login($u,$p);
}
if(isset($_SESSION["logged_corp"]) || isset($_SESSION["logged_sist"]) || isset($_SESSION["logged_user"])){
    header("Location: /mikrotik/src/router/index.php");
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
    
    <!-- Archivo de Validaciones -->
    <script type="text/javascript" src="/mikrotik/requiere/validacion.js"></script>    
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

  <body>
    <div class="container">      
      <form class="form-signin" role="form" name='login' style="width:300px; margin: 0 auto;">        
        <h2 class="form-signin-heading">
        <center>            
          <img src="/mikrotik/imgs/coleccionBeair.png" height="80%" width="80%"><br><br><br>
          Acceso al Sistema          
        </center>
        </h2>
        <input type="input" name="user" class="form-control" placeholder="User" required autofocus>
        <input type="password" name="pass" class="form-control" placeholder="Password" required> <br>
        <input type="hidden" name="conn" value=''>       
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="validar()">Iniciar Sesion</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>