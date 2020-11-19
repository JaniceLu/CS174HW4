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
        <div class='puzzle puzzleLoc0' id='0' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc1' id='1' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc2' id='2' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc3' id='3' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc4' id='4' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc5' id='5' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc6' id='6' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc7' id='7' onclick="swap(this.id)"></div>
        <div class='puzzle puzzleLoc8' id='8' onclick="swap(this.id)"></div>
      </div>
      <script type="text/javascript">
        function swap(docID){
            //see if puzzle is solved

            // check to see if any tiles have the outline class
            var i;
            var selected = false;

            for(i=0; i < 9; i++){ //
              if (document.getElementById(i.toString()).className.includes('outline'))
              {
                selected = true;
                document.getElementById(i.toString()).classList.remove("outline");
                break;
              }
            }

            if (selected)
            {
              //check if i and docID are the same
              if(i == docID)
              {
                //remove outline from docID
                document.getElementById(i.toString()).classList.remove("outline");
              }
              else { // if not the same then these are the two we need to swap

              }

            }
            else //if no give docID tile the outline class
            {
              document.getElementById(docID.toString()).classList.add("outline");
            }
        }

        function puzzleify(){
          var order = "012345678";
          request = new XMLHttpRequest();
          request.onreadystatechange = function()
          {
            console.log(request.requestText)
            order = request.responseText;
          }
          request.open("GET", "./index.php?c=order", false);
          request.send();
          for (var i = 0; i < order.length; i++)
          {
            var outline = ""
            if(document.getElementById(i.toString()).className.includes('outline'))
            {
              outline = " outline";
            }
            c = order.charAt(i);
            document.getElementById(i.toString()).className = 'puzzle puzzleLoc' + i + " puzzlePic" + " piece"+c + outline;
          }
        }
        window.onload = puzzleify();
      </script>
    <?php
  }

  function __construct($arr)
  {
    $this->order = $arr;
  }

}
