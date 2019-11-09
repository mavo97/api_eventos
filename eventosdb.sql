CREATE DATABASE eventos;

USE eventos;

/* Creación de tabla usuarios */
CREATE TABLE usuarios ( id_usuario varchar(50) not null, 
nombre varchar(30) not null, apellidos varchar(30) not null, curp varchar(18) not null,
PRIMARY KEY (curp),
 telefono INT(10) not null, correo varchar(30) not null, rol_usuario smallint(1) not null,
 contrasena varchar(20) not null)ENGINE=INNODB;


/* Creación de tabla usuarios */
CREATE TABLE eventos ( id_evento int unsigned not null auto_increment,
PRIMARY KEY (id_evento),
nombre varchar(30) not null, fecha_inicio date not null, fecha_fin date not null,
ubicacion varchar(30), costo int(5), estado boolean not null, 
 descripcion varchar(200) not null )ENGINE=INNODB;

/* Creación de tabla actividades */
CREATE TABLE actividades (id_actividad int unsigned not null auto_increment,
PRIMARY KEY (id_actividad),
nombre varchar(30) not null, fecha_inicio date not null, fecha_fin date not null,
descripcion varchar(200) not null, id_evento int unsigned not null)ENGINE=INNODB;

/* Creación de llave foranea id_evento */
ALTER TABLE actividades 
ADD CONSTRAINT FK_idevento 
FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Creación de tabla sala_taller */
CREATE TABLE sala_taller (id_sala int unsigned not null auto_increment PRIMARY KEY, 
id_actividad int unsigned not null, nombre varchar(20) not null, estado boolean not null,
ubicacion varchar(30) not null);

/* Creación de llave foranea id_actividad */
ALTER TABLE sala_taller 
ADD CONSTRAINT FK_idactividad 
FOREIGN KEY (id_actividad) REFERENCES actividades(id_actividad) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Creación de tabla usuarios_sala */
CREATE TABLE usuarios_sala (id_sala int unsigned not null, estado boolean not null,
curp_usuario varchar(18) not null);

/* Creación de llave foranea id_sala */
ALTER TABLE usuarios_sala 
ADD CONSTRAINT FK_idsala 
FOREIGN KEY (id_sala) REFERENCES sala_taller(id_sala) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Creación de llave foranea curp_usuario */
ALTER TABLE usuarios_sala 
ADD CONSTRAINT FK_curpusuario 
FOREIGN KEY (curp_usuario) REFERENCES usuarios(curp) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Creación de tabla usuarios_evento */
CREATE TABLE usuarios_evento (id_evento int unsigned not null, curp_usuario varchar(18) not null,
estado boolean, FOREIGN KEY (curp_usuario) REFERENCES usuarios(curp),
 FOREIGN KEY (id_evento) REFERENCES eventos(id_evento));

/* Creación de llave foranea curp_usuario */
 ALTER TABLE usuarios_evento 
ADD CONSTRAINT FK_curp 
FOREIGN KEY (curp_usuario) REFERENCES usuarios(curp) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Creación de llave foranea id_evento */
ALTER TABLE usuarios_evento 
ADD CONSTRAINT FK_idevent 
FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) 
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE eventos MODIFY estado varchar(1) not null;

insert into eventos(nombre, fecha_inicio, fecha_fin, ubicacion, costo, estado, descripcion)
	values('sss', '2222-02-02', '2222-02-02', 'sss', '200', FALSE, 'sss');