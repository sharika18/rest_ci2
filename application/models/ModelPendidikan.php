<?php
class ModelPendidikan extends CI_Model
{
    public function getAllPendidikan()
    {
        $sqlQuery = "SELECT * FROM tb_pendidikan";
        return $this->db->query($sqlQuery)->result_array();
    }
}