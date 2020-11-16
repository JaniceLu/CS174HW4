<?php

namespace BatmansParentsLive\hw4\Controllers;
use BatmansParentsLive\hw4\Views\ImageView as ImageView;
use BatmansParentsLive\hw4\Models\ImageTools as ImageTools;

class ImageAdapter extends Adapter
{
    private $view;
    private $model;
    private $index;

    function run(){
      $this->view->render();
      $this->model->LoadJpeg($this->index);
    }

    function __construct()
    {
      $this->view = new ImageView();
      $this->model = new ImageTools();
      if(!empty($_GET['i'])){
        $this->index = $_GET['i'];
      }
      else{
        $this->index = 0;
      }
    }
}
