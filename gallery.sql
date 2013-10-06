USE cs105_asrivas;

DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users (
	id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	name VARCHAR(30), 
	password VARCHAR(30),
	fact1 VARCHAR(30),
	fact2 VARCHAR(30),
	fact3 VARCHAR(30)
);

DROP TABLE IF EXISTS albums CASCADE;

CREATE TABLE albums (
	album_id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id INT(5), 
	album_name VARCHAR(30)
);

DROP TABLE IF EXISTS photos CASCADE;

CREATE TABLE photos (
	photo_id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	album_id INT(5),
	user_id INT(5),
	title VARCHAR(30),
	file VARCHAR(30)
);


INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('Anu', 'password1', 'fact1', 'fact2', 'fact3');
INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('Jason', 'password1', 'fact1', 'fact2', 'fact3');
INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('User3', 'password1', 'fact1', 'fact2', 'fact3');
INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('User4', 'password1', 'fact1', 'fact2', 'fact3');

INSERT INTO albums (user_id, album_name)
VALUES (1, 'Album1');
INSERT INTO albums (user_id, album_name)
VALUES (2, 'Jasons Album');
INSERT INTO albums (user_id, album_name)
VALUES (3, 'Album3');
INSERT INTO albums (user_id, album_name)
VALUES (4, 'Album4');
INSERT INTO albums (user_id, album_name)
VALUES (4, 'Album5');

INSERT INTO photos(album_id, user_id, title, file)
VALUES(1, 1, 'San Francisco', 'sf1.jpg');
INSERT INTO photos(album_id, user_id, title, file)
VALUES(1, 1, 'San Francisco', 'sf2.jpg');