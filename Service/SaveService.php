<?php


class SaveService
{

    public function save($postData)
    {
        global $_application_folder;
        global $tablename;
        global $formname;
        global $afterinsert;
        global $pkey;

        $sql_body = array();

        //key-value pairs samenstellen
        foreach ($postData as $field => $value) {
            if (in_array($field, array("tablename", "formname", "afterinsert", "pkey", "savebutton", $pkey))) continue;

            $sql_body[] = " $field = '" . htmlentities($value, ENT_QUOTES) . "' ";
        }

        if ($postData[$pkey] > 0) //update
        {
            $sql = "UPDATE $tablename SET " . implode(", ", $sql_body) . " WHERE $pkey=" . $_POST[$pkey];
            if (ExecuteSQL($sql)) $new_url = $_application_folder . "/$formname.php?id=" . $_POST[$pkey] . "&updateOK=true";
        } else //insert
        {
            $sql = "INSERT INTO $tablename SET " . implode(", ", $sql_body);
            if (ExecuteSQL($sql)) $new_url = $_application_folder . "/$afterinsert?insertOK=true";
        }

        header("Location: $new_url");

    }
}