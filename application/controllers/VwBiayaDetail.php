<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class VwBiayaDetail extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Model_VwBiayaDetail','mbiayadetail'); 
            
        }

        public function index_get()
        {
            $id = $this-> get('id');
            $jenjang = $this-> get('jenjang');
            $status = $this-> get('status');

            if($id == null && $jenjang == null && $status == null)
            {
                $biayadetail = $this->mbiayadetail->getAllBiayaDetail();
            }
            else if($id != null)
            {
                $biayadetail = $this->mbiayadetail->getBiayaDetailByID($id);
            }
            else
            {
                $biayadetail = $this->mbiayadetail->getBiayaDetailByJenjang($status, $jenjang);
            }

            $lastquery  = $this->db->last_query();
            if($biayadetail)
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'data'      => $biayadetail
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

        public function DataByStatus_get()
        {
            $status = $this-> get('status');

            $biayadetail = $this->mbiayadetail->getBiayaDetailByStatus($status);

            $lastquery  = $this->db->last_query();
            if($biayadetail)
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'data'      => $biayadetail
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
