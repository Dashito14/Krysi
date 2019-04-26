INSERT INTO country (name, n_cities) VALUES
('Spain', 6), /*id= 1*/
('Austria', 1), /*id= 2*/
('Italy', 1), /*id= 3*/
('Arabe Emirates', 1), /*id= 4*/
('Serbia', 1), /*id= 5*/
('United Kingdom', 1), /*id= 6*/
('United States', 1), /*id= 7*/
('Czech Republic', 1), /*id= 8*/
('France', 1), /*id= 9*/
('Portugal', 0), /*id= 10*/
('Rusia', 1), /*id= 11*/
('Bielorrusia', 1), /*id= 12*/
('Egypt', 1), /*id= 13*/
('Cuba', 1); /*id= 14*/
-- Paises disponibles en los cuáles se podrá añadir aeropuertos dentro de nuestra web,
-- dentro de la web se podrán agregar nuevos países


/*Se han añadido algunos valores por defecto, más adelante en la web se podrán
agregar nuevas ciudades con su aeropuerto correspondiente*/
INSERT INTO city (name, country_id) VALUES
('Valencia', 1), /*id= 1*/
('Madrid', 1), /*id= 2*/
('Castellon', 1), /*id= 3*/
('Vienna', 2), /*id= 4*/
('Rome', 3), /*id= 5*/
('Dubai', 4), /*id= 6*/
('Belgrade', 5), /*id= 7*/
('London', 6), /*id= 8*/
('New York', 7), /*id= 9*/
('Prague', 8), /*id= 10*/
('Malaga', 1), /*id= 11*/
('Paris', 9), /*id= 12*/
('Bilbao', 1), /*id= 13*/
('Saint Petersburg', 11), /*id= 14*/
('A Coruña', 1), /*id= 15*/
('Minsk', 12), /*id= 16*/
('Cairo', 13), /*id= 17*/
('Guantanamo', 14); /*id= 18*/



/*Valores añadidos, se han añadido algunos por defecto para que la web
funcione desde su creación, más adelante se podrán añadir aeropuertos
desde la propia web*/
INSERT INTO airport (city_id, acronym, name) VALUES
(1, 'VLC', 'Aeropuerto de Manises'),
(2, 'MAD', 'Barajas Adolfo Suárez'),
(3, 'CDT', 'Costa Azahar'),
(4, 'VIE', 'Aeropuerto de Schwechat'),
(5, 'FCO', 'Fiumicino'),
(6, 'DXB', 'Aeropuerto Internacional de Dubái'),
(7, 'BEG', 'Nikola Tesla'),
(8, 'LGW', 'Aeropuerto Gatwick'),
(9, 'JFK', 'John F. Kennedy'),   /*Este aeropuerto es de Nueva York (Aeropuerto J. F. Kennedy)*/
(10, 'PRG', 'Václav Havel'),
(11, 'AGP', 'Costa del Sol'),
(9, 'LGA', 'Aeropuerto LaGuardia'),   /*Este aeropuerto también es de Nueva York (Aeropuerto LaGuardia)*/
(12, 'CDG' , 'Charles de Gaulle'),
(13, 'BIO', 'Aeropuerto de Bilbao'),
(14, 'LED', 'Púlkovo'),
(15, 'LCG', 'Aeropuerto de A Coruña'),
(16, 'MSQ', 'Aeropuerto Internacional de Minsk'),
(17, 'CAI', 'Aeropuerto Internacional de El Cairo'),
(18, 'GAO', 'Mariana Grajales');  


/*Valores agregados para la tabla aerolínea, las aerolíneas vendrán escritas por defecto,
no se podrán agregar desde la página*/
INSERT INTO airline (name, airline_acr) VALUES
('Aerolineas Argentinas', 'AR'),
('Fly Emirates', 'FE'),
('Spanair', 'SP'),
('Lufthansa', 'LU'),
('Tunisair', 'TU'),
('Air Europa', 'AE'),
('Iberia', 'IB');


