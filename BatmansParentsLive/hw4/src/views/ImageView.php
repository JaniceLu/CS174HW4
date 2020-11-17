<?php
namespace BatmansParentsLive\hw4\Views;

class ImageView extends View
{
  private $image = NULL;
  private $imageSize = NULL;

  public function setImage($im)
  {
    $this->image = $im;
    //$this->imageSize = $im['size'];
  }

  public function render(){
    header("Content-Type: image/jpeg");
    //header("Content-Length: " . $this->imageSize);
    //echo $this->imageSize;
    //fpassthru('php://memory/temp.jpg');
  }
}
