<?php

$folder = $_GET['folder'];
$files = preg_split('/,/', $_GET['files']);

// Temporary name for the zip file
$zipname = tempnam('./', 'images_').'.zip';
// Create zip file containing requested contents
$zip = new ZipArchive();
if ($zip->open($zipname, ZIPARCHIVE::CREATE) !== TRUE ) {
    exit("cannot open <$filename>\n");
}
foreach($files as $file) {
    $zip->addFile("./images/$folder/$file.jpg", "$folder/$file.jpg");
}
$zip->close();

// Now construct the response.  This causes the browser to prompt the user to 
// save the zip file.

header('Content-Description: File Transfer');
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename='.$folder.'.zip');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: '.filesize($zipname));

// Make doubly sure we don't send any extra data in the body (?),
// read in the data, and finally remove the temporary file>
ob_clean();
flush();
readfile($zipname);
unlink($zipname);

exit;

?>
