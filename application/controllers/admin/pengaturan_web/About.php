<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/pengaturan_Web/About_model');
    }

	public function index()
	{
        $data['title'] = 'About';
        $data['isi'] = 'admin/pengaturan_web/about/index';
        $data['userdata'] = $this->userdata;
        $data['simpan'] = base_url('admin/pengaturan_web/about/simpan');
        $data['get'] = base_url('admin/pengaturan_web/about/get_data');
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function get_data()
    {
        $where['m_about.id'] = $this->input->get('id', TRUE);
        $select = "m_about.*";
        $data['about'] = $this->About_model->get($where, $select);
        
        echo json_encode($data);
    }

    public function simpan()
    {

        $logo = null;
        // logo
        if($_FILES['logo']['tmp_name']) {
            $logo_data = $this->upload_data('logo');
            if(isset($logo_data['type']) && $logo_data['type'] == 'error') {
                $msg = $logo_data;
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/pengaturan_web/about'), 'refresh');
                exit;
            }
            $logo = base_url('assets/uploads/').$logo_data['file_name'];
        }

        
        $savedata['name'] = $this->input->post('name', TRUE);
        $savedata['email'] = $this->input->post('email', TRUE);
        $savedata['phone'] = $this->input->post('phone', TRUE);
        $savedata['address'] = $this->input->post('address', TRUE);
        $savedata['desc'] = $this->input->post('desc', TRUE);
        $savedata['map'] = $this->input->post('map', TRUE);

        $this->db->trans_begin();
        if($this->input->post('id')) { 
            // edit
            $about = $this->About_model->get(['id'=>$this->input->post('id')]);
            if ($logo) {
                $image_path = substr($about->logo, strlen(base_url()));
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $savedata['logo'] = $logo;
            }else {
                $savedata['logo'] = $about->logo;
            }
			$this->About_model->update($savedata, array('id' => $this->input->post('id', TRUE)));
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
        
        redirect(base_url('admin/pengaturan_web/about'), 'refresh');
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
