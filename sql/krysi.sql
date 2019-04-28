SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*---------------------------------------------------------------------------*/
/*-----------------------------TABLA AEROLÍNEA-------------------------------*/
/*---------------------------------------------------------------------------*/


/*Creación de la tabla*/
CREATE TABLE airline (
  name varchar(64) NOT NULL,
  airline_acr char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*Adición de la clave primaria "airline_acr"*/
ALTER TABLE airline
  ADD PRIMARY KEY (airline_acr);

  

/*---------------------------------------------------------------------------*/
/*--------------------------------TABLA PAÍS---------------------------------*/
/*---------------------------------------------------------------------------*/


/*Creación de la tabla*/  
CREATE TABLE country (
  name char(64) NOT NULL,
  country_id int(32) NOT NULL,
  n_cities int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*Se añade la clave primaria "country_id"*/
ALTER TABLE country
  ADD PRIMARY KEY (country_id);
  

  
/*Se añade el valor auto_increment a la variable country_id para que cree un nuevo id
sin que el usuario tenga que agregarlo*/
ALTER TABLE country
  MODIFY country_id int(32) NOT NULL AUTO_INCREMENT;


/*---------------------------------------------------------------------------*/
/*-------------------------------TABLA CIUDAD--------------------------------*/
/*---------------------------------------------------------------------------*/


/*Creación de la tabla*/
CREATE TABLE city (
  name char(64) NOT NULL,
  city_id int(32) NOT NULL,
  country_id int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*Se añade la clave primaria "city_id" y la clave foránea "country_id"*/
ALTER TABLE city
  ADD PRIMARY KEY (city_id),
  ADD KEY country_id (country_id);
  

  
 /*Adición de la clave foránea "country_id" que referencia a la clave primaria de la tabla 
"country"*/
ALTER TABLE city
  ADD CONSTRAINT city_ibfk_1 FOREIGN KEY (country_id) REFERENCES country (country_id) ON DELETE CASCADE;



/*Se añade el valor auto_increment a la variable city_id para que cree un nuevo id
sin que el usuario tenga que agregarlo*/
ALTER TABLE city
  MODIFY city_id int(32) NOT NULL AUTO_INCREMENT;
  
  
  
/*---------------------------------------------------------------------------*/
/*----------------------------TABLA AEROPUERTO-------------------------------*/
/*---------------------------------------------------------------------------*/

/*Esta tabla esta creada ya que en algunas ciudades hay más de un aeropuerto. Almacenaremos
en ella el acrónimo del Aeropuerto y el identificador de la ciudad*/


/*Creación de la tabla*/
CREATE TABLE airport (
  city_id int(32) NOT NULL,
  acronym char(3) NOT NULL,
  name varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*Se añaden los índices a la tabla, clave primaria "acronym", clave foránea "city_id"*/
ALTER TABLE airport
  ADD PRIMARY KEY (acronym),
  ADD KEY city_id (city_id);
  
  
/*Adición de la clave foránea "city_id" que referencia a la clave primaria de la tabla 
"city"*/
ALTER TABLE airport
  ADD CONSTRAINT airport_ibfk_1 FOREIGN KEY (city_id) REFERENCES city (city_id) ON DELETE CASCADE;
  


/*---------------------------------------------------------------------------*/
/*-------------------------------TABLA USUARIO-------------------------------*/
/*---------------------------------------------------------------------------*/


/*Creación de la tabla*/
CREATE TABLE users (
	user_id int(32) NOT NULL,
	user_name varchar(32) NOT NULL,
	user_pass varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*Se añade la clave primaria "user_id"*/
ALTER TABLE users
	ADD PRIMARY KEY (user_id);


/*Valor auto_increment a "user_id"*/
ALTER TABLE users
  MODIFY user_id int(32) NOT NULL AUTO_INCREMENT;

  
  
/*---------------------------------------------------------------------------*/
/*------------------------------TABLA PILOTO---------------------------------*/
/*---------------------------------------------------------------------------*/


/*Creación de la tabla*/
CREATE TABLE pilot (
	user_id int(32) NOT NULL,
	belongs_airline char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*Adición índice para la clave foránea de "user_id" y "belongs_airline*/
ALTER TABLE pilot
	ADD KEY userid (user_id),
	ADD KEY belongs (belongs_airline);
	

/*Creación de la relación de la clave foránea, "user_id" que referencia "user_id" de 
la tabla "users" y "belongs_airline" que referencia a "airline_acr" de la tabla 
"airline"*/
ALTER TABLE pilot
	ADD CONSTRAINT pilot_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (user_id),
	ADD CONSTRAINT pilot_ibfk_2 FOREIGN KEY (belongs_airline) REFERENCES airline (airline_acr);
	
	
	
/*---------------------------------------------------------------------------*/
/*--------------------------TABLA VIAJES DISPONIBLES-------------------------*/
/*---------------------------------------------------------------------------*/


/*Tabla con los viajes disponibles ya que no todas las conexiones entre ciudades serán posibles
de realizar, para meter datos en esta tabla el usuario deberá de ser un piloto*/


/*Creación de la tabla*/
CREATE TABLE available_trip (
	travel_id int(32) NOT NULL,
	price double(10, 2) NOT NULL,	
	acr_ori char(3) NOT NULL,
	acr_dst char(3) NOT NULL,
	sits int(3) NOT NULL,
	airline_acr char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*Los valores "acr_ori", "acr_dst" y "airline" son claves foráneas. Ponemos "travel_id" como clave primaria*/
ALTER TABLE available_trip
  ADD PRIMARY KEY (travel_id),
  ADD KEY origin (acr_ori),
  ADD KEY destiny (acr_dst),
  ADD KEY airline (airline_acr);
  
  
/*Se agregan las referencias de las claves foráneas, "acr_ori" y "acr_dst" que referencian 
al valor "acronym" de la tabla "aeropuerto", el campo "airline_acr" que referencia al campo 
con el mismo nombre del a tabla "airline"*/
ALTER TABLE available_trip
  ADD CONSTRAINT trip_ibfk_1 FOREIGN KEY (acr_ori) REFERENCES airport (acronym) ON DELETE CASCADE,
  ADD CONSTRAINT trip_ibfk_2 FOREIGN KEY (acr_dst) REFERENCES airport (acronym) ON DELETE CASCADE,
  ADD CONSTRAINT trip_ibfk_3 FOREIGN KEY (airline_acr) REFERENCES airline (airline_acr);  


/*Agregamos el valor AUTO_INCREMENT al "id" de los viajes disponibles*/
ALTER TABLE available_trip
  MODIFY travel_id int(32) NOT NULL AUTO_INCREMENT;
  
  
  
/*---------------------------------------------------------------------------*/
/*--------------------------------TABLA BILLETE------------------------------*/
/*---------------------------------------------------------------------------*/


/*Esta tabla esta creada porque entre "users" y "available_trip" tenemos uan relación 
N a N. Por tanto debemos almacenar en una tabla aparte los datos del ava_trip_id y user_id*/


/*Creación de la tabla*/
CREATE TABLE ticket (
  user_id int(32) NOT NULL,
  ava_trip_id int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*Se añaden las claves foráneas available_trip y user_id*/
ALTER TABLE ticket
  ADD KEY available_trip (ava_trip_id),
  ADD KEY userid (user_id);


/*El campo "user_id" que referencia al del mismo nombre de la tabla "users" y "ava_trip_id"
que referencia a "travel_id" de "available_trip"*/
ALTER TABLE ticket
	ADD CONSTRAINT ticket_ibfk_1 FOREIGN KEY (ava_trip_id) REFERENCES available_trip (travel_id) ON DELETE CASCADE,
	ADD CONSTRAINT ticket_ibfk_2 FOREIGN KEY (user_id) REFERENCES users (user_id);

/*Se cierra la transacción*/  
COMMIT;

