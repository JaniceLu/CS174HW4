<?php

namespace BatmansParentsLive\hw4\Models;

class ImageTools{
  function LoadJpeg($i)
  {
      /* Attempt to open */
      $im = imagecreatefromjpeg("./hw4/src/resources/active_image.jpg");
      return imagejpeg($im);

  }

  function swap($i, $j)
  {
    //lock down file
    if( is_null($i) || is_null($j) || $i == $j || $i < 0 || $j < 0 || $i > 8 || $j > 8)
    {
      echo False; // we cant swap if i or j are null and there isn't a point to swap anything when they're ==
      return;
    }
    $fp = fopen("./hw4/src/resources/active_image.txt", 'r+');
    while (!flock($fp, LOCK_EX))
    {
      //wait until we can acquire the lock
      continue;
    }

    //read file into array
    //can we write this better: yes
    //are we going to write this better: no. i'm lazy
    $arr = [];
    for($f = 0; $f < 9; $f++)
    {
      $arr[$f] = fgetc($fp);
    }
    //swap items in array at position i and position j
    $k = $arr[$i];
    $arr[$i] = $arr[$j];
    $arr[$j] = $k;


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
    return True;
  }


  function getOrder()
  {
    $fp = fopen("./hw4/src/resources/active_image.txt", 'r');
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
    if(implode($arr) == '012345678')
    {
      $this->shuffleOrder();
    }
    return $arr;
  }

  function shuffleOrder(){
    $fp = fopen("./hw4/src/resources/active_image.txt", 'r+');
    while (!flock($fp, LOCK_EX)) //could result in a deadlock maybe???
    {
      //wait until we can acquire the lock
      continue;
    }
    $order = ['0', '1', '2', '3', '4', '5', '6', '7', '8'];
    for($i = 0; $i <= 7; $i++)
    {
      $j = rand($i, 8);
      //swap i and j
      $hold = $order[$j];
      $order[$j] = $order[$i];
      $order[$i] = $hold;
    }
    $writeMe = implode($order);
    fseek($fp, 0);
    fwrite($fp, $writeMe);
    //unlock files
    flock($fp, LOCK_UN);
  }
}
