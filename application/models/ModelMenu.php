<?php
class ModelMenu extends CI_Model
{
    public function getMenuBySubMenu($SubMenu = "")
    {
        $sqlQuery = "SELECT * FROM tb_menu WHERE Status = 'A' AND SubMenu = '".$SubMenu."'";
        return $this->db->query($sqlQuery)->result_array();
    }
}