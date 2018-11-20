CREATE TABLE consejo (
	idConsejo int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	tema varchar(100),
	categoria varchar(100),
	idUsuario int,
	CONSTRAINT consejo_pk PRIMARY KEY (idConsejo),
	CONSTRAINT consejo_fk1 FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)

)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;
CREATE TABLE foro(
	id int UNSIGNED not null AUTO_INCREMENT,
	tema varchar(100),
	discusion varchar(250),
	categoria varchar(100),
	idUsuario int,
	CONSTRAINT foro_pk PRIMARY KEY (id),
	CONSTRAINT foro_fk1 FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;
CREATE TABLE usuario(
	idUsuario int UNSIGNED not null AUTO_INCREMENT,
	nombre varchar(100),
	apPaterno varchar(100),
	apMaterno varchar(100),
	ci varchar(50),
	telefono varchar(50),
	celular varchar(20),
	direccion varchar(50),
	ocupacion varchar(100),
	fecha_nac date,
	email varchar(100),
	password varchar(100),
	idConsejo int UNSIGNED not null,
	id int UNSIGNED not null,
	CONSTRAINT usuario_pk PRIMARY KEY (idUsuario),
	CONSTRAINT usuario_fk1 FOREIGN KEY (idConsejo) REFERENCES consejo(idConsejo),
	CONSTRAINT usuario_fk2 FOREIGN KEY (id) REFERENCES foro(id)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;
CREATE TABLE recurso(
	nombre varchar(100) not null,
	idUsuario int UNSIGNED not null,
	descripcion varchar(250),
	tipo varchar(100),
	CONSTRAINT recurso_pk PRIMARY KEY (nombre,idUsuario),
	CONSTRAINT recurso_fk FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;
CREATE TABLE tema(
	idTema int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	tema varchar(100),
	idUsuario int UNSIGNED not null,
	CONSTRAINT tema_pk PRIMARY KEY (idTema),
	CONSTRAINT tema_fk FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE problematica(
	idProblematica int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	idTema int UNSIGNED not null,
	CONSTRAINT problematica_pk PRIMARY KEY (idProblematica),
	CONSTRAINT problematica_fk FOREIGN KEY (idTema) REFERENCES tema(idTema)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE causa(
	idCausa int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	idProblematica int UNSIGNED not null,
	CONSTRAINT causa_pk PRIMARY KEY (idCausa),
	CONSTRAINT causa_fk FOREIGN KEY (idProblematica) REFERENCES problematica(idProblematica)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE responsable(
	idResponsable int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	CONSTRAINT responsable_pk PRIMARY KEY (idResponsable)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE crea(
	idCausa int UNSIGNED not null,
	idResponsable int UNSIGNED not null,
	CONSTRAINT crea_pk PRIMARY KEY (idCausa,idResponsable),
	CONSTRAINT crea_fk1 FOREIGN KEY (idCausa) REFERENCES causa(idCausa),
	CONSTRAINT crea_fk2 FOREIGN KEY (idResponsable) REFERENCES responsable(idResponsable)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;
CREATE TABLE consecuencia(
	idConsecuencia int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	idProblematica int UNSIGNED not null,
	CONSTRAINT consecuencia_pk PRIMARY KEY (idConsecuencia),
	CONSTRAINT consejo_fk FOREIGN KEY (idProblematica) REFERENCES problematica(idProblematica)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE perjudicado(
	idPerjudicado int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	idConsecuencia int UNSIGNED not null,
	idRealidad int UNSIGNED not null,
	CONSTRAINT perjudicado_pk PRIMARY KEY (idPerjudicado),
	CONSTRAINT perjudicado_fk1 FOREIGN KEY (idConsecuencia) REFERENCES consecuencia(idConsecuencia),
	CONSTRAINT perjudicado_fk2 FOREIGN KEY (idRealidad) REFERENCES realidadvividencial(idRealidad)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE realidadvividencial(
	idRealidad int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	CONSTRAINT realidadvividencial_pk PRIMARY KEY(idRealidad)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;
CREATE TABLE relacionsocial(
	idRel int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	idRealidad int UNSIGNED not null,
	CONSTRAINT relacionsocial_pk PRIMARY KEY (idRel),
	CONSTRAINT relacionsocial_fk FOREIGN KEY (idRealidad) REFERENCES realidadvividencial(idRealidad)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE temaGenerador(
	idTemaG int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	inv_tematica varchar(250),
	cont_progrmaticos varchar(250),
	idResponsable int UNSIGNED not null,
	idRel int UNSIGNED not null,
	CONSTRAINT temaGenerador_pk PRIMARY KEY (idTemaG),
	CONSTRAINT temaGenerador_fk1 FOREIGN KEY (idResponsable) REFERENCES responsable(idResponsable),
	CONSTRAINT temaGenerador_fk2 FOREIGN KEY (idRel) REFERENCES relacionsocial(idRel)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;
CREATE TABLE tecnica_mediadora(
	idTecMediadora int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	cod_contenidos varchar(300),
	decod_contenidos varchar(300),
	idTemaG int UNSIGNED not null,
	CONSTRAINT tecnica_mediadora_pk PRIMARY KEY (idTecMediadora),
	CONSTRAINT tecnica_mediadora_fk FOREIGN KEY (idTemaG) REFERENCES temaGenerador(idTemaG)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE consientizacion_sujeto(
	idCon int UNSIGNED not null AUTO_INCREMENT,
	descripcion varchar(250),
	valor int,
	CONSTRAINT consientizacion_sujeto_pk PRIMARY KEY (idCon)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci;

CREATE TABLE crea2(
	idTecMediadora int UNSIGNED not null,
	idCon int UNSIGNED not null,
	CONSTRAINT crea2_pk PRIMARY KEY (idTecMediadora,idCon),
	CONSTRAINT crea2_fk1 FOREIGN KEY (idTecMediadora) REFERENCES tecnica_mediadora(idTecMediadora),
	CONSTRAINT crea2_fk2 FOREIGN KEY (idCon) REFERENCES consientizacion_sujeto(idCon)
)ENGINE MyISAM charset utf8 COLLATE utf8_spanish_ci


/*-----------------------------REQUERIMIENTOS---------------*/
/*INSERTAR USUARIOS*/
INSERT INTO usuario VALUES(null,'Eddy','Ramos','Quenta','38657066','2216703','70667445','Av. 6 de Marzo Z.12 de Octubre','Heladero','eddy@gmail.com','123',1,1);
/*Elegir Temas*/
SELECT *
FROM tema as t,usuario as u
where t.idUsuario = u.idUsuario
/*COMPARTIR RECURSOS*/
INSERT INTO recurso VALUES('cuchillos',1,'Imagen donde se logra apreciar armas punso cortantes ','imagen')
