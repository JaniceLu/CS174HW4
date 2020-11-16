<?php

namespace Controllers;
use Views\LandingView as LandingView;
use Models\ImageTools as ImageTools;

class LandingAdapter extends Adapter
{
    private $view;
    private $model;

    function run(){

      $this->view->render();
    }

    function __construct()
    {
      $this->model= new ImageTools();
      $this->view = new LandingView($this->model->getOrder());

    }
}
