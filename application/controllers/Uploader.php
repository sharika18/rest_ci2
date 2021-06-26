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
            $tanggalUpload = date("Ymd");
            $fileFolder = $this-> post ('fileFolder');
            $filePath = $this->uploadPath.$fileFolder;//."/".$tanggalUpload; $this->folderBuktiPembayaran."/".$tanggalPendaftaran;
            if (!file_exists($filePath)) {
                mkdir($filePath);
            }
            if(move_uploaded_file($_FILES['file']['tmp_name'], $filePath."/".$_FILES['file']['name']))
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

        public function download_get()
        {
            $tanggalUpload = $this-> get ('tanggalUpload');
            $folderPath = $this-> get ('folderPath');
            $fileName = $this-> get ('fileName');

            $filePath = 'assets/uploads/'.$folderPath.'/'.$tanggalUpload.'/'.$fileName;
            $imagedata = file_get_contents($filePath);
            $extension = mime_content_type($filePath);
            $base64 = base64_encode($imagedata);

            $filename ="a";
            $this->response([
                'status'        => true,
                'contentType'   => $extension,
                'data'          => $base64,
            ], RestController::HTTP_OK);
        }
    }