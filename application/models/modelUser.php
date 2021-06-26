<?php
class modelUser extends CI_Model
{
    public function getUserAll()
    {
        $sqlQuery = "SELECT * FROM tbUser";
                return $this->db->query($sqlQuery)->result_array();
    }
    public function getUserByNik($nik = null)
    {
        $sqlQuery = "SELECT * FROM tbUser WHERE NIK = '".$nik."'";
        return $this->db->query($sqlQuery)->result_array();
    }
}
?>
