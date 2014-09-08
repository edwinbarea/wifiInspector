<?php 
//======================================== Termina funcion menuFront() =================================
function nav($active){ ?>

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>           
            <a class="navbar-brand" href="/index.php">
                wifi Inspector
            </a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">                                                        
            <li class="dropdown">
                <?php /*if (($_SESSION["logged_cliente"])){ */?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php
                            if(isset($_SESSION["logged_corp"])){
                                $idUsuario = $_SESSION["logged_corp"];
                            }else if(isset($_SESSION["logged_sist"])){
                                $idUsuario = $_SESSION["logged_sist"];
                            }
                            $conexion = crearConexion();
                            $conNom = ('SELECT nombre FROM usuario where idUsuario="'.$idUsuario.' " ');                            
                            $sentencia = $conexion->query($conNom);
                            if($infoUser = $sentencia->fetch_array()){
                                echo('<span class="glyphicon glyphicon-user"></span>');
                                echo("&nbsp".$infoUser["nombre"]);
                                echo('&nbsp<span class="fa fa-caret-down"> </span>');
                            }
                        ?>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">                    
                        <!-- <li class="divider"></li> -->
                        <li>
                            <a href="?op=Out"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                <?php /*}*/ ?>
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!-- Aqui esta el buscador de productos-->
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <!-- Aqui esta el buscador de producos -->
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>                                           
                    <li>
                        <a <?php if($active=="info"){ echo('class="active"'); } ?>  href="#"><i class="fa fa-wrench fa-fw"></i> Router <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/mikrotik/src/router/index.php">Interfases</a>
                            </li>
                            <li>
                                <a href="/mikrotik/src/router/index.php?task=1">AP's</a>
                            </li>
                            <li>
                                <a href="/mikrotik/src/router/index.php?task=2">Informacion</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>   
                    <li>
                        <a <?php if($active=="hotspot"){ echo('class="active"'); } ?>  href="#"><i class="fa fa-wrench fa-fw"></i> Hotspot <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/mikrotik/src/hotspot/index.php">Server Profiles</a>
                            </li>
                            <li>
                                <a href="index.php?task=1">User</a>
                            </li>
                            <li>
                                <a href="#">User Profile</a>
                            </li>
                            <li>
                                <a href="#">Active</a>
                            </li>
                            <li>
                                <a href="#">Hosts</a>
                            </li>
                            <li>
                                <a href="#">Bindings</a>
                            </li>
                            <li>
                                <a href="#">Cookies</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>   
                    <li>                        
                        <a <?php if($active=="hotel"){ echo('class="active"'); } ?> href="#"><i class="fa fa-sitemap fa-fw"></i>Hotel</a>
                    </li>
                    <li>                        
                        <a <?php if($active=="aps"){ echo('class="active"'); } ?> href="#"><i class="fa fa-sitemap fa-fw"></i>Registro de APs</a>
                    </li>
                    <li>                        
                        <a <?php if($active=="usuarios"){ echo('class="active"'); } ?> href="#"><i class="fa fa-sitemap fa-fw"></i>Usuarios</a>
                    </li>
                    <li>
                        <a <?php if($active=="reportes"){ echo('class="active"'); } ?> href="#">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                            Reportes                            
                                <span class="badge pull-right">0</span>                            
                        </a>
                    </li>                 
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
<?php
}
?>