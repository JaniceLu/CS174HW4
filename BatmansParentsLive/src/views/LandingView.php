<?php
namespace Views;

use Views\Layouts\header as header;

class LandingView extends View
{

  public function render(){
    $header = new header();
    $header->render();
    ?>
      <form class="addimage" action="./index.php?c=addImage" method="post" enctype="multipart/form-data">
        <label for="imageToUpload">New Image: <input type="text" id="imageToUpload"></label>
        <label for="submitImage"><input type="submit" value="Upload" name="submit"></label>
      </form>
    <?php
  }
}
