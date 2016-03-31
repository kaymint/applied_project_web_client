<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/10/16
 * Time: 12:41 PM
 */

// Get image string posted from Android App
$base=$_REQUEST['image'];
// Get file name posted from Android App
$filename = $_REQUEST['filename'];
// Decode Image
$binary=base64_decode($base);
header('Content-Type: bitmap; charset=utf-8');
// Images will be saved under 'www/imgupload/uplodedimages' folder
if($file = fopen('uploadedimages/'.$filename, 'wb')){
    // Create File
    fwrite($file, $binary);
    fclose($file);

    $host = "127.0.0.1";
    $port = 2000;

    $output= $base ;

    $socket1 = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");

    socket_connect ($socket1 , $host,$port ) ;

    socket_write($socket1, $output, strlen ($output)) or die("Could not write output\n");

    socket_close($socket1) ;
    echo 'Image upload complete, Please check your php file directory';
}else{
    echo 'Image failed to upload';
//    $result = system('/usr/local/bin/python /Users/StreetHustling/PycharmProjects/image_processing_tutorials/command_line.py images/test_001.jpg', $retval);
//    exec('cd /Users/StreetHustling/PycharmProjects/image_processing_tutorials');
//    $result = exec('/usr/local/bin/python');
//    echo $result;
}


