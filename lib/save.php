<?php
require_once "autoload.php";

$tablename = $_POST["tablename"];
$formname = $_POST["formname"];
$afterinsert = $_POST["afterinsert"];
$pkey = $_POST["pkey"];

if ( $_POST["savebutton"] === "Save" )
{
    $saveService = $container->getSaveService();
    $saveService->save($_POST);
}
?>