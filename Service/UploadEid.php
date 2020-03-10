<?php
class UploadEid extends AbstractUploadService {
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
}