<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Registrasi extends RestController
    {
        function __construct()
        {
            include "construct.php";
            $this->load->model('Model_Registrasi','mregistrasi');             
        }

        public function upload_post()
        {
            $fileFolder = $this-> post ('fileFolder');
            if(move_uploaded_file($_FILES['file']['tmp_name'], $this->uploadPath.$fileFolder."/".$_FILES['file']['name']))
            {
                $this->response([
                    'status'    => true,
                    'fileName'     => $_FILES['file']['name'].$fileFolder
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'fileName'     => $_FILES['file']['name']
                ], RestController::HTTP_OK);
            }
        }

        public function index_get()
        {
            $id = $this-> get ('id');
            $status = $this -> get ('status');

            if ($id === null && $status === null) 
            {
                $registrasi = $this->mregistrasi->getAllRegistrasi();
            }
            elseif ($id != null && $status != null)
            {
                $registrasi = $this->mregistrasi->getRegistrasiByIDStatus($id, $status);
            }
            elseif ($id != null)
            {
                $registrasi = $this->mregistrasi->getRegistrasiByID($id);
            }
            elseif ($status != null)
            {
                $registrasi = $this->mregistrasi->getRegistrasiByStatus($status);
            }

            $lastquery  = $this->db->last_query();
            $countdata  = count($registrasi);
            if($registrasi)
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'countdata' => $countdata,
                    'data'      => $registrasi,
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    "countdata" => 0,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }

        public function index_post()
        {
            $data = [
                'Biaya_Detail_ID'   => $this -> post ('Biaya_Detail_ID'),
                'DeskripsiBiaya'    => $this -> post ('DeskripsiBiaya'),
                'Jenjang'           => $this -> post ('Jenjang'),
                'Nominal'           => $this -> post ('Nominal'),
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
                'WaliAlamat'        => $this -> post ('WaliAlamat'),
                'Status'            => $this -> post ('Status'),
                'Bukti_Pembayaran'	=> $this -> post ('Bukti_Pembayaran'),
                'CreatedBy'         => $this -> post ('CreatedBy'),
                'CreatedDate'       => $this -> post ('CreatedDate'),
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

        public function KonfirmasiPembayaran_put()
        {
            $id = $this->put('id');   
            $date = date("Y-m-d");;
            $data = [
                'Status'        => $this -> put ('Status'),
                'ModifiedBy'    => $this -> put ('ModifiedBy'),
                'ModifiedDate'  => $date,
            ];
            $lastquery  = $this->db->last_query();
            if ($this->mregistrasi->konfirmasi($data, $id) > 0) 
            {
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'message'   => 'Data has been updated'
                ], 201 /*RestController::HTTP_CREATED*/);
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

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'Biaya_Detail_ID'   => $this -> put ('Biaya_Detail_ID'),
                'DeskripsiBiaya'    => $this -> put ('DeskripsiBiaya'),
                'Jenjang'           => $this -> put ('Jenjang'),
                'Nominal'           => $this -> put ('Nominal'),
                'NamaLengkap'       => $this -> put ('NamaLengkap'),
                'NamaPanggilan'     => $this -> put ('NamaPanggilan'),
                'TempatLahir'       => $this -> put ('TempatLahir'),
                'TanggalLahir'      => $this -> put ('TanggalLahir'),
                'NIK'               => $this -> put ('NIK'),
                'JenisKelamin'      => $this -> put ('JenisKelamin'),
                'AnakKe'            => $this -> put ('AnakKe'),
                'DariBerapaSaudara' => $this -> put ('DariBerapaSaudara'),
                'TinggiBadan'       => $this -> put ('TinggiBadan'),
                'BeratBadan'        => $this -> put ('BeratBadan'),
                'AlamatSantri' 		=> $this -> put ('AlamatSantri'),
			    'AsalSekolah' 		=> $this -> put ('AsalSekolah'),
                'UkuranBaju'        => $this -> put ('UkuranBaju'),
                'UkuranCelana'      => $this -> put ('UkuranCelana'),
                'UkuranJilbab'      => $this -> put ('UkuranJilbab'),
                'AyahNama'          => $this -> put ('AyahNama'),
                'AyahNIK'           => $this -> put ('AyahNIK'),
                'AyahTempatLahir'   => $this -> put ('AyahTempatLahir'),
                'AyahTanggalLahir'  => $this -> put ('AyahTanggalLahir'),
                'AyahPendidikan'    => $this -> put ('AyahPendidikan'),
                'AyahPekerjaan'     => $this -> put ('AyahPekerjaan'),
                'AyahPenghasilan'   => $this -> put ('AyahPenghasilan'),
                'AyahHP'            => $this -> put ('AyahHP'),
                'IbuNama'           => $this -> put ('IbuNama'),
                'IbuNIK'            => $this -> put ('IbuNIK'),
                'IbuTempatLahir'    => $this -> put ('IbuTempatLahir'),
                'IbuTanggalLahir'   => $this -> put ('IbuTanggalLahir'),
                'IbuPendidikan'     => $this -> put ('IbuPendidikan'),
                'IbuPekerjaan'      => $this -> put ('IbuPekerjaan'),
                'IbuPenghasilan'    => $this -> put ('IbuPenghasilan'),
                'IbuHP'             => $this -> put ('IbuHP'),
                'WaliNama'          => $this -> put ('WaliNama'),
                'WaliNIK'           => $this -> put ('WaliNIK'),
                'WaliTempatLahir'   => $this -> put ('WaliTempatLahir'),
                'WaliTanggalLahir'  => $this -> put ('WaliTanggalLahir'),
                'WaliPendidikan'    => $this -> put ('WaliPendidikan'),
                'WaliPekerjaan'     => $this -> put ('WaliPekerjaan'),
                'WaliPenghasilan'   => $this -> put ('WaliPenghasilan'),
                'WaliHP'            => $this -> put ('WaliHP'),
                'WaliAlamat'        => $this -> put ('WaliAlamat'),
                //'Status'            => $this -> put ('Status'),
                'ModifiedBy'        => $this -> put ('ModifiedBy'),
                'ModifiedDate'      => $this -> put ('ModifiedDate'),
            ];

            if ($this->mregistrasi->updateRegistrasi($data, $id) > 0) 
            {
                $this->response([
                    'status'    => true,
                    'message' => 'Data has been updated'
                ], 201 /*RestController::HTTP_CREATED*/);
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