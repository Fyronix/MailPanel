<?php

session_start();
include_once "admin-setup/config.php";

try {
    $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DB, USER, PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['login'])) {
    $username = strip_tags(htmlspecialchars($_POST['username']));
    $password = strip_tags(htmlspecialchars($_POST['password']));
    $remember = $_POST['remember'];
    do_login($username, $password, $remember, $dbh);
}

if(isset($_GET['logged_out']) && $_GET['logged_out'] == 'true'){ 
    do_logout($dbh); 
}

function is_user_login($dbh) {
    if (isset($_SESSION['mailpanel_login'])) {
        return true;
    } else {
        if(isset($_COOKIE['mailpanel_identifier'])){
            $username = $_COOKIE['mailpanel_username'];
            $statement = "SELECT * FROM user WHERE username=:username";
            $stat = $dbh->prepare($statement);
            $stat->bindParam(":username" , $username);
            $result = $stat->execute();
            if($result){
                $row_obj = $stat->fetchObject();
                $identifier = $row_obj->identifier;
                return $identifier == $_COOKIE['mailpanel_identifier'];
            } else {
                return false;
            }          
        } else {
            return false;
        }
    }
}

function do_login($username, $password, $remember, $dbh) {
    $statement = "SELECT * FROM user WHERE username=:username";
    $stat = $dbh->prepare($statement);
    $stat->bindParam(":username", $username);
    $result = $stat->execute();
    if ($result) {
        $row_obj = $stat->fetchObject();
        $check_password = password_verify($password, $row_obj->password);
        if ($check_password) {
            if (isset($remember)) {
                $_SESSION['mailpanel_login'] = true;
                $_SESSION['mailpanel_username'] = $username;
                $ip = $_SERVER['REMOTE_ADDR'];
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $salt = rng_random_string();
                $identifier = md5($ip . $salt . $user_agent);
                $statement = "UPDATE user SET identifier=:identifier WHERE username=:username";
                $stat = $dbh->prepare($statement);
                $stat->bindParam(":identifier", $identifier);
                $stat->bindParam(":username", $username);
                $result = $stat->execute();
                if ($result) {
                    setcookie('mailpanel_identifier', $identifier , time() + 3600);
                    setcookie('mailpanel_username', $username , time() + 3600);
                    header("Location: index.php");
                }
            } else {
                $_SESSION['mailpanel_login'] = true;
                $_SESSION['mailpanel_username'] = $username;
                header("Location: index.php");
            }
        }
    }
}

function rng_random_string(){
    $characters = "QWERT
