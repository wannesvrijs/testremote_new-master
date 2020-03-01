<?php


class UploadService
{

    public function UploadFileUser ($file){
        $_application_folder = "/testremote_new-master";
        $_root_folder = $_SERVER['DOCUMENT_ROOT'] . "$_application_folder";
        $target_dir = $_root_folder."/img/";
        foreach ($file as $filename => $f) {
            $upfile = array();
            $upfile['name'] = basename($f['name']);
            $upfile['tmp_name'] = $f['tmp_name'];
            $upfile['target_path_name'] = $target_dir . $upfile['name']; //samenstellen definitieve bestandsnaam (+pad)
            $upfile['extension'] = pathinfo($upfile['name'], PATHINFO_EXTENSION);
            $upfile['getimagesize'] = getimagesize($upfile['tmp_name']); //getimagesize geeft false als het bestand geen afbeelding is
            $upfile['size'] = $f['size'];
            $extensie = pathinfo($upfile['name'], PATHINFO_EXTENSION);

            $result = $this->CheckUploadedFile($upfile);

            if ($filename === 'pasfoto')
            {
                $target = "pasfoto_" . $_SESSION["usr"]->getId(). "." . $extensie;
                $images[] = "usr_pasfoto='" . $target . "'";
                $_SESSION['usr']->setPasfoto($target);
            }
            elseif ($filename === 'eidvoor')
            {
                $target = "eidvoor_" . $_SESSION["usr"]->getId() . "." . $extensie;
                $images[] = "usr_vz_eid='" . $target . "'";
                $_SESSION['usr']->setVzEid($target);
            }
            elseif ($filename === 'eidachter')
            {
                $target = "eidachter_" . $_SESSION["usr"]->getId() . "." . $extensie;
                $images[] = "usr_az_eid='" . $target . "'";
                $_SESSION['usr']->setAzEid($target);
            }

            $target = $target_dir.$target;

            if ( !$result )
            {
                echo "Sorry, your file was not uploaded.<br>";
                header('Location: ../profiel.php');
            }
            else
            {
                //bestand verplaatsen naar definitieve locatie + naam
                if ( move_uploaded_file( $upfile["tmp_name"], $target ))
                {
                    echo "The file " . $upfile["name"] . " has been uploaded <br>";

                }
                else
                {
                    echo "Sorry, there was an unexpected error uploading file " . $upfile["name"] . "<br>";
                    header('Location: ../profiel.php');
                }
            }
        }

        $sql = 'update users SET ' . implode(',', $images) . ' where usr_id=' . $_SESSION['usr']->getId();
        if (ExecuteSQL($sql)) {
            header('Location: ../profiel.php');
        }
        else{
            header('Location: ../profiel.php');
        }

    }

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

    public function CheckUploadedFile( $upfile, $check_real_image = true, $check_if_exists = true, $check_max_size = true, $check_allowed_extensions = true )
    {
        global $allowed_extensions, $max_size;

        $returnvalue = true;

        // Check if image file is a actual image or fake image
        if ($check_real_image AND $upfile["getimagesize"] === false) {
            echo "File " . $upfile["name"] . " is not an image.<br>";
            $returnvalue = false;
        }

        // Check if file already exists
        if ($check_if_exists AND file_exists($upfile["target_path_name"])) {
            echo "File  " . $upfile["name"] . " already exists.<br>";
            $returnvalue = false;
        }

        // Check file size
        if ($check_max_size AND $upfile["size"] > $max_size) {
            echo "File  " . $upfile["name"] . "  is too large.<br>";
            $returnvalue = false;
        }

        // Allow only certain file formats
        if ($check_allowed_extensions) {
            if (!in_array($upfile["extension"], $allowed_extensions)) {
                echo "Wrong extension. Only " . implode(", ", $allowed_extensions) . " files are allowed.<br>";
                $returnvalue = false;
            }
        }
        return $returnvalue;
    }
}