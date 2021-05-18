<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Biaya extends RestController
    {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            # mbiaya alias Model_biaya... 
            $this->load->model('Model_biaya','mbiaya'); 
            # contoh menggunakan limit...
            //$this->methods['index_get']['limit'] = 2;
            
        }

        public function index_get()
        {
            $id = $this-> get ('id');
    
            if ($id === null) 
            {
                $biaya = $this->mbiaya->getBiaya();
            }
            else
            {
                $biaya = $this->mbiaya->getBiaya($id);
            }

            $lastquery  = $this->db->last_query();
            if($biaya)
            {
                $this->response([
                    'status'    => true,
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
                # mahasiswa alias Mahasiswa_model...  
                if ($this->mbiaya->deleteBiaya($id) > 0) 
                {
                    # code...
                    $this->response([
                        'status'    => true,
                        'id'        => $id,
                        'message'   => 'Data deleted'
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
        
        public function index_post()
        {
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'Deskripsi' => $this -> post ('Deskripsi'),
                'CreatedBy' => $this -> post ('CreatedBy'),
                'CreatedDate' => $this -> post ('CreatedDate'),
                'ModifiedBy' => $this -> post ('ModifiedBy'),
                'ModifiedDate' => $this -> post ('ModifiedDate'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mbiaya->createBiaya($data) > 0) 
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

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'Deskripsi'     => $this -> put ('Deskripsi'),
                'CreatedBy'     => $this -> put ('CreatedBy'),
                'CreatedDate'   => $this -> put ('CreatedDate'),
                'ModifiedBy'    => $this -> put ('ModifiedBy'),
                'ModifiedDate'  => $this -> put ('ModifiedDate'),
            ];

            if ($this->mbiaya->updateBiaya($data, $id) > 0) 
            {
                # ok...
                $this->response([
                    'status' => true,
                    'message' => 'Data has been updated'
                ], 201 /*RestController::HTTP_NO_CONTENT*/ );
            }
            else
            {
                #failed
                $this->response([
                    'status' => false,
                    'message' => 'failed update data'
                ],  400 /*RestController::HTTP_BAD_REQUEST*/);
            }
        }
    }