<?php

namespace BatmansParentsLive\hw4\Models;

class UploadTools
{
  private $directory = "hw4/src/resources/";
  function checkImage($logger)
  {

    $file = $this->directory . basename($_FILES["imageToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
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

  function uploadImage($logger){
    $upload_destination = "./" . $this->directory . basename($_FILES["imageToUpload"]["name"]);
    echo $upload_destination;
    $fileType = strtolower(pathinfo($upload_destination, PATHINFO_EXTENSION));
    if(isset($_POST["submit"]))
    {
      $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
      if($check == false)
      {
        $logger->error("File is not an image. Upload failed");
        return 0;
      }
      else
      {
        if(move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $upload_destination))
        {
          $newImageName = "./hw4/src/resources/active_image.jpg";
          if(rename($upload_destination, $newImageName))
          {
            return 1;
          }
          else {
            $logger->error("Error changing file name.");
            return 0;
          }
        }
        else
        {
          $logger->error("Error uploading file.");
          return 0;
        }
      }
    }



  }

  function convertImage(){
    $dimensions = 360; // 360px as per Requirements
    $filePath = realpath($_FILES["imageToUpload"]["tmp_name"]);
    list($origWidth, $origHeight) = getimagesize($filePath);
    $source = imagecreatefromjpeg($_FILES["imageToUpload"]["name"]);
    $destination = imagecreatetruecolor($dimensions, $dimensions);

    imagecopyresized($destination, $source, 0, 0, 0, 0, $dimensions, $dimensions, $origWidth, $origHeight);
    imagejpeg($output);
  }
}
