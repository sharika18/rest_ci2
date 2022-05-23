<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Santri extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelSantri','mSantri');

        }

        // GET ALL DATA
        public function getAllVwSantriDetail_get()
        {
            $data = $this->mSantri->getAllVwSantriDetail();

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

        // GET BY NIS
        public function getVwSantriDetailByNIS_get ()
        {
            $NIS = $this-> get ('NIS');
            $data = $this->mSantri->getVwSantriDetailByNIS($NIS);

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

        public function getOrangTuaByNIK_get ()
        {
            $NIK = $this-> get ('NIK');
            $data = $this->mSantri->getOrangTuaByNIK($NIK);

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