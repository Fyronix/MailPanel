<?php
$filename = "config.php";
if(file_exists($filename)){
    include_once 'config.php';
    $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DB , USER , PASSWORD);
    $configuration = "CREATE TABLE IF NOT EXISTS configuration("
            . "id INT(1) NOT NULL AUTO_INCREMENT,"
            . "host VARCHAR(128) NOT NULL,"
            . "port INT(4) NOT NULL,"
            . "username VARCHAR(128) NOT NULL,"
            . "password VARCHAR(128) NOT NULL,"
            . "PRIMARY KEY(id)"
            . ")";
    $dbh->query($configuration);
    $contacts = "CREATE TABLE IF NOT EXISTS contacts("
            . "id INT(3) NOT NULL AUTO_INCREMENT,"
            . "firstname VARCHAR(32) NOT NULL,"
            . "lastname VARCHAR(32) NOT NULL,"
            . "email VARCHAR(32) NOT NULL,"
            . "PRIMARY KEY(id)"
            . ")";
    $dbh->query($contacts);
    $mails = "CREATE TABLE IF NOT EXISTS mails("
            . "id INT(4) NOT NULL AUTO_INCREMENT,"
            . "mail_to VARCHAR(128) NOT NULL,"
            . "mail_from VARCHAR(128) DEFAULT NULL,"
            . "subject VARCHAR(256) DEFAULT NULL,"
            . "cc VARCHAR(128) DEFAULT NULL,"
            . "bcc VARCHAR(128) DEFAULT NULL,"
            . "charset VARCHAR(64) DEFAULT 'UTF-8',"
            . "is_html BIT NOT NULL ,"
            . "body MEDIUMTEXT NOT NULL,"
            . "PRIMARY KEY(id)"
            . ")";
    $dbh->query($mails);
    $user_query = "CREATE TABLE IF NOT EXISTS user("
            . "id INT(1) NOT NULL AUTO_INCREMENT,"
            . "username VARCHAR(128) NOT NULL,"
            . "password VARCHAR(128) NOT NULL,"
            . "identifier VARCHAR(128),"
            . "ip VARCHAR(32),"
            . "last_login DATETIME,"
            . "PRIMARY KEY (id)"
            . ")";
    $dbh->query($user_query);
    header("Location: setup-user.php");
}else{
    echo 'configuration is not successfully';
    header("Location: index.php");
}