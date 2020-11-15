<?php

namespace Models;

class ImageTools{
  function LoadJpeg($i)
  {
      /* Attempt to open */
      $im = imagecreatefromjpeg("./src/resources/active_image.jpg");
      //compute x and y using i.
      //x is just 120 * i %3
      //y is just the integer division of i and 3..... i'm hella tired and it took me waaaay too long to figure that out :(
      return imagejpeg(imagecrop($im, ['x'=> 120*($i%3), 'y' => 120*intdiv($i,3), 'width' => 120, 'height' => 120]));
  }
}
