<?php
class Model_vw_biaya_detail extends CI_Model
{
    public function getBiayaDetail($id = null, $status = null)
    {
        if ($id === null) 
        {
            if ($status === null)
            {
                return $this->db->get('vw_biaya_detail')->result_array();
            }
            else
            {
                return $this->db->get_where('vw_biaya_detail', ['Status' => $status]) ->result_array();
            }
            
        }
        else
        {
            return $this->db->get_where('vw_biaya_detail', ['biaya_detail_id' => $id, 'Status' => $status]) ->result_array();
        }
    }
}