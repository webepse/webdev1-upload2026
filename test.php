<?php
var_dump($_POST);
var_dump($_GET);
var_dump($_FILES);


$path = "upload/monfichier.jpg";
$file = "monfichier.twig.jpg";
echo basename($path);
echo "<br>";
echo strrchr($file, '.');

$tab = ["kobe","Jordan","Iverson","Pippen","O'neil"];
$player = "Wemby";

var_dump(in_array($player,$tab));
