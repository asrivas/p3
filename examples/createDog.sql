USE bendy;

DROP TABLE IF EXISTS people;

CREATE TABLE  people (id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(30), password VARCHAR(30));

DROP TABLE IF EXISTS dogs;
CREATE TABLE  dogs (chip INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(30), food VARCHAR(30), breed VARCHAR(30));

DROP TABLE IF EXISTS owns;

CREATE TABLE owns (id INT(5) NOT NULL REFERENCES people, chip INT(5) NOT NULL REFERENCES dogs);

INSERT INTO people (name, password)
VALUES ('Bob', 's1');
INSERT INTO people (name, password)
VALUES ('Alice', 's2');
INSERT INTO people (name, password)
VALUES ('Merida', 's3');
INSERT INTO people (name, password)
VALUES ('Yinon', 's4');

INSERT INTO dogs (name, food, breed)
VALUES('Linus', 'Kibble', 'Dachshund');
INSERT INTO dogs (name, food, breed)
VALUES('Mo', 'Anything','Dachshund');
INSERT INTO dogs (name, food, breed)
VALUES('Colby', 'Wet', 'Jack Russell');
INSERT INTO dogs (name, food, breed)
VALUES('Moscow', 'Kibble', 'Boston Terrier');

INSERT INTO owns (id, chip)
VALUES (1, 1);
INSERT INTO owns (id, chip)
VALUES (1, 2);
INSERT INTO owns (id, chip)
VALUES (2, 3);
INSERT INTO owns (id, chip)
VALUES (3, 3);
INSERT INTO owns (id, chip)
VALUES (3, 4);
INSERT INTO owns (id, chip)

-- CROSS JOINS
SELECT * FROM dogs CROSS JOIN people;
SELECT name FROM dogs, people;
SELECT people.name FROM dogs, people;
SELECT * FROM dogs CROSS JOIN people CROSS JOIN owns WHERE owns.id=people.id AND owns.chip=dogs.chip;

-- INNER JOIN
SELECT * FROM dogs INNER JOIN owns ON dogs.chip = owns.chip AND breed='Dachshund';
SELECT * FROM dogs INNER JOIN (owns INNER JOIN people ON people.id = owns.id) ON dogs.chip = owns.chip WHERE breed='Dachushund';
SELECT * FROM dogs INNER JOIN (owns INNER JOIN people ON people.id = owns.id) ON dogs.chip = owns.chip WHERE breed='Dachshund';
SELECT people.name FROM dogs INNER JOIN (owns INNER JOIN people ON people.id = owns.id) ON dogs.chip = owns.chip WHERE food='Wet';

-- ALIASING
SELECT o1.id FROM owns as o1;
SELECT d1.name, o1.id FROM (owns AS o1 INNER JOIN dogs As d1 ON o1.chip = d1.chip));
SELECT id FROM (SELECT o1.id FROM (owns as o1 INNER JOIN dogs as d1)) AS T1;

-- LEFT JOIN 
SELECT * FROM (dogs LEFT JOIN (owns INNER JOIN people ON owns.id = people.id) ON dogs.chip = owns.chip);

-- RIGHT JOIN
SELECT * FROM (owns RIGHT JOIN people ON owns.id = people.id);



