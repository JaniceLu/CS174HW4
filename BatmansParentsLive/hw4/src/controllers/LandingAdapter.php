<?php

namespace BatmansParentsLive\hw4\Controllers;
use BatmansParentsLive\hw4\Views\LandingView as LandingView;
use BatmansParentsLive\hw4\Models\ImageTools as ImageTools;

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
