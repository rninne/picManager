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
    $files = scandir($dir);
?>

<html>
    <head>
    <script src="js/prototype.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
    <script type="text/javascript">
        var imagePosition = {};
        var imageList = [];
        
        function toggleImage(id){
            for(i=0; i<imageList.length; i++){
                if(imageList[i] == id){
                    //image is already in the download list, remove it
                    removeImageFromDownloads(id, i);
                    updateURL();
                    return;
                }
            }
            //image not found in imageList, add it
            addImageToDownloads(id);
            updateURL();
        }
        function removeImageFromDownloads(id, index){
            $('DL_'+id).remove();
            $('A_'+id).title = '<input id="CBL_'+ id +'" class="CBL" type="checkbox" onchange="toggleImage(\''+ id +'\')" /> Add to downloads';
            imageList.splice(index, 1);
        }
        function addImageToDownloads(id){
            $('downloads').insert('<div id="DL_'+ id +'" class="choice"><img src="<?php echo $dir ?>thumbs/small/'+ id +'.jpg" onmouseup="toggleImage(\''+ id +'\')" /><br />'+id+'</div>');
            $('A_'+id).title = '<input id="CBL_'+ id +'" class="CBL" type="checkbox" checked="checked" onchange="toggleImage(\''+ id +'\')" /> Add to downloads';
            imageList.push(id);
            
        }
        function updateURL(){
            $('DLZIP').href = 'zipDownload.php?folder=<?php echo $folder ?>&files=' + imageList.toString();        
        }

    </script>
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
    <?php
        if($folder == 'photobooth'){
            echo '<link rel="stylesheet" href="css/photobooth.css" type="text/css" media="screen" />';
        } else {
            echo '<link rel="stylesheet" href="css/thumbnails.css" type="text/css" media="screen" />';
        }
    ?>
    </head>
    <body>
<?php
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
    <img src="${dir}thumbs/small/$file" id="$id" onclick="toggleImage('$id')"/>
    <br />
    <a id="A_$id" href="${dir}thumbs/large/$file" rel="lightbox[photobooth]" title="&lt;input id=&quot;CBL_$id&quot; class=&quot;CBL&quot; type=&quot;checkbox&quot; onchange=&quot;toggleImage('$id')&quot; /&gt; Add to downloads">Show in slide show</a>
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
