<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/tabungan_qurban/Group_model');
    }

	public function index()
	{
        $data['title'] = 'Group';
        $data['isi'] = 'admin/tabungan_qurban/group/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/tabungan_qurban/group/simpan');
        $data['data'] = base_url('admin/tabungan_qurban/group/data');
        $data['get'] = base_url('admin/tabungan_qurban/group/get_data');
        $data['hapus'] = base_url('admin/tabungan_qurban/group/hapus');
        $data['cetak'] = base_url('admin/tabungan_qurban/group/cetak');
        $data['select_jamaah'] = base_url('admin/tabungan_qurban/group/select_jamaah');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Group_model->lists(
            'm_jamaah_group.*',
            $where, 
            $this->input->post('length'), 
            $this->input->post('start')
        );
		if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['name'] = $ls['name'];
                $row['jamaah'] = $this->get_jamaah_group($ls['id']);
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Group_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Group_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['m_jamaah_group.id'] = $this->input->get('id', TRUE);
        $select = "m_jamaah_group.*";

        $list = $this->Group_model->get($where, $select);

        if ($list) {
            $row = array();
            $row['name'] = $list->name;
            $row['jamaah'] = $this->get_jamaah_group($list->id);
            $row['id'] = $list->id;
        }

        $data['jamaah_group'] = (object)$row;
        
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
        $savedata['name'] = $this->input->post('name', TRUE);
        $jamaah_ids = $this->input->post('jamaah_id');
        
        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
            $jamaah_group_id = $this->input->post('id');
			$this->Group_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
            if (count($jamaah_ids) > 0) {
                $this->Group_model->table = "m_jamaah_group_map";
                $this->Group_model->delete(['jamaah_group_id' => $jamaah_group_id]);
                foreach ($jamaah_ids as $jamaah_id) {
                    $savedata_detail['jamaah_group_id'] = $jamaah_group_id;
                    $savedata_detail['jamaah_id'] = $jamaah_id;
                    $this->Group_model->insert($savedata_detail);
                }
            }
        } else { 
            //create
			$jamaah_group_id = $this->Group_model->insert($savedata, true);
            if ($jamaah_group_id) {
                if (count($jamaah_ids) > 0) {
                    foreach ($jamaah_ids as $jamaah_id) {
                        $this->Group_model->table = "m_jamaah_group_map";
                        $savedata_detail['jamaah_group_id'] = $jamaah_group_id;
                        $savedata_detail['jamaah_id'] = $jamaah_id;
                        $this->Group_model->insert($savedata_detail);
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
        
        redirect(base_url('admin/tabungan_qurban/group'), 'refresh');
    }

    public function hapus()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Group_model->delete($where);

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
            m_jamaah_group.*
        ";
        $list = $this->Group_model->get_all($where, $select);
        $no = 1;
        if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['name'] = $ls['name'];
                $row['jamaah'] = count($this->get_jamaah_group($ls['id'])) > 0 ? implode(',', array_column($this->get_jamaah_group($ls['id']), 'jamaah_name')) : '';
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}

        $data['data'] = $temp_data;
        $data['title'] = 'Data Group';

        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $data['title'];
        $this->pdf->load_view('admin/tabungan_qurban/group/cetak', $data);
    }

    public function select_jamaah()
    {
        $q = $this->input->get('q');
        $where = [];
        $this->Group_model->order_by = "id";
        $this->Group_model->order_type = "ASC";
        $this->Group_model->search_field = "name";
        $this->Group_model->column_search = "name";
        $this->Group_model->table = "m_jamaah";
        $data = $this->Group_model->list_select($q, $where);
        echo json_encode($data);
    }
}
