<?php
class Model_biaya_detail extends CI_Model
{
    public function getBiayaDetail($id = null)
    {
        if ($id === null) 
        {
            return $this->db->get('tb_biaya_detail')->result_array();
        }
        else
        {
            return $this->db->get_where('tb_biaya_detail', ['biaya_detail_id' => $id]) ->result_array();
        }
    }

    
    public function deleteBiayaDetail($id)
    {
        $this->db->delete('tb_biaya_detail', ['biaya_detail_id' => $id]);
        return $this->db->affected_rows();
    }

    public function createBiayaDetail($data)
    {
        $this->db->insert('tb_biaya_detail', $data);
        return $this->db->affected_rows();
    }

    // public function createMahasiswa($data)
    // {
    //     $this->db->insert('tb_biaya_detail', $data);
    //     return $this->db->affected_rows();
    // }

    // public function updateMahasiswa($data, $id)
    // {
    //     $this->db->update('tb_biaya_detail', $data, ['biaya_detail_id' => $id]);
    //     return $this->db->affected_rows();
    // }
}