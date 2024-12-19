-- Crea schema
CREATE DATABASE IF NOT EXISTS db_biblioteca_series;

-- Activa schema
USE db_biblioteca_series;

-- Crea Plataformas
CREATE TABLE IF NOT EXISTS Plataformas (
	ID INT AUTO_INCREMENT PRIMARY KEY,
	Nombre VARCHAR(255) NOT NULL
);

-- Crea Series
CREATE TABLE IF NOT EXISTS Series (
	ID INT AUTO_INCREMENT PRIMARY KEY,
	Titulo VARCHAR(255) NOT NULL,
	PlataformaID INT NOT NULL,
	FOREIGN KEY (PlataformaID) REFERENCES Plataformas(ID)
);