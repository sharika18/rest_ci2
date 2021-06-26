<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class controllerRole extends RestController
    {
        public function __construct()
        {
            // Construct the parent class
            parent::__construct();
            $this->load->model('modelRole', 'model');
        }

        public function getRoleAll_get()
        {
            $data = $this->model->getRoleAll();
            $lastquery  = $this->db->last_query();
            if($data)
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'data'      => $data
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'Data is empty',
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }