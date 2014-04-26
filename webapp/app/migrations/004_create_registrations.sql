CREATE TABLE registrations
(
	id int PRIMARY KEY AUTO_INCREMENT,
	module_id int,
	external_id int,
	submitted int,
	mark int,
	passed int,
	time_spent int DEFAULT 0
);