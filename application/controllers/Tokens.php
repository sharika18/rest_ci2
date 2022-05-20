<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Tokens extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelTokens','mTokens'); 
            
        }

        public function createTokens_post()
        {
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'token' => $this -> post ('token'),
                'userId' => $this -> post ('userId'),
                'CreatedDate' => $this -> post ('CreatedDate'),
                'ModifiedBy' => $this -> post ('ModifiedBy'),
                'ModifiedDate' => $this -> post ('ModifiedDate'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mTokens->createTokens($data) > 0) 
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

        public function getTokensByTokenUserId_get()
        {
            $token = $this-> get ('token');
            $userId = $this-> get ('userId');
            $data = $this->mTokens->getTokensByTokenUserId($token, $userId);

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