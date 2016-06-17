DROP SEQUENCE plante_seq;
DROP SEQUENCE img_seq;

CREATE SEQUENCE plante_seq START WITH 1 INCREMENT BY 1 NOMAXVALUE;
CREATE SEQUENCE img_seq START WITH 1 INCREMENT BY 1 NOMAXVALUE;  
/
DROP TRIGGER plante_increment;
DROP TRIGGER img_increment;
/
CREATE TRIGGER plante_increment
BEFORE INSERT ON plante
FOR EACH ROW
BEGIN
 	SELECT plante_seq.nextval INTO :new.id_planta FROM DUAL;
END;
/
CREATE TRIGGER img_increment
BEFORE INSERT ON imagini
FOR EACH ROW
BEGIN
 	SELECT img_seq.nextval INTO :new.id_plant FROM DUAL;
END;
/