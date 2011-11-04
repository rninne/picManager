<?php
/*** Include configuration
*/
include('php/iniProperties.php');
?>

<?php
$dir = './images/';
$randPics = array();
$folders = scandir($dir);
array_shift($folders);
array_shift($folders);

$i=0;
foreach($folders as $index => $item){
    if(is_dir($dir.$item)){
        $files = scandir($dir.$item.'/thumbs/small');
        array_shift($files);
        array_shift($files);
        $randIndex = array_rand($files, 5);
        $asdf = array();
        foreach($randIndex as $index2){
            $qwer = preg_split('/\./', $files[$index2]);
            array_push($asdf, array($qwer[0], $item));
        }
        array_push($randPics, $asdf);
    }else{
        array_splice($folders, $index-$i, 1);
        $i++;
    }
}
?>
<html>
<head>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/imageThumbs.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/public.css" type="text/css" media="screen" />
</head>
<body>
<?php
/*
<canvas id="IMG_0023" album="photobooth" class="card r"></canvas>
<canvas id="IMG_0026" album="photobooth" class="card rm"></canvas>
<canvas id="IMG_0028" album="photobooth" class="card m"></canvas>
<canvas id="IMG_0031" album="photobooth" class="card ml"></canvas>
<canvas id="IMG_0036" album="photobooth" class="card l"></canvas>

<br />
<br />

<canvas id="IMGP4431" album="JonM-S" class="card r"></canvas>
<canvas id="IMGP4432" album="JonM-S" class="card rm"></canvas>
<canvas id="IMGP4433" album="JonM-S" class="card m"></canvas>
<canvas id="IMGP4434" album="JonM-S" class="card ml"></canvas>
<canvas id="IMGP4435" album="JonM-S" class="card l"></canvas>
*/
?>
<div id="albums">
    <h3>Choose an album</h3>

    
<?php
/*
$rotationCode = array('r', 'rm', 'm', 'ml', 'l');
foreach($randPics as $index => $item){
    foreach($item as $index2 => $pic){
        echo <<<EOS
        <canvas id="$pic[0]" album="$pic[1]" class="card $rotationCode[$index2]"></canvas>
EOS;
    }
}
*/
?>
<?php
$rotationCode = array('r', 'rm', 'm', 'ml', 'l');
foreach($folders as $index => $item){
    echo <<<EOS
        <div class="album">
            <div class="cards">
EOS;
    $pics = $randPics[$index];
    foreach($pics as $index2 => $pic){
        echo <<<EOS
        <canvas id="$pic[0]" album="$pic[1]" class="card $rotationCode[$index2]"></canvas>
EOS;
    }
    echo <<<EOS
            </div>
            <a href="album.php?folder=$item">
                $item
            </a>
        </div>
EOS;
}

?>
</div>
</body>
</html>
































