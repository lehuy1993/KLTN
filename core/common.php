<?php
$rootURL = '';
$rootFolder='/KLTN';

if ($_SERVER["SERVER_PORT"] != "80") {
    $rootURL .= $_SERVER['DOCUMENT_ROOT'] . $rootFolder;
} else {
    $rootURL .= $_SERVER['DOCUMENT_ROOT'];
}

$CRUDUrl = $rootURL . "/core/CRUD.php";
$PaginationUrl = $rootURL . "/core/Pagination.php";
$uploadImgUrl = $rootURL . "/KLTN/public/truyen/";
$uploadImgUrl1 = $rootURL . "/KLTN/public/truyen/";

define("__rootURL", $rootURL);
define("__CRUD", $CRUDUrl);
define("__Pagination", $PaginationUrl);
define("__UploadImage", $uploadImgUrl);
define("__UploadImageNew", $uploadImgUrl1);

define("__rootFolder", $rootFolder);

$pageURL = "";
if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] .$rootFolder;
} else {
    $pageURL .= $_SERVER["SERVER_NAME"];
}
$imagePath = $rootFolder."/public/truyen/";
$imagePath2 = $rootFolder."/public/truyen/";
define("__ImageNew", $imagePath2);

define("__ImagePro", $imagePath);


