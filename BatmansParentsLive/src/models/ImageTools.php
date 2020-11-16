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

  function swap($i, $j)
  {
    //lock down file
    if( is_null($i) || is_null($j) || $i == $j || $i < 0 || $j < 0 || $i > 8 || $j > 8)
    {
      echo False; // we cant swap if i or j are null and there isn't a point to swap anything when they're ==
      return;
    }
    $fp = fopen("./src/resources/active_image.txt", 'r+');
    while (!flock($fp, LOCK_EX)) //could result in a deadlock maybe???
    {
      //wait until we can acquire the lock
      continue;
    }

    //read file into array
    #$fileText = fread($fp, filesize('./src/resources/active_image.txt'));
    $arr = [];
    for($f = 0; $f < 9; $f++)
    {
      $arr[$f] = fgetc($fp);
    }
    //swap items in array at position i and position j
    $k = $arr[$i];
    $arr[$i] = $arr[$j];
    $arr[$j] = $k;

    //message all connected players???

    //save array to file
    $writeMe = '';
    for($f = 0; $f < 9; $f++)
    {
      $writeMe = $writeMe . $arr[$f];
    }
    fseek($fp, 0);
    fwrite($fp, $writeMe);
    //unlock files
    flock($fp, LOCK_UN);

    //exit
    echo True;
  }


  function getOrder()
  {
    $fp = fopen("./src/resources/active_image.txt", 'r');
    while (!flock($fp, LOCK_SH)) //could result in a deadlock maybe???
    {
      //wait until we can acquire the lock
      continue;
    }

    //read file into array
    $arr = [];
    for($f = 0; $f < 9; $f++)
    {
      $arr[$f] = fgetc($fp);
    }
    flock($fp, LOCK_UN);
    return $arr;
  }
}
