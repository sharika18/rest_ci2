<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class KelasAsrama extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelKelasAsrama','mKelasAsrama');

        }

        //KAMAR
            public function getAllAsrama_get()
            {
                $data = $this->mKelasAsrama->getAllAsrama();

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

            public function getAllVwKamarDetail_get()
            {
                $data = $this->mKelasAsrama->getAllVwKamarDetail();

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

            public function getDistinctAnggota_get()
            {
                $data = $this->mKelasAsrama->getDistinctAnggota();

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

            public function getDistinctAnggotaByKamarID_get ()
            {
                $KamarID = $this-> get ('KamarID');
                $data = $this->mKelasAsrama->getDistinctAnggotaByKamarID($KamarID);
    
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

            public function getAllVwKamarDetailByAsramaID_get ()
            {
                $AsramaID = $this-> get ('AsramaID');
                $data = $this->mKelasAsrama->getAllVwKamarDetailByAsramaID($AsramaID);
    
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

            public function getNamaAsramaByKamarID_get ()
            {
                $KamarID = $this-> get ('KamarID');
                $data = $this->mKelasAsrama->getNamaAsramaByKamarID($KamarID);
    
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

            public function getAllVwKamarDetailByNIS_get ()
            {
                $NIS = $this-> get ('NIS');
                $data = $this->mKelasAsrama->getAllVwKamarDetailByNIS($NIS);
    
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

            public function createAsrama_post()
            {
                $data = [
                    'NamaAsrama'                => $this -> post ('NamaAsrama'),
                    'NIPPenanggungJawabAsrama'  => $this -> post ('NIPPenanggungJawabAsrama'),
                    'CreatedBy'                 => $this -> post ('CreatedBy'),
                    'CreatedDate'               => $this -> post ('CreatedDate'),
                    'ModifiedBy'                => $this -> post ('ModifiedBy'),
                    'ModifiedDate'              => $this -> post ('ModifiedDate'),
                ];
    
                $lastquery  = $this->db->last_query();
                
                if ($this->mKelasAsrama->createAsrama($data) > 0) 
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

            public function createKamar_post()
            {
                $data = [
                    'AsramaID'          => $this -> post ('AsramaID'),
                    'NamaKamar'         => $this -> post ('NamaKamar'),
                    'CreatedBy'         => $this -> post ('CreatedBy'),
                    'CreatedDate'       => $this -> post ('CreatedDate'),
                    'ModifiedBy'        => $this -> post ('ModifiedBy'),
                    'ModifiedDate'      => $this -> post ('ModifiedDate'),
                ];
    
                $lastquery  = $this->db->last_query();
                
                if ($this->mKelasAsrama->createKamar($data) > 0) 
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
            
            public function createAnggotaKamar_post()
            {
                $data = [
                    'KamarID'          => $this -> post ('KamarID'),
                    'NISAnggotaKamar'  => $this -> post ('NISAnggotaKamar'),
                    'StatusAnggota'    => $this -> post ('StatusAnggota'),
                    'CreatedBy'        => $this -> post ('CreatedBy'),
                    'CreatedDate'      => $this -> post ('CreatedDate'),
                    'ModifiedBy'       => $this -> post ('ModifiedBy'),
                    'ModifiedDate'     => $this -> post ('ModifiedDate'),
                ];
    
                $lastquery  = $this->db->last_query();
                
                if ($this->mKelasAsrama->createAnggotaKamar($data) > 0) 
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

            public function updateAsrama_put()
            {
                $AsramaID = $this->put('AsramaID');
                $data = [
                    'NamaAsrama'                => $this -> put ('NamaAsrama'),
                    'NIPPenanggungJawabAsrama'  => $this -> put ('NIPPenanggungJawabAsrama'),
                    'ModifiedBy'                => $this -> put ('ModifiedBy'),
                    'ModifiedDate'              => $this -> put ('ModifiedDate'),
                ];
    
                $lastquery  = $this->db->last_query();
                
                if ($this->mKelasAsrama->updateAsrama($data, $AsramaID) > 0) 
                {
                    $this->response([
                        'status'    => true,
                        'query'     => $lastquery,
                        'message'   => 'new register has been updated'
                    ], 201 /*RestController::HTTP_updateD*/);
                }
                else
                {
                    # not ok
                    $this->response([
                        'status' => false,
                        'message' => 'failed update data'
                    ],  400 /*RestController::HTTP_BAD_REQUEST*/);
                }
            }

            public function updateKamar_put()
            {
                $KamarID = $this->put('KamarID');
                $data = [
                    'AsramaID'          => $this -> put('AsramaID'),
                    'NamaKamar'        => $this -> put('NamaKamar'),
                    'ModifiedBy'        => $this -> put('ModifiedBy'),
                    'ModifiedDate'      => $this -> put('ModifiedDate'),
                ];
    
                $lastquery  = $this->db->last_query();
                
                if ($this->mKelasAsrama->updateKamar($data, $KamarID) > 0) 
                {
                    $this->response([
                        'status'    => true,
                        'query'     => $lastquery,
                        'message'   => 'new register has been updated'
                    ], 201 /*RestController::HTTP_updateD*/);
                }
                else
                {
                    # not ok
                    $this->response([
                        'status' => false,
                        'message' => 'failed update data'
                    ],  400 /*RestController::HTTP_BAD_REQUEST*/);
                }
            }
            
            public function updateAnggotaKamar_put()
            {
                $AnggotaKamarID = $this->put('AnggotaKamarID');
                $data = [
                    'KamarID'          => $this -> put ('KamarID'),
                    'NISAnggotaKamar'  => $this -> put ('NISAnggotaKamar'),
                    'StatusAnggota'    => $this -> put ('StatusAnggota'),
                    'updatedBy'        => $this -> put ('updatedBy'),
                    'updatedDate'      => $this -> put ('updatedDate'),
                    'ModifiedBy'       => $this -> put ('ModifiedBy'),
                    'ModifiedDate'     => $this -> put ('ModifiedDate'),
                ];
    
                $lastquery  = $this->db->last_query();
                
                if ($this->mKelasAsrama->updateAnggotaKamar($data, $AnggotaKamarID) > 0) 
                {
                    $this->response([
                        'status'    => true,
                        'query'     => $lastquery,
                        'message'   => 'new register has been updated'
                    ], 201 /*RestController::HTTP_updateD*/);
                }
                else
                {
                    # not ok
                    $this->response([
                        'status' => false,
                        'message' => 'failed update data'
                    ],  400 /*RestController::HTTP_BAD_REQUEST*/);
                }
            }

            public function deleteAnggotaKamar_delete()
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
                    if ($this->mKelasAsrama->deleteAnggotaKamar($id) > 0) 
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
    }