<?php
namespace BatmansParentsLive;
require("./vendor/autoload.php");

use BatmansParentsLive\hw4\Controllers\LandingAdapter as LandingAdapter;
use BatmansParentsLive\hw4\Controllers\ImageAdapter as ImageAdapter;
use BatmansParentsLive\hw4\Controllers\SwapAdapter as SwapAdapter;

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
else if ($controller == "swap")
{
  $controller = new SwapAdapter();
}

$controller->run();
