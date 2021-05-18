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
            $id = $this-> get ('id');
            $status = 1;
            //$this->response([$status]);
            $biayadetail = $this->mbiayadetail->getBiayaDetail($id, $status);

            $lastquery  = $this->db->last_query();
            if($biayadetail)
            {
                // $this->response(
                // $mahasiswa, RestController::HTTP_OK );
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

    