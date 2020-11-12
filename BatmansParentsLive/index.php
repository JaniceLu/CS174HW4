<?php
namespace BatmansParentsLive;
require("./vendor/autoload.php");

use Controllers\LandingAdapter as LandingAdapter;
$controller = "LandingView";

if ($controller == "LandingView"){
  $controller = new LandingAdapter();
}

$controller->run();
