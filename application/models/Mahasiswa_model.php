<?php
class Mahasiswa_model extends CI_Model
{
    public function getMahasiswa($id = null, $nama= null)
    {
        //$response = array();

        //Select Record
        // $this->db->select('*');
        // $q = $this->db->get('mahasiswa');
        // $response = $q->result_array();

        //return $response;

        if ($id === null) 
        {
            if ($nama === null)
            {
                return $this->db->get('mahasiswa')->result_array();
            }
            else
            {
                # sql statement...
                # https://codeigniter.com/userguide3/database/queries.html?highlight=database
                // $sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
                // $this->db->query($sql, array(3, 'live', 'Rick'));

                # coba sqlstatement where...
                //$sql = "SELECT * FROM mahasiswa WHERE nama = ? ";                
                //return $this->db->query($sql, array($nama))->result_array();                


                $sql = "SELECT * FROM mahasiswa WHERE nama LIKE '%" .
                $this->db->escape_like_str($nama)."%' ESCAPE '!'";
                return $this->db->query($sql, array($nama))->result_array();

                // $this->db->select('*');
                // $this->db->like('nama', $nama);
                // $query = $this->db->get('mahasiswa');
                // return $query->result_array();

                // print_r($this->db->last_query()); 
                // log_message('query : ', $query);
                
                // var_dump($this->db->last_query());
                // echo $this->db->last_query();
                # query CI...
                // return $this->db->get_where('mahasiswa', ['nama' =>$nama]) ->result_array();
            }
        }
        else
        {   
            # CONTOH
            // $sql = "SELECT 'ID is not Null' as keterangan, nama FROM mahasiswa WHERE id = ". $id ." AND nama LIKE '%" .
            //     $this->db->escape_like_str($nama)."%' ESCAPE '!'";
            //     return $this->db->query($sql, array($id, $nama))->result_array();

            // $sql = "SELECT * FROM mahasiswa WHERE id = ". $id ." AND nama LIKE '%" .$nama."%' ESCAPE '!'";
            // return $this->db->query($sql, array($id, $nama))->result_array();
            return $this->db->get_where('mahasiswa', ['id' => $id]) ->result_array();
        }
    }

    public function deleteMahasiswa($id)
    {
        $this->db->delete('mahasiswa', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createMahasiswa($data)
    {
        $this->db->insert('mahasiswa', $data);
        // print_r($data);
        return $this->db->affected_rows();

        
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
        
    }

    public function updateMahasiswa($data, $id)
    {
        $this->db->update('mahasiswa', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
