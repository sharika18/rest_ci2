<?php
class Model_vw_biaya_detail extends CI_Model
{
    public function getAllBiayaDetail()
    {
        return $this->db->get('vw_biaya_detail')->result_array();
    }
    public function getBiayaDetailByID($id = null)
    {
        return $this->db->get_where('vw_biaya_detail', ['Biaya_Detail_Id'=> $id]) ->result_array();
    }
    public function getBiayaDetailByJenjang($status = null, $jenjang = null)
    {
        return $this->db->get_where('vw_biaya_detail', ['Jenjang'=> $jenjang, 'Status' => $status]) ->result_array();
    }
}