<?php
/*** Set page defaults based on selection at choice of album page
*/
    $folder = $_GET['folder'];

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
        var imageArray = [];

        function selectImage(id, l){
            if(l){
                var checked = $('CBL_'+id).checked
            } else {
                var checked = $('CB_'+id).checked
            }

            if (checked){
                $('CB_'+id).checked = true;
                $('downloads').insert('<div id="DL_'+ id +'" class="choice"><img src="<?php echo $dir ?>thumbs/small/'+ id +'.JPG" onmouseup="removeImage(\''+id+'\')" /><br />'+id+'</div>');
                $('A_'+id).title = '<input checked="true" type="checkbox" id="CBL_'+id+'" onchange="selectImage(\''+id+'\',true)" /> Add to downloads';
                imagePosition[id] = imageArray.length;
                imageArray.push(id);
            } else {
                removeImage(id);
            }

            for(i=0;i<imageArray.length;i++){
                imagePosition[imageArray[i]] = i
            }
            //alert(imageArray);
        }

        function removeImage(id){
            $('DL_'+id).remove();
            $('CB_'+id).checked = false;
            imageArray.splice(imagePosition[id], 1);
            imagePosition[id] = false;

            $('A_'+id).title = '<input checked="false" type="checkbox" id="CBL_'+id+'" onchange="selectImage(\''+id+'\',true)" /> Add to downloads';
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

        function asdf(){
            var filename = $('filename').value;
            new Ajax.Request('zipDownload.php?files='+imageArray.toString()+'&filename='+filename, {
                method: 'get',
                onSuccess: function(response) {
                    $('generate').replace('<a href="zips/'+ filename +'.zip" >Download '+ filename +'.zip</a>');
                }
            });
        }
    </script>
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/photobooth.css" type="text/css" media="screen" />
    </head>
    <body>

<?php

include('SimpleImage.php');

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

$i=0;

foreach($files as $file){

    $i ++;

    list($id, $extension) = preg_split('/\./', $file);

    if ($i%3 == 1) {
        //left
        echo '<div class="left">';
    } elseif ($i%3 == 0) {
        //right
        echo '<div class="right">';
    } else {
        //middle
        echo '<div class="middle">';

    }

    echo <<<EOS
    <a id="A_$id" href="${dir}thumbs/large/$file" rel="lightbox[photobooth]" title="&lt;input type=&quot;checkbox&quot; id=&quot;CBL_$id&quot; onchange=&quot;selectImage('$id',true)&quot; /&gt; Add to downloads">
    <img src="${dir}thumbs/small/$file" id="$id"/>
    </a>
    <br />
    <input type="checkbox" id="CB_$id" onchange="selectImage('$id')" /> Add to downloads
    </div>
EOS;

    if ($i%6 == 0) {

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
            <div id="asdf">
                <input id="filename" type="text" />
                <input id="generate" type="button" value="generate .zip" onclick="asdf()" />
            </div>
        </div>
    </body>
</html>