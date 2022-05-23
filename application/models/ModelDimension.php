<?php
class ModelDimension extends CI_Model
{
    public function getValueByCode($code = "")
    {
        $sqlQuery = "SELECT * FROM tb_dimension WHERE flag = 'Y' AND code = '".$code."'";
        return $this->db->query($sqlQuery)->result_array();
    }
}