/*Agregar todos los pilotos que podrán iniciar sesión en la web, no se podrán añadir más pilotos desde la
aplicación*/
INSERT INTO users (user_name, user_pass) VALUES
('PilotoArgentina', '$2y$10$UwDj/r3jfmLj3yg2MOWMHOecg/WVQdgL1r/dEROjnkgsTkmNDLiF.'), /*Pass: argentina*/ /*id= 1*/
('PilotoIberia', '$2y$10$xAXdfbyAdQIYboo1AmHc2.PIq03GSN0eFStd1yh/ABrR42jLIgXWG'), /*Pass: iberia*/ /*id= 2*/
('PilotoLufthansa', '$2y$10$0aFyHUyn5sB2FIe/m3EP..kmZlc63uRzA57dt6r/B6EkgpRlKTWy.'), /*Pass: lufthansa*/ /*id= 3*/
('PilotoSpanair', '$2y$10$x39zkj9bxhaXQ49Ncg7f7eR/s0JI2SWvBWOYO7CrFyv2JVgRWV19m'), /*Pass: spanair*/ /*id= 4*/
('PilotoTunisair', '$2y$10$Gz783WALqVdlFldnTITuaevrhuMWqOJGwM5/gnulCIoNPozY6CeG2'), /*Pass: tunisair*/ /*id= 5*/
('PilotoEuropa', '$2y$10$TxM/5nLxi73Ri1Q0bybn8OOgxhHpUski5wFL1ivdxYU/3a.Ov1j..'), /*Pass: europa*/ /*id= 6*/
('PilotoEmirates', '$2y$10$O/LgLEYiKOJPiTllLz58IueJpJAyWW9iU5vYs47q1DZLApw5PUI3W'), /*Pass: emirates*/ /*id= 7*/
('Luctorm', '$2y$10$37IoEaeiqzczGwh.yJEdU.UMBm3piGimKqoHmrzjCXpN0MzI4xW92'), /*Pass: luctorm*/ /*id= 8*/
('Jorgex', '$2y$10$ExnS1iD0eoaT425NprT5VeAuFiPgxZP3yEjjmOz6D1pkobHlk8VEm'), /*Pass: jorgex*/ /*id= 9*/
('Dashito', '$2y$10$oFNFpSp3wu5mv/cNBd.y5.m7g2Ij1gfIJiWxneIonIVFSaH4E0ScK'), /*Pass: dashito*/ /*id= 10*/
('Zebra', '$2y$10$0a22WP3DbPzevbQqsD0rQuqur8C.i1XAsMmtz6bhLGzXr0u2mwY.m'), /*Pass: zebra*/ /*id= 11*/
('Tirex', '$2y$10$9KG9OoDqd/hv94qDGiAZZOGRId39WogWHP3Dmg7/nFTSk8atx0PzK'); /*Pass: tirex*/ /*id= 12*/

/*Agregar todos los pilotos que podrán iniciar sesión en la web, no se podrán añadir más pilotos desde la
aplicación*/
INSERT INTO pilot (user_id, belongs_airline) VALUES
(1, 'AR'),
(2, 'IB'),
(3, 'LU'),
(4, 'SP'),
(5, 'TU'),
(6, 'AE'),
(7, 'FE');

/*Todos los viajes por defecto están creados para que funcione la web correctamente desde el principio, desde
la misma web se pueden crear nuevos*/
INSERT INTO available_trip (price, acr_ori, acr_dst, sits, airline_acr) VALUES
(34.99, 'VLC', 'BIO', 120, 'IB'), /*De Valencia a Bilbao*//*id= 1*/
(173.89, 'MAD', 'LED', 250, 'AE'), /*De Madrid a San Petersburgo*//*id= 2*/
(453.05, 'AGP', 'JFK', 275, 'LU'), /*De Málaga a Nueva York*//*id= 3*/
(9.99, 'VLC', 'CDT', 30, 'SP'), /*De Valencia a Castellón*//*id= 4*/
(249.00, 'LCG', 'MSQ', 210, 'LU'), /*De A Coruña a Minsk*//*id= 5*/
(105.05, 'CDG', 'CAI', 125, 'TU'), /*De Paris a El Cairo*//*id= 6*/
(320.45, 'MAD', 'GAO', 230, 'AR'), /*De Madrid a Guantanamo*//*id= 7*/
(225.00, 'CDT', 'DXB', 20, 'FE'), /*De Castellon a Dubai*//*id= 8*/
(75.88, 'VLC', 'LGW', 100, 'IB'), /*De Valencia a Londres*//*id= 9*/
(112.36, 'MAD', 'VIE', 108, 'LU'), /*De Madrid a Viena*//*id= 10*/
(210.09, 'MSQ', 'BEG', 120, 'FE'); /*De Minsk a Belgrado*//*id= 11*/

/*Agrego viajes comprados por defecto para que el ránking y el perfil de los usuarios funcione bien desde la inicialización
de la base de datos*/
INSERT INTO ticket(user_id, ava_trip_id) VALUES
(10, 8), /*Dashito compra "Castellon a Dubai"*/
(8, 2), /*Luctorm compra "Madrid a San Petersburgo"*/
(8, 6),
(9, 5), /*Jorgex compra de "A Coruña a Minsk"*/
(9, 1),
(10, 2),
(12, 3),
(12, 9),
(10, 6),
(8, 8),
(11, 4),
(10, 7),
(10, 11),
(8, 7),
(8, 10),
(9, 8),
(11, 9);
