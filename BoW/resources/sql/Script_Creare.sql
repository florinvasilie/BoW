DROP TABLE utilizatori CASCADE CONSTRAINTS;

DROP TABLE admin CASCADE CONSTRAINTS;

DROP TABLE plante CASCADE CONSTRAINTS;

DROP TABLE aprecieri CASCADE CONSTRAINTS;

DROP TABLE mesaje CASCADE CONSTRAINTS;

DROP TABLE blacklist CASCADE CONSTRAINTS;

DROP INDEX utilizatori_index_email;
/
CREATE TABLE utilizatori(
	username VARCHAR2(30),
	passwd VARCHAR2(30),
	nume VARCHAR2(50),
	email VARCHAR2(40),
	data_nasterii DATE
);
CREATE TABLE admin(
	username VARCHAR2(30),
	passwd VARCHAR2(30)
);
CREATE TABLE plante(
	id_planta NUMBER(10) DEFAULT 0,
	categorie VARCHAR2(20),
	beneficii VARCHAR2(20),
	data_postarii DATE,
	username VARCHAR2(30),
	vizualizari NUMBER(10),
	denumire VARCHAR2(50),
	origine VARCHAR2(50),
	regim_dezv VARCHAR2(50),
	descriere CLOB,
	imagine CLOB
);

/
CREATE TABLE aprecieri(
	id_planta NUMBER(10),
	username VARCHAR2(30)
);
/
CREATE TABLE mesaje(
	nume VARCHAR2(50),
	email VARCHAR2(40),
	mesaj CLOB
);
/
CREATE TABLE blacklist(
	email VARCHAR2(40),
	nume VARCHAR2(50)
);
/
CREATE INDEX utilizatori_index_email ON
utilizatori(email);


/
COMMIT;