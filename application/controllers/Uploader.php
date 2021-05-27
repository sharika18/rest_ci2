<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Uploader extends RestController
    {
        function __construct()
        {
            include "construct.php";   
        }

        public function upload_post()
        {
            $fileFolder = $this-> post ('fileFolder');
            if(move_uploaded_file($_FILES['file']['tmp_name'], $this->uploadPath.$fileFolder."/".$_FILES['file']['name']))
            {
                $this->response([
                    'status'    => true,
                    'fileName'  => $_FILES['file']['name'],
                    'filePath' => $_FILES['file']['tmp_name'],
                    'message' => 'File Uploaded'
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'message' => 'File Not Uploaded'
                ], RestController::HTTP_OK);
            }
        }
    }