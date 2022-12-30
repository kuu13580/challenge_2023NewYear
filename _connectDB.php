<?php
// define $db_name $db_host $db_user $db_password
include "secred_variables.php";
$dbn = "mysql:dbname=".$db_name.";host=".$db_host;
// データベース接続
try {
    $dbh = new PDO($dbn, $db_user, $db_password);
} catch (PDOException $e) {
    print('Error:'.$e->getMessage());
    die();
}
?>