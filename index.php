<html>
<head>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/imageThumbs.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/public.css" type="text/css" media="screen" />
</head>
<body>

<canvas id="IMG_0023" class="canvas1"></canvas>
<canvas id="IMG_0026" class="canvas2"></canvas>
<canvas id="IMG_0028" class="canvas3"></canvas>
<canvas id="IMG_0031" class="canvas4"></canvas>
<canvas id="IMG_0036" class="canvas5"></canvas>

<br />
<br />
<p>
            <strong>Rotate Image: </strong>
            <a href="javascript:asdf();" id="resetImage">Reset Image</a>
            <a href="javascript:asdf2();" id="rotate90">90&deg;</a>
            <a href="javascript:;" id="rotate180">180&deg;</a>
            <a href="javascript:;" id="rotate270">270&deg;</a>
        </p>
    <div id="albums">
        <h3>Choose an album</h3>
<?php
$dir = './images/';
$folders = scandir($dir);
array_shift($folders);
array_shift($folders);

$i=0;
foreach($folders as $index => $item){
    if(is_dir($dir.$item)){
    //<img src="${item}_album.jpg" /><br />
        echo <<<EOS
        <dir class="album">
            <a href="album.php?folder=$item">
                
                $item
            </a>
        </dir>
EOS;
    }else{
        array_splice($folders, $index-$i, 1);
        $i++;
    }
}
?>
    </div>
</body>
</html>
































