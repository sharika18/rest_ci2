<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Mahasiswa extends RestController {

        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            # mhs alias Mahasiswa_model... 
            $this->load->model('Mahasiswa_model','mhs'); 
        }

        public function index_get()
        {
            // $response = $this->Mahasiswa_model->getMahasiswa();
            // $this->response($response);
            

            $id = $this-> get ('id');
            $nama = $this-> get ('nama');
            if ($id === null)
            {
                $mahasiswa = $this->mhs->getMahasiswa();
            }
            else
            {
                $mahasiswa = $this->mhs->getMahasiswa($id);
            }


            //var_dump('$mahasiswa');
            if($mahasiswa)
            {
                $this->response([
                    'status' => true,
                    'data' => $mahasiswa
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
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
                    'status' => false,
                    'message' => 'provide an id'
                ], RestController::HTTP_BAD_REQUEST);
            }
            else
            {
                # mhs alias Mahasiswa_model...  
                if ($this->mhs->deleteMahasiswa($id) > 0) 
                {
                    # code...
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'delete'
                    ], 204 /*RestController::HTTP_NO_CONTENT*/ );
                }
                else
                {
                    #not found
                    $this->response([
                        'status' => false,
                        'message' => 'id not found'
                    ], 404 /*RestController::HTTP_NOT_FOUND*/ );
                }
            }
        }

        public function index_post()
        {
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'nrp' => $this -> post ('nrp'),
                'nama' => $this -> post ('nama'),
                'email' => $this -> post ('email'),
                'jurusan' => $this -> post ('jurusan')
            ];
            
            if ($this->mhs->createMahasiswa($data) > 0) 
            {
                # ok...
                $this->response([
                    'status' => true,
                    'message' => 'new mahasiswa has been created'
                ], 201 /*RestController::HTTP_CREATED*/);
            }
            else
            {
                #not found
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
                'nrp' => $this -> put ('nrp'),
                'nama' => $this -> put ('nama'),
                'email' => $this -> put ('email'),
                'jurusan' => $this -> put ('jurusan')
            ];

            if ($this->mhs->updateMahasiswa($data, $id) > 0) 
            {
                # ok...
                $this->response([
                    'status' => true,
                    'message' => 'mahasiswa has been updated'
                ], 400 /*RestController::HTTP_NO_CONTENT*/ );
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
?>