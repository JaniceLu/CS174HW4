<?php

namespace BatmansParentsLive\hw4\Controllers;
use BatmansParentsLive\hw4\Views\LandingView as LandingView;
use BatmansParentsLive\hw4\Models\UploadTools as UploadTools;
use BatmansParentsLive\hw4\Models\ImageTools as ImageTools;
class UploadAdapter extends Adapter
{
    private $view;
    private $model;
    private $imageModel;

    function run(){

      $this->view->render();
    }

    function __construct()
    {
      $this->$imageModel = new UploadTools();
      $this->model= new ImageTools();
      $this->view = new LandingView($this->model->getOrder());

    }
}
