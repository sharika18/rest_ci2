<?php
class Model_vw_biaya_detail extends CI_Model
{
    public function getBiayaDetail($id = null)
    {
        if ($id === null) 
        {
            return $this->db->get('vw_biaya_detail')->result_array();
        }
        else
        {
            return $this->db->get_where('vw_biaya_detail', ['biaya_detail_id' => $id]) ->result_array();
        }
    }
}