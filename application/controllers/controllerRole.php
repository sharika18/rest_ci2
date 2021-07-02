<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class controllerRole extends RestController
    {
        public function __construct()
        {
            // Construct the parent class
            include "construct.php";
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

        public function createRole_post()
        {
            //date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'namaRole'      => $this -> post ('namaRole'),
                'CreatedDate'   => $now,
                'CreatedBy'     => $this -> post ('CreatedBy'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->model->createRole($data) > 0) 
            {
                # ok...
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'message'   => 'Data has been created'
                ], 201 /*RestController::HTTP_CREATED*/);
            }
            else
            {
                # not ok
                $this->response([
                    'status' => false,
                    'message' => 'failed create data'
                ],  400 /*RestController::HTTP_BAD_REQUEST*/);
            }
        }
    }