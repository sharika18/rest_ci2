<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Payroll extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelPayroll','mPayroll'); 
            
        }
        
        public function getAllPayroll_get()
        {
            
            $data = $this->mPayroll->getAllPayroll();

            $lastquery  = $this->db->last_query();
            if($data)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $data
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }

        public function getFinancePeriode_get()
        {
            $periode = $this->mPayroll->getFinancePeriode();

            $lastquery  = $this->db->last_query();
            if($periode)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $periode
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }

        public function getAllFinanceByPeriode_get()
        {
            $periode = $this-> get ('periode');
            $financeData = $this->mPayroll->getAllFinanceByPeriode($periode);

            $lastquery  = $this->db->last_query();
            if($financeData)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $financeData
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }

        public function getAllFinanceByPeriodeNIP_get()
        {
            $periode = $this-> get ('periode');
            $NIP = $this-> get ('NIP');
            $financeData = $this->mPayroll->getAllFinanceByPeriodeNIP($periode, $NIP);

            $lastquery  = $this->db->last_query();
            if($financeData)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $financeData
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }

        public function getAllFinanceByNIP_get()
        {
            $NIP = $this-> get ('NIP');
            $financeData = $this->mPayroll->getAllFinanceByNIP($NIP);

            $lastquery  = $this->db->last_query();
            if($financeData)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $financeData
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }

        public function createPayroll_post()
        {
            $data = [
                'noTransaksi'                   => $this -> post ('noTransaksi'),
                'Periode'                       => $this -> post ('Periode'),
                'NIP'                           => $this -> post ('NIP'),
                'Nama'                          => $this -> post ('Nama'),
                //'Email'                         => $this -> post ('Email'),
                'jabatanTugas'                  => $this -> post ('jabatanTugas'),
                'Unit'                          => $this -> post ('Unit'),
                'statusKepegawaian'             => $this -> post ('statusKepegawaian'),

                'incomeGajiPokok'               => $this -> post ('incomeGajiPokok'),
                'incomeTunjanganHarian'         => $this -> post ('incomeTunjanganHarian'),
                'incomeTunjanganJabatan1'       => $this -> post ('incomeTunjanganJabatan1'),
                'incomeTunjanganJabatan2'       => $this -> post ('incomeTunjanganJabatan2'),
                'incomeTunjanganAnak'           => $this -> post ('incomeTunjanganAnak'),
                'incomeTunjanganIstri'          => $this -> post ('incomeTunjanganIstri'),
                'incomeRewardKehadiran'         => $this -> post ('incomeRewardKehadiran'),
                'incomeKepanitiaan'             => $this -> post ('incomeKepanitiaan'),
                'incomeSupervisi'               => $this -> post ('incomeSupervisi'),
                'incomeTambahanJamMengajar'     => $this -> post ('incomeTambahanJamMengajar'),
                'incomeTambahanExtracurricular' => $this -> post ('incomeTambahanExtracurricular'),

                'fasilitasTempatTinggal'        => $this -> post ('fasilitasTempatTinggal'),
                'fasilitasAir'                  => $this -> post ('fasilitasAir'),
                'fasilitasListrik'              => $this -> post ('fasilitasListrik'),
                'fasilitasMaintenanceRumah'     => $this -> post ('fasilitasMaintenanceRumah'),
                'fasilitasKonsumsiBulanan'      => $this -> post ('fasilitasKonsumsiBulanan'),
                'fasilitasSembako'              => $this -> post ('fasilitasSembako'),
                'fasilitasBiayaSekolah'         => $this -> post ('fasilitasBiayaSekolah'),
                'fasilitasSppSekolah'           => $this -> post ('fasilitasSppSekolah'),
                'fasilitasKesehatan'            => $this -> post ('fasilitasKesehatan'),
                'fasilitasBpjsKesehatan'        => $this -> post ('fasilitasBpjsKesehatan'),
                'fasilitasBpjsKetenagakerjaan'  => $this -> post ('fasilitasBpjsKetenagakerjaan'),
                'fasilitasLainnya'              => $this -> post ('fasilitasLainnya'),

                'hariKetidakhadiran'            => $this-> post ('hariKetidakhadiran'),
                'potonganKetidakhadiran'        => $this -> post ('potonganKetidakhadiran'),
                'potonganKeterlambatan'         => $this -> post ('potonganKeterlambatan'),
                'potonganArisanPondok'          => $this -> post ('potonganArisanPondok'),
                'potonganPinjaman'              => $this -> post ('potonganPinjaman'),
                'potonganDanaPensiun'           => $this -> post ('potonganDanaPensiun'),
                'potonganTabungan'              => $this -> post ('potonganTabungan'),
                'potonganPembiayaanBma1'        => $this -> post ('potonganPembiayaanBma1'),
                'potonganPembiayaanBma2'        => $this -> post ('potonganPembiayaanBma2'),
                'potonganBpjsKesehatan'         => $this -> post ('potonganBpjsKesehatan'),
                'potonganBpjsKetenagakerjaan'   => $this -> post ('potonganBpjsKetenagakerjaan'),
                'potonganArisanQurban'          => $this -> post ('potonganArisanQurban'),
                'potonganLainnya'               => $this -> post ('potonganLainnya')
            ];

            $lastquery  = $this->db->last_query();
            
            if ($this->mPayroll->createPayroll($data) > 0) 
            {
                # ok...
                $this->response([
                    'status'    => true,
                    'query'     => $lastquery,
                    'message'   => 'Data has been created'
                ], 201 /*RestController::HTTP_CREATED*/);
            }
            else
            {
                # not ok
                $this->response([
                    'status' => false,
                    'message' => 'failed create data'
                ],  400 /*RestController::HTTP_BAD_REQUEST*/);
            }
        }

        public function getVwSumPerPeriode_get()
        {   
            $data = $this->mPayroll->getVwSumPerPeriode();

            $lastquery  = $this->db->last_query();
            if($data)
            {
                $this->response([
                    'status'    => "true",
                    'query'     => $lastquery,
                    'data'      => $data
                ], RestController::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status'    => false,
                    'query'     => $lastquery,
                    'message'   => 'id not found',
                ], RestController::HTTP_NOT_FOUND);
            }
        }

        public function deletePayrollByPeriode_delete()
        {
            $periode =$this->delete('periode');
            if ($periode === null) 
            {
                $this->response([
                    'status'    => false,
                    'message'   => 'provide an id'
                ], RestController::HTTP_BAD_REQUEST);
            }
            else
            {
                if ($this->mPayroll->deletePayrollByPeriode($periode) > 0) 
                {
                    $this->response([
                        'status'    => true,
                        'id'        => $id,
                        'message'   => 'Data deleted'
                    ], RestController::HTTP_OK /*204 RestController::HTTP_NO_CONTENT*/ );
                }
                else
                {
                    $this->response([
                        'status'    => false,
                        'message'   => 'id not found'
                    ], 404 /*RestController::HTTP_NOT_FOUND*/ );
                }
            }
        }

        public function updatePayrollByNIPPeriode_put()
        {
            $NIP        = $this->put('NIP');
            $Periode    = $this->put('Periode');
            $data = [
                # alt + Shift + bawah > untuk copy data ke baris bawah
                # alt + bawah/atas > untuk memindahkan data baris atas ke bawah
                'isSent'            => $this -> put('isSent'),
                // 'ModifiedBy'        => $this -> put ('ModifiedBy'),
                // 'ModifiedDate'      => $this -> put ('ModifiedDate'),
            ];

            if ($this->mPayroll->updatePayrollByNIPPeriode($data, $NIP, $Periode) > 0) 
            {
                # ok...
                $this->response([
                    'status' => true,
                    'message' => 'Data has been updated'
                ], 201 /*RestController::HTTP_NO_CONTENT*/ );
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'failed update data',
                    'data' => $data
                ],  400 /*RestController::HTTP_BAD_REQUEST*/);
            }
        }
    }