<?php
require_once 'autoload.php';

//$target_dir = de map waar de afbeeldingen uiteindelijk moet komen
$max_size = 5000000;
$allowed_extensions = ['jpeg', 'jpg', 'png', 'gif'];//maximum grootte in bytes

$upload = $container->getUploadService();
$upload->UploadFileUser($_FILES);