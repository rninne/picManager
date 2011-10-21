<html>
<head>
<script src="js/prototype.js" type="text/javascript">
</script>
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
        //$('asdf').insert('qwerty');
        if (checked){
			$('CB_'+id).checked = true;
            $('downloads').insert('<div id="DL_'+ id +'" class="choice"><img src="photobooth/thumbs/small/'+ id +'.JPG" onmouseup="removeImage(\''+id+'\')" /><br />'+id+'</div>');
            
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
<link rel="stylesheet" href="css/public.css" type="text/css" media="screen" />
</head>
<body>
<?php

include('SimpleImage.php');

/* Scan directory for images.
*/

/* Scan for thumbnails
if thumbnail not found in /thumbs directory, create a new one.
*/

/* Create 
*/

// current directory
//echo getcwd() . '<br />';





$files = scandir('photobooth');

$asdf = array_shift($files);
$asdf = array_shift($files);
$asdf = array_pop($files);

//print_r($files);
?>

<div id="picContainer" style="clear:none;">
	<div class="row">
<?php
$i=0;
foreach($files as $file){
    
    $i ++;
    if(file_exists('photobooth/thumbs/large/'.$file)){
        //echo 'large thumb for '.$file.' exists <br />';
    } else {
        $image = new SimpleImage();
        $image->load('photobooth/'.$file);
        $image->resizeToWidth(800);
        $image->save('photobooth/thumbs/large/'.$file);
    }
    
    if(file_exists('photobooth/thumbs/small/'.$file)){
        //echo 'large thumb for '.$file.' exists <br />';
    } else {
        $image = new SimpleImage();
        $image->load('photobooth/'.$file);
        $image->resizeToWidth(150);
        $image->save('photobooth/thumbs/small/'.$file);
    }
    
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
    echo '<a id="A_'.$id.'" href="photobooth/thumbs/large/'.$file.'" rel="lightbox[photobooth]" title="&lt;input type=&quot;checkbox&quot; id=&quot;CBL_'.$id.'&quot; onchange=&quot;selectImage(\''.$id.'\',true)&quot; /&gt; Add to downloads">';
	/* checked=&quot;true&quot; */
    echo '<img src="photobooth/thumbs/small/'.$file.'" id="'.$id.'" />';
    echo '</a>';
    echo '<br />';
    echo '<input type="checkbox" id="CB_'.$id.'" onchange="selectImage(\''.$id.'\')" /> Add to downloads';
    echo '</div>';
    if ($i%6 == 0) {
        echo '</div>';
		echo '<div class="row">';
    }
    
    //echo '<img src="photobooth/thumbs/'.$file.'" /><br />';
	//echo '<img src="thumbs/IMG_0023.JPG" /><br />';

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
