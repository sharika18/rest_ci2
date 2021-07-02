<?php
    class modelRole extends CI_Model
    {
        public function getRoleAll()
        {
            return $this->db->get('tbRole')->result_array();
        }

        public function createRole($data)
        {
            $this->db->set('roleId','UUID()',FALSE);
            $this->db->insert('tbRole', $data);
            return $this->db->affected_rows();
        }
    }