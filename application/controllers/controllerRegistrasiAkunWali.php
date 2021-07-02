<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class controllerRegistrasiAkunWali extends RestController
    {
        public function __construct()
        {
            // Construct the parent class
            include "construct.php";
            parent::__construct();
            $this->load->model('modelRegistrasiAkunWali', 'model');
            $this->load->model('modelWali', 'modelWali');
        }

        public function insertRegistrasiAkunWali_post()
        {
            $NIK = $this -> post ('pNIK');
            $data = [
                'pNamaLengkap'  => $this -> post ('pNamaLengkap'),
                'pNIK'          => $this -> post ('pNIK'),
                'pNoHandphone'  => $this -> post ('pNoHandphone'),
                'pAlamat'       => $this -> post ('pAlamat'),
                'pUserName'     => $this -> post ('pUserName'),
                'pPassword'     => $this -> post ('pPassword'),
                'pCreatedBy'    => $this -> post ('pCreatedBy')
            ];

            $countWali = $this->modelWali->countWaliByNIK($NIK);

            $responseData =    [
                'status' => false,
                'countWali' => $countWali[0]['countWali'],
                'message' => 'failed create data'
            ]; 
            $responseStatusCode= 404;

            If($countWali[0]['countWali'] <= 0)
            {
                $responseModel = $this->model->insertRegistrasiAkunWali($data);
            
                if ($responseModel) 
                {
                    $responseData =   [
                            'status'    => true,
                            'countWali' => $countWali[0]['countWali'],
                            'message'   => 'Data has been created'
                        ];
                    $responseStatusCode= 201; 
                }
            }

            $this->response($responseData,  $responseStatusCode);
        }
    }