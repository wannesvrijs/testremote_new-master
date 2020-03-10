<?php
require_once 'autoload.php';


$upload = $container->getUploadImage();

if ( isset($_POST['submit']) AND $_POST["submit"] == "Opladen" ){
    $upload->UploadFile($_FILES);
}