DROP DATABASE IF EXISTS ud2_test;
/* DROP DATABASE IF EXISTS ud2_reservas; */
/* DROP DATABASE IF EXISTS ud2_pizzeria; */

CREATE DATABASE ud2_test;
/* CREATE DATABASE ud2_reservas; */
/* CREATE DATABASE ud2_pizzeria;*/ 

/* -------------- UD2: SISTEMA DE TEST ONLINE ----------------------- */

USE ud2_test;

/* Pon aquí tus CREATE TABLE, INSERT INTO y restricciones necesarias.*/


CREATE TABLE IF NOT EXISTS usuarios(
id INT NOT NULL AUTO_INCREMENT,
login VARCHAR(10) NOT NULL UNIQUE,
contrasena VARCHAR (20) NOT NULL,
nombre VARCHAR (30) NOT NULL,
apellidos VARCHAR (40) NOT NULL,
email VARCHAR (40) NOT NULL UNIQUE,
rol VARCHAR(10) NOT NULL,
CONSTRAINT PK_usuario PRIMARY KEY(id)
);

INSERT INTO usuarios(login, contrasena, nombre, apellidos, email, rol) VALUES
('admin', '123456', 'Ana Maria', 'Dias Moreno', 'correo@gmail.com','admin'),
('jose1','abcdef', 'Jose Luis', 'Guerra Godoy','juse_guerra@gmail.com','user');

CREATE TABLE IF NOT EXISTS oportunidades(
id INT NOT NULL AUTO_INCREMENT,
nota DOUBLE,  /* nota media para respuestas elegidas  */
fecha DATE,
CONSTRAINT PK_Oportunidades PRIMARY KEY(id)
);

/* INSERT INTO oportunidades(nota, fecha) VALUES(6.8, '2021-11-16'); ------> para hacer la prueba */

CREATE TABLE IF NOT EXISTS user_oportunidad(
id_user INT,
id_oport INT,
num INT, /* numero de oportunidad de un usuario, maximo 3 */
CONSTRAINT FK_Id_Users FOREIGN KEY (id_user) REFERENCES usuarios(id),
CONSTRAINT FK_Id_Oport FOREIGN KEY(id_oport) REFERENCES oportunidades(id)
);

CREATE TABLE IF NOT EXISTS preguntas(
id INT NOT NULL,
texto_p VARCHAR(250) NOT NULL,
opcion VARCHAR(10) NOT NULL,
CONSTRAINT PK_Preg PRIMARY KEY (id)
);

INSERT INTO preguntas(id,texto_p, opcion) VALUES 
(1,'Método utilizado para acceder a la página (seleccione una):','una'),
(2,'Para incluir codigo PHP entre etiquetas HTML, se puede utilizar(seleccione una):', 'una'),
(3,'Si una vez creado un array $a, eliminamos algun elemento intermedio, 
podemos utilizar la funcion array_values haciendo array_values($a); para volver a tener los indices de $a consecutivos. ¿Verdadero o falso?','una'),
(4,'Para mostrar información en el navegador, podemos utilizar (Seleccione una o más de una):','multi'),
(5,'Los identificadores que se utilizan en PHP para constantes suelen ir en mayúsculas y al igual
que las variables deben ir precedidos por el signo $. ¿Verdadero o falso?','una'),
(6,'Si quieres mostrar una cadena de texto letra a letra, y no sabes si está vacía, 
¿qué tipo de bucle emplearías, while o do-while?','una'),
(7,'¿Puedes utilizar include o require para incluir el mismo encabezado HTML en varias páginas?','una'),
(8,'Para incluir un comentario en linea utilizan simbolo (selecciona una o mas de una):','multi'),
(9,'¿Las funciones pueden tener más de un argumanto?','una'),
(10,'¿Cuántos bloques "catch" se han de utilizar después de un bloque "try"?','una'); 


CREATE TABLE IF NOT EXISTS oport_preguntas(
id_oport INT NOT NULL,
id_pregunta INT NOT NULL,
id_user INT NOT NULL,
CONSTRAINT PK_oport_preguntas PRIMARY KEY (id_oport),
CONSTRAINT FK_Id_Oportun FOREIGN KEY (id_oport) REFERENCES oportunidades(id),
CONSTRAINT FK_Id_Pregunta FOREIGN KEY (id_pregunta) REFERENCES preguntas(id),
CONSTRAINT FK_Id_User FOREIGN KEY (id_user) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS respuestas(
id INT NOT NULL,
texto_res VARCHAR(100) NOT NULL,
id_pregunta INT NOT NULL,
correcto BOOLEAN NOT NULL,
valor DOUBLE NOT NULL,
CONSTRAINT PK_respuesta PRIMARY KEY (id),
CONSTRAINT FK_id_preg FOREIGN KEY (id_pregunta) REFERENCES preguntas(id)
);

INSERT INTO respuestas(id,texto_res, id_pregunta, correcto, valor) VALUES 
(1,"$_SERVER['ACCESS_METHOD']", 1, false, 0),
(2,"$_SERVER['REQUEST_METHOD']", 1, true, 1),
(3,"$_SERVER['REMOTE_ADDR']", 1, false, 0),
(4,"$_SERVER['REMOTE_METHOD']", 1, false, 0),
(5,"Solo los delimitadores < ? y ? >", 2, false, 0),
(6,"Solo los delimitadores < ? php y ? >", 2, false, 0),
(7,"Solo los delimitadores < ! -- y -- >", 2, false, 0),
(8,"Al menos los delimitadores < ? php y ? >", 2, true, 1),
(9,"Verdadero", 3, false, 0),
(10,"Falso", 3, true, 1),
(11,"print", 4, true, 0.5),
(12,"printf", 4, false, 0),
(13,"sprintf", 4, false, 0),
(14,"echo", 4, true, 0.5),
(15,"Verdadero", 5, false, 0),
(16,"Falso", 5, true, 1),
(17,"while", 6, true, 1),
(18,"do while", 6, false, 0),
(19,"Si", 7, true, 1),
(20,"No", 7, false, 0),
(21,"#un comentario", 8, true, 0.5),
(22,"//un comentario", 8, true, 0.5),
(23,"< ! -- un comentario -- >", 8, false, 0),
(24,"Si", 9, true, 1),
(25,"No", 9, false, 0),
(26,"Uno", 10, false, 0),
(27,"Uno o más", 10, true, 1);


CREATE TABLE IF NOT EXISTS oport_respuestas(
id_oport INT NOT NULL,
id_resp INT NOT NULL,
valor INT,  /*valor de respuesta elegida, incorrecta = 0, correctas dependen del tipo de pregunta  */
CONSTRAINT FK_id_oportunidad FOREIGN KEY (id_oport) REFERENCES oportunidades(id),
CONSTRAINT FK_id_resp FOREIGN KEY (id_resp) REFERENCES respuestas(id)
);





