<?php
class ModelUser extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->get('tb_user')->result_array();
    }
    public function getUserByEmailPassword($email = null, $password = null)
    {
        $sqlQuery = "SELECT * FROM tb_user WHERE email = '".$email."' and password = '".$password."' ";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getUserByEmail($email = null)
    {
        $sqlQuery = "SELECT * FROM tb_user WHERE email = '".$email."' ";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getUserByUserId($userId = null)
    {
        $sqlQuery = "SELECT * FROM tb_user WHERE userId = '".$userId."' ";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function updateUserById($data, $id)
    {
        $this->db->update('tb_user', $data, ['userId' => $id]);
        return $this->db->affected_rows();
    }
}
?>
