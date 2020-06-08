CREATE DATABASE eventos;

USE eventos;

/* Creación de tabla usuarios */
CREATE TABLE usuarios ( id_usuario INT UNSIGNED NOT NULL auto_increment PRIMARY KEY, 
nombre VARCHAR(30) NOT NULL, apellidos VARCHAR(30) NOT NULL, 
 telefono VARCHAR(10) NOT NULL, correo VARCHAR(50) NOT NULL, rol_usuario VARCHAR(1) NOT NULL,
 contrasena VARCHAR(20) NOT NULL, no_control VARCHAR(8) NULL, carrera VARCHAR(40) NULL, rfc VARCHAR(15) NULL,
 ocupacion VARCHAR(30) NULL, departamento VARCHAR(30) NULL, direccion VARCHAR(30) NULL )ENGINE=INNODB;

 /* Creación de tabla eventos */
CREATE TABLE eventos ( id_evento INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,
nombre VARCHAR(30) NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL,
ubicacion VARCHAR(100), costo INT, estado VARCHAR(1) NOT NULL, 
 descripcion VARCHAR(200) NOT NULL )ENGINE=INNODB;

/* Creación de tabla actividades */
CREATE TABLE actividades (id_actividad INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,
nombre VARCHAR(30) NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL,
descripcion VARCHAR(200) NOT NULL, id_evento INT UNSIGNED NOT NULL)ENGINE=INNODB;

/* Creación de tabla sala_taller */
CREATE TABLE sala_taller (id_sala INT UNSIGNED NOT NULL auto_increment PRIMARY KEY, 
id_actividad INT UNSIGNED NOT NULL, nombre VARCHAR(20) NOT NULL, estado VARCHAR(1) NOT NULL,
ubicacion VARCHAR(100) NOT NULL);

/* Creación de tabla usuarios_sala */
CREATE TABLE usuarios_sala (id_sala INT UNSIGNED NOT NULL, id_usuario INT UNSIGNED NOT NULL);

/* Creación de tabla usuarios_evento */
CREATE TABLE usuarios_evento (id_evento INT UNSIGNED NOT NULL, id_usuario INT UNSIGNED NOT NULL);

/* Foreign Key id_evento on actividades */
ALTER TABLE actividades 
ADD CONSTRAINT FK_idevent 
FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Foreign Key id_actividad on sala_taller */
ALTER TABLE sala_taller 
ADD CONSTRAINT FK_idactividad 
FOREIGN KEY (id_actividad) REFERENCES actividades(id_actividad) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Foreign Key id_sala on usuarios_sala */
ALTER TABLE usuarios_sala 
ADD CONSTRAINT FK_idsala
FOREIGN KEY (id_sala) REFERENCES sala_taller(id_sala) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Foreign Key id_usuario on usuarios_sala */
ALTER TABLE usuarios_sala 
ADD CONSTRAINT FK_iduser
FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Foreign Key id_usuario on usuarios_evento */
ALTER TABLE usuarios_evento 
ADD CONSTRAINT FK_iduser2
FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) 
ON UPDATE CASCADE
ON DELETE CASCADE;

/* Foreign Key id_evento on usuarios_eventos */
ALTER TABLE usuarios_evento 
ADD CONSTRAINT FK_idevent2
FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) 
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE usuarios MODIFY contrasena text not null;
