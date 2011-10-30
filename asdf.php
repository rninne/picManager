<?php

$dir = './images/JonM-S/';

/*** Scan directory for images
*/

$files = scandir($dir);

/*** remove all non image files from the array
*/

foreach($files as $index => $file){
    //echo $dir.$file;
    if(is_dir($dir.$file)){

    } else {
    
        list($id, $extension) = preg_split('/\./', $file);
        rename($dir.$file, $dir.$id.'.jpg');
        }
}

?>