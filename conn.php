<?php
header("Content-Type: text/html; charset=utf-8");

$host = "localhost";
$user = "user";
$password = "pass";
$database = "mto_db";

//$conn->query("SET NAMES utf8");
$conn =  mysqli_connect( $host ,$user,$password,$database );
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

?>

