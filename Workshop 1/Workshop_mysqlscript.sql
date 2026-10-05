CREATE table Users
(
	id int auto_increment primary key,
	user varchar (50),
	password varchar (50)
);

SELECT user`user`, password  from Users;

INSERT INTO Users (user, password)
VALUES 
(
	"Kevin",
	"12345"
);