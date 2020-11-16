<?php

namespace Controllers;
use Views\ImageView as ImageView;
use Models\ImageTools as ImageTools;

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
