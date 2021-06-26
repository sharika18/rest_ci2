<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class role extends RestController
    {
        public function __construct()
        {
            // Construct the parent class
            parent::__construct();
            $this->load->model('modelRole', 'mRole');
        }

        public function index_get()
        {
            $id = $this-> get ('id');
    
            if ($id === null) 
            {
                $role = $this->mRole->getRole();
            }
            else
            {
                $role = $this->mRole->getRole($id);
            }

            $lastquery  = $this->db->last_query();
            if($role)
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'data'      => $role
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