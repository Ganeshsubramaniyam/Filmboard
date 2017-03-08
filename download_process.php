<?php
include 'Main_Controller.php';
ini_set('memory_limit', '1024M');

function zipFilesAndDownload($file_names, $archive_file_name, $file_path, $org_file_names) {
    $zip = new ZipArchive();
    //create the file and throw the error if unsuccessful
    if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE) !== TRUE) {
        exit("cannot open <$archive_file_name>");
    }
    $i = 0;
    //add each files of $file_name array to archive
    foreach ($file_names as $files) {
        $zip->addFile($file_path . $files, $files);
        $zip->renamename(basename($file_path . $files), $org_file_names[$i] . ".mp3");
        $i = $i + 1;
    }
    $zip->close();
    $size=filesize($archive_file_name);
    //then send the headers to force download the zip file
    header("Content-length: $size");
    header("Content-Type: application/zip"); // ZIP file
    header("Content-Disposition: attachment; filename=$archive_file_name");
    header("Content-Transfer-Encoding: binary");
    ob_end_clean();
    flush();
    readfile("$archive_file_name");
}

function videodownload($file,$filenam)
{
    $video_data = file_get_contents("Other Data/Video Songs/$file");
    $key = '';
    $keys = range(0, 9);
    for ($i = 0; $i < 18; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    $filename=str_replace(" ", "_", strtolower($filenam))."_$key.mp4";
    file_put_contents($filename, $video_data);
    header("Cache-Control: public");
    header('Content-length: ' .  filesize($filename));
    header("Content-Description: File Transfer");
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Transfer-Encoding: binary");
    readfile($filename);
    return $filename;
}
$downloadobj = new Main_Controller();
if ($_GET['Type'] == 0) {
    $file_name_t = $downloadobj->GetFileNames($_GET["VideoId"], 0);
    $f_t = explode("@", $file_name_t[0]);
    $file_names = $f_t[0];
    $file_org_names = $f_t[1];
    $ret=videodownload($file_names,$file_org_names);
    unlink($ret);
    exit;
} else if ($_GET['Type'] == 1) {
    $file_name = array();
    $file_names = array();
    $file_org_names = array();
    $file_name = $downloadobj->GetFileNames($_GET["AlbumId"], 1);
    for ($index = 0; $index < count($file_name); $index++) {
        $f_t = explode("@", $file_name[$index]);
        $file_names[$index] = $f_t[0];
        $file_org_names[$index] = $f_t[1];
    }
    print_r($file_names);
    print_r($file_org_names);
    $album_name = $downloadobj->GetAlbumName($_GET["AlbumId"]);
    $key = '';
    $keys = range(0, 9);
    for ($i = 0; $i < 18; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    $archive_file_name = $album_name."_$key.zip";
    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/Other Data/Audio Files/';
    zipFilesAndDownload($file_names, $archive_file_name, $file_path, $file_org_names);
    unlink($archive_file_name);
    exit;
} else if ($_GET['Type'] == 2) 
{
    
}
?>