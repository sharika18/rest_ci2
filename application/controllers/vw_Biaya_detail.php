<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class vw_Biaya_detail extends RestController
    {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            # mahasiswa alias Mahasiswa_model... 
            $this->load->model('Model_vw_biaya_detail','mbiayadetail'); 
            # contoh menggunakan limit...
            //$this->methods['index_get']['limit'] = 2;
            
        }

        public function index_get()
        {
            $jenjang = $this-> get('jenjang');
            $status = $this-> get('status');

            if($jenjang == null && $status == null)
            {
                $biayadetail = $this->mbiayadetail->getAllBiayaDetail();
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
    }

    