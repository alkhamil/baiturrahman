<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
	public function index()
	{
        $data['title'] = 'Masjid Baiturrahmah';
        $data['about'] = $this->get_about();
        $data['infaq'] = $this->sum_transaction(1);
        $data['zakat_mal'] = $this->sum_transaction(2);
        $data['zakat_fitrah'] = $this->sum_transaction(3);
        $data['kas'] = $this->sum_transaction(4);
        $data['kegiatan'] = $this->get_data('m_kegiatan');
        $data['banner'] = $this->get_data('m_banner');
        $data['pengurus'] = $this->get_data('m_pengurus');
        $data['berita'] = $this->get_data('m_berita', 3);
        $this->load->view('home/index', $data);
    }

    public function sum_transaction($trans_type_id)
    {
        $this->db->select('saldo');
        $this->db->from('m_trans_type');
        $this->db->where('id', $trans_type_id);
        $q = $this->db->get();
        return $q->row();
    }

    public function get_about()
    {
        $about = $this->db->get_where('m_about', ['id'=>1])->row();
        return $about;
    }

    public function get_data($table, $limit = null)
    {
        if ($limit) {
            $this->db->limit($limit);
            $this->db->order_by('id', 'desc');
        }
        $data = $this->db->get($table)->result_object();
        return $data;
    }
}