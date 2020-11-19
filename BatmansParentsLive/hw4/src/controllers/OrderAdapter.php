<?php

namespace BatmansParentsLive\hw4\Controllers;
use BatmansParentsLive\hw4\Views\OrderView as OrderView;
use BatmansParentsLive\hw4\Models\ImageTools as ImageTools;

class OrderAdapter extends Adapter
{
    private $view;
    private $model;

    function run(){

      $this->view->render();
    }

    function __construct()
    {
      $this->model= new ImageTools();
      $this->view = new OrderView($this->model->getOrder());

    }
}
