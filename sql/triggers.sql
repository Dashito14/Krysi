CREATE TRIGGER rst_sits 
AFTER INSERT ON ticket
FOR EACH ROW
BEGIN

IF ticket(ava_trip_id) = available_trip (travel_id) THEN
			UPDATE available_trip SET sits = sits - 1;
ENDIF;
END;



CREATE TRIGGER sum_cities 
AFTER INSERT ON city
FOR EACH ROW
BEGIN

IF city(country_id) = country(country_id) THEN
			UPDATE country SET num_cities = num_cities + 1;
ENDIF;
END;