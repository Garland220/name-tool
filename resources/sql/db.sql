CREATE TABLE names (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contributor VARCHAR(40) NOT NULL DEFAULT 'default',
	contributor_id id NOT NULL DEFAULT 0,
	contributed TIMESTAMP NOT NULL DEFAULT NOW(),
	name VARCHAR(255) NOT NULL DEFAULT '',
	description TEXT NOT NULL DEFAULT '',
	race VARCHAR(255) NOT NULL DEFAULT '',
	last_name BOOLEAN NOT NULL DEFAULT FALSE,
	female BOOLEAN NOT NULL DEFAULT FALSE,
	guide VARCHAR(255) NOT NULL DEFAULT '',
	disabled BOOLEAN NOT NULL DEFAULT FALSE,
	PRIMARY KEY (id),
	UNIQUE KEY (race, female, name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE spells (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contributor VARCHAR(40) NOT NULL DEFAULT 'default',
	contributed TIMESTAMP NOT NULL DEFAULT NOW(),
	name VARCHAR(255) NOT NULL DEFAULT '',
	description TEXT NOT NULL DEFAULT '',
	school VARCHAR(512) NOT NULL DEFAULT '',
	cast_time VARCHAR(255) NOT NULL DEFAULT '',
	components VARCHAR(255) NOT NULL DEFAULT '',
	range VARCHAR(255) NOT NULL DEFAULT '',
	duration VARCHAR(255) NOT NULL DEFAULT '',
	saving_throw VARCHAR(255) NOT NULL DEFAULT '',
	spell_resist BOOLEAN NOT NULL DEFAULT FALSE,
	disabled BOOLEAN NOT NULL DEFAULT FALSE
);


CREATE TABLE items (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contributor VARCHAR(40) NOT NULL DEFAULT 'default',
	contributed TIMESTAMP NOT NULL DEFAULT NOW(),
	name VARCHAR(255) NOT NULL DEFAULT '',
	description TEXT NOT NULL DEFAULT '',
	disabled BOOLEAN NOT NULL DEFAULT FALSE
);