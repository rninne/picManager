<?php
	/*** Chris' workspace
	*/
	
	




?>

<html>
<head>
</head>
<body>
<h3>Choose an album</h3>

<?php
$dir = './images/';
$folders = scandir($dir);
array_shift($folders);
array_shift($folders);

$i=0;
foreach($folders as $index => $item){
    if(is_dir($dir.$item)){
        echo '<a href="album.php?folder='.$item.'">'.$item.'</a><br />';
    }else{
        array_splice($folders, $index-$i, 1);
        $i++;
    }
}
print_r($folders);
?>
</body>
</html>
































