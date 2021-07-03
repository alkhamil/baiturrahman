<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
	public function index()
	{
        $data['title'] = 'Dashboard';
        $data['isi'] = 'admin/dashboard/index';
        $data['userdata'] = $this->userdata;
        $data['infaq'] = $this->sum_transaction(1);
        $data['zakat_mal'] = $this->sum_transaction(2);
        $data['zakat_fitrah'] = $this->sum_transaction(3);
        $data['kas'] = $this->sum_transaction(4);
        $data['get_grafik'] = base_url('admin/dashboard/get_grafik');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function sum_transaction($trans_type_id)
    {
        $this->db->select('saldo');
        $this->db->from('m_trans_type');
        $this->db->where('id', $trans_type_id);
        $q = $this->db->get();
        return $q->row();
    }

    public function sidebar()
    {
        $sidebar_toggled = $this->input->post('sidebar_toggled', true);
        $this->session->set_userdata('sidebar_toggled', $sidebar_toggled);
    }

    public function get_grafik()
    {
        $tahun = date('Y');
        $in = "SELECT 
                bulan, 
                SUM(amount) total
                FROM (
                    SELECT
                        MONTHNAME( created_date ) bulan,
                        amount 
                    FROM
                        t_transaction
                    WHERE DATE_FORMAT(created_date, '%Y') = $tahun
                ) x GROUP BY bulan";
        $result_in = $this->db->query($in)->result_array();

        $out = "SELECT 
                bulan, 
                SUM(amount) total
                FROM (
                    SELECT
                        MONTHNAME( created_date ) bulan,
                        amount 
                    FROM
                        t_pengeluaran
                    WHERE DATE_FORMAT(created_date, '%Y') = $tahun
                ) x GROUP BY bulan";
        $result_out = $this->db->query($out)->result_array();
        $data = [];
        foreach ($result_in as $key => $item) {
            $data[$key]['bulan'] = $item['bulan'];
            $data[$key]['total_pemasukan'] = $item['total'];
            $data[$key]['total_pengeluaran'] = $result_out[$key]['total'];
        }
        echo json_encode(array_reverse($data));
    }

}