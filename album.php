<?php
/*** Include configuration scripts and image scaler
*/
include('php/SimpleImage.php');
include('php/iniProperties.php');
/*** Set page defaults based on selection at choice of album page
*/
    if(isset($_GET['folder'])){
        $folder = $_GET['folder'];
    }else {
        $folder = 'photobooth';
    }

    //$username = $SESSION[''];

    //$userFolder = './users/'. $username;

    $dir = './images/'.$folder.'/';
?>

<html>
    <head>
    <script src="js/prototype.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
    <script type="text/javascript">
        var imagePosition = {};
        var imageList = [];

        function toggleImage(checkBox, id){
            var checked = $(checkBox).checked;
            if(checked){
                $('CB_'+id).checked = 'checked';
                $('downloads').insert('<div id="DL_'+ id +'" class="choice"><img src="<?php echo $dir ?>thumbs/small/'+ id +'.JPG" onmouseup="removeImage(\''+ id +'\')" /><br />'+id+'</div>');
                $('A_'+id).title = '<input id="CBL_'+ id +'" class="CBL" type="checkbox" checked="checked" onchange="toggleImage(this,\''+ id +'\')" /> Add to downloads';
                imageList.push(id);
            } else {
                removeImage(id);
            }

            $('DLZIP').href = 'zipDownload.php?folder=<?php echo $folder ?>&files=' + imageList.toString();
        }
        
        function removeImage(id){
            $('DL_'+id).remove();
            $('CB_'+id).checked = '';
            $('A_'+id).title = '<input id="CBL_'+ id +'" class="CBL" type="checkbox" onchange="toggleImage(this,\''+ id +'\')" /> Add to downloads';

            for(i=0;i<imageList.length;i++){
                if(imageList[i] == id) {
                    imageList.splice(i, 1);
                    break;
                }
            }
            $('DLZIP').href = 'zipDownload.php?folder=<?php echo $folder ?>&files=' + imageList.toString();
        }
        
        function checkPosition(id){
            alert(listOfImages[id]);
        }

        function hoverImage(id, over){
            if (over) {
                $('DL_'+id).setStyle('border-bottom:5px solid blue;')
            } else {
                $('DL_'+id).setStyle('border-bottom:none;')
            }
        }
        function makeZipLink() {
            window.location='zipDownload.php?folder=<?php echo $folder ?>&files=' + imageList.toString();
        }

    </script>
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/photobooth.css" type="text/css" media="screen" />
    </head>
    <body>

<?php

/*** Scan directory for images
*/

$files = scandir($dir);

/*** Scan for thumbnails
if thumbnail not found in /thumbs directory, create a new one.

foreach($files as $file){

    if(file_exists($dir.'/thumbs/large/'.$file)){
        echo 'large thumb for '.$file.' exists <br />';
    } else {
        $image = new SimpleImage();
        $image->load($dir.$file);
        $image->resizeToWidth(800);
        $image->save($dir.'/thumbs/large/'.$file);

    }

    if(file_exists($dir.'/thumbs/small/'.$file)){
        echo 'large thumb for '.$file.' exists <br />';
    } else {
        $image = new SimpleImage();
        $image->load($dir.$file);
        $image->resizeToWidth(150);
        $image->save($dir.'/thumbs/small/'.$file);
    }
}
*/

/*** remove all non image files from the array
*/

$i=0;

foreach($files as $index => $file){
    //echo $dir.$file;
    if(is_dir($dir.$file)){
        array_splice($files, $index-$i, 1);
        $i++;
    }
}

//print_r($files);

?>

        <div id="picContainer" style="clear:none;">
            <div class="row">

<?php

foreach($files as $index => $file){

    list($id, $extension) = preg_split('/\./', $file);

    if ($index%3 == 0) {
        //left
        echo '<div class="left">';
    } elseif ($index%3 == 1){
        //middle
        echo '<div class="middle">';
    } elseif ($index%3 == 2) {
        //right
        echo '<div class="right">';
    }

    echo <<<EOS
    <a id="A_$id" href="${dir}thumbs/large/$file" rel="lightbox[photobooth]" title="&lt;input id=&quot;CBL_$id&quot; class=&quot;CBL&quot; type=&quot;checkbox&quot; onchange=&quot;toggleImage(this)&quot; /&gt; Add to downloads"><img src="${dir}thumbs/small/$file" id="$id"/></a>
    <br />
    <input id="CB_$id" class="CB" type="checkbox" onchange="toggleImage(this, '$id')" /> Add to downloads
    </div>
EOS;

    if ($index%6 == 5) {

        echo <<<EOS
        </div>
        <div class="row">
EOS;
    }
}
?>
            </div>
        </div>
        <div id="downloads">
            <a id="DLZIP" href="#">Download .zip</a>
        </div>
    </body>
</html>
