CREATE table Users
(
	id int auto_increment primary key,
	user varchar (50),
	password varchar (50),
	provinceID int
);


CREATE table Province 
(
	id int auto_increment primary key,
	province varchar (50)
);

ALTER TABLE Users
ADD CONSTRAINT fk_users_provinces
FOREIGN KEY (provinceID)
REFERENCES Province(id);

INSERT into Province (province) VALUES 
("San José"),
("Alajuela"),
("Heredia"),
("Cartago"),
("Puntarenas"),
("Guanacaste"),
("Limon");

INSERT into Users (user, password, provinceID) values
("Kevin", "12345", 1),
("Patroclo", "patro", 2),
("Agneta", "56789", 3)
;

SELECT * from Users;

select * from Province;