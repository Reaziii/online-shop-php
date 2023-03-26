<?php
function upload($file)
{
    $filename = $file["name"];
    $milliseconds = floor(microtime(true) * 1000);
    $tempname = $file["tmp_name"];
    $folder = $_SERVER['DOCUMENT_ROOT'] . "/uploads/".$milliseconds."--". $filename;
    if (move_uploaded_file($tempname, $folder)) {
        $filename = "/uploads/".$milliseconds."--". $filename;
        try {
            return $filename;
        } catch (Exception $err) {
            return "error";
        }

    } else {
        return "error";
    }
}
