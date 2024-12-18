import mysql.connector
from mysql.connector import Error

# Database connection parameters
host = "dbseries.c7yks6yyy5jl.us-east-2.rds.amazonaws.com"
user = "admin"  # Replace with your MySQL username
password = "admin123456"  # Replace with your MySQL password

def connect_to_db(host, user, password):
    """Function to connect to MySQL database."""
    connection = None
    try:
        # Attempt to connect to the MySQL database
        connection = mysql.connector.connect(
            host=host,
            user=user,
            password=password
        )

        if connection.is_connected():
            print("Successfully connected to the database.")
            return connection  # Return the connection object for further use

    except Error as e:
        print(f"Error: {e}")

    return connection  # Return None if there was an error


def create_tables(connection):
  if connection.is_connected():
            cursor = connection.cursor()

            # Create database if it doesn't exist
            cursor.execute("CREATE DATABASE IF NOT EXISTS db_biblioteca_series;")
            cursor.execute("USE db_biblioteca_series;")

            # Create Plataformas table
            cursor.execute("""
                CREATE TABLE IF NOT EXISTS Plataformas (
                    ID INT AUTO_INCREMENT PRIMARY KEY,
                    Nombre VARCHAR(255) NOT NULL
                );
            """)

            # Create Directores table
            cursor.execute("""
                CREATE TABLE IF NOT EXISTS Directores (
                    ID INT AUTO_INCREMENT PRIMARY KEY,
                    Nombre VARCHAR(255) NOT NULL,
                    Apellidos VARCHAR(255) NOT NULL,
                    FechaNacimiento DATE NOT NULL,
                    Nacionalidad VARCHAR(255) NOT NULL
                );
            """)

            # Create Actores table
            cursor.execute("""
                CREATE TABLE IF NOT EXISTS Actores (
                    ID INT AUTO_INCREMENT PRIMARY KEY,
                    Nombre VARCHAR(255) NOT NULL,
                    Apellidos VARCHAR(255) NOT NULL,
                    FechaNacimiento DATE NOT NULL,
                    Nacionalidad VARCHAR(255) NOT NULL
                );
            """)

            # Create Idiomas table
            cursor.execute("""
                CREATE TABLE IF NOT EXISTS Idiomas (
                    ID INT AUTO_INCREMENT PRIMARY KEY,
                    Nombre VARCHAR(255) NOT NULL,
                    ISOCodigo VARCHAR(10) NOT NULL UNIQUE
                );
            """)

            # Create Series table
            cursor.execute("""
                CREATE TABLE IF NOT EXISTS Series (
                    ID INT AUTO_INCREMENT PRIMARY KEY,
                    Titulo VARCHAR(255) NOT NULL,
                    PlataformaID INT NOT NULL,
                    DirectorID INT NOT NULL,
                    ActoresID INT NOT NULL,
                    IdiomaAudioID INT NOT NULL,
                    IdiomaSubtituloID INT NOT NULL,
                    FOREIGN KEY (PlataformaID) REFERENCES Plataformas(ID),
                    FOREIGN KEY (DirectorID) REFERENCES Directores(ID),
                    FOREIGN KEY (ActoresID) REFERENCES Actores(ID),
                    FOREIGN KEY (IdiomaAudioID) REFERENCES Idiomas(ID),
                    FOREIGN KEY (IdiomaSubtituloID) REFERENCES Idiomas(ID)
                );
            """)

            print("Database and tables created successfully.")

def close_db_connection(connection):
    """Function to close the database connection."""
    if connection is not None and connection.is_connected():
        connection.close()
        print("MySQL connection is closed.")


# Connect to the database
connection = connect_to_db(host, user, password)

# Create tables
create_tables(connection)

# Ensure the connection is closed when done
close_db_connection(connection)