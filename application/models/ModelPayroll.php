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
                    trim(Email) <> '' and
                    Email NOT IN ('ririnrezabiah94@gmail.com', 'megawati15081996@gmail.com', 'ekanurfitriani24@gmail.com', 'khoirunnissa00000@gmail.com', 'dwiputriningsih1234@gmail.com', 'mairumirawati123@gmail.com', 'eyinrupika123@gmail.com', 'ekasulistyanti1234@gmail.com', 'ekaherlizah123@gmail.com', 'vetiengraini123@gmail.com', 'costanofal164@gmail.com', 'lastirani12345@gmail.com', 'ajengarum376@gmail.com', 'ekapasmawati17121995@gmail.com', 'lesianitasari19011991@gmail.com', 'Heniagustina261@gmail.com', 'yulikurnia884@gmail.com', 'nikeyuspa123@gmail.com', 'naniknuryati810@gmail.com', 'wiwidiana221@gmail.com', 'edonandaalyos@gmail.com', 'emi91.ratu3gcell@gmail.com', 'karinaadindasari12@gmail.com', 'alfaraby.riki@gmail.com', 'sitinuraisyah.krj@gmail.com', 'yesilacpns@gmail.com', 'asmasutarnisuradi@gmail.com', 'heriyantibinti@gmail.com', 'lusyaanti@gmail.com', 'halimahcurup2018@gmail.com', 'rizkiayuamaliah99@gmail.com', 'hayatirkm@gmail.com', 'yumainahayu16071999@gmail.com', 'lailatussyarifahp1@gmail.com', 'nana123nurjanah@gmail.com', 'lidiyadepega18@gmail.com', 'helnaplg@gmail.com', 'detikusneni12@gmail.com', 'ratihagustin1419@gmail.com', 'anggrainilina095@gmail.com', 'puririzki25@gmail.com', 'restyoctarina@gmail.com', 'ayusaputrinita@gmail.com', 'rayulianira01@gmail.com', 'riskanovitasari05@gmail.com', 'wahyucurup14@gmail.com', 'burhanasn8@gmail.com', 'zakiyahpadangcell@gmail.com', 'aansuwandi058@gmail.com', 'hayalinggau1101@gmail.com', 'lilinurindahsari72@gmail.com', 'Jumii3791@gmail.com', 'krisnamonika27@gmail.com', 'destymagriati1199@gmail.com', 'krismadwisagita315@gmail.com', 'windidita06@gmail.com', 'riniprabawati20@gmail.com', 'muttoharoh562@gmail.com', 'de.baskara12@gmail.com', 'sintaspeed2017@gmail.com', 'nandalarassaskia@gmail.com', 'dwikatamarailmaa@gmail.com', 'riskayunitasari98@gmail.com', 'wandriadisaputra96@gmail.com', 'alfarimuhammad17@gmail.com', 'nandolinggogressiko@gmail.com', 'saputraandi1001@gmail.com', 'cacaa4763@gmail.com', 'romaita.my18@gmail.com', 'heni35033@gmail.com', 'liamardiyanti54@gmail.com', 'yulianuryani23@gmail.com', 'ariaquarina234@gmail.com', 'jevi230196@gmail.com', 'husnida1210@gmail.com', 'sitimasrifah2601@gmail.com', 'fn102920@gmail.com', 'yumithaelviza.29@gmail.com', 'wuahmad1@gmail.com', 'rianmarp@gmail.com', 'aidilfitriyansyah13@gmail.com', 'hetykurnia17@gmail.com','mafatih78@gmail.com', 'Syihababbas5@gmail.com', 'asephidayaht02@gmail.com', 'rendisukaji47@gmail.com', 'nasrianilham@gmail.com', 'leozubair98@gmail.com', 'ardhany1219@gmail.com', 'nellylinggau123@gmail.com', 'kurnianingsihnanda@gmail.com', 'sriholipah21@gmail.com', 'juliaindahhlinggau2018@gmail.com', 'miftahsaadah025@gmail.com','juliaindahhlinggau2018@gmail.com', 'meta3881@gmail.com', 'yurangriana@gmail.com', 'juliyani392@gmail.com', 'miftahuljannahllg17@gmail.com', 'erpizahara@gmail.com', 'latuhar2020@gmail.com', 'rahmann841@gmail.com', 'imasmawarni8@gmail.com', 'Salbiaseptina@gmail.com', 'Tjhriezti4nt0@gmail.com', 'Sriratnadewi.h.16@gmail.com', 'tamrinregina@gmail.com', 'rahmadiszahendani@gmail.com', 'januardiirawan@gmail.com', 'rodhiyatumm@gmail.com', 'jambicity130299@gmail.com', 'datikdani97@gmail.com', 'wpratomo98@gmail.com', 'juliaindahhlinggau2018@gmail.com', 'yudha24permana24@gmail.com', 'kurniawannovan35@gmail.com', 'hermawanindra018@gmail.com', 'mariska8384@gmail.com', 'juliaindahhlinggau2018@gmail.com', 'yunitapraptiu@gmail.com', 'rianpratamaputra1992@gmail.com', 'Shakulala41@gmail.com', 'lusipurwanti1999@gmail.com', 'ikhwandp9@gmail.com', 'yuridayanti36@gmail.com', 'kikisumiarti917@gmail.com', 'Dianmayasari117@gmail.com ', 'dianasarisugimin@gmail.com', 'zuhaizuhairiah11@gmail.com', 'meiandit1@gmail.com', 'hasani1grati@gmail.com', 'Septianjimmi@gmail.com', 'juliaindahhlinggau2018@gmail.com', 'Dianmayasari117@gmail.com ', 'Luthfyaprilianti2828@gmail.com', 'muarofah.dewi12@gmail.com', 'indahpramana15@gmail.com', 'Chusnanso8@gmail.com', 'devicawati41@gmail.com', 'ekapatwa24@gmail.com', 'Wanikh83@gmail.com', 'dekaputriansis@gmail.com', 'mohu21890@gmail.com', 'kconkhaliel@gmail.com', 'mohaliridwan245@gmail.com', 'ojieqpicture@gmail.com', 'yockuhady1298@gmail.com', 'idaistanti88@gmail.com', 'Faridahmahardika@gmail.com', 'gustyonsudirman95@gmail.com', 'mayarahmi94@gmail.com', 'madonsyahe@gmail.com', 'sukri.d.ace@gmail.com', 'nunu.nurulhidayati@gmail.com', 'gerinlarassaputri97@gmail.com', 'mhusran2013@gmail.com', 'mistikurniaaa@gmail.com', 'syifathoyyibah04@gmail.com', 'kurniawandedi264@gmail.com', 'ochadinda21@gmail.com', 'musadad250@gmail.com', 'yesiulmag17@gmail.com', 'Teguhsaz801@gmail.com', 'nopririfai@gmail.com')";

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

    public function deletePayrollByPeriode($periode)
    {
        $this->db->delete('tb_payroll', ['periode' => $periode]);
        return $this->db->affected_rows();
    }
}