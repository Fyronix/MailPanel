<?php

if (isset($_POST['save_configuration'])) {
    include_once 'database.php';
    $smtpsecure = strip_tags(htmlspecialchars($_POST['smtpsecure']));
    $host = strip_tags(htmlspecialchars($_POST['host']));
    $port = strip_tags(htmlspecialchars($_POST['port']));
    $username = strip_tags(htmlspecialchars($_POST['username']));
    $password = strip_tags(htmlspecialchars($_POST['password']));
    $hash_pass = "KksnNu7r8d" . $password . "16zSmTQHkl";
    $statement = "UPDATE configuration SET "
            . "smtpsecure=:smtpsecure,"
            . " host=:host ,"
            . " port=:port ,"
            . " username=:username ,"
            . " password=:password";
    $stmt = $dbh->prepare($statement);
    $stmt->bindParam(":smtpsecure" , $smtpsecure , PDO::PARAM_STR);
    $stmt->bindParam(":host" , $host , PDO::PARAM_STR);
    $stmt->bindParam(":port" , $port , PDO::PARAM_INT);
    $stmt->bindParam(":username" , $username , PDO::PARAM_STR);
    $stmt->bindParam(":password" , $password , PDO::PARAM_STR);
    $result = $stmt->execute();
    if($result){
        header("Location: index.php");
    }else{
        echo 'Error with save configuration';
    }
}else{
    header("Location: index.php");
}
