CREATE TABLE questions
(
	id int PRIMARY KEY AUTO_INCREMENT,
	module_id int,
	unique_key varchar(255),
	text TEXT,
	is_active int DEFAULT 1,
	q_order int
);