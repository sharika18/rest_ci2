<?php
    class Model_biaya extends CI_Model
    {
        public function getRole($id = null)
        {
            if ($id === null) {
                return $this->db->get('tbRole')->result_array();
            } else {
                return $this->db->get_where('tbRole', ['roleId' => $id]) ->result_array();
            }
        }
    }