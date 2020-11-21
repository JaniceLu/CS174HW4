<?php

namespace BatmansParentsLive\hw4\Models;

class UploadTools
{
  function checkImage($logger, $image)
  {
    $directory = "./hw4/src/resources/";
    $file = $directory . basename($_FILES["imageToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    $uploadPass = 1;
    $returnMsg = "";
    if (isset($_POST["submit"]))
    {
      if($_FILES["imageToUpload"]["size"] > 2000000) // limit to 2MB
      {
        $logger->error("File exceeds 2MB limit.");
        return 0;
      }
      if($fileType != "jpg" && $fileType != "png" && $fileType != "gif") // limit to jpg, png, gif
      {
        $logger->error("File extension \"" . $fileType . "\" is not a supported format.");
        return 0;
      }
      return 1;
    }
  }
}
