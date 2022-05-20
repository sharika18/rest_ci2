<?php
    class ModelRegistrasiAkunWali extends CI_Model
    {
        
        public function insertRegistrasiAkunWali($data)
        {
            $a_procedure    = "CALL spRegistrasiAkunWali (?,?,?,?,?,?,?,@pResult)";
            return $this->db->query( $a_procedure, $data);
            
            // if ($a_result !== NULL) {
            //     return TRUE;
            // }
            // return FALSE;
        }
    }