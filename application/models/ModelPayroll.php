<?php
class ModelPayroll extends CI_Model
{
    public function getAllPayroll()
    {
        $sqlQuery = 
        "   SELECT distinct * FROM vwgrandtotalpayroll 
            WHERE Periode = 
            (
                SELECT MAX(Periode) FROM tb_payroll
            )
            ORDER BY Periode, Nama
        ";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getFinancePeriode()
    {
        return $this->db->get('vwfinanceperiode')->result_array();
    }

    public function getAllFinanceByPeriode($periode = null)
    {
        $sqlQuery = 
                "
                    SELECT * FROM vwgrandtotalpayroll 
                    WHERE Periode = '".$periode."' AND
                    trim(Email) <> ''";

        // AND email in ('derianpratama@gmail.com', 'ida84827@gmail.com', 'rodhiyatumm@gmail.com', '') LIMIT 7
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getAllFinanceByPeriodeNIP($periode = null, $NIP = null)
    {
        $sqlQuery = "SELECT * FROM vwgrandtotalpayroll WHERE Periode = '".$periode."' AND NIP = '".$NIP."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function getAllFinanceByNIP($NIP = null)
    {
        $sqlQuery = "SELECT * FROM vwgrandtotalpayroll WHERE NIP = '".$NIP."'";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function createPayroll($data)
    {
        $this->db->insert('tb_payroll', $data);
        return $this->db->affected_rows();
    }

    public function getVwSumPerPeriode()
    {
        $sqlQuery = 
        "SELECT * FROM vwsumperperiode";
        return $this->db->query($sqlQuery)->result_array();
    }

    public function updatePayrollByNIPPeriode($data, $NIP, $Periode)
    {
        $this->db->update('tb_payroll', $data, ['NIP' => $NIP, 'Periode' => $Periode]);
        return $this->db->affected_rows();
    }

    public function deletePayrollByPeriode($periode)
    {
        $this->db->delete('tb_payroll', ['periode' => $periode]);
        return $this->db->affected_rows();
    }
}