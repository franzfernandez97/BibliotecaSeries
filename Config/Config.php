<?php

class Config {

    private static function getJsonPath() {
        // Call the getAll method from the Plataforma model
        return  $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/config/credentials.json';
    }
    // This method loads the credentials from the JSON file

    public static function getDbCredentials() {
        $jsonFilePath = self::getJsonPath();
        
        // Check if the file exists
        if (file_exists($jsonFilePath)) {
            // Read the file contents
            $jsonData = file_get_contents($jsonFilePath);

            // Decode JSON data into an associative array
            $data = json_decode($jsonData, true);

            // Check if decoding was successful
            if (json_last_error() === JSON_ERROR_NONE) {
                // Return the credentials
                return [
                    'host' => $data['host'],
                    'user' => $data['user'],
                    'password' => $data['password'],
                    'dbname' => $data['dbname']
                ];
            } else {
                // JSON decoding error
                echo "Error decoding JSON data.\n";
                exit;
            }
        } else {
            // File not found

            echo "Error: Could not find the credentials file.\n";
            exit;
        }
    }
}
?>
