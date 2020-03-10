<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_application_folder = "/testremote_new-master";
$_root_folder = $_SERVER['DOCUMENT_ROOT'] . "$_application_folder";

//load Models
require_once $_root_folder . "/Model/City.php";
require_once $_root_folder . "/Model/User.php";
require_once $_root_folder . "/Model/Taak.php";

//load Services
require_once $_root_folder . "/Service/Container.php";
require_once $_root_folder . "/Service/CityLoader.php";
require_once $_root_folder . "/Service/TaakLoader.php";
require_once $_root_folder . "/Service/MessageService.php";
require_once $_root_folder . "/Service/UserService.php";
require_once $_root_folder . "/Service/OpmaakService.php";
require_once $_root_folder . "/Service/AbstractUploadService.php";
require_once $_root_folder . "/Service/UploadEid.php";
require_once $_root_folder . "/Service/UploadImage.php";
require_once $_root_folder . "/Service/SaveService.php";
require_once $_root_folder . "/Service/DetailInterface.php";
require_once $_root_folder . "/Service/DetailTvToren.php";
require_once $_root_folder . "/Service/DetailBigBen.php";
require_once $_root_folder . "/Service/DetailEiffeltoren.php";

session_start();
$_SESSION["head_printed"] = false;

require_once $_root_folder . "/lib/passwd.php";
require_once $_root_folder . "/lib/pdo.php";                          //database functies

$container = new Container($configuration);
$MS = $container->getMessageService();
$opmaakService = $container->getOpmaakService();


//redirect naar NO ACCESS pagina als de gebruiker niet ingelogd is en niet naar
//de loginpagina gaat
if ( ! isset($_SESSION['usr']) AND ! $login_form AND ! $register_form AND ! $no_access)
{
    header("Location: " . $_application_folder . "/no_access.php");
}
