<?php
    // These variables define the connection information for your MySQL database 
    $username = "databaseuser"; 
    $password = "databasepass"; 
    $host = "localhost"; 
    $dbname = "yourdatabase"; 

    $host="localhost"; // Host name 
    $username="thnbgr_admin"; // Mysql email 
    $password="Database101"; // Mysql password 
    $dbname="thnbgr_db"; // Database name 

     
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
    try { $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); } 
    catch(PDOException $ex){ die("Failed to connect to the database: " . $ex->getMessage());} 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    header('Content-Type: text/html; charset=utf-8'); 
    session_start(); 
?>