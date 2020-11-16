<?php
namespace Views;

use Views\Layouts\header as header;

class LandingView extends View
{
  private $order;

  public function render(){
    $header = new header();
    $header->render();
    ?>
      <form class="addimage" action="./index.php?c=addImage" method="post" enctype="multipart/form-data">
        <label for="imageToUpload">New Image: <input type="text" id="imageToUpload"></label>
        <label for="submitImage"><input type="submit" value="Upload" name="submit"></label>
      </form> <br>
      <div class="puzzle0">
        <img src="./index.php?c=image&i=<?php echo $this->order[0]?>">
      </div>
      <div class="puzzle1">
        <img src="./index.php?c=image&i=<?php echo $this->order[1]?>">
      </div>
      <div class="puzzle2">
        <img src="./index.php?c=image&i=<?php echo $this->order[2]?>">
      </div>
      <div class="puzzle3">
        <img src="./index.php?c=image&i=<?php echo $this->order[3]?>">
      </div>
      <div class="puzzle4">
        <img src="./index.php?c=image&i=<?php echo $this->order[4]?>">
      </div>
      <div class="puzzle5">
        <img src="./index.php?c=image&i=<?php echo $this->order[5]?>">
      </div>
      <div class="puzzle6">
        <img src="./index.php?c=image&i=<?php echo $this->order[6]?>">
      </div>
      <div class="puzzle7">
        <img src="./index.php?c=image&i=<?php echo $this->order[7]?>">
      </div>
      <div class="puzzle8">
        <img src="./index.php?c=image&i=<?php echo $this->order[8]?>">
      </div>
    <?php
  }

  function __construct($arr)
  {
    $this->order = $arr;
  }

}
