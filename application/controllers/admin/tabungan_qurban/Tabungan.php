<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabungan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/tabungan_qurban/Tabungan_model');
        $this->load->model('admin/tabungan_qurban/Tabungan_detail_model');
        $this->load->model('admin/tabungan_qurban/Hewan_model');
    }

	public function index()
	{
        $data['title'] = 'Tabungan';
        $data['isi'] = 'admin/tabungan_qurban/tabungan/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/tabungan_qurban/tabungan/simpan');
        $data['data'] = base_url('admin/tabungan_qurban/tabungan/data');
        $data['get'] = base_url('admin/tabungan_qurban/tabungan/get_data');
        $data['hapus'] = base_url('admin/tabungan_qurban/tabungan/hapus');
        $data['bayar'] = base_url('admin/tabungan_qurban/tabungan/bayar');
        $data['cetak'] = base_url('admin/tabungan_qurban/tabungan/cetak');
        $data['select_jamaah_group'] = base_url('admin/tabungan_qurban/tabungan/select_jamaah_group');
        $data['data_hewan'] = base_url('admin/tabungan_qurban/tabungan/data_hewan');
        $data['data_jamaah'] = base_url('admin/tabungan_qurban/tabungan/data_jamaah');
        $data['data_tabungan_detail'] = base_url('admin/tabungan_qurban/tabungan/data_tabungan_detail');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Tabungan_model->lists(
            '
                t_tabungan.*,
                m_jamaah_group.id as jamaah_group_id,
                m_jamaah_group.name as jamaah_group_name,
                m_hewan_jenis.name as hewan_jenis_name,
                m_hewan_golongan.name as hewan_golongan_name,
                m_hewan.price as hewan_price
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
				$row['code'] = $ls['code'];
				$row['jamaah'] = $this->get_jamaah_group($ls['jamaah_group_id']);
				$row['jamaah_group_id'] = $ls['jamaah_group_id'];
				$row['jamaah_group_name'] = $ls['jamaah_group_name'];
				$row['hewan_qurban'] = $ls['hewan_jenis_name'].' / '.$ls['hewan_golongan_name'].' / '.number_format($ls['hewan_price']);
				$row['duration'] = $ls['duration']. ' Bulan';
				$row['start_date'] = date('d-M-Y', strtotime($ls['start_date']));
				$row['end_date'] = date('d-M-Y', strtotime($ls['end_date']));
				$row['created_date'] = date('d-M-Y', strtotime($ls['created_date']));
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Tabungan_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Tabungan_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['t_tabungan.id'] = $this->input->get('id', TRUE);
        $select = "
            t_tabungan.*,
            m_jamaah_group.id as jamaah_group_id,
            m_jamaah_group.name as jamaah_group_name,
            m_hewan_jenis.name as hewan_jenis_name,
            m_hewan_golongan.name as hewan_golongan_name,
            m_hewan.price as hewan_price
        ";
        $join = [
            [
                'table'     => 'm_jamaah_group',
                'on'        => 'm_jamaah_group.id = t_tabungan.jamaah_group_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_hewan',
                'on'        => 'm_hewan.id = t_tabungan.hewan_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_hewan_jenis',
                'on'        => 'm_hewan_jenis.id = m_hewan.hewan_jenis_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_hewan_golongan',
                'on'        => 'm_hewan_golongan.id = m_hewan.hewan_golongan_id',
                'type'      => 'left'
            ]
        ];

        $list = $this->Tabungan_model->get($where, $select, $join);

        if ($list) {
            $row = array();
            $row['code'] = $list->code;
            $row['jamaah'] = $this->get_jamaah_group($list->jamaah_group_id);
            $row['jamaah_group_name'] = $list->jamaah_group_name;
            $row['hewan_jenis_name'] = $list->hewan_jenis_name;
            $row['hewan_golongan_name'] = $list->hewan_golongan_name;
            $row['hewan_price'] = $list->hewan_price;
            $row['duration'] = $list->duration;
            $row['start_date'] = $list->start_date;
            $row['end_date'] = $list->end_date;
            $row['id'] = $list->id;
        }
        $data['tabungan'] = (object)$row;
        
        echo json_encode($data);
    }

    public function get_jamaah_group($jamaah_group_id)
    {
        $select = "
            m_jamaah_group_map.*, 
            m_jamaah_group.name as jamaah_group_name,
            m_jamaah.name as jamaah_name
        ";
        $where['m_jamaah_group_map.jamaah_group_id'] = $jamaah_group_id;
        $this->db->select($select)
                 ->join('m_jamaah_group', 'm_jamaah_group.id = m_jamaah_group_map.jamaah_group_id', 'left')
                 ->join('m_jamaah', 'm_jamaah.id = m_jamaah_group_map.jamaah_id', 'left')
                 ->where($where);
        $result = $this->db->get('m_jamaah_group_map');
        return $result->result_object();
    }

    public function simpan()
    {
        $savedata['jamaah_group_id'] = $this->input->post('jamaah_group_id', TRUE);
        $savedata['hewan_id'] = $this->input->post('hewan_id', TRUE);
        $savedata['code'] = 'TBQ'.date('YmdHis');
        $savedata['duration'] = $this->input->post('duration', TRUE);
        $savedata['start_date'] = date('Y-m-d', strtotime($this->input->post('start_date', TRUE)));
        $savedata['end_date'] = date('Y-m-d', strtotime($this->input->post('end_date', TRUE)));
        $savedata['created_by'] = $this->userdata->id;
        $savedata['created_date'] = date('Y-m-d H:i:s');

        $hewan = $this->Hewan_model->get(['m_hewan.id' => $savedata['hewan_id']], "m_hewan.*");

        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
        } else { 
            //create
			$tabungan_id = $this->Tabungan_model->insert($savedata, true);
            if ($tabungan_id) {
                if ($savedata['duration'] > 0) {
                    $old_date = $savedata['start_date'];
                    for ($i=0; $i < $savedata['duration']; $i++) { 
                        $savedata_detail['tabungan_id'] = $tabungan_id;
                        $next_due_date = date('Y-m-d', strtotime($old_date. ' +30 days'));
                        $old_date = $next_due_date;
                        $savedata_detail['due_date'] = $next_due_date;
                        $savedata_detail['pay_date'] = null;
                        $savedata_detail['amount'] = round($hewan->price / $savedata['duration'], 0, PHP_ROUND_HALF_UP);
                        $this->Tabungan_detail_model->insert($savedata_detail);
                    }
                }
            }
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
        
        redirect(base_url('admin/tabungan_qurban/tabungan'), 'refresh');
    }


    public function hapus()
    {        
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Tabungan_model->delete($where);

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

    public function bayar()
    {
        $where['id'] = $this->input->post('id', TRUE);
        $this->db->trans_begin();
        $savedata['pay_date'] = date('Y-m-d');
        $savedata['is_paid'] = 1;
        $this->Tabungan_detail_model->update($savedata, $where);
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $msg = array(
                'type' => 'error',
                'msg' => 'Data tidak terbayar.',
            );
        }else{
            $this->db->trans_commit();
            $msg = array(
                'type' => 'success',
                'msg' => 'Data berhasil dibayar.',
            );
        }
        echo json_encode($msg);
    }

    public function cetak()
    {
        $where['t_tabungan.id'] = $this->input->get('id', TRUE);
        
        $select = "
            t_tabungan.*, 
            m_jamaah_group.id as jamaah_group_id,
            m_hewan.price as hewan_price,
            m_hewan_jenis.name as hewan_jenis_name,
            m_hewan_golongan.name as hewan_golongan_name
        ";
        
        $join = [
            [
                'table'     => 'm_jamaah_group',
                'on'        => 'm_jamaah_group.id = t_tabungan.jamaah_group_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_hewan',
                'on'        => 'm_hewan.id = t_tabungan.hewan_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_hewan_jenis',
                'on'        => 'm_hewan_jenis.id = m_hewan.hewan_jenis_id',
                'type'      => 'left'
            ],
            [
                'table'     => 'm_hewan_golongan',
                'on'        => 'm_hewan_golongan.id = m_hewan.hewan_golongan_id',
                'type'      => 'left'
            ]
        ];
        $list = $this->Tabungan_model->get($where, $select, $join);

        if ($list) {
            $row = array();
            $row['code'] = $list->code;
            $row['created_date'] = date('d/m/Y', strtotime($list->created_date));
            $row['start_date'] = date('d/m/Y', strtotime($list->start_date));
            $row['end_date'] = date('d/m/Y', strtotime($list->end_date));
            $row['duration'] = $list->duration . ' Bulan';
            $row['hewan_qurban'] = $list->hewan_jenis_name . ' / ' . $list->hewan_golongan_name . ' / ' . number_format($list->hewan_price);
            $row['jamaah'] = $this->get_jamaah_group($list->jamaah_group_id);
            $row['detail'] = $this->get_tabungan_detail($list->id);
            $row['id'] = $list->id;
        }

        $data['data'] = (object)$row;
        $data['title'] = 'Lampiran Tabungan Qurban';

        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $data['title'];
        $this->pdf->load_view('admin/tabungan_qurban/tabungan/cetak', $data);

    }

    public function get_tabungan_detail($tabungan_id)
    {
        $where['t_tabungan_detail.tabungan_id'] = $tabungan_id;
        $select = "
            t_tabungan_detail.*
        ";
        $list = $this->Tabungan_detail_model->get_all($where, $select);
        return $list;
    }

    public function select_jamaah_group()
    {
        $q = $this->input->get('q');
        $where = [];
        $this->Tabungan_model->order_by = "id";
        $this->Tabungan_model->order_type = "ASC";
        $this->Tabungan_model->search_field = "name";
        $this->Tabungan_model->column_search = "name";
        $this->Tabungan_model->table = "m_jamaah_group";
        $data = $this->Tabungan_model->list_select($q, $where);
        echo json_encode($data);
    }

    public function data_hewan()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Hewan_model->lists(
            '
                m_hewan.*,
                m_hewan_jenis.name as hewan_jenis_name,
                m_hewan_golongan.name as hewan_golongan_name,
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
				$row['hewan_jenis_name'] = $ls['hewan_jenis_name'];
				$row['hewan_golongan_name'] = $ls['hewan_golongan_name'];
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

    public function data_jamaah()
    {
        $temp_data = [];
        $jamaah_group_id = $this->input->post('jamaah_group_id', true);
        $list = $this->get_jamaah_group($jamaah_group_id);
        $no=0;
        if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
                $row['jamaah_name'] = $ls->jamaah_name;
				$temp_data[] = (object)$row;
			}
        }
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = count($list);
		$data['recordsFiltered'] = count($list);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function data_tabungan_detail()
    {
        $temp_data = [];
        $tabungan_id = $this->input->post('tabungan_id', true);
        $where['t_tabungan_detail.tabungan_id'] = $tabungan_id;
        $no = $this->input->post('start');
        $list = $this->Tabungan_detail_model->lists(
            '
                t_tabungan_detail.*
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
				$row['amount'] = $ls['amount'];
				$row['is_paid'] = $ls['is_paid'];
				$row['due_date'] = date('d-m-Y', strtotime($ls['due_date']));
				$row['pay_date'] = $ls['pay_date'] !== null ? date('d-m-Y', strtotime($ls['pay_date'])) : '';
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Tabungan_detail_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Tabungan_detail_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }
}
