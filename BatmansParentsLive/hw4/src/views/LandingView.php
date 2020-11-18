<?php
namespace BatmansParentsLive\hw4\Views;

use BatmansParentsLive\hw4\Layouts\Header as header;

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
      <div class="puzzle" id="puzzle">
        <script src="./hw4/src/views/helpers/getOrder.js" language="text/javascript">
          getOrder(<?=json_encode($this->order); ?>);
        </script>
      </div>
    <?php
  }

  function __construct($arr)
  {
    $this->order = $arr;
  }

}
