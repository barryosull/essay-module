CREATE TABLE modules
(
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(255),
	organisation_id int,
	is_active int DEFAULT 0,
	hex_branding varchar(7)
);