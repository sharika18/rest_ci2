<?php
class ModelKelasAsrama extends CI_Model
{
    //KAMAR
        public function getAllAsrama()
        {
            $sqlQuery = "SELECT DISTINCT AsramaID, NamaAsrama, NIPPenanggungJawabAsrama, NamaPenanggungJawab FROM vwkamardetail;";
            return $this->db->query($sqlQuery)->result_array();
        }

        public function getAllVwKamarDetail()
        {
            $sqlQuery = "SELECT * FROM VwKamarDetail";
            return $this->db->query($sqlQuery)->result_array();
        }

        public function getDistinctAnggota()
        {
            $sqlQuery = "SELECT * FROM `vwkamardetail` WHERE AnggotaKamarID IS NOT NULL";
            return $this->db->query($sqlQuery)->result_array();
        }

        public function getDistinctAnggotaByKamarID($KamarID = "")
        {
            $sqlQuery = "SELECT * FROM `vwkamardetail` WHERE AnggotaKamarID IS NOT NULL AND KamarID = '".$KamarID."'";
            return $this->db->query($sqlQuery)->result_array();
        }

        public function getAllVwKamarDetailByAsramaID($AsramaID = "")
        {
            $sqlQuery = "SELECT 
                            C.NamaAsrama,
                            A.*, 
                            COUNT(B.AnggotaKamarID) AS 'JumlahAnggotaKamar'
                            FROM 
                            tb_asrama C INNER JOIN
                            tb_kamar A ON A.AsramaID = C.AsramaID lEFT JOIN
                            tb_anggota_kamar B
                            ON A.KamarID = B.KamarID
                            WHERE
                            1 = 1
                            AND A.AsramaID = '".$AsramaID."'
                            GROUP BY A.KamarID
                        ";
            return $this->db->query($sqlQuery)->result_array();
        }

        public function getNamaAsramaByKamarID($KamarID = "")
        {
            $sqlQuery = "SELECT 
                            DISTINCT
                            A.AsramaID,
                            A.NamaAsrama,
                            B.KamarID
                            FROM
                            tb_asrama A LEFT JOIN tb_kamar B
                            ON A.AsramaID = B.AsramaID
                            WHERE 
                            B.KamarID = '".$KamarID."'
                        ";
            return $this->db->query($sqlQuery)->result_array();
        }

        public function getAllVwKamarDetailByNIS($NIS = "")
        {
            $sqlQuery = "SELECT * FROM VwKamarDetail WHERE NIS = '".$NIS."'";
            return $this->db->query($sqlQuery)->result_array();
        }
        
        public function createAsrama($data)
        {
            $this->db->insert('tb_asrama', $data);
            return $this->db->affected_rows();
        }

        public function createKamar($data)
        {
            $this->db->insert('tb_kamar', $data);
            return $this->db->affected_rows();
        }
        
        public function createAnggotaKamar($data)
        {
            $this->db->insert('tb_anggota_Kamar', $data);
            return $this->db->affected_rows();
        }

        public function updateAsrama($data, $id)
        {
            $this->db->update('tb_asrama', $data, ['AsramaID' => $id]);
            return $this->db->affected_rows();
        }

        public function updateKamar($data, $id)
        {
            $this->db->update('tb_kamar', $data, ['KamarID' => $id]);
            return $this->db->affected_rows();
        }

        public function updateAnggotaKamar($data, $id)
        {
            $this->db->update('tb_anggota_kamar', $data, ['AnggotaKamarID' => $id]);
            return $this->db->affected_rows();
        }

        public function deleteAnggotaKamar($AnggotaKamarID)
        {
            $this->db->delete('tb_anggota_kamar', ['AnggotaKamarID' => $AnggotaKamarID]);
            return $this->db->affected_rows();
        }
    //KELAS
        // public function getAllVwKelasDetail()
        // {
        //     $sqlQuery = "SELECT * FROM VwKelasDetail";
        //     return $this->db->query($sqlQuery)->result_array();
        // }

        // public function getAllVwKelasDetailByNIS($NIS = "")
        // {
        //     $sqlQuery = "SELECT * FROM VwKelasDetail WHERE NIS = '".$NIS."'";
        //     return $this->db->query($sqlQuery)->result_array();
        // }
}