<?php
class ModelStatusKaryawan extends CI_Model
{
    public function getAllStatusKaryawan()
    {
        $sqlQuery = "SELECT * FROM tb_status_karyawan";
        return $this->db->query($sqlQuery)->result_array();
    }
}