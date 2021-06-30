<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/pengaturan_web/Pengurus_model');
    }

	public function index()
	{
        $data['title'] = 'Pengurus';
        $data['isi'] = 'admin/pengaturan_web/pengurus/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/pengaturan_web/pengurus/simpan');
        $data['data'] = base_url('admin/pengaturan_web/pengurus/data');
        $data['get'] = base_url('admin/pengaturan_web/pengurus/get_data');
        $data['hapus'] = base_url('admin/pengaturan_web/pengurus/hapus');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function data()
    {
        $temp_data = [];
        $where = [];
        $no = $this->input->post('start');
        $list = $this->Pengurus_model->lists(
            '*',
            $where, 
            $this->input->post('length'), 
            $this->input->post('start')
        );
		if($list) {
			foreach ($list as $ls) {
				$no++;
				$row = array();
                $row['no'] = $no;
				$row['picture'] = $ls['picture'];
				$row['name'] = $ls['name'];
				$row['profession'] = $ls['profession'];
				$row['id'] = $ls['id'];
	
				$temp_data[] = (object)$row;
			}
		}
		
		$data['draw'] = $this->input->post('draw');
		$data['recordsTotal'] = $this->Pengurus_model->list_count($where, true);
		$data['recordsFiltered'] = $this->Pengurus_model->list_count($where, true);
        $data['data'] = $temp_data;
        echo json_encode($data);
    }

    public function get_data()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $select = "*";
        $data['pengurus'] = $this->Pengurus_model->get($where, $select);
        
        echo json_encode($data);
    }

    public function simpan()
    {

        $picture = null;
        // picture
        if($_FILES['picture']['tmp_name']) {
            $picture_data = $this->upload_data('picture');
            if(isset($picture_data['type']) && $picture_data['type'] == 'error') {
                $msg = $picture_data;
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/pengaturan_web/pengurus'), 'refresh');
                exit;
            }
            $picture = base_url('assets/uploads/').$picture_data['file_name'];
        }

        $savedata['name'] = $this->input->post('name', TRUE);
        $savedata['profession'] = $this->input->post('profession', TRUE);
        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
            $banner = $this->Pengurus_model->get(['id'=>$this->input->post('id')]);
            if ($picture) {
                $picture_path = substr($banner->picture, strlen(base_url()));
                if (file_exists($picture_path)) {
                    unlink($picture_path);
                }
                $savedata['picture'] = $picture;
            }else {
                $savedata['picture'] = $banner->picture;
            }
			$this->Pengurus_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
        } else { 
            //create
            if ($picture) {
                $savedata['picture'] = $picture;
            }
            $this->Pengurus_model->insert($savedata);
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
        
        redirect(base_url('admin/pengaturan_web/pengurus'), 'refresh');
    }

    public function hapus()
    {
        $where['id'] = $this->input->get('id', TRUE);
        $this->db->trans_begin();
        $this->Pengurus_model->delete($where);

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

    public function upload_data($field_name)
    {
        $config['upload_path']          = './assets/uploads';
        $config['allowed_types']        = 'png|jpg|jpeg';
        $config['max_size']             = 2048; // 2mb

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload($field_name)) {
            $error = [
                'error' => $this->upload->display_errors()
            ];
            return [
                'type' => 'error',
                'msg' => strip_tags($error['error'])
            ];
        }else {
            return $this->upload->data();
        }
    }
}
