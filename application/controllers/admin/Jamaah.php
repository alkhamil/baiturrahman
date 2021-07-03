<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jamaah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Jamaah_model');
    }

	public function index()
	{
        $data['title'] = 'Jamaah';
        $data['isi'] = 'admin/jamaah/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/jamaah/simpan');
        $data['data'] = base_url('admin/jamaah/data');
        $data['get'] = base_url('admin/jamaah/get_data');
        $data['hapus'] = base_url('admin/jamaah/hapus');
        $data['cetak'] = base_url('admin/jamaah/cetak');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Jamaah_model->lists(
            'm_jamaah.*',
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
				$row['phone'] = $ls['phone'];
				$row['address'] = $ls['address'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Jamaah_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Jamaah_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['m_jamaah.id'] = $this->input->get('id', TRUE);
        $select = "m_jamaah.*";
        $data['jamaah'] = $this->Jamaah_model->get($where, $select);
        
        echo json_encode($data);
    }

    public function simpan()
    {
        $savedata['name'] = $this->input->post('name', TRUE);
        $savedata['phone'] = $this->input->post('phone', TRUE);
        $savedata['address'] = $this->input->post('address', TRUE);

        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
			$this->Jamaah_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
        } else { 
            //create
			$this->Jamaah_model->insert($savedata);
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
        
        redirect(base_url('admin/jamaah'), 'refresh');
    }

    public function hapus()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Jamaah_model->delete($where);

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
        $where = [];
        $select = "
            m_jamaah.*
        ";
        $list = $this->Jamaah_model->get_all($where, $select);
        $data['data'] = $list;
        $data['title'] = 'Data Jamaah';

        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $data['title'];
        $this->pdf->load_view('admin/jamaah/cetak', $data);
    }
}
