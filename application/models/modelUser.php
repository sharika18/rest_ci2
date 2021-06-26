<?php
class modelUser extends CI_Model
{
    public function getUserAll()
    {
        $sqlQuery = "SELECT * FROM tbUser";
                return $this->db->query($sqlQuery)->result_array();
    }
}
?>
