<?php

namespace BatmansParentsLive\hw4\Models;

class UploadTools
{
  function uploadImage($image)
  {
    $directory = "/hw4/src/resources/";
    $file = $directory . basename($_FILES["imageToUpload"]["name"]);
    $fileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    $uploadPass = 1;
    $returnMsg = "";
    if (isset($_POST("submit")))
    {
      $checkSize = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
      if($checkSize !== false) // limit to only images
      {
        $returnMsg = "Not an image. Upload failed.";
        $uploadPass = 0;
      }
      if($_FILES["imageToUpload"]["size"] > 2000000) // limit to 2MB
      {
        $returnMsg = "Image too large. Upload failed.";
        $uploadPass = 0;
      }
      if($fileType != "jpg" && $fileType != "png" && $fileType != "gif")
      {
        $returnMsg = "Not the correct format. Must be .jpg, .png, .gif. Upload failed.";
        $uploadPass = 0;
      }
    }
  }
}
