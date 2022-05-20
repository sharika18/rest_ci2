<?php
class ModelWali extends CI_Model
{
    public function countWaliByNIK($nik = '')
    {
        $sqlQuery = "SELECT COUNT(1) AS countWali FROM tbWali WHERE  NIK = '".$nik."'";
        return $this->db->query($sqlQuery)->result_array();
    }
    public function getUserByNik($nik = null)
    {
        $sqlQuery = "SELECT * FROM tbUser WHERE NIK = '".$nik."'";
        return $this->db->query($sqlQuery)->result_array();
    }
}
?>
