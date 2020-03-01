<?php
require_once 'autoload.php';

$max_size = 5000000;                                                           //maximum grootte in bytes
$allowed_extensions = ['jpeg', 'jpg', 'png', 'gif'];       //toegelaten bestandsextensies

$upload = $container->getUploadService();

if ( isset($_POST['submit']) AND $_POST["submit"] == "Opladen" ){
    $upload->UploadFile($_FILES);
}