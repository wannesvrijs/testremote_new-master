<?php
function GetConnection()
{
    require_once "autoload.php";

    global $configuration;

    $dbdsn = $configuration['dbdsn'];
    $dbuser = $configuration['dbuser'];
    $dbpasswd = $configuration['dbpasswd'];


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

