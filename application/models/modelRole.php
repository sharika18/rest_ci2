<?php
    class modelRole extends CI_Model
    {
        public function getRoleAll()
        {
            return $this->db->get('tbRole')->result_array();
        }
    }