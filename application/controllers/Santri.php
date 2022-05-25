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

        // GET BY NIK WALI
        public function getVwSantriDetailByNIKWali_get ()
        {
            $NIKWali = $this-> get ('NIKWali');
            $data = $this->mSantri->getVwSantriDetailByNIKWali($NIKWali);

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

        public function createSantri_post()
        {
            $data = [
                'NIS'               => $this -> post ('NIS'),
                'NamaLengkap'       => $this -> post ('NamaLengkap'),
                'NamaPanggilan'     => $this -> post ('NamaPanggilan'),
                'TempatLahir'       => $this -> post ('TempatLahir'),
                'TanggalLahir'      => $this -> post ('TanggalLahir'),
                'NIK'               => $this -> post ('NIK'),
                'JenisKelamin'      => $this -> post ('JenisKelamin'),
                'AnakKe'            => $this -> post ('AnakKe'),
                'DariBerapaSaudara' => $this -> post ('DariBerapaSaudara'),
                'TinggiBadan'       => $this -> post ('TinggiBadan'),
                'BeratBadan'        => $this -> post ('BeratBadan'),
                'AlamatSantri' 		=> $this -> post ('AlamatSantri'),
			    'AsalSekolah' 		=> $this -> post ('AsalSekolah'),
                'UkuranBaju'        => $this -> post ('UkuranBaju'),
                'UkuranCelana'      => $this -> post ('UkuranCelana'),
                'UkuranJilbab'      => $this -> post ('UkuranJilbab'),
                'NIKAyah'           => $this -> post ('NIKAyah'),
                'NIKIBU'            => $this -> post ('NIKIBU'),
                'NIKWali'           => $this -> post ('NIKWali'),
                'KuotaIzin'         => $this -> post ('KuotaIzin'),
                'CreatedBy'         => $this -> post ('CreatedBy'),
                'CreatedDate'       => $this -> post ('CreatedDate'),
                'ModifiedBy'        => $this -> post ('ModifiedBy'),
                'ModifiedDate'      => $this -> post ('ModifiedDate'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mSantri->createSantri($data) > 0) 
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

        public function createOrangTua_post()
        {
            $data = [
                
                'NIK'                   => $this -> post ('NIK'),
                'NamaLengkap'           => $this -> post ('NamaLengkap'),
                'TempatLahir'           => $this -> post ('TempatLahir'),
                'TanggalLahir'          => $this -> post ('TanggalLahir'),
                'PendidikanTerakhir'    => $this -> post ('PendidikanTerakhir'),
                'Pekerjaan'             => $this -> post ('Pekerjaan'),
                'PenghasilanPerBulan'   => $this -> post ('PenghasilanPerBulan'),
                'NomorHandphone'        => $this -> post ('NomorHandphone'),
                'Alamat'                => $this -> post ('Alamat'),
                'Email'                 => $this -> post ('Email'),
                'CreatedBy'             => $this -> post ('CreatedBy'),
                'CreatedDate'           => $this -> post ('CreatedDate'),
                'ModifiedBy'            => $this -> post ('ModifiedBy'),
                'ModifiedDate'          => $this -> post ('ModifiedDate'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mSantri->createOrangTua($data) > 0) 
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

        public function updateOrangTua_put()
        {
            $NIK = $this->put('NIK');
            $data = [
                'NamaLengkap'           => $this -> put ('NamaLengkap'),
                'TempatLahir'           => $this -> put ('TempatLahir'),
                'TanggalLahir'          => $this -> put ('TanggalLahir'),
                'PendidikanTerakhir'    => $this -> put ('PendidikanTerakhir'),
                'Pekerjaan'             => $this -> put ('Pekerjaan'),
                'PenghasilanPerBulan'   => $this -> put ('PenghasilanPerBulan'),
                'NomorHandphone'        => $this -> put ('NomorHandphone'),
                'Alamat'                => $this -> put ('Alamat'),
                'Email'                 => $this -> put ('Email'),
                'ModifiedBy'            => $this -> put ('ModifiedBy'),
                'ModifiedDate'          => $this -> put ('ModifiedDate'),
            ];

            if ($this->mSantri->updateOrangTua($data, $NIK) > 0) 
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