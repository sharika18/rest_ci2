<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class User extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelUser','mUser'); 
            
        }
        
        public function index_get()
        {
            $biaya = $this->mUser->getAllUser();

            $lastquery  = $this->db->last_query();
            if($biaya)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $biaya
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

        public function getUserByEmailPassword_get()
        {
            $email = $this-> get ('email');
            $password = $this-> get ('password');
            $data = $this->mUser->getUserByEmailPassword($email, $password);

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

        public function getUserByEmail_get()
        {
            $email = $this-> get ('email');
            $data = $this->mUser->getUserByEmail($email);

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

        public function getUserByUserId_get()
        {
            $userId = $this-> get ('userId');
            $data = $this->mUser->getUserByUserId($userId);

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

        public function createUser_post()
        {
            $data = [
                'userName'              => $this -> post ('userName'),
                'email'                 => $this -> post ('email'),
                'password'              => $this -> post ('password'),
                'NIK'                   => $this -> post ('NIK'),
                'Role'                  => $this -> post ('Role'),
                'CreatedBy'             => $this -> post ('CreatedBy'),
                'CreatedDate'           => $this -> post ('CreatedDate'),
                'ModifiedBy'            => $this -> post ('ModifiedBy'),
                'ModifiedDate'          => $this -> post ('ModifiedDate'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mUser->createUser($data) > 0) 
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'message'   => 'new register has been created'
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

        public function updateUserById_put()
        {
            $id = $this->put('id');
            $data = [
                'Password'     => $this -> put ('Password'),
                'ModifiedBy'    => $this -> put ('ModifiedBy'),
                'ModifiedDate'  => $this -> put ('ModifiedDate'),
            ];

            if ($this->mUser->updateUserById($data, $id) > 0) 
            {
                # ok...
                $this->response([
                    'status' => true,
                    'message' => 'Data has been updated'
                ], 201 /*RestController::HTTP_NO_CONTENT*/ );
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'failed update data'
                ],  400 /*RestController::HTTP_BAD_REQUEST*/);
            }
        }
    }