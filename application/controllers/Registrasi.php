<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Registrasi extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Model_Registrasi','mregistrasi');             
        }

        public function index_get()
        {
            $id = $this-> get ('id');
    
            if ($id === null) 
            {
                $registrasi = $this->mregistrasi->getRegistrasi();
            }
            else
            {
                $registrasi = $this->mregistrasi->getRegistrasi($id);
            }

            $lastquery  = $this->db->last_query();
            if($registrasi)
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'data'      => $registrasi
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
                'Biaya_Detail_ID'  => $this -> post ('Biaya_Detail_ID'),
                'DeskripsiBiaya'    => $this -> post ('DeskripsiBiaya'),
                'Jenjang'           => $this -> post ('Jenjang'),
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
                'UkuranBaju'        => $this -> post ('UkuranBaju'),
                'UkuranCelana'      => $this -> post ('UkuranCelana'),
                'UkuranJilbab'      => $this -> post ('UkuranJilbab'),
                'AyahNama'          => $this -> post ('AyahNama'),
                'AyahNIK'           => $this -> post ('AyahNIK'),
                'AyahTempatLahir'   => $this -> post ('AyahTempatLahir'),
                'AyahTanggalLahir'  => $this -> post ('AyahTanggalLahir'),
                'AyahPendidikan'    => $this -> post ('AyahPendidikan'),
                'AyahPekerjaan'     => $this -> post ('AyahPekerjaan'),
                'AyahPenghasilan'   => $this -> post ('AyahPenghasilan'),
                'AyahHP'            => $this -> post ('AyahHP'),
                'IbuNama'           => $this -> post ('IbuNama'),
                'IbuNIK'            => $this -> post ('IbuNIK'),
                'IbuTempatLahir'    => $this -> post ('IbuTempatLahir'),
                'IbuTanggalLahir'   => $this -> post ('IbuTanggalLahir'),
                'IbuPendidikan'     => $this -> post ('IbuPendidikan'),
                'IbuPekerjaan'      => $this -> post ('IbuPekerjaan'),
                'IbuPenghasilan'    => $this -> post ('IbuPenghasilan'),
                'IbuHP'             => $this -> post ('IbuHP'),
                'WaliNama'          => $this -> post ('WaliNama'),
                'WaliNIK'           => $this -> post ('WaliNIK'),
                'WaliTempatLahir'   => $this -> post ('WaliTempatLahir'),
                'WaliTanggalLahir'  => $this -> post ('WaliTanggalLahir'),
                'WaliPendidikan'    => $this -> post ('WaliPendidikan'),
                'WaliPekerjaan'     => $this -> post ('WaliPekerjaan'),
                'WaliPenghasilan'   => $this -> post ('WaliPenghasilan'),
                'WaliHP'            => $this -> post ('WaliHP'),
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mregistrasi->createRegistrasi($data) > 0) 
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
                if ($this->mregistrasi->deleteRegistrasi($id) > 0) 
                {
                    # code...
                    $this->response([
                        'status'    => true,
                        'id'        => $id,
                        'message'   => 'Registrasi deleted'
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