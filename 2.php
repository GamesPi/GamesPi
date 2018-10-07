<?php
$img = file_get_contents('https://wallpapershome.com/images/wallpapers/poppy-7680x4320-5k-4k-wallpaper-8k-meadows-wildflowers-5251.jpg');
file_put_contents('1.jpg',$img);
echo '<img src="1.jpg">';
?>
