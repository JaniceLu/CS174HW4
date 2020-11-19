<?php
namespace BatmansParentsLive\hw4\Views;

class OrderView extends View
{
  private $order;


  public function render(){
    echo $this->order;
  }

  function __construct($order)
  {
    $this->order = implode($order);
  }
}
