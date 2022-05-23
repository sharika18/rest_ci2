<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Dimension extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('ModelDimension','mDimension'); 
            
        }

        public function getValueByCode_get()
        {
            $code = $this-> get ('code');
            $data = $this->mDimension->getValueByCode($code);

            $lastquery  = $this->db->last_query();
            if($data)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $data
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }