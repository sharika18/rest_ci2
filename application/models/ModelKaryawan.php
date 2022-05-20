<?php
class ModelKaryawan extends CI_Model
{
    public function getAllKaryawan()
    {
        $sqlQuery = "SELECT * FROM tb_karyawan ORDER BY TanggalMulaiTugas DESC";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getKaryawanByKaryawanID($karyawanID = null)
    {
        $sqlQuery = "SELECT * FROM tb_karyawan WHERE karyawanID = '".$karyawanID."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getKaryawanByNIP($NIP = null)
    {
        $sqlQuery = "SELECT * FROM tb_karyawan WHERE NIP = '".$NIP."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getVwKaryawanDetail()
    {
        $sqlQuery = "SELECT * FROM vwkaryawandetail ORDER BY TanggalMulaiTugas DESC";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getVwKaryawanDetailByNIP($NIP = null)
    {
        $sqlQuery = "SELECT * FROM vwkaryawandetail WHERE NIP = '".$NIP."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getNoUrutKaryawanByTMT($TMT = null)
    {
        $sqlQuery = 
        "   SELECT (COUNT(*) + 1) AS 'NoUrut' FROM `tb_karyawan` 
            WHERE 
            DATE_FORMAT(tanggalmulaitugas, '%Y%m%d') = DATE_FORMAT('".$TMT."', '%Y%m%d');
        ";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function createKaryawan($data)
    {
        $this->db->insert('tb_karyawan', $data);
        return $this->db->affected_rows();
    }

    public function updateKaryawan($data, $id)
    {
        $this->db->update('tb_karyawan', $data, ['karyawanID' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteKaryawan($id)
    {
        $this->db->delete('tb_karyawan', ['karyawanID' => $id]);
        return $this->db->affected_rows();
    }

    public function getCountKaryawanByStatus()
    {
        $sqlQuery = 
        "   SELECT tsk.status, COUNT(tk.karyawanID) as 'jumlah'
            FROM 
            `tb_karyawan` tk 
            RIGHT JOIN
            `tb_status_karyawan` tsk
            ON tk.statusID = tsk.statusID
            GROUP BY tsk.status
            ORDER BY tsk.statusOrder ASC;
        ";
        return $this->db->query($sqlQuery)->result_array();
    }
}