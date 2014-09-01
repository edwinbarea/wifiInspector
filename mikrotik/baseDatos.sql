-- create database wifiInspector;
-- use wifiInspector;

create table hotel(
	idHotel int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	ciudad varchar(45) NOT NULL,
	user_mk varchar(15) NOT NULL,
	pass_mk varchar(45) NOT NULL,
	gateway varchar(20) NOT NULL,
	ip_external varchar(20) NULL,
	status varchar(2) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB ;

create table AP(
	idAP int(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	MAC varchar(20) NOT NULL unique,
	IPV4 varchar(20) NOT NULL,
	nombre varchar(45) NOT NULL,
	marca varchar(20) NOT NULL,
	modelo varchar(20) NOT NULL,
	redConexion varchar(2) NOT NULL,
	comentarios text NULL,
	idHotel int(3) NOT NULL,
	status varchar(2) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB;

create table nivel(
	idNivel int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nombre varchar(15) NOT NULL,
	status varchar(2) NOT NULL
) ENGINE=InnoDB;

create table usuario(
	idUsuario int(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	user varchar(15) NOT NULL unique,
	pass varchar(45) NOT NULL,
	idHotel int(3) NOT NULL,
	idNivel int(3) NOT NULL,
	status varchar(2) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB;

# Alters tables
ALTER TABLE `AP`
 ADD CONSTRAINT `fk_AP_hotel` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`);

ALTER TABLE `usuario`
 ADD CONSTRAINT `fk_usuario_hotel` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`),
 ADD CONSTRAINT `fk_usuario_nivel` FOREIGN KEY (`idNivel`) REFERENCES `nivel` (`idNivel`);


# Insertamos en la base de datos
INSERT INTO nivel VALUES(0,'Corporativo','A');
INSERT INTO nivel VALUES(0,'Sistemas','A');
INSERT INTO nivel VALUES(0,'Usuarios','A');

INSERT INTO hotel VALUES (0,'Corporativo','GDL','belair','cancun','10.0.0.1','','A');

INSERT INTO usuario VALUES (0,'Administrador Sistemas','admin','icdsitra',1,1,'A');