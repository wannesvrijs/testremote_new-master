<?php


abstract class AbstractUploadService
{
    public function CheckUploadedFile( $upfile, $check_real_image = true, $check_if_exists = true, $check_max_size = true, $check_allowed_extensions = true )
    {
        $max_size = 5000000;                                       //maximum grootte in bytes
        $allowed_extensions = ['jpeg', 'jpg', 'png', 'gif'];       //toegelaten bestandsextensies

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