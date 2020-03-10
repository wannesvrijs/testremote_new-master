<?php
class UploadImage extends AbstractUploadService {
    public function UploadFile ($file){

        $_application_folder = "/testremote_new-master";
        $_root_folder = $_SERVER['DOCUMENT_ROOT'] . "$_application_folder";
        $target_dir = $_root_folder."/img/";

        foreach ($file as $f) {
            $upfile = array();
            $upfile['name'] = basename($f['name']);
            $upfile['tmp_name'] = $f['tmp_name'];
            $upfile['target_path_name'] = $target_dir . $upfile['name']; //samenstellen definitieve bestandsnaam (+pad)
            $upfile['extension'] = pathinfo($upfile['name'], PATHINFO_EXTENSION);
            $upfile['getimagesize'] = getimagesize($upfile['tmp_name']); //getimagesize geeft false als het bestand geen afbeelding is
            $upfile['size'] = $f['size'];

            $result = $this->CheckUploadedFile($upfile);
            if ( !$result ) echo "Sorry, your file was not uploaded.<br>";
            else
            {
                //bestand verplaatsen naar definitieve locatie + naam
                if ( move_uploaded_file( $upfile["tmp_name"], $upfile["target_path_name"] ))
                {
                    echo "The file " . $upfile["name"] . " has been uploaded <br>";
                }
                else
                {
                    echo "Sorry, there was an unexpected error uploading file " . $upfile["name"] . "<br>";
                }
            }
        }
    }

}