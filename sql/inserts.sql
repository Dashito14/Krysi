/*Países disponibles en los cuáles se podrá añadir aeropuertos dentro de nuestra web,
dentro de la web se podrán agregar nuevos países*/
INSERT INTO country (name, n_cities) VALUES
('Spain', 4),
('Austria', 1),
('Italy', 1),
('Arabe Emirates', 1),
('Serbia', 1),
('United Kingdom', 1),
('United States', 1),
('Czech Republic', 1),
('France', 1);



/*Se han añadido algunos valores por defecto, más adelante en la web se podrán
agregar nuevas ciudades con su aeropuerto correspondiente*/
INSERT INTO city (name, country_id) VALUES
('Valencia', 1),
('Madrid', 1),
('Castellon', 1),
('Vienna', 2),
('Rome', 3),
('Dubai', 4),
('Belgrade', 5),
('London', 6),
('New York', 7),
('Prague', 8),
('Malaga', 1),
('Paris', 9);



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
(9, 'LGA', 'Aeropuerto LaGuardia'),
(12, 'CDG' , 'Charles de Gaulle');   /*Este aeropuerto también es de Nueva York (Aeropuerto LaGuardia)*/


/*Valores agregados para la tabla aerolínea, las aerolíneas vendrán escritas por defecto,
no se podrán agregar desde la página*/
INSERT INTO airline (name, airline_acr) VALUES
('Aerolineas Argentinas', 'AR'),
('Iberia', 'IB');


/*Agregar todos los pilotos que podrán iniciar sesión en la web, no se podrán añadir más pilotos desde la
aplicación*/
INSERT INTO users (user_name, user_pass) VALUES
('PilotoIberia', '$2y$10$xAXdfbyAdQIYboo1AmHc2.PIq03GSN0eFStd1yh/ABrR42jLIgXWG'); /*Pass: iberia*/

/*Agregar todos los pilotos que podrán iniciar sesión en la web, no se podrán añadir más pilotos desde la
aplicación*/
INSERT INTO pilot (user_id, belongs_airline) VALUES
(1, 'IB'); /*Pass: iberia*/
