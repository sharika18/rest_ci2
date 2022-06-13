<?php
class ModelSantri extends CI_Model
{
    public function getAllVwSantriDetail()
    {
        $sqlQuery = "SELECT * FROM VwSantriDetail";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getVwSantriDetailByNIS($NIS = "")
    {
        $sqlQuery = "SELECT * FROM VwSantriDetail WHERE NIS = '".$NIS."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getVwSantriDetailByNIKWali($NIKWali = "")
    {
        $sqlQuery = "SELECT * FROM VwSantriDetail WHERE NIKWali = '".$NIKWali."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getOrangTuaByNIK($NIK = "")
    {
        $sqlQuery = "SELECT * FROM tb_orangtua WHERE NIK = '".$NIK."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getNotAnggotaKamar()
    {
        $sqlQuery = 
            "SELECT * FROM `tb_santri` 
                WHERE NIS NOT IN 
                (SELECT NISAnggotaKamar FROM tb_anggota_kamar)";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function createSantri($data)
    {
        $this->db->insert('tb_santri', $data);
        return $this->db->affected_rows();
    }

    public function updateSantri($data, $NIS)
    {
        $this->db->update('tb_santri', $data, ['NIS' => $NIS]);
        return $this->db->affected_rows();
    }

    public function createOrangTua($data)
    {
        $this->db->insert('tb_orangtua', $data);
        return $this->db->affected_rows();
    }

    public function updateOrangTua($data, $NIK)
    {
        $this->db->update('tb_orangtua', $data, ['NIK' => $NIK]);
        return $this->db->affected_rows();
    }
}