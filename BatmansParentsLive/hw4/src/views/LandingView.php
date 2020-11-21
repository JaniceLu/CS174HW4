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
        <label for="filename">New Image: <input type="text" id="filename" onclick="browse()"/></label>
        <label class="upload"><input style="display: none;" id="filelocation" type="file"  onchange="update()"></label>
        <label for="submitImage"><input type="button" value="Upload" name="submit" onclick="validateFile()"></label>
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

        function update(){
          var uploadFile = document.getElementById("filename");
          var input = document.getElementById("filelocation");
          uploadFile.value = input.value;
        }

        function validateFile(){
          var input = document.getElementById("filelocation");

          var uploadFilePath = input.value;
          var fileExt = uploadFilePath.split('.').pop();
          var returnMsg = "";
          var returnStatus = 1;
          if(!fileExt.match(/(png|jpg|gif)$/))
          {
              returnStatus = 0;
              alert("Not an image. Upload failed.");
          }
          var uploadFileSize = input.files[0].size / 1024 / 1204;
          if(uploadFileSize > 2)
          {
            returnStatus = 0;
            alert('File size is larger than 2 MB. Upload Failed.');
          }
          if(returnStatus)
          {
            document.form.submit();
          }
        }

        function browse(){
          var fileInput = document.getElementById("filelocation");
          fileInput.click();
        }

        function swap(docID){
            //see if puzzle is solved
            var order = "012345678";
            request = new XMLHttpRequest();
            request.onreadystatechange = function()
            {
              order = request.responseText;
            }
            request.open("GET", "./index.php?c=order", false);
            request.send();
            if (order == "012345678")
            {
              alert("congrats! Now do it again");
              puzzleify();
            }
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
                request = new XMLHttpRequest();
                solved = 0;
                request.onreadystatechange = function()
                {
                  solved = request.responseText;
                }
                request.open("GET", "./index.php?c=swap&i="+i+"&j="+docID, false);
                request.send();
                puzzleify();
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
