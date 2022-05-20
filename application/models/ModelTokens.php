<?php
class ModelTokens extends CI_Model
{
    public function createTokens($data)
    {
        $this->db->insert('tb_tokens', $data);
        return $this->db->affected_rows();
    }

    public function getTokensByTokenUserId($token = null, $userId = null)
    {
        $sqlQuery = "SELECT * FROM tb_tokens WHERE token = '".$token."' and userId = '".$userId."' ";
        return $this->db->query($sqlQuery)->result_array();
    }
}
?>
