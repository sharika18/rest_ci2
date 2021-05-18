<?php
class Model_Registrasi extends CI_Model
{
    public function createRegistrasi($data)
    {
        $this->db->insert('tb_registrasi', $data);
        return $this->db->affected_rows();
    }

    public function getRegistrasi($id = null)
    {
        if ($id === null) 
        {
            return $this->db->get('tb_registrasi')->result_array();
        }
        else
        {
            return $this->db->get_where('tb_registrasi', ['id_registrasi' => $id]) ->result_array();
        }
    }

    public function updateRegistrasi($data, $id)
    {
        $this->db->update('tb_registrasi', $data, ['id_registrasi' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteRegistrasi($id)
    {
        $this->db->delete('tb_registrasi', ['id_registrasi' => $id]);
        return $this->db->affected_rows();
    }
}