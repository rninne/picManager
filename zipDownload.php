<?php
$files = preg_split('/,/', $_GET['files']);
$zip = new ZipArchive();
// $filename = "./photobooth/robert.zip";
$filename = $_GET['filename'];
echo $filename .'<br />';
if ($zip->open('./zips/'.$filename.'.zip', ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}
/*
$zip->addFromString('test1.txt', 'file content goes here');
$zip->addFromString('test2.txt', 'file content goes here');
$zip->addFromString('test3.txt', 'file content goes here');
$zip->addFromString('test4.txt', 'file content goes here');
*/
foreach($files as $file){
    echo './photobooth/'.$file.'.jpg<br />';
    $zip->addFile('./photobooth/'.$file.'.jpg', $file.'.jpg');

}

// echo "numfiles: " . $zip->numFiles . "\n";
// echo "status:" . $zip->status . "\n";
$zip->close();

?>