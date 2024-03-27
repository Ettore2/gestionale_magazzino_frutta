<?php

require_once ("php/constants.php");

session_start();

$conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);

if($conn->connect_error){
    die("error while connecting to database".$conn->connect_error);
}


function checkLogged(){
    if(!isset($_SESSION[SESSION_USERNAME])){
        header("Location: index.php");
        die();
    }
}

function checkPower($conn, $id_power){
    checkLogged();

    $sql = "SELECT id FROM potere_user WHERE id_user = (SELECT id FROM user WHERE username = '".$_SESSION[SESSION_USERNAME]."') and id_potere = '" . $id_power . "'";
    //echo ($sql);
    echo ("    ");
    if($conn->query($sql)->num_rows != 1){
        header("Location: index.php");
        die();
        //echo(";(");
    }
}

?>

