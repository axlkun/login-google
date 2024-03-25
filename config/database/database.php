<?php

function connectDB() {

    $host = 'localhost';
    $dbname = 'login-demo';
    $username = 'postgres';
    $password = 'admindb10';

    $conn_string = "host=$host dbname=$dbname user=$username password=$password";

    $db = pg_connect($conn_string);

    if (!$db) {
        echo "Error al conectar a la base de datos.";
        exit;
    }

    return $db;

}