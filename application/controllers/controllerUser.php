<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class controllerUser extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelUser','model'); 
        }

        public function getUserAll_get()
        {
            $data = $this->model->getUserAll();
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

        public function getUserByNik_get()
        {
            $NIK = $this-> get('NIK');
            $data = $this->model->getUserByNik($NIK);
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
                    'message'   => 'Data not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }