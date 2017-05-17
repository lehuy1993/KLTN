<?php

if(!file_exists("uploads/")) {
    mkdir("uploads/");
    $output_dir = "uploads/";
}

if (isset($_FILES["img_name"])) {
    $ret = array();

    $error = $_FILES["img_name"]["error"];
    {

        if (!is_array($_FILES["img_name"]['name'])) //upload 1 anh
        {
            $RandomNum = uniqid();

            $ImageName = str_replace(' ', '-', strtolower($_FILES['img_name']['name']));
            $ImageType = $_FILES['img_name']['type']; //"image/png", image/jpeg etc.

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;

            move_uploaded_file($_FILES["img_name"]["tmp_name"], $output_dir . $NewImageName);
            $ret[$NewImageName] = $output_dir . $NewImageName;
        } else { // upload nhieu anh
            $fileCount = count($_FILES["img_name"]['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                $RandomNum = time();

                $ImageName = str_replace(' ', '-', strtolower($_FILES['img_name']['name'][$i]));
                $ImageType = $_FILES['img_name']['type'][$i]; //"image/png", image/jpeg etc.

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.', '', $ImageExt);
                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;

                $ret[$NewImageName] = $output_dir . $NewImageName;
                move_uploaded_file($_FILES["img_name"]["tmp_name"][$i], $output_dir . $NewImageName);
            }
        }
    }
    echo json_encode($ret);

}

?>