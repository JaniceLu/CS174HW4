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
    if (isset($_POST["submit"])) {
      // limit to 2MB
      if($_FILES["imageToUpload"]["size"] > 2000000) {
        $logger->error("File exceeds 2MB limit.");
        return 0;
      }
      // limit to jpg, png, gif
      if($fileType != "jpg" && $fileType != "png" && $fileType != "gif") {
        $logger->error("File extension \"" . $fileType . "\" is not a supported format.");
        return 0;
      }
      return 1;
    }
  }

  function uploadImage($logger){
    $upload_destination = "./" . $this->directory . basename($_FILES["imageToUpload"]["name"]);
    $fileType = strtolower(pathinfo($upload_destination, PATHINFO_EXTENSION));
    if(isset($_POST["submit"]))
    {
      $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
      if($check == false) {
        $logger->error("File is not an image. Upload failed");
        return 0;
      }
      else {
        if(move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $upload_destination)) {
          $newImageName = "./hw4/src/resources/active_image.jpg";
          if(rename($upload_destination, $newImageName)) {
            return 1;
          }
          else {
            $logger->error("Error changing file name.");
            return 0;
          }
        }
        else {
          $logger->error("Error uploading file.");
          return 0;
        }
      }
    }



  }

  function convertImage(){
    $dimensions = 360; // 360px as per Requirements
    $newImageName = "./hw4/src/resources/active_image.jpg";
    list($origWidth, $origHeight) = getimagesize($newImageName);
    $source = imagecreatefromjpeg($newImageName);
    $destination = imagecreatetruecolor($dimensions, $dimensions);
    if(imagecopyresized($destination, $source, 0, 0, 0, 0, $dimensions, $dimensions, $origWidth, $origHeight)) {
      echo "changed";
      return 1;
    }
    else {
      return 0;
    }
  }
}
