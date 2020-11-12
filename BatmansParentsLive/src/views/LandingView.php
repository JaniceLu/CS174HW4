<?php
namespace Views;

use Views\Layouts\header as header;

class LandingView extends View
{

  public function render(){
    $header = new header();
    $header->render();
  }
}
