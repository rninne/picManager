<html>
<head>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/imageThumbs.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/public.css" type="text/css" media="screen" />
</head>
<body>

<canvas id="IMG_0023"></canvas>
<canvas id="IMG_0026"></canvas>
<canvas id="IMG_0028"></canvas>
<canvas id="IMG_0031"></canvas>
<canvas id="IMG_0036"></canvas>

<br />
<br />
<p>
            <strong>Rotate Image: </strong>
            <a href="javascript:asdf();" id="resetImage">Reset Image</a>
            <a href="javascript:;" id="rotate90">90&deg;</a>
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
        echo <<<EOS
        <dir class="album">
            <a href="album.php?folder=$item">
                <img src="${item}_album.jpg" /><br />
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
































