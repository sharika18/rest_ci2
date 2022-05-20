<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Karyawan extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelKaryawan','mKaryawan'); 
            
        }

        public function getAllKaryawan_get()
        {
            
            $data = $this->mKaryawan->getAllKaryawan();

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

        public function getKaryawanByKaryawanID_get()
        {
            $karyawanID = $this-> get ('karyawanID');
            $data = $this->mKaryawan->getKaryawanByKaryawanID($karyawanID);

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

        public function getKaryawanByNIP_get()
        {
            $NIP = $this-> get ('NIP');
            $data = $this->mKaryawan->getKaryawanByNIP($NIP);

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

        public function getVwKaryawanDetail_get()
        {
            
            $data = $this->mKaryawan->getVwKaryawanDetail();

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
        
        public function getVwKaryawanDetailByNIP_get()
        {
            $NIP = $this-> get ('NIP');
            $data = $this->mKaryawan->getVwKaryawanDetailByNIP($NIP);

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

        public function getNoUrutKaryawanByTMT_get()
        {
            $TMT = $this-> get ('TMT');
            $data = $this->mKaryawan->getNoUrutKaryawanByTMT($TMT);

            $lastquery  = $this->db->last_query();
            if($data)
            {
                $noUrut = $data[0]['NoUrut'];
                $lengthNourut = strlen((string)$noUrut);
                
                if($lengthNourut == 1)
                {
                    $noUrut = "000".$noUrut;
                }else if($lengthNourut == 2)
                {
                    $noUrut = "00".$noUrut;
                }else if($lengthNourut == 3)
                {
                    $noUrut = "0".$noUrut;
                }
                else if($lengthNourut == 4)
                {
                    $noUrut = $noUrut;
                }

                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $noUrut
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

        public function createKaryawan_post()
        {
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'NIP'               => $this -> post ('NIP'),
                'TanggalMulaiTugas' => $this -> post ('TanggalMulaiTugas'),
                'NamaLengkap'       => $this -> post ('NamaLengkap'),
                'Email'             => $this -> post ('Email'),
                'jabatanTugasID'    => $this -> post ('jabatanTugasID'),
                'unitID'            => $this -> post ('unitID'),
                'statusID'          => $this -> post ('statusID'),
                'pedidikanID'       => $this -> post ('pendidikanID'),
                'CreatedBy'         => $this -> post ('CreatedBy'),
                'CreatedDate'       => $this -> post ('CreatedDate'),
                'ModifiedBy'        => $this -> post ('ModifiedBy'),
                'ModifiedDate'      => $this -> post ('ModifiedDate'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mKaryawan->createKaryawan($data) > 0) 
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

        public function updateKaryawan_put()
        {
            $id = $this->put('id');
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'NIP' => $this -> put ('NIP'),
                'NamaLengkap' => $this -> put ('NamaLengkap'),
                'Email' => $this -> put ('Email'),
                'jabatanTugasID' => $this -> put ('jabatanTugasID'),
                'unitID' => $this -> put ('unitID'),
                'statusID' => $this -> put ('statusID'),
                'CreatedBy' => $this -> put ('CreatedBy'),
                'CreatedDate' => $this -> put ('CreatedDate'),
                'ModifiedBy' => $this -> put ('ModifiedBy'),
                'ModifiedDate' => $this -> put ('ModifiedDate'),
            ];

            if ($this->mKaryawan->updateKaryawan($data, $id) > 0) 
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

        public function deleteKaryawan_delete()
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
                if ($this->mKaryawan->deleteKaryawan($id) > 0) 
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

        public function getCountKaryawanByStatus_get()
        {
            $data = $this->mKaryawan->getCountKaryawanByStatus();

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