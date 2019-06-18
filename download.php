<?
$name = $_GET['name'];
    $uploaddir = $fileItem . $name;

if (file_exists($uploaddir)) {
    header("Content-Disposition: attachment; filename=  $uploaddir");
    header("Content-Type: octet-stream");
    readfile($uploaddir);
}   

