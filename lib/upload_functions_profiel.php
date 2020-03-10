<?php
require_once 'autoload.php';

$upload = $container->getUploadEid();
$upload->UploadFileUser($_FILES);