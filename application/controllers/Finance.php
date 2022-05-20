<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Finance extends RestController
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('modelFinance','mFinance'); 
            
        }

        public function getFinancePeriode_get()
        {
            $periode = $this->mFinance->getFinancePeriode();

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
            $financeData = $this->mFinance->getAllFinanceByPeriode($periode);

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
    }