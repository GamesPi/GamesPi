<?php
$img = file_get_contents('http://www.baidu.com/img/baidu_logo.gif');
file_put_contents('1.gif',$img);
echo '<img src="1.gif">';
?>
