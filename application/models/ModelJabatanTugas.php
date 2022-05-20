<?php
class ModelJabatanTugas extends CI_Model
{
    public function getAllJabatanTugas()
    {
        $sqlQuery = "SELECT * FROM tb_jabatan_tugas ORDER BY jabatanTugas ASC";
        return $this->db->query($sqlQuery)->result_array();
    }
}