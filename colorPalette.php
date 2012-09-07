<?php 
	class Palette
		{
			public function set($name, $color)
				{
					$this->$name=$color;
				}
	}
?>
<?php

$im = imagecreatefromjpeg("test.jpg");
$x = imagesx($im)-1;
$y = imagesy($im)-1;
$c = 1;
$image = array();
if($x<$y)
{
	$m = $x;
}
else
{
	$m = $y;
}
//DIAGONAL
while($c<$m)
	{	
		$rgb = imagecolorat($im, $c, $c);
		$r = ($rgb >> 16) & 0xFF;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;
		array_push($image,"rgb(" . $r . "," . $g . "," . $b . ")");
		$c++;
	}
//OPPOSITE DIAGONAL
$c = $m;
while($c>0)
	{	
		$rgb = imagecolorat($im, $x-$c, $c);
		$r = ($rgb >> 16) & 0xFF;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;
		array_push($image,"rgb(" . $r . "," . $g . "," . $b . ")");
		$c--;
	}
//HORIZONTAL
$a = $y/20;
$i = 1;
while($i<$a)
	{
		$m = 10;
		$c = 1;
		while($c<$m)
			{	
				$rgb = imagecolorat($im, $x/$c, $y/$i);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				array_push($image,"rgb(" . $r . "," . $g . "," . $b . ")");
				$c++;
			}
		$i++;
	}
// VERTICAL
$a = $x/20;
$i = 1;
while($i<$a)
	{
		$m = 10;
		$c = 1;
		while($c<$m)
			{	
				$rgb = imagecolorat($im, $x/$i, $y/$c);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				array_push($image,"rgb(" . $r . "," . $g . "," . $b . ")");	
				$c++;
			}
		$i++;
	}
$image = array_count_values($image);
arsort($image);
$l = 20;
?>
<?php
while(count($image)>$l)
	{
		array_pop($image);
	}
$palette = new Palette;
$i = 1;
foreach ($image as $key => $value) {
	$palette->set("color" . $i,$key);
	$i++;
}
?>