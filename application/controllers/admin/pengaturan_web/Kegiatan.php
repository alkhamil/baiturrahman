<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/pengaturan_web/Kegiatan_model');
    }

	public function index()
	{
        $data['title'] = 'Kegiatan';
        $data['isi'] = 'admin/pengaturan_web/kegiatan/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/pengaturan_web/kegiatan/simpan');
        $data['data'] = base_url('admin/pengaturan_web/kegiatan/data');
        $data['get'] = base_url('admin/pengaturan_web/kegiatan/get_data');
        $data['hapus'] = base_url('admin/pengaturan_web/kegiatan/hapus');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Kegiatan_model->lists(
            'm_kegiatan.*',
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
				$row['icon'] = $ls['icon'];
				$row['desc'] = $ls['desc'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Kegiatan_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Kegiatan_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['m_kegiatan.id'] = $this->input->get('id', TRUE);
        $select = "m_kegiatan.*";
        $data['kegiatan'] = $this->Kegiatan_model->get($where, $select);
        
        echo json_encode($data);
    }

    public function simpan()
    {
        $savedata['name'] = $this->input->post('name', TRUE);
        $savedata['icon'] = $this->input->post('icon', TRUE);
        $savedata['desc'] = $this->input->post('desc', TRUE);

        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
			$this->Kegiatan_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
        } else { 
            //create
			$this->Kegiatan_model->insert($savedata);
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
        
        redirect(base_url('admin/pengaturan_web/kegiatan'), 'refresh');
    }

    public function hapus()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Kegiatan_model->delete($where);

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
}
