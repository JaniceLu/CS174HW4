<?php
namespace BatmansParentsLive;
require("./vendor/autoload.php");

use Controllers\LandingAdapter as LandingAdapter;
use Controllers\ImageAdapter as ImageAdapter;

//use Models\ImageTools as ImageTools;

$controller = "LandingView";
if(!empty($_GET['c'])){
  $controller = $_GET['c'];
}

if ($controller == "LandingView"){
  $controller = new LandingAdapter();
}
else if ($controller == "image")
{
  $controller = new ImageAdapter();
}

$controller->run();
