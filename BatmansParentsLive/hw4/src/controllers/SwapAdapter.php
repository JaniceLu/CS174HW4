<?php

namespace BatmansParentsLive\hw4\Controllers;
use BatmansParentsLive\hw4\Models\ImageTools as ImageTools;

class SwapAdapter extends Adapter
{
    private $model;
    private $i;
    private $j;

    function run(){
      $this->model->swap($this->i, $this->j);
    }

    function __construct()
    {
      $this->model = new ImageTools();

      if(!empty($_GET['i'])){
        $this->i = $_GET['i'];
      }
      else{
        $this->i = 0;//assume 0 if it's empty
      }

      if(!empty($_GET['j'])){
        $this->j = $_GET['j'];
      }
      else{
        $this->j = 0;
      }
    }
}
