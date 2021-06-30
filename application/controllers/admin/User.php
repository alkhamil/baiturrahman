<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/User_model');
    }

	public function index()
	{
        $data['title'] = 'User';
        $data['isi'] = 'admin/user/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/user/simpan');
        $data['data'] = base_url('admin/user/data');
        $data['get'] = base_url('admin/user/get_data');
        $data['hapus'] = base_url('admin/user/hapus');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->User_model->lists(
            'm_user.*',
            $where, 
            $this->input->post('length'), 
            $this->input->post('start')
        );
		if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['username'] = $ls['username'];
				$row['password'] = $ls['password'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->User_model->list_count($where, true);
		$data['recordsFiltered'] = $this->User_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['m_user.id'] = $this->input->get('id', TRUE);
        $select = "m_user.*";
        $data['user'] = $this->User_model->get($where, $select);
        
        echo json_encode($data);
    }

    public function simpan()
    {
        $savedata['username'] = $this->input->post('username', TRUE);
        $savedata['password'] = password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT);

        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
			$this->User_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
        } else { 
            //create
			$this->User_model->insert($savedata);
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
        
        redirect(base_url('admin/user'), 'refresh');
    }

    public function hapus()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->User_model->delete($where);

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
