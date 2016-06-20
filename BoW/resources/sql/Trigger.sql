DROP SEQUENCE plante_seq;
DROP SEQUENCE gradi_seq;

CREATE SEQUENCE plante_seq START WITH 1 INCREMENT BY 1 NOMAXVALUE;
CREATE SEQUENCE gradi_seq START WITH 1 INCREMENT BY 1 NOMAXVALUE; 
/
DROP TRIGGER plante_increment;
DROP TRIGGER gradi_increment;
/
CREATE TRIGGER plante_increment
BEFORE INSERT ON plante
FOR EACH ROW
BEGIN
 	SELECT plante_seq.nextval INTO :new.id_planta FROM DUAL;
END;
/
CREATE TRIGGER gradi_increment
BEFORE INSERT ON gradini
FOR EACH ROW
BEGIN
 	SELECT gradi_seq.nextval INTO :new.id_gradina FROM DUAL;
END;
/