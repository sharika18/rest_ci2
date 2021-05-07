<?php
class Model_biaya extends CI_Model
{
    public function getBiaya($id = null)
    {
        if ($id === null) 
        {
            return $this->db->get('tb_biaya')->result_array();
        }
        else
        {
            return $this->db->get_where('tb_biaya', ['biaya_id' => $id]) ->result_array();
        }
    }

    public function deleteBiaya($id)
    {
        $this->db->delete('tb_biaya', ['biaya_id' => $id]);
        return $this->db->affected_rows();
    }

    public function createBiaya($data)
    {
        $this->db->insert('tb_biaya', $data);
        return $this->db->affected_rows();
    }

    public function updateBiaya($data, $id)
    {
        $this->db->update('tb_biaya', $data, ['biaya_id' => $id]);
        return $this->db->affected_rows();
    }
}