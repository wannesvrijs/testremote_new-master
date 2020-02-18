<?php
function GetConnection()
{
    require_once "passwd.php";
    $arr_connection = GetConnectionData();

    $dbdsn = $arr_connection['dbdsn'];
    $dbuser = $arr_connection['dbuser'];
    $dbpasswd = $arr_connection['dbpasswd'];


    $pdo = new PDO($dbdsn, $dbuser, $dbpasswd);
    return $pdo;
}

function GetData( $sql )
{
    $pdo = GetConnection();

    $stm = $pdo->prepare($sql);
    $stm->execute();

    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function ExecuteSQL( $sql )
{
    $pdo = GetConnection();

    $stm = $pdo->prepare($sql);

    if ( $stm->execute() ) return true;
    else return false;
}

