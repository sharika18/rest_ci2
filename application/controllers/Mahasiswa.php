<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Mahasiswa extends RestController {

        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            # mahasiswa alias Mahasiswa_model... 
            $this->load->model('Mahasiswa_model','mhs'); 

            #menggunakan limit
            //$this->methods['index_get']['limit'] = 2;
        }

        // public function index()
        // {
        //     $this->load->view('template');
        // }

        public function index_get()
        {
            // $response = $this->Mahasiswa_model->getMahasiswa();
            // $this->response($response);
            

            $id = $this-> get ('id');
            $nama = $this-> get ('nama');
            
            if ($id === null)
            {
                if ($nama === null)
                {
                    $mahasiswa = $this->mhs->getMahasiswa();
                }
                else
                {
                    $mahasiswa = $this->mhs->getMahasiswa($id, $nama);
                    
                    //var_dump($this->db->last_query());
                    //var_dump($mahasiswa);
                    //print_r($this->db->last_query());
                }
            }
            else
            {
                $mahasiswa = $this->mhs->getMahasiswa($id);
            }

           
            $test  = $this->db->last_query();
            //var_dump('$mahasiswa');
            if($mahasiswa)
            {
                // $this->response(
                // $mahasiswa, RestController::HTTP_OK );
                $this->response([
                    'status' => true,
                    'query' => $test,
                    'queryx' => $this->db->last_query(),
                    'data' => 
                    $mahasiswa
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'id not found',
                    'queryx' => $this->db->last_query(),
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
                # mahasiswa alias Mahasiswa_model...  
                if ($this->mhs->deleteMahasiswa($id) > 0) 
                {
                    # code...
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'delete'
                    ], RestController::HTTP_OK /*204 RestController::HTTP_NO_CONTENT*/ );
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

            # install sipets2 ... 
            # https://marketplace.visualstudio.com/items?itemName=Anish-M.ci-snippets2
            # default upload...
            // $config['upload_path'] = './uploads/';
            // $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size']  = '100';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';
            
            // $this->load->library('upload', $config);
            
            // if ( ! $this->upload->do_upload()){
            //     $error = array('error' => $this->upload->display_errors());
            // }
            // else{
            //     $data = array('upload_data' => $this->upload->data());
            //     echo "success";
            // }

            $path1 = 'register/';
            $path = $path1.$this -> post ('nrp'); 
            if (!is_dir('uploads/'.$path)) {
                mkdir('./uploads/'.$path, 0777, TRUE);

            }
            $config['upload_path'] = './uploads/'.$path;
            
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $config['overwrite'] = TRUE;
            $config['file_name'] = 'test';

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('user_file','coba')){
                $error = array('error' => $this->upload->display_errors());
                //echo $error;
                //print_r($error );
                $this->response([
                    'status'    => false,
                    'message'   => 'upload data bermasalah',
                    'error'     => $this->upload->display_errors()
                ], 400 /*RestController::HTTP_BAD_REQUEST*/);
            }

            else{
                $data = array('upload_data' => $this->upload->data());
                echo "success upload";
                
                $data = [
                    # alt + Shift + bawah > untuk copy data ke baris bawah
                    # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                    'nrp' => $this -> post ('nrp'),
                    'nama' => $this -> post ('nama'),
                    'email' => $this -> post ('email'),
                    'jurusan' => $this -> post ('jurusan')
                ];
    
                 print_r($data);
                
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
        }

        public function index_put()
        {
            $id = $this->put ('id');
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
                ], RestController::HTTP_OK /*204 RestController::HTTP_NO_CONTENT*/ );
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