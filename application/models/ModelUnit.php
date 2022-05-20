<?php
class ModelUnit extends CI_Model
{
    public function getAllUnit()
    {
        $sqlQuery = "SELECT * FROM tb_unit";
        return $this->db->query($sqlQuery)->result_array();
    }
}