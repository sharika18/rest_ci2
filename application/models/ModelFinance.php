<?php
class ModelFinance extends CI_Model
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

    public function getFinancePeriode()
    {
        return $this->db->get('vwfinanceperiode')->result_array();
    }

    /*public function getAllFinanceByPeriode($periode = null)
    {
        return $this->db->get_where('tb_biaya', ['periode' => $periode]) ->result_array();
    }*/

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

    public function createBatchBiaya($data)
    {
        $this->db->insert_batch('tb_biaya', $data);
        return $this->db->affected_rows();
    }

    public function updateBiaya($data, $id)
    {
        $this->db->update('tb_biaya', $data, ['biaya_id' => $id]);
        return $this->db->affected_rows();
    }
}