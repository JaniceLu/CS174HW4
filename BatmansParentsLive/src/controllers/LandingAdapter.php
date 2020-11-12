<?php

namespace Controllers;
use Views\LandingView as LandingView;

class LandingAdapter extends Adapter
{
    private $view;

    function run(){
      $this->view->render();
    }

    function __construct()
    {
      $this->view = new LandingView();
    }
}
