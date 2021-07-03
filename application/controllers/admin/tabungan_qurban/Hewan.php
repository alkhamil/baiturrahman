<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hewan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/tabungan_qurban/Hewan_model');
    }

	public function index()
	{
        $data['title'] = 'Hewan';
        $data['isi'] = 'admin/tabungan_qurban/hewan/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/tabungan_qurban/hewan/simpan');
        $data['data'] = base_url('admin/tabungan_qurban/hewan/data');
        $data['get'] = base_url('admin/tabungan_qurban/hewan/get_data');
        $data['hapus'] = base_url('admin/tabungan_qurban/hewan/hapus');
        $data['cetak'] = base_url('admin/tabungan_qurban/hewan/cetak');
        $data['select_hewan_jenis'] = base_url('admin/tabungan_qurban/hewan/select_hewan_jenis');
        $data['select_hewan_golongan'] = base_url('admin/tabungan_qurban/hewan/select_hewan_golongan');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Hewan_model->lists(
            '
                m_hewan.*,
                m_hewan_jenis.name as hewan_jenis,
                m_hewan_golongan.name as hewan_golongan
            ',
            $where, 
            $this->input->post('length'), 
            $this->input->post('start')
        );
		if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['hewan_jenis'] = $ls['hewan_jenis'];
				$row['hewan_golongan'] = $ls['hewan_golongan'];
				$row['weight'] = $ls['weight'];
				$row['label'] = $ls['label'];
				$row['price'] = $ls['price'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Hewan_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Hewan_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['m_hewan.id'] = $this->input->get('id', TRUE);
        $select = "
            m_hewan.*,
            m_hewan_jenis.id as hewan_jenis_id,
            m_hewan_jenis.name as hewan_jenis_name,
            m_hewan_golongan.id as hewan_golongan_id,
            m_hewan_golongan.name as hewan_golongan_name
        ";
        $join = [
            [
                'table'     => 'm_hewan_jenis',
                'on'        => 'm_hewan_jenis.id = m_hewan.hewan_jenis_id'
            ],
            [
                'table'     => 'm_hewan_golongan',
                'on'        => 'm_hewan_golongan.id = m_hewan.hewan_golongan_id'
            ]
        ];

        $data['hewan'] = $this->Hewan_model->get($where, $select, $join);

        echo json_encode($data);
    }

    public function simpan()
    {
        $savedata['hewan_jenis_id'] = $this->input->post('hewan_jenis_id', TRUE);
        $savedata['hewan_golongan_id'] = $this->input->post('hewan_golongan_id', TRUE);
        $savedata['label'] = $this->input->post('label', TRUE);
        $savedata['weight'] = $this->input->post('weight', TRUE);
        $savedata['price'] = $this->input->post('price', TRUE);
        
        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
			$this->Hewan_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
        } else { 
            //create
			$this->Hewan_model->insert($savedata);
        }

        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $msg = array(
                'type' => 'error',
                'msg' => 'Data tidak berhasil disimpan',
            );
        }else {
            $this->db->trans_commit();
            $msg = array(
                'type' => 'success',
                'msg' => 'Data Berhasil disimpan',
            );
        }
        $this->session->set_flashdata('msg', $msg);
        
        redirect(base_url('admin/tabungan_qurban/hewan'), 'refresh');
    }

    public function hapus()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Hewan_model->delete($where);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $msg = array(
                'type' => 'error',
                'msg' => 'Data tidak terhapus.',
            );
        }else{
            $this->db->trans_commit();
            $msg = array(
                'type' => 'success',
                'msg' => 'Data berhasil terhapus.',
            );
        }
        echo json_encode($msg);
    }

    public function cetak()
    {
        $temp_data = [];
        $where = [];
        $select = "
            m_hewan.*,
            m_hewan_jenis.id as hewan_jenis_id,
            m_hewan_jenis.name as hewan_jenis_name,
            m_hewan_golongan.id as hewan_golongan_id,
            m_hewan_golongan.name as hewan_golongan_name
        ";
        $join = [
            [
                'table'     => 'm_hewan_jenis',
                'on'        => 'm_hewan_jenis.id = m_hewan.hewan_jenis_id'
            ],
            [
                'table'     => 'm_hewan_golongan',
                'on'        => 'm_hewan_golongan.id = m_hewan.hewan_golongan_id'
            ]
        ];

        $list = $this->Hewan_model->get_all($where, $select, $join);
        $no = 1;
        if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['hewan_jenis_name'] = $ls['hewan_jenis_name'];
				$row['hewan_golongan_name'] = $ls['hewan_golongan_name'];
				$row['weight'] = $ls['weight'];
				$row['label'] = $ls['label'];
				$row['price'] = $ls['price'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}

        $data['data'] = $temp_data;
        $data['title'] = 'Data Hewan';

        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $data['title'];
        $this->pdf->load_view('admin/tabungan_qurban/hewan/cetak', $data);
    }

    public function select_hewan_jenis()
    {
        $q = $this->input->get('q');
        $where = [];
        $this->Hewan_model->order_by = "id";
        $this->Hewan_model->order_type = "ASC";
        $this->Hewan_model->search_field = "name";
        $this->Hewan_model->column_search = "name";
        $this->Hewan_model->table = "m_hewan_jenis";
        $data = $this->Hewan_model->list_select($q, $where);
        echo json_encode($data);
    }

    public function select_hewan_golongan()
    {
        $q = $this->input->get('q');
        $where = [];
        $this->Hewan_model->order_by = "id";
        $this->Hewan_model->order_type = "ASC";
        $this->Hewan_model->search_field = "name";
        $this->Hewan_model->column_search = "name";
        $this->Hewan_model->table = "m_hewan_golongan";
        $data = $this->Hewan_model->list_select($q, $where);
        echo json_encode($data);
    }
}
