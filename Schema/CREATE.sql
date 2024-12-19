-- Crea schema
CREATE DATABASE IF NOT EXISTS db_biblioteca_series;

-- Activa schema
USE db_biblioteca_series;

-- Crea Plataformas
CREATE TABLE IF NOT EXISTS platforms (
  id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL
);

-- Crea Series
CREATE TABLE IF NOT EXISTS series (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	platformid INT,
	FOREIGN KEY (platformid) REFERENCES platforms(id) ON DELETE CASCADE ON UPDATE SET DEFAULT
);

-- Crear Actores
CREATE TABLE IF NOT EXISTS actors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  birthdate DATE NOT NULL,
  nationality VARCHAR(255) NOT NULL
);

-- Crear Directores
CREATE TABLE IF NOT EXISTS directors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  birthdate DATE NOT NULL,
  nationality VARCHAR(255) NOT NULL
);

-- Crear Directores_Series
CREATE TABLE IF NOT EXISTS series_directors (
  iddirector INT,
  idserie INT,
  PRIMARY KEY (iddirector, idserie),
  FOREIGN KEY (iddirector) REFERENCES directors(id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  FOREIGN KEY (idserie) REFERENCES series(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Crear Actores_Series
CREATE TABLE IF NOT EXISTS series_actors (
  idactor INT,
  idserie INT,
  PRIMARY KEY (idactor, idserie),
  FOREIGN KEY (idactor) REFERENCES actors(id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  FOREIGN KEY (idserie) REFERENCES series(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Crea Idiomas
CREATE TABLE IF NOT EXISTS languages (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	isocode VARCHAR(10) NOT NULL UNIQUE
);

-- Crea Idiomas_Series
CREATE TABLE IF NOT EXISTS languages_series (
	idlanguage INT,
	idserie INT,
  languagestype ENUM('audio', 'subtitle'),
	PRIMARY KEY (idlanguage, idserie, languagestype),
	FOREIGN KEY (idlanguage) REFERENCES languages(id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idserie) REFERENCES series(id) ON DELETE CASCADE ON UPDATE CASCADE
);
