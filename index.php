<?php

require_once ('includes/classes/Database.php');

define('DB_HOST','localhost');
define('DB_NAME','ue06');
define('DB_USER','testuser');
define('DB_PASS','testpass');

$db = new Database();

$cryptedPassword = password_hash('testpassword',PASSWORD_BCRYPT);
$username = 'test';

$cryptedPassword = $db->escapeString($cryptedPassword);
$username = $db->escapeString($username);

//$sql = "Insert into user(name,`password`)values('.$username.','.$cryptedPassword')";

//$db ->query($sql);

$sql = "Select * from user where name='.$username.'";
$result = $db->query($sql);

if($db->numRows($result)>0){
    $row = $db->fetchAssoc($result);

    if (password_verify("testpassword",$row['password'])){
        echo "Der Nutzer".$username." mit der ID ".$row['id']." hat";
        echo " das Passwort testpassword";
    }else{
        echo "Nutzer gefunden aber falsches Passwort";
    }
}else{
    echo "Keinen Nutzer gefunden";
}





