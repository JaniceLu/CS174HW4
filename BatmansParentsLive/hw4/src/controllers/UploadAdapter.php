<?php

namespace BatmansParentsLive\hw4\Controllers;
use BatmansParentsLive\hw4\Views\UploadView as UploadView;
use BatmansParentsLive\hw4\Models\UploadTools as UploadTools;
use BatmansParentsLive\hw4\Models\ImageTools as ImageTools;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class UploadAdapter extends Adapter
{
    private $view;
    private $model;
    private $uploadModel;
    private $logger;

    function run(){
      if(!empty($_POST))
      {
        if(isset($_FILES["imageToUpload"]))
        {
          $uploadFile = $_FILES["imageToUpload"];
          $uploadName = $_FILES["imageToUpload"]["name"];
          $this->logger->notice("Attempting to upload " . $uploadName);
          //check image to see if it meets requirements
          $validateResults = $this->uploadModel->checkImage($this->logger);
          if(!$validateResults) {
            $this->logger->error("Attempt to upload failed. Did not meet upload requirements.");
          }
          else {
            //upload image to server after verifying file meets requirements
            if($this->uploadModel->uploadImage($this->logger)) {
              //change image to be 360x360
              if($this->uploadModel->convertImage($this->logger)) {
                $this->logger->notice("Attempt to upload successful.");
              }
              else {
                $this->logger->error("Attempt to change file dimensions unsuccessful.");
              }
            }
            else {
              $this->logger->error("Attempt to upload unsuccessful.");
            }
          }
        }
        else {
          $this->logger->notice("Attempt to upload failed. Form input did not meet upload requirements.");
        }
      }
      $this->model->shuffleOrder();
      $this->view->render();
    }

    function __construct()
    {
      $this->logger = new Logger('upload_logger');
      $this->logger->pushHandler(new StreamHandler('./hw4/src/resources/jigsaw.log', Logger::DEBUG));
      $this->logger->pushHandler(new FirePHPHandler());
      $this->uploadModel = new UploadTools();
      $this->model= new ImageTools();
      $this->view = new UploadView();
    }
}
