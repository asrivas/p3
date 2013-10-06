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
	album_name VARCHAR(30)
);

DROP TABLE IF EXISTS user_albums CASCADE;

CREATE TABLE user_albums (
	id INT(5) NOT NULL REFERENCES users, 
	album_id INT(5) NOT NULL REFERENCES albums
);

DROP TABLE IF EXISTS photos CASCADE;

CREATE TABLE photos (
	photo_id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(30),
	file VARCHAR(30)
);

DROP TABLE IF EXISTS album_photos CASCADE;

CREATE TABLE album_photos (
	album_id INT(5) NOT NULL REFERENCES albums, 
	photo_id INT(5) NOT NULL REFERENCES photos
);

INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('Anu', 'password1', 'fact1', 'fact2', 'fact3');
INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('Jason', 'password1', 'fact1', 'fact2', 'fact3');
INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('User3', 'password1', 'fact1', 'fact2', 'fact3');
INSERT INTO users (name, password, fact1, fact2, fact3)
VALUES ('User4', 'password1', 'fact1', 'fact2', 'fact3');

INSERT INTO albums (album_name)
VALUES ('Album1');
INSERT INTO albums (album_name)
VALUES ('Jasons Album');
INSERT INTO albums (album_name)
VALUES ('Album3');
INSERT INTO albums (album_name)
VALUES ('Album4');

INSERT INTO user_albums (id, album_id)
VALUES (1, 1);
INSERT INTO user_albums (id, album_id)
VALUES (2, 2);
INSERT INTO user_albums (id, album_id)
VALUES (3, 3);
INSERT INTO user_albums (id, album_id)
VALUES (4, 4);