<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Biaya_detail extends RestController
    {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            $this->load->model('Model_biaya_detail','mbiayadetail'); 
            # contoh menggunakan limit...
            //$this->methods['index_get']['limit'] = 2;
            
        }

        public function index_get()
        {
            $id = $this-> get ('id');
    
            if ($id === null) 
            {
                $biayadetail = $this->mbiayadetail->getBiayaDetail();
            }
            else
            {
                $biayadetail = $this->mbiayadetail->getBiayaDetail($id);
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

        public function index_post()
        {
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'Biaya_ID' => $this -> post ('Biaya_ID'),
                'Jenjang' => $this -> post ('Jenjang'),
                'Gelombang' => $this -> post ('Gelombang'),
                'Nominal' => $this -> post ('Nominal'),
                'Ketentuan' => $this -> post ('Ketentuan'),
                'StartDate' => $this -> post ('StartDate'),
                'EndDate' => $this -> post ('EndDate'),
                'CreatedBy' => $this -> post ('CreatedBy'),
                'CreatedDate' => $this -> post ('CreatedDate'),
                'ModifiedBy' => $this -> post ('ModifiedBy'),
                'ModifiedDate' => $this -> post ('ModifiedDate'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mbiayadetail->createBiayaDetail($data) > 0) 
            {
                # ok...
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'message'   => 'new biaya detail has been created'
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

        public function index_delete()
        {
            # code...
            $id =$this->delete('id');

            if ($id === null) 
            {
                # code...
                $this->response([
                    'status'    => false,
                    'message'   => 'provide an id'
                ], RestController::HTTP_BAD_REQUEST);
            }
            else
            {
                if ($this->mbiayadetail->deleteBiayaDetail($id) > 0) 
                {
                    # code...
                    $this->response([
                        'status'    => true,
                        'id'        => $id,
                        'message'   => 'biaya detail deleted'
                    ], RestController::HTTP_OK /*204 RestController::HTTP_NO_CONTENT*/ );
                }
                else
                {
                    #not found
                    $this->response([
                        'status'    => false,
                        'message'   => 'id not found'
                    ], 404 /*RestController::HTTP_NOT_FOUND*/ );
                }
            }
        }

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'Biaya_ID'      => $this -> put ('Biaya_ID'),
                'Jenjang'       => $this -> put ('Jenjang'),
                'Gelombang'     => $this -> put ('Gelombang'),
                'Nominal'       => $this -> put ('Nominal'),
                'Ketentuan'     => $this -> put ('Ketentuan'),
                'StartDate'     => $this -> put ('StartDate'),
                'EndDate'       => $this -> put ('EndDate'),
                'CreatedBy'     => $this -> put ('CreatedBy'),
                'CreatedDate'   => $this -> put ('CreatedDate'),
                'ModifiedBy'    => $this -> put ('ModifiedBy'),
                'ModifiedDate'  => $this -> put ('ModifiedDate'),
            ];

            if ($this->mbiayadetail->updateBiayaDetail($data, $id) > 0) 
            {
                # ok...
                $this->response([
                    'status' => true,
                    'message' => 'Biaya has been updated'
                ], 400 /*RestController::HTTP_NO_CONTENT*/ );
            }
            else
            {
                #failed
                $this->response([
                    'status' => false,
                    'message' => 'failed update biaya'
                ],  400 /*RestController::HTTP_BAD_REQUEST*/);
            }
        }
    }

